<?php

namespace Stainless\Client\Request\Api;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

/**
 * Class BaseRequest
 *
 * Represent a base request that will be sent to the API Server
 *
 * @package Stainless\Client\Request\Api
 */
abstract class BaseRequest extends Request implements IRequest
{
    public function __construct(array $headers = [], $body = null)
    {
        parent::__construct(
            $this->getMethod(),
            $this->getUri(),
            $headers,
            $body
        );
    }

    protected array $queryParameters = [];

    public function setQueryParameter(string $key, string $value): self
    {
        $this->queryParameters[$key] = $value;

        return $this;
    }

    /**
     * @return array
     */
    #[Pure]
    #[ArrayShape([RequestOptions::QUERY => "array", RequestOptions::HEADERS => "array"])]
    public function options(): array
    {
        return [
            RequestOptions::QUERY => $this->queryParameters,
            RequestOptions::HEADERS => $this->getHeaders(),
        ];
    }
}
