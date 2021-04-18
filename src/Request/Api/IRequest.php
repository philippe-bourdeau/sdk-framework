<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 30/05/18
 * Time: 4:49 PM.
 */

namespace ZEROSPAM\Framework\SDK\Request\Api;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ZEROSPAM\Framework\SDK\Response\Api\IResponse;

/**
 * Interface IRequest
 *
 * Request sent to the API server.
 *
 * @package ZEROSPAM\Framework\SDK\Request\Api
 */
interface IRequest extends RequestInterface
{
    /**
     * options to be added to the request
     *
     * @return array
     */
    public function options(): array;

    /**
     * Process the data that is in the response.
     *
     * @param ResponseInterface $response
     * @return IResponse
     */
    public function response(ResponseInterface $response): IResponse;
}
