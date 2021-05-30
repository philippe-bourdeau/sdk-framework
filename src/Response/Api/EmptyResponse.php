<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-07-16
 * Time: 09:55
 */

namespace Stainless\Client\Response\Api;

use Exception;
use Stainless\Client\Utils\Contracts\DataObject;

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
     * @param $name
     *
     * @throws Exception
     */
    public function __get($name)
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

    public function populateDataObject(DataObject &$dataObject): void
    {
        // TODO: Implement populateDataObject() method.
    }
}
