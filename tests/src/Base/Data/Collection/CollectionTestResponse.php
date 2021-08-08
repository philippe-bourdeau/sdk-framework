<?php

namespace Stainless\Client\Test\Base\Data\Collection;

use JetBrains\PhpStorm\Pure;
use Psr\Http\Message\ResponseInterface;
use Stainless\Client\Response\Api\Collection\CollectionResponse;
use Stainless\Client\Response\Api\IResponse;

class CollectionTestResponse extends CollectionResponse implements IResponse
{
    /**
     * CollectionTestResponse constructor.
     *
     * @param  ResponseInterface  $response
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
    }

    /**
     * @param array $data
     *
     * @return CollectionTestResponseItem
     */
    #[Pure]
    protected static function toCollectionItem(array $data): CollectionTestResponseItem
    {
        return new CollectionTestResponseItem($data);
    }
}
