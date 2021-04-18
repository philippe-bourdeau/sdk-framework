<?php

namespace ZEROSPAM\Framework\SDK\Test\Base\Client;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use ZEROSPAM\Framework\SDK\Client\BaseClient;
use ZEROSPAM\Framework\SDK\Configuration\IBaseConfiguration;

class CustomTestClient extends BaseClient
{
    private MockHandler $mockHandler;
    private array $container = [];

    /**
     * TestConf constructor.
     *
     * @param MockHandler $mockHandler
     * @param IBaseConfiguration $configuration
     */
    public function __construct(MockHandler $mockHandler, IBaseConfiguration $configuration)
    {
        $this->mockHandler = $mockHandler;
        $this->configuration = $configuration;

        parent::__construct($configuration, $this->buildClient());
    }

    /**
     * Build the client for this configuration.
     *
     * @return ClientInterface
     */
    public function buildClient(): ClientInterface
    {
        $handler = HandlerStack::create($this->mockHandler);
        $handler->push(Middleware::history($this->container));

        return new Client(
            [
                'handler' => $handler,
                'base_uri' => $this->configuration->getBaseUri(),
                'headers' => $this->configuration->defaultHeaders()
            ]
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

    /**
     * Retrieve last transaction in the history container stack
     *
     * @return Transaction|null null if no transaction done
     */
    public function lastTransaction(): ?Transaction
    {
        $last = count($this->container) - 1;
        if ($last < 0) {
            return null;
        }
        $lastTrans = $this->container[$last];

        return new Transaction(
            $lastTrans['request'],
            $lastTrans['options'],
            $lastTrans['response'],
            $lastTrans['error']
        );
    }
}
