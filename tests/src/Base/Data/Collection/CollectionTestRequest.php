<?php

namespace Stainless\Client\Test\Base\Data\Collection;

use Psr\Http\Message\ResponseInterface;
use Stainless\Client\Request\Api\BaseRequest;
use Stainless\Client\Request\Type\HTTP_METHOD;
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
        return HTTP_METHOD::HTTP_GET()->getValue();
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
