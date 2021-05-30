<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-18
 * Time: 11:38
 */

namespace Stainless\Client\Response\Api\Collection;

use Stainless\Client\Utils\Str;

/**
 * Class CollectionPagination
 *
 * @package ProvulusSDK\Client\Response\Collection
 */
class CollectionMetaData
{

    private $metaData = [];

    /**
     * CollectionPagination constructor.
     *
     * @param array $pagination
     */
    public function __construct(array $pagination)
    {
        $this->metaData = $pagination;
    }


    function __isset($name)
    {
        $name = Str::snake($name);

        return isset($this->metaData[$name]);
    }


    function __get($name)
    {
        if (isset($this->{$name})) {
            $name = Str::snake($name);

            return $this->metaData[$name];
        }

        return null;
    }
}
