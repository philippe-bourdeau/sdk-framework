<?php

namespace ZEROSPAM\Framework\SDK\Client;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\RequestOptions;
use ZEROSPAM\Framework\SDK\Request\Api\IRequest;
use ZEROSPAM\Framework\SDK\Response\Api\IResponse;

abstract class BaseClient implements IClient
{
    protected ?ClientInterface $client;

    /**
     * Client constructor
     * Override client with your own custom client/handler or use configuration values
     *
     * @param string $baseUri
     * @param array $headers
     * @param HandlerStack|null $handler
     */
    public function __construct(
        string $baseUri,
        array $headers = [],
        HandlerStack $handler = null
    ) {
        $options = [];
        $options[RequestOptions::HEADERS] = $headers;
        $options['base_uri'] = $baseUri;
        if ($handler) {
            $options['handler'] = $handler;
        }
        $this->client = $client = new Client($options);
    }

    /**
     * Process the given request and return an array containing the results.
     *
     * @param IRequest $request
     *
     * @return IResponse
     * @throws GuzzleException
     */
    public function processRequest(IRequest $request): IResponse
    {
        try {
            $response = $this->client->send(
                $request,
                $request->options()
            );

            return $request->response($response);
        } catch (Exception $e) {
            throw $e;
        } catch (GuzzleException $e) {
            throw new $e;
        }
    }
}
