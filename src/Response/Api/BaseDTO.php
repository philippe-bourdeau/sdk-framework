<?php


namespace Stainless\Client\Response\Api;


use Carbon\Carbon;
use Illuminate\Support\Str;

class BaseDTO
{
    /** @var array Date fields to be mutated from string to Carbon */
    protected array $dates = [];
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $this->fromArray($data);
    }

    /**
     * @param  array  $data
     * @return array
     */
    private function fromArray(array $data): array
    {
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
        return isset($this->data[$name]);
    }

    /**
     * @param $key
     * @return Carbon|false|mixed|null
     */
    public function __get($key)
    {
        $methodName = sprintf('get%sAttribute', Str::studly($key));
        if (method_exists($this, $methodName)) {
            return call_user_func(
                [
                    $this,
                    $methodName,
                ]
            );
        }

        if (isset($this->dates) && in_array($key, $this->dates)) {
            if (!$dateTime = Carbon::parse($this->data[$key])) {
                throw new \InvalidArgumentException('Date cannot be parsed');
            }

            return $dateTime;
        }

        return $this->data[$key] ?? null;
    }
}
