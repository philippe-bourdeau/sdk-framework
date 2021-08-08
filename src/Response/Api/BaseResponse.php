<?php

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
    /** @var array Date fields to be mutated from string to Carbon */
    protected array $dates = [];
    protected ResponseInterface $guzzleResponse;

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
    }

    protected function unserializeData() {
        return Utils::jsonDecode(
            $this->getBody()->getContents(),
            true
        );
    }

    /**
     * @return array
     */
    protected function toArray(): array {

    }

    /**
     * @return array
     */
    protected function data(): array {
        $data = $this->unserializeData();

        foreach ($data as $key => $value) {
            $method = sprintf('set%s', ucfirst(Str::camel($key)));
            if (!method_exists($this, $method)) {
                continue;
            }

            $this->{$method}($value);
        }

        return $data;
    }

    public function __isset($name)
    {
        return isset($this->data()[$name]);
    }

    /**
     * Mutate attribute if needed
     *
     * @param $field
     * @return Carbon|false|mixed|null
     */
    public function __get($field)
    {
        $methodName = sprintf('get%sAttribute', ucfirst(strtolower($field)));
        if (method_exists($this, $methodName)) {
            return call_user_func(
                [
                    $this,
                    $methodName,
                ]
            );
        }

        if (isset($this->dates) && in_array($field, $this->dates)) {
            if (!$dateTime = Carbon::parse($this->data()[$field])) {
                throw new \InvalidArgumentException('Date cannot be parsed');
            }

            return $dateTime;
        }

        return $this->data()[$field] ?? null;
    }
}
