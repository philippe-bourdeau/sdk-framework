<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-01
 * Time: 15:40.
 */

namespace ZEROSPAM\Framework\SDK\Test\Tests\Request;

use ZEROSPAM\Framework\SDK\Test\Base\Request\BindableMultiTestRequest;
use ZEROSPAM\Framework\SDK\Test\Base\Request\BindableTestRequest;
use ZEROSPAM\Framework\SDK\Test\Base\TestCase;
use ZEROSPAM\Framework\SDK\Test\Tests\Utils\Obj\BasicEnum;

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
    public function bindable_replace_bindings_enum()
    {
        $bindableRequest = new BindableTestRequest();
        $bindableRequest->setNiceId(4)->setTestEnum(BasicEnum::TEST());

        $this->assertEquals('test/test/nice/4', $bindableRequest->uri());
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
        $this->expectException(\InvalidArgumentException::class);

        $bindableRequest = new BindableMultiTestRequest();
        $bindableRequest->setNiceId(new \stdClass());
    }

    /**
     * @test
     */
    public function bindable_failure_exception_array()
    {
        $this->expectException(\InvalidArgumentException::class);

        $bindableRequest = new BindableMultiTestRequest();
        $bindableRequest->setNiceId([]);
    }

    /**
     * @test
     */
    public function bindable_failure_override()
    {
        $this->expectException(\InvalidArgumentException::class);

        $bindableRequest = new BindableMultiTestRequest();
        $bindableRequest->setNiceId(1)->setNiceId(5);
    }

    /**
     * @test
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function bindableRequestResponse()
    {
        $bindableRequest = new BindableTestRequest();
        $bindableRequest->setNiceId(4)->setTestEnum(BasicEnum::TEST());

        $client = $this->prepareClientSuccess([]);
        $response = $client->processRequest($bindableRequest);

        $this->assertEquals('test/test/nice/4', $bindableRequest->uri());
    }
}
