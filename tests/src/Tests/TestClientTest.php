<?php


namespace ZEROSPAM\Framework\SDK\Test\Tests;


use ZEROSPAM\Framework\SDK\Test\Base\Data\Request\TestRequest;
use ZEROSPAM\Framework\SDK\Test\Base\TestCase;

class TestClientTest extends TestCase
{
    public function testClientDefaultHeaders()
    {
        $client = $this->prepareSuccess([]);

        $client->processRequest(new TestRequest());
        $transaction = $this->lastTransaction($client);

        $header1 = $transaction->request()->getHeader('X-Test-Header-1');
        $this->assertEquals(100, $header1[0]);

        $header2 = $transaction->request()->getHeader('X-Test-Header-2');
        $this->assertEquals(200, $header2[0]);
    }

    public function testRequestMiddleware()
    {
        $client = $this->prepareSuccess([]);

        $client->processRequest(new TestRequest());
        $transaction = $this->lastTransaction($client);

        var_dump($transaction->request()->getHeaders());

        $header1 = $transaction->request()->getHeader('X-Test-Header-1');
        $this->assertEquals('Goods', $header1[0]);
    }
}
