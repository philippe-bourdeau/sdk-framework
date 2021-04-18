<?php


namespace ZEROSPAM\Framework\SDK\Test\Tests;


use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use ZEROSPAM\Framework\SDK\Test\Base\Client\TestClient;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Request\TestRequest;

class TestClientTest extends TestCase
{
    public function testHeaders()
    {
        $client = $this->prepareQueue([
            new Response(200),
        ]);

        $client->processRequest(new TestRequest());

        $transaction = $client->lastTransaction();
        $header1 = $transaction->request()->getHeader('X-Test-Header-1');
        $this->assertEquals(100, $header1[0]);

        $header2 = $transaction->request()->getHeader('X-Test-Header-2');
        $this->assertEquals(200, $header2[0]);
    }

    protected function prepareQueue(array $queue): TestClient
    {
        return new TestClient(
            new MockHandler($queue)
        );
    }
}
