<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 30/05/18
 * Time: 4:49 PM.
 */

namespace ZEROSPAM\Framework\SDK\Request\Api;

use Psr\Http\Message\ResponseInterface;
use ZEROSPAM\Framework\SDK\Response\Api\IResponse;

/**
 * Interface IRequest
 *
 * Request sent to the API server.
 *
 * @package ZEROSPAM\Framework\SDK\Request\Api
 */
interface IRequest
{
    /**
     * The url of the route.
     *
     * @return string
     */
    public function uri(): string;

    /**
     * @return array
     */
    public function generateOptions(): array;

    /**
     * Process the data that is in the response.
     *
     * @param ResponseInterface $response
     * @return IResponse
     */
    public function processResponse(ResponseInterface $response): IResponse;

    /**
     */
    public function method(): string;
}
