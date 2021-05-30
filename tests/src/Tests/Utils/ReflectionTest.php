<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-01
 * Time: 15:24.
 */

namespace Stainless\Client\Test\Tests\Utils;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Utils;
use Stainless\Client\Test\Base\Data\Response\Data\TestDataObject;
use Stainless\Client\Test\Base\Data\Response\TestResponse;
use Stainless\Client\Test\Base\TestCase;
use Stainless\Client\Test\Tests\Utils\Obj\BasicEnum;
use Stainless\Client\Test\Tests\Utils\Obj\BasicObj;
use Stainless\Client\Test\Tests\Utils\Obj\BasicObjArrayEnum;
use Stainless\Client\Test\Tests\Utils\Obj\BasicObjEnum;
use Stainless\Client\Utils\Reflection\ReflectionUtil;

class ReflectionTest extends TestCase
{
    /**
     * @test
     */
    public function reflection_class_to_array()
    {
        $test = new BasicObj('bar');

        $array = ReflectionUtil::objToSnakeArray($test);
        $this->assertArrayHasKey('foo', $array);
        $this->assertEquals('bar', $array['foo']);
    }

    /**
     * @test
     */
    public function reflection_class_to_array_with_enum()
    {
        $test = new BasicObjEnum(BasicEnum::TEST());
        $array = ReflectionUtil::objToSnakeArray($test);
        $this->assertArrayHasKey('enum',$array);
        $this->assertEquals('test', $array['enum']);
    }

    /**
     * @test
     */
    public function reflection_class_to_array_with_array_enum()
    {
        $test  = new BasicObjArrayEnum([BasicEnum::TEST()]);
        $array = ReflectionUtil::objToSnakeArray($test);
        $this->assertArrayHasKey('enum_array',$array);
        $this->assertEquals(['test'], $array['enum_array']);
    }

    public function testDataPopulateFromResponse(): void
    {
        $date     = 'Wed, 26 Sep 2018 15:43:11 GMT';
        $response = new TestResponse(new Response(
            200,
            [],


        ));
        $dataObj  = \Mockery::mock(new TestDataObject())
                            ->shouldReceive('setTestDate')
                            ->with(Carbon::class)
                            ->andReturnSelf()
                            ->once()
                            ->getMock();

        ReflectionUtil::populateResponseData($response, $dataObj);

        $dataObj->shouldNotHaveReceived('setTest');
    }

    public function testArrayToObject()
    {
        $array = [
            'cool' => [
                'sauce' => 'red',
                'goood' => 'times'
            ],
            'nice' => 'view',
            'plop'
        ];

        $result = ReflectionUtil::arrayToObject($array);

        $this->assertTrue($result->{'cool'}->{'sauce'} === 'red');
    }

    public function testObjectToResponse()
    {
        $array = [
            'cool' => [
                'sauce' => 'red',
                'goood' => 'times',
            ],
            'color' => 'yellow',
            'company' => [
                'building' => 111,
                'stages' => [1, 2, 3]
            ]
        ];

        $response = new TestResponse(new Response(
            200,
            [],
            Utils::jsonEncode($array)
            )
        );

        $this->assertTrue($response->company->building === 111);
    }

}
