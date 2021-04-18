<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 30/05/18
 * Time: 4:35 PM.
 */

namespace ZEROSPAM\Framework\SDK\Request\Api;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;
use ZEROSPAM\Framework\SDK\Response\Api\IResponse;

/**
 * Class BaseRequest
 *
 * Represent a base request that will be sent to the API Server
 *
 * @package ZEROSPAM\Framework\SDK\Request\Api
 */
abstract class BaseRequest extends Request implements IRequest
{
    protected array $queryParameters = [];

    public function setQueryParameter(string $key, string $value): self
    {
        $this->queryParameters[$key] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function generateOptions(): array
    {
        return [
            'query' => $this->queryParameters,
            'headers' => $this->getHeaders()
        ];
    }

    /**
     * @param ResponseInterface $response
     * @return IResponse
     */
    abstract public function processResponse(ResponseInterface $response): IResponse;
}
