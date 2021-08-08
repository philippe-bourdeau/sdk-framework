<?php

namespace Stainless\Client\Response\Api\Collection;

use ArrayAccess;
use ArrayIterator;
use IteratorAggregate;
use Psr\Http\Message\ResponseInterface;
use Stainless\Client\Response\Api\BaseResponse;
use Stainless\Client\Response\Api\Collection\Iterator\ImmutableTransformerIterator;

/**
 * Class BaseCollectionResponse
 * @package Stainless\Client\Response\Api\Collection
 */
abstract class BaseCollectionResponse extends BaseResponse implements IteratorAggregate, ArrayAccess
{
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
    }

    /**
     * Retrieve an external iterator
     *
     * @link  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @since 5.0.0
     * @return ArrayIterator
     */
    public function getIterator()
    {
        return new ImmutableTransformerIterator(
            function (array $data) {
                return static::toItem($data);
            },
            $this->toArray()
        );
    }

    /**
     * Whether a offset exists
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return $this->getIterator()->offsetExists($offset);
    }

    /**
     * Offset to retrieve
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->getIterator()->offsetGet($offset);
    }

    /**
     * Offset to set
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->getIterator()->offsetSet($offset, $value);
    }

    /**
     * Offset to unset
     *
     * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        $this->getIterator()->offsetUnset($offset);
    }
}
