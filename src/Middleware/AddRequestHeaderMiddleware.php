<?php

namespace ZEROSPAM\Framework\SDK\Middleware;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;

final class AddRequestHeaderMiddleware
{
    private string $value;
    private string $name;
    /**
     * @var callable
     */
    private $handler;

    /**
     * AddHeaderMiddleware constructor.
     * @param callable $handler
     * @param string $name
     * @param string $value
     */
    public function __construct(callable $handler, string $name, string $value)
    {
        $this->handler = $handler;
        $this->name = $name;
        $this->value = $value;
    }

    public function __invoke(RequestInterface $request, array $options): PromiseInterface
    {
        $fn = $this->handler;
        $request = $request->withHeader($this->name, $this->value);

        return $fn($request, $options);
    }
}
