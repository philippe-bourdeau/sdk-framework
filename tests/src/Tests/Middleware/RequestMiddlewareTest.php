<?php

namespace Stainless\Client\Test\Tests\Middleware;

use Stainless\Client\Test\Base\Data\Request\TestRequest;
use Stainless\Client\Test\Base\TestCase;

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
