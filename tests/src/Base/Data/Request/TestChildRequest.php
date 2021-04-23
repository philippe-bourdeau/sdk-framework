<?php


namespace ZEROSPAM\Framework\SDK\Test\Base\Data\Request;


use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use ZEROSPAM\Framework\SDK\Request\Type\HTTP_METHOD;
use ZEROSPAM\Framework\SDK\Response\Api\IResponse;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Response\TestResponse;

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
