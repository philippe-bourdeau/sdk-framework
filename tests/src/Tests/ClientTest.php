<?php


namespace Stainless\Client\Test\Tests;

use Stainless\Client\Test\Base\Data\Request\TestRequest;
use Stainless\Client\Test\Base\TestCase;

class ClientTest extends TestCase
{
    public function testDefaultHeaders()
    {
        $client = $this->prepareClientSuccess([]);

        $request = new TestRequest();
        $client->processRequest($request);
        $transaction = $this->lastTransaction($client);

        $header1 = $transaction->request()->getHeader('X-Test-Header-1');
        $this->assertEquals(100, $header1[0]);

        $header2 = $transaction->request()->getHeader('X-Test-Header-2');
        $this->assertEquals(200, $header2[0]);
    }

    public function testResponse()
    {
        $client = $this->prepareClientSuccess([
            'test' => 'test_value',
            'nice' => 'job'
        ]);

        $request = new TestRequest();
        $response = $client->processRequest($request);

        $this->assertEquals('test_value', $response->test->test);
        $this->assertEquals('job', $response->nice);
    }

    //TODO:: test mutators (date ...)
}


