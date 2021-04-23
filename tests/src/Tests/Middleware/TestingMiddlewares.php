<?php


namespace ZEROSPAM\Framework\SDK\Test\Tests\Middleware;

use ZEROSPAM\Framework\SDK\Middleware\AddRequestHeaderMiddleware;

class TestingMiddlewares
{
    /**
     * Middleware that handles request redirects.
     *
     * @param string $name
     * @param string $value
     * @return callable Returns a function that accepts the next handler.
     */
    public static function addRequestHeader(string $name, string $value): callable
    {
        return static function (callable $handler) use ($name, $value): AddRequestHeaderMiddleware {
            return new AddRequestHeaderMiddleware($handler, $name, $value);
        };
    }
}
