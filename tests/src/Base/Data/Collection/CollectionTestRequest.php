<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-20
 * Time: 11:09
 */

namespace ZEROSPAM\Framework\SDK\Test\Base\Data\Collection;

use Psr\Http\Message\ResponseInterface;
use ZEROSPAM\Framework\SDK\Request\Api\BaseRequest;
use ZEROSPAM\Framework\SDK\Request\Type\HTTP_METHOD;
use ZEROSPAM\Framework\SDK\Response\Api\IResponse;

/**
 * Class CollectionTestRequest
 *
 * @method CollectionTestResponse getGuzzleResponse()
 * @package ZEROSPAM\Framework\SDK\Test\Base\Data\Collection
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
     * @return \ZEROSPAM\Framework\SDK\Response\Api\IResponse
     */
    public function processResponse(ResponseInterface $response): IResponse
    {
        return new CollectionTestResponse($response);
    }
}
