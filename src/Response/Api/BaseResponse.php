<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 30/05/18
 * Time: 4:08 PM.
 */

namespace ZEROSPAM\Framework\SDK\Response\Api;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Utils;
use Psr\Http\Message\ResponseInterface;
use ZEROSPAM\Framework\SDK\Utils\Str;

/**
 * Class BaseResponse
 *
 * @package ZEROSPAM\Framework\SDK\Response\Api
 */
abstract class BaseResponse extends Response implements IResponse
{
    /**
     * Dates to be transTyped from string to Carbon.
     *
     * @var string[]
     */
    protected array $dates = [];

    protected array $data;

    /**
     * @var ResponseInterface
     */
    private ResponseInterface $guzzleResponse;

    public function __construct(ResponseInterface $response)
    {
        $this->guzzleResponse = $response;
        $this->data = $this->bodyToArray();

        parent::__construct(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );
    }

    /**
     * @return array
     */
    public function bodyToArray(): array
    {
        $contents = $this->guzzleResponse->getBody()->getContents();
        if (empty($contents)) {
            return [];
        }

        return Utils::jsonDecode($contents, true);
    }

    public function __isset($name)
    {
        return isset($this->data[$name])
            || method_exists($this, sprintf('get%sAttribute', Str::studly($name)))
            || (isset($this->dates) && in_array($name, $this->dates));
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * Get a specific field.
     *
     * @param string $field
     *
     * @return mixed|null
     */
    public function get(string $field)
    {
        $methodName = sprintf('get%sAttribute', Str::studly($field));
        if (method_exists($this, $methodName)) {
            return call_user_func(
                [
                    $this,
                    $methodName,
                ]
            );
        }

        if (isset($this->dates) && in_array($field, $this->dates)) {
            if (!$dateTime = Carbon::parse($this->data[$field])) {
                throw new \InvalidArgumentException('Date cannot be parsed');
            }

            return $dateTime;
        }

        return $this->data[$field] ?? null;
    }
}
