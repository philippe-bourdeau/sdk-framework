<?php
/**
 * Created by PhpStorm.
 * User: pbb
 * Date: 14/08/18
 * Time: 9:10 AM
 */

namespace Stainless\Client\Test\Tests\Enums;


use Stainless\Client\Test\Base\TestCase;
use Stainless\Client\Test\Tests\Utils\Obj\BasicEnum;

class EnumInsensitiveTest extends TestCase
{
    /**
     * @test
     */
    public function byNameInsensitiveSuccess()
    {
        $this->assertTrue(BasicEnum::byNameInsensitive('test')->is(BasicEnum::TEST()));
    }

    /**
     * @test
     */
    public function byValueInsensitiveSuccess()
    {
        $this->assertTrue(BasicEnum::byValueInsensitive('TEST')->is(BasicEnum::TEST()));
    }

    /**
     * @test
     */
    public function getDisplayableValueSuccess()
    {
        $this->assertEquals('test, other', BasicEnum::getDisplayableValues());
    }

    /**
     * @test
     */
    public function getEnumsByNameInsensitive()
    {
        $enums = BasicEnum::getEnumsByNameInsensitive(['test', 'other']);
        $this->assertContains(BasicEnum::TEST(), $enums);
        $this->assertContains(BasicEnum::OTHER(), $enums);
    }

}
