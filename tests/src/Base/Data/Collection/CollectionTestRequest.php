<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-20
 * Time: 11:09
 */

namespace Stainless\Client\Test\Base\Data\Collection;

use Psr\Http\Message\ResponseInterface;
use Stainless\Client\Request\Api\BaseRequest;
use Stainless\Client\Request\Type\HTTP_METHOD;
use Stainless\Client\Response\Api\IResponse;

/**
 * Class CollectionTestRequest
 *
 * @method CollectionTestResponse getGuzzleResponse()
 * @package Stainless\Client\Test\Base\Data\Collection
 */
class CollectionTestRequest extends BaseRequest
{


    /**
     * The url of the route.
     *
     * @return string
     */
    public function uri(): string
    {
        return 'collection';
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
     * @return \Stainless\Client\Response\Api\IResponse
     */
    public function response(ResponseInterface $response): IResponse
    {
        return new CollectionTestResponse($response);
    }
}
