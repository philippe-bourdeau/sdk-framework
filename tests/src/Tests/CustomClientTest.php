<?php


namespace ZEROSPAM\Framework\SDK\Test\Tests;


use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use ZEROSPAM\Framework\SDK\Test\Base\Client\CustomTestClient;
use ZEROSPAM\Framework\SDK\Test\Base\Client\CustomTestClientConfiguration;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Request\TestRequest;

class CustomClientTest extends TestCase
{
    public function testDefaultHeader()
    {
        $client = $this->prepareQueue([
            new Response(200),
        ]);

        $client->processRequest(new TestRequest());

        $transaction = $client->lastTransaction();
        $testHeader = $transaction->request()->getHeader('X-Custom-Test-Client-Header');

        $this->assertEquals($testHeader[0], 'Test Value');
    }

    protected function prepareQueue(array $queue): CustomTestClient
    {
        return new CustomTestClient(
            new MockHandler($queue),
            new CustomTestClientConfiguration('http://127.0.2.1')
        );
    }
}
