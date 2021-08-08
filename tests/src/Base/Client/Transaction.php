<?php

namespace Stainless\Client\Test\Base\Client;

use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Transaction
 *
 * Data container for mockup transaction
 *
 * @package Stainless\Client\Test\Base\Container
 */
class Transaction
{
    private RequestInterface $request;
    private ?ResponseInterface $response;
    private array $options;
    private ?GuzzleException $error;

    /**
     * Transaction constructor.
     *
     * @param RequestInterface  $request
     * @param array             $options
     * @param ?ResponseInterface $response
     * @param ?GuzzleException   $error
     */
    public function __construct(
        RequestInterface $request,
        array $options,
        ResponseInterface $response = null,
        GuzzleException $error = null
    ) {
        $this->request  = $request;
        $this->response = $response;
        $this->options  = $options;
        $this->error    = $error;
    }

    /**
     *
     * @return RequestInterface
     */
    public function request(): RequestInterface
    {
        return $this->request;
    }

    /**
     *
     * @return ResponseInterface|null
     */
    public function response(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     *
     * @return array
     */
    public function options(): array
    {
        return $this->options;
    }

    /**
     *
     * @return GuzzleException|null
     */
    public function error(): ?GuzzleException
    {
        return $this->error;
    }
}
