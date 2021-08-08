<?php

namespace Stainless\Client\Request\Api;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Stainless\Client\Response\Api\IResponse;

/**
 * Interface IRequest
 *
 * Request sent to the API server.
 *
 * @package Stainless\Client\Request\Api
 */
interface IRequest extends RequestInterface
{
    /**
     * options to be added to the request
     *
     * @return array
     */
    public function options(): array;

    /**
     * Process the data that is in the response.
     *
     * @param ResponseInterface $response
     * @return IResponse
     */
    public function response(ResponseInterface $response): IResponse;
}
