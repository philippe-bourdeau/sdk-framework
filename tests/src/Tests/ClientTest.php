<?php


namespace ZEROSPAM\Framework\SDK\Test\Tests;

use ZEROSPAM\Framework\SDK\Test\Base\Data\Request\TestRequest;
use ZEROSPAM\Framework\SDK\Test\Base\TestCase;

class ClientTest extends TestCase
{
    public function testDefaultHeaders()
    {
        $client = $this->prepareSuccess([]);

        $request = new TestRequest();
        $client->processRequest($request);
        $transaction = $this->lastTransaction($client);

        $header1 = $transaction->request()->getHeader('X-Test-Header-1');
        $this->assertEquals(100, $header1[0]);

        $header2 = $transaction->request()->getHeader('X-Test-Header-2');
        $this->assertEquals(200, $header2[0]);
    }
}
