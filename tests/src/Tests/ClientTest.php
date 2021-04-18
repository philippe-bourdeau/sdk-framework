<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-01
 * Time: 14:17.
 */

namespace ZEROSPAM\Framework\SDK\Test\Tests;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use ZEROSPAM\Framework\SDK\Response\Api\EmptyResponse;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Request\TestRequest;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Response\TestDataResponse;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Response\TestResponse;
use ZEROSPAM\Framework\SDK\Test\Base\TestCase;

class ClientTest extends TestCase
{
    public function testResponseAttributeBinding(): void
    {
        $client = $this->preSuccess(['test' => 'data']);

        $request = new TestRequest();
        $client->getOAuthTestClient()
               ->processRequest($request);

        $response = $request->getGuzzleResponse();
        $this->assertInstanceOf(\stdClass::class, $response->test);
        $this->assertEquals('data', $response->test->test);
    }

    public function testResponseDateBinding(): void
    {
        $now    = Carbon::now()->startOfMinute();
        $client = $this->preSuccess(['test_date' => $now->toIso8601String()]);

        $request = new TestRequest();
        $client->getOAuthTestClient()
               ->processRequest($request);

        $response = $request->getGuzzleResponse();
        $this->assertInstanceOf(Carbon::class, $response->test_date);
        $this->assertEquals($now, $response->test_date);
    }

    public function testResponseAttributeBypassBinding(): void
    {
        $client = $this->preSuccess(['test' => 'data']);

        $request = new TestRequest();
        $client->getOAuthTestClient()
               ->processRequest($request);

        $response = $request->getGuzzleResponse();
        $this->assertEquals('data', $response->getRawValue('test'));
    }

    public function testResponseAddedField(): void
    {
        $client = $this->preSuccess(['added' => 'field']);

        $request = new TestRequest();
        $client->getOAuthTestClient()
               ->processRequest($request);

        $response = $request->getGuzzleResponse();
        $this->assertThat(isset($response->added), $this->isTrue());
        $this->assertEquals('field', $response->get('added'));
    }

    /**
     */
    public function testResponseAttributeBypassBindingUnavailable(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $client = $this->preSuccess([]);

        $request = new TestRequest();
        $client->getOAuthTestClient()
            ->processRequest($request);

        $response = $request->getGuzzleResponse();
        $this->assertEquals('data', $response->getRawValue('test'));
    }

    public function testResponseDateBindingNull(): void
    {
        $client = $this->preSuccess([]);

        $request = new TestRequest();
        $client->getOAuthTestClient()
               ->processRequest($request);

        $response = $request->getGuzzleResponse();
        $this->assertNull($response->test_date);
    }

    /**
     */
    public function testEmptyResponseNoGet(): void
    {
        $this->expectException(NoActionEmptyResponseException::class);

        (new EmptyResponse())->id;
    }


    /**
     */
    public function testEmptyResponseNoGetMethod(): void
    {
        $this->expectException(NoActionEmptyResponseException::class);

        (new EmptyResponse())->get('test');
    }


    /**
     */
    public function testEmptyResponseNoGetRawMethod(): void
    {
        $this->expectException(NoActionEmptyResponseException::class);

        (new EmptyResponse())->getRawValue('test');
    }

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
