<?php

namespace ZEROSPAM\Framework\SDK\Client;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use ZEROSPAM\Framework\SDK\Configuration\BaseConfiguration;
use ZEROSPAM\Framework\SDK\Configuration\IBaseConfiguration;
use ZEROSPAM\Framework\SDK\Request\Api\IRequest;
use ZEROSPAM\Framework\SDK\Response\Api\IResponse;

abstract class BaseClient implements IClient
{
    protected IBaseConfiguration $configuration;
    protected ?ClientInterface $client;

    /**
     * Client constructor
     * Override client with your own custom client/handler or use configuration values
     *
     * @param IBaseConfiguration $configuration
     * @param ClientInterface|null $guzzleClient
     */
    public function __construct(IBaseConfiguration $configuration, ClientInterface $guzzleClient = null)
    {
        $this->configuration = $configuration;
        $this->client = $guzzleClient;
        if (!$this->client) {
            $this->client = $client = new Client(
                [
                    'base_uri' => $configuration->getBaseUri(),
                    'headers' => $configuration->defaultHeaders(),
                    'handler' => $configuration->defaultHandler(),
                ]
            );
        }
    }

    /**
     * Get linked configuration
     *
     * @return BaseConfiguration
     */
    public function getConfiguration(): IBaseConfiguration
    {
        return $this->configuration;
    }


    /**
     * Process the given request and return an array containing the results.
     *
     * @param IRequest $request
     *
     * @return IResponse
     * @throws GuzzleException
     * @throws Exception
     */
    public function processRequest(IRequest $request): IResponse
    {
        try {
            $response = $this->client->request(
                $request->getMethod(),
                $request->uri(),
                $request->generateOptions()
            );

            return $request->processResponse($response);
        } catch (Exception $e) {
            throw $e;
        } catch (GuzzleException $e) {
            throw new $e;
        }
    }
}
