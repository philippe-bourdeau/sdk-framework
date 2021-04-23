<?php


namespace ZEROSPAM\Framework\SDK\Test\Tests\Middleware;

class TestMiddlewares
{
    /**
     * Middleware that handles request redirects.
     *
     * @param string $name
     * @param string $value
     * @return callable Returns a function that accepts the next handler.
     */
    public static function addHeader(string $name, string $value): callable
    {
        return static function (callable $handler) use ($name, $value): AddHeaderMiddleware {
            return new AddHeaderMiddleware($handler, $name, $value);
        };
    }
}
