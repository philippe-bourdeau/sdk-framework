<?php

namespace Stainless\Client\Test\Base\Data\Collection;

use Psr\Http\Message\ResponseInterface;
use Stainless\Client\Response\Api\BaseDTO;
use Stainless\Client\Response\Api\Collection\BaseCollectionResponse;
use Stainless\Client\Response\Api\IResponse;

class BaseCollectionTestResponse extends BaseCollectionResponse implements IResponse
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
     * @return BaseDTO
     */
    protected static function toItem(array $data): BaseDTO
    {
        return new BaseDTO($data);
    }
}
