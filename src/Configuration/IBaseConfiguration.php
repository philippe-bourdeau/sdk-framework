<?php

namespace ZEROSPAM\Framework\SDK\Configuration;

use GuzzleHttp\HandlerStack;

interface IBaseConfiguration
{
    /**
     * End point for Requests.
     *
     * @return string
     */
    public function getBaseUri(): string;

    /**
     * @return array
     */
    public function defaultHeaders(): array;

    /**
     * @return HandlerStack
     */
    public function defaultHandler(): HandlerStack;
}
