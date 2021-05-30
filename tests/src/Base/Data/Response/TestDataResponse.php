<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-07-17
 * Time: 11:02
 */

namespace Stainless\Client\Test\Base\Data\Response;

/**
 * Class TestDataResponse
 *
 * @property-read TestResponse $data
 * @package Stainless\Client\Test\Base\Data
 */
class TestDataResponse extends TestResponse
{
    /**
     * @return TestResponse
     */
    public function getDataAttribute(): TestResponse
    {
        return new TestResponse($this->data);
    }
}
