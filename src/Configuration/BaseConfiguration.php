<?php


namespace ZEROSPAM\Framework\SDK\Configuration;


use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\HandlerStack;

abstract class BaseConfiguration implements IBaseConfiguration
{
    private string $baseUri;

    /**
     * BaseConfiguration constructor.
     * @param string $baseUri
     */
    public function __construct(string $baseUri)
    {
        $this->baseUri = $baseUri;
    }

    /**
     * End point for Requests.
     *
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * @param string|null $token
     * @return array
     */
    public function defaultHeaders(string $token = null): array
    {
        return [];
    }

    /**
     * @return HandlerStack
     */
    public function defaultHandler(): HandlerStack
    {
        $handler = new CurlHandler();

        return HandlerStack::create($handler);
    }
}
