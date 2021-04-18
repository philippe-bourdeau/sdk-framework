<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-01
 * Time: 14:18.
 */

namespace ZEROSPAM\Framework\SDK\Test\Base\Data\Request;

use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use ZEROSPAM\Framework\SDK\Request\Api\BaseRequest;
use ZEROSPAM\Framework\SDK\Request\Type\HTTP_METHOD;
use ZEROSPAM\Framework\SDK\Response\Api\IResponse;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Response\TestResponse;

/**
 * Class TestRequest.
 *
 * @method TestResponse getGuzzleResponse()
 */
class TestRequest extends BaseRequest
{
    /**
     * The url of the route.
     *
     * @return UriInterface
     */
    public function getUri(): UriInterface
    {
        return new Uri('test');
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
