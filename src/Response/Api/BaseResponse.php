<?php

namespace Stainless\Client\Response\Api;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Utils;
use Psr\Http\Message\ResponseInterface;

/**
 * Class BaseResponse
 *
 * @package Stainless\Client\Response\Api
 */
abstract class BaseResponse extends Response implements IResponse
{
    protected ResponseInterface $guzzleResponse;
    protected BaseDTO $data;

    public function __construct(ResponseInterface $response)
    {
        $this->guzzleResponse = $response;

        parent::__construct(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );

        $this->data = new BaseDTO($this->toArray());
    }

    /**
     * @return array
     */
    protected function toArray(): array {
        return Utils::jsonDecode(
            $this->getBody()->getContents(),
            true
        );
    }
}
