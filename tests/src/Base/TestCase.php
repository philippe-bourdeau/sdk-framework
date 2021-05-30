<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-01
 * Time: 13:51.
 */

namespace Stainless\Client\Test\Base;

use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Utils;
use Mockery as m;
use Stainless\Client\Test\Base\Client\TestClient;
use Stainless\Client\Test\Base\Client\Transaction;

/**
 * Base for making the different tests
 *
 * Help you with a TestClient and preparing different kind of request
 *
 * @package Stainless\Client\Test\Base
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    use ArraySubsetAsserts;

    public function tearDown(): void
    {
        if ($container = m::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }
        m::close();
    }

    /**
     * @param MockHandler $handler
     *
     * @return TestClient
     * @see http://docs.guzzlephp.org/en/latest/testing.html
     *
     */
    protected function getTestClient(MockHandler $handler): TestClient
    {
        return new TestClient($handler);
    }

    /**
     * The last transaction done (first if only one done).
     *
     * @param TestClient $conf
     *
     * @return Transaction|null null if no transaction done
     */
    protected function lastTransaction(TestClient $conf): ?Transaction
    {
        $last = count($conf->getContainer()) - 1;
        if ($last < 0) {
            return null;
        }
        $lastTrans = $conf->getContainer()[$last];

        return new Transaction(
            $lastTrans['request'],
            $lastTrans['options'],
            $lastTrans['response'],
            $lastTrans['error']
        );
    }

    /**
     * All the transaction in order.
     *
     * @param TestClient $conf
     *
     * @return Transaction[]
     */
    protected function allTransactions(TestClient $conf): array
    {
        return array_map(
            function ($transaction) {
                return new Transaction(
                    $transaction['request'],
                    $transaction['options'],
                    $transaction['response'],
                    $transaction['error']
                );
            },
            $conf->getContainer()
        );
    }

    /**
     * Validate that the request did contain the wanted arguments.
     *
     * @param TestClient $config
     * @param string|string[] $requestBody
     */
    protected function validateRequest(TestClient $config, $requestBody): void
    {
        $trans = $this->lastTransaction($config);
        $contents = $trans->request()->getBody()->getContents();
        $decode = [];
        if (!empty($contents)) {
            $decode = \GuzzleHttp\json_decode($contents, true);
        }

        if (is_array($requestBody)) {
            $sent = $requestBody;
        } else {
            $sent = \GuzzleHttp\json_decode($requestBody, true);
        }

        self::assertArraySubset($sent, $decode, false, 'Request contains all we want');
    }

    /**
     * Prepare handler queue for success response
     *
     * @param string|string[] $responseBody
     * @param int $statusCode
     *
     * @return TestClient
     */
    protected function prepareClientSuccess($responseBody, $statusCode = 200): TestClient
    {
        return $this->prepareMockHandlerQueue($responseBody, $statusCode);
    }

    /**
     * Prepare handler queue for failure response
     *
     * @param string|string[] $responseBody
     * @param int $statusCode Set the status code of the response
     *
     * @return TestClient
     */
    protected function prepareFailure($responseBody, $statusCode = 422): TestClient
    {
        return $this->prepareMockHandlerQueue($responseBody, $statusCode);
    }

    protected function prepareMockHandlerQueue($responseBody, int $statusCode): TestClient
    {
        if (is_array($responseBody)) {
            $responseBody = Utils::jsonEncode($responseBody, true);
        }

        $mockHandler = new MockHandler(
            [
                new Response($statusCode, [], $responseBody),
            ]
        );

        return $this->getTestClient($mockHandler);
    }


    /**
     * Used to queue an exception.
     *
     * @param array $queue
     *
     * @return TestClient
     */
    protected function prepareQueue(array $queue): TestClient
    {
        $mockHandler = new MockHandler($queue);

        $config = $this->getTestClient($mockHandler);

        return $config;
    }

    /**
     * Validate that the request URI matches expected Uri
     *
     * @param TestClient $client
     * @param string $expectedUri
     */
    protected function validateRequestUri(TestClient $client, string $expectedUri): void
    {
        $trans = $this->lastTransaction($client);
        $this->assertEquals($expectedUri, $trans->request()->getUri());
    }
}
