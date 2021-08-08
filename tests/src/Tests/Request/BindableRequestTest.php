<?php

namespace Stainless\Client\Test\Tests\Request;

use GuzzleHttp\Exception\GuzzleException;
use InvalidArgumentException;
use Stainless\Client\Test\Base\Data\Response\TestResponse;
use Stainless\Client\Test\Base\Request\BindableMultiTestRequest;
use Stainless\Client\Test\Base\Request\BindableTestRequest;
use Stainless\Client\Test\Base\TestCase;
use stdClass;

class BindableRequestTest extends TestCase
{
    /**
     * @test
     */
    public function bindable_replace_bindings()
    {
        $bindableRequest = new BindableTestRequest();
        $bindableRequest->setNiceId(4)->setTestId(5);

        $this->assertEquals('test/5/nice/4', $bindableRequest->uri());
    }

    /**
     * @test
     */
    public function bindable_replace_bindings_multiple()
    {
        $bindableRequest = new BindableMultiTestRequest();
        $bindableRequest->setNiceId(4)->setTestId(5);

        $this->assertEquals('test/5/nice/4/super/4', $bindableRequest->uri());
    }

    /**
     * @test
     */
    public function bindable_failure_exception_object()
    {
        $this->expectException(InvalidArgumentException::class);

        $bindableRequest = new BindableMultiTestRequest();
        $bindableRequest->setNiceId(new stdClass());
    }

    /**
     * @test
     */
    public function bindable_failure_exception_array()
    {
        $this->expectException(InvalidArgumentException::class);

        $bindableRequest = new BindableMultiTestRequest();
        $bindableRequest->setNiceId([]);
    }

    /**
     * @test
     */
    public function test_multiple_bindings_failure()
    {
        $this->expectException(InvalidArgumentException::class);

        $bindableRequest = new BindableMultiTestRequest();
        $bindableRequest->setNiceId(1)->setNiceId(5);
    }

    /**
     * @test
     * @throws GuzzleException
     */
    public function test_request_and_response()
    {
        $bindableRequest = new BindableTestRequest();
        $bindableRequest->setNiceId(4)->setTestId(1);

        $client = $this->prepareClientSuccess([]);
        $response = $client->processRequest($bindableRequest);

        $this->assertEquals('test/1/nice/4', $bindableRequest->uri());
        $this->assertTrue($response instanceof TestResponse);
    }
}
