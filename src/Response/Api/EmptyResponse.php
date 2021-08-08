<?php

namespace Stainless\Client\Response\Api;

use Exception;

/**
 * Class EmptyResponse
 *
 * Response to represent the code 202
 *
 * @package Stainless\Client\Response\Api
 */
final class EmptyResponse extends BaseResponse
{
    public function __isset($name)
    {
        return false;
    }

    /**
     * @param $field
     *
     * @throws Exception
     */
    public function __get($field)
    {
        throw new Exception('Empty response has no data');
    }

    /**
     * @param $name
     * @param $value
     *
     * @throws Exception
     */
    public function __set($name, $value)
    {
        throw new Exception('Empty response has no data');
    }

    /**
     * Data contained in the response.
     *
     * @return array
     */
    public function data(): array
    {
        return [];
    }
}
