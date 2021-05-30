<?php


namespace Stainless\Client\Test\Base\Data\Request;


use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Stainless\Client\Request\Type\HTTP_METHOD;
use Stainless\Client\Response\Api\IResponse;
use Stainless\Client\Test\Base\Data\Response\TestResponse;

class TestChildRequest extends TestRequest
{
    /**
     * The url of the route.
     *
     * @return UriInterface
     */
    public function getUri(): UriInterface
    {
        return new Uri(parent::getUri() . '/child');
    }

    /**
     */
    public function getMethod(): string
    {
        return HTTP_METHOD::HTTP_GET;
    }

    /**
     * Process the data that is in the response.
     *
     * @param ResponseInterface $response
     *
     * @return IResponse
     */
    public function response(ResponseInterface $response): IResponse
    {
        return new TestResponse($response);
    }
}
