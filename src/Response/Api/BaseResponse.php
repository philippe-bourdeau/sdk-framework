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
abstract class BaseResponse extends Response implements ResponseInterface, IResponse
{
    /**
     * Dates to be transTyped from string to Carbon.
     *
     * @var string[]
     */
    protected array $dates = [];

    /**
     * @var array
     */
    public array $cache;

    /**
     * Get a specific field.
     *
     * @param string $field
     *
     * @return mixed|null
     */
    public function get(string $field)
    {
        $methodName = 'get' . Str::studly($field) . 'Attribute';

        if (method_exists($this, $methodName)) {
            if (isset($this->cache[$field])) {
                return $this->cache[$field];
            }

            return $this->cache[$field] = call_user_func(
                [
                    $this,
                    $methodName,
                ]
            );
        }

        if (isset($this->dates) && in_array($field, $this->dates)) {
            if (isset($this->cache[$field])) {
                return $this->cache[$field];
            }

            if (!isset($this->data[$field])) {
                return;
            }

            if (!$dateTime = Carbon::parse($this->data[$field])) {
                throw new \InvalidArgumentException('Date cannot be parsed');
            }

            return $this->cache[$field] = $dateTime;
        }

        if (isset($this->data[$field])) {
            return $this->data[$field];
        }
    }

    public function __isset($name)
    {
        $methodName = 'get' . Str::studly($name) . 'Attribute';

        return isset($this->data[$name])
            || method_exists($this, $methodName)
            || (isset($this->dates) && in_array($name, $this->dates));
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    /**
     * @return array
     */
    public function bodyToArray(): array
    {
        $contents = $this->getBody()->getContents();
        if (empty($contents)) {
            return [];
        }

        return Utils::jsonDecode($contents, true);
    }
}
