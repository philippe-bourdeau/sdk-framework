<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-01
 * Time: 14:17.
 */

namespace ZEROSPAM\Framework\SDK\Test\Tests;

use ZEROSPAM\Framework\SDK\Response\Api\EmptyResponse;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Request\TestRequest;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Response\TestDataResponse;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Response\TestResponse;
use ZEROSPAM\Framework\SDK\Test\Base\TestCase;

class ClientTest extends TestCase
{
    /**
     */
    public function testEmptyResponseNoSet(): void
    {
        $this->expectException(NoActionEmptyResponseException::class);

        $emptyResponse     = new EmptyResponse();
        $emptyResponse->id = 'test';
    }

    /**
     */
    public function testEmptyResponseIssetFalse(): void
    {
        $this->assertFalse(isset((new EmptyResponse())->id));
    }

    /**
     */
    public function testEmptyResponseWithRequest(): void
    {
        $client = $this->preSuccess([]);

        $request = \Mockery::mock(TestRequest::class)
                           ->makePartial()
                           ->shouldReceive('processResponse')
                           ->andReturn(new EmptyResponse())
                           ->getMock();

        $client->getOAuthTestClient()
               ->processRequest($request);

        $response = $request->getResponse();
        $this->assertInstanceOf(EmptyResponse::class, $response);
    }

    public function testDataOverride(): void
    {
        $testResponse = new TestDataResponse(['test' => 5]);

        $this->assertInstanceOf(TestResponse::class, $testResponse->data);
        $this->assertEquals(5, $testResponse->data->test->test);
    }
}
