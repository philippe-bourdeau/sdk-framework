<?php

namespace ZEROSPAM\Framework\SDK\Test\Base\Client;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use ZEROSPAM\Framework\SDK\Client\BaseClient;

class TestClient extends BaseClient
{
    private MockHandler $mockHandler;
    private array $container = [];

    /**
     * TestConf constructor.
     *
     * @param MockHandler $mockHandler
     */
    public function __construct(MockHandler $mockHandler)
    {
        $this->mockHandler = $mockHandler;

        $handler = HandlerStack::create($this->mockHandler);
        $handler->push(Middleware::history($this->container));

        parent::__construct(
            'http://127.0.2.1',
            [
                'X-Test-Header-1' => 100,
                'X-Test-Header-2' => 200
            ],
            $handler
        );
    }

    /**
     * Containing the request and response done.
     *
     * @see http://docs.guzzlephp.org/en/latest/testing.html#history-middleware
     *
     * @return array
     */
    public function getContainer(): array
    {
        return $this->container;
    }
}
