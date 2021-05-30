<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 30/05/18
 * Time: 4:08 PM.
 */

namespace Stainless\Client\Response\Api;

use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Utils;
use Psr\Http\Message\ResponseInterface;
use Stainless\Client\Utils\Str;

/**
 * Class BaseResponse
 *
 * @package Stainless\Client\Response\Api
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
    private ResponseInterface $guzzleResponse;

    public function __construct(ResponseInterface $response)
    {
        $this->guzzleResponse = $response;

        parent::__construct(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );

        $this->setProperties();
    }

    /**
     */
    private function setProperties()
    {
        $this->data = $data = Utils::jsonDecode($this->getBody()->getContents(), true);

        foreach ($data as $key => $value) {
            $method = sprintf('set%s', ucfirst(Str::camel($key)));
            if (!method_exists($this, $method)) {
                continue;
            }

            $this->{$method}($value);
        }
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
