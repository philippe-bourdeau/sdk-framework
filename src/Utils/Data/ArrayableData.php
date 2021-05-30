<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-09-26
 * Time: 13:08
 */

namespace Stainless\Client\Utils\Data;

use Stainless\Client\Request\Api\HasNullableFields;
use Stainless\Client\Request\Api\WithNullableFields;
use Stainless\Client\Response\Api\IResponse;
use Stainless\Client\Utils\Contracts\DataObject;
use Stainless\Client\Utils\Reflection\ReflectionUtil;

/**
 * Class ArrayableData
 *
 * Data to be used in Request. Will be transform into an array
 * By default use all the available properties to do so.
 *
 * @package Stainless\Client\Utils\Data
 */
abstract class ArrayableData implements DataObject, WithNullableFields
{
    use HasNullableFields;

    /** @var string[] */
    protected $renamed = [];

    /**
     * Create the data from the response
     *
     * @param IResponse $response
     *
     * @return static
     */
    public static function fromResponse(IResponse $response)
    {
        $instance = new static();
        $response->populateDataObject($instance);

        return $instance;
    }

    /**
     * Properties to not serialize into array
     *
     * @return array
     */
    protected static function blacklist(): array
    {
        static $blacklist = ['renamed', 'nullableChanged'];

        return $blacklist;
    }

    /**
     * Return the object as Array.
     *
     * @return array
     * @throws \ReflectionException
     */
    public function toArray(): array
    {
        $data = ReflectionUtil::objToSnakeArray($this, static::blacklist());
        foreach ($this->renamed as $name => $newName) {
            if (!array_key_exists($name, $data)) {
                continue;
            }
            $data[$newName] = $data[$name];
            unset($data[$name]);
        }

        return $data;
    }
}
