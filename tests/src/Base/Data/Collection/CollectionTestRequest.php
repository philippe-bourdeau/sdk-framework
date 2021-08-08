<?php

namespace Stainless\Client\Test\Base\Data\Collection;

use Psr\Http\Message\ResponseInterface;
use Stainless\Client\Request\Api\BaseRequest;
use Stainless\Client\Response\Api\IResponse;

/**
 * Class CollectionTestRequest
 *
 * @package Stainless\Client\Test\Base\Data\Collection
 */
class CollectionTestRequest extends BaseRequest
{
    /**
     * Type of request.
     *
     * @return string
     */
    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     *
     * @param ResponseInterface $response
     *
     * @return IResponse
     */
    public function response(ResponseInterface $response): IResponse
    {
        return new CollectionTestResponse($response);
    }
}
