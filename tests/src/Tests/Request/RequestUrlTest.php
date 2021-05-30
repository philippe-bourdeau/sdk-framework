<?php


namespace Stainless\Client\Test\Tests\Request;


use Stainless\Client\Test\Base\Data\Request\TestChildRequest;
use Stainless\Client\Test\Base\Data\Request\TestRequest;
use Stainless\Client\Test\Base\TestCase;

class RequestUrlTest extends TestCase
{
    public function testChildRequestUrl()
    {
        $client = $this->prepareClientSuccess([]);

        $client->processRequest(new TestChildRequest());
        $this->validateRequestUri($client, 'test/child');
    }

    public function testSingleQueryParameter()
    {
        $client = $this->prepareClientSuccess([]);

        $request = new TestRequest();
        $request->setQueryParameter('foo', 'bar');
        $client->processRequest($request);

        $query = $this->lastTransaction($client)->request()->getUri()->getQuery();

        $this->assertEquals('foo=bar', $query);
    }

    public function testMultipleQueryParameters()
    {
        $client = $this->prepareClientSuccess([]);

        $request = new TestRequest();
        $request->setQueryParameter('foo', 'bar');
        $request->setQueryParameter('kool', 'aid');
        $client->processRequest($request);

        $transaction = $this->lastTransaction($client);
        $query = $transaction->request()->getUri()->getQuery();

        $this->assertEquals('foo=bar&kool=aid', $query);
    }

    public function testUri()
    {
        $client = $this->prepareClientSuccess([]);

        $request = new TestRequest();
        $client->processRequest($request);

        $uri = $this->lastTransaction($client)->request()->getUri();

        $this->assertEquals('test', $uri);
    }
}
