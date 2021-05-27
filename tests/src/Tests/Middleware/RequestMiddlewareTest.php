<?php

namespace ZEROSPAM\Framework\SDK\Test\Tests\Middleware;

use ZEROSPAM\Framework\SDK\Test\Base\Data\Request\TestRequest;
use ZEROSPAM\Framework\SDK\Test\Base\TestCase;

class RequestMiddlewareTest extends TestCase
{
    public function testRequestMiddleware()
    {
        $client = $this->prepareClientSuccess([]);

        $client->processRequest(new TestRequest());
        $transaction = $this->lastTransaction($client);

        $header1 = $transaction->request()->getHeader('X-Test-Middleware-Header');
        $this->assertEquals('Hello World', $header1[0]);
    }
}
