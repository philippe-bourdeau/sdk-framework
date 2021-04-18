<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-01
 * Time: 14:18.
 */

namespace ZEROSPAM\Framework\SDK\Test\Base\Data\Request;

use Psr\Http\Message\ResponseInterface;
use ZEROSPAM\Framework\SDK\Request\Api\BaseRequest;
use ZEROSPAM\Framework\SDK\Request\Type\HTTP_METHOD;
use ZEROSPAM\Framework\SDK\Response\Api\IResponse;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Response\TestResponse;

/**
 * Class TestRequest.
 *
 * Test request
 * @method TestResponse getGuzzleResponse()
 */
class TestRequest extends BaseRequest
{
    /**
     * The url of the route.
     *
     * @return string
     */
    public function uri(): string
    {
        return 'test';
    }

    /**
     * Type of request.
     *
     * @return HTTP_METHOD
     */
    public function getMethod(): HTTP_METHOD
    {
        return HTTP_METHOD::HTTP_GET();
    }

    /**
     * Process the data that is in the response.
     *
     * @param ResponseInterface $response
     *
     * @return \ZEROSPAM\Framework\SDK\Response\Api\IResponse
     */
    public function processResponse(ResponseInterface $response): IResponse
    {
        return new TestResponse($response);
    }
}
