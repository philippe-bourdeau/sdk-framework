<?php

namespace Stainless\Client\Request\Api;

use Stainless\Client\Utils\Str;

trait HasRouteBindings
{
    private array $routeBindings = [];

    /**
     * @param int|string $key
     * @param $value
     */
    protected function addRouteBinding(int|string $key, $value): void
    {
        $this->routeBindings[$key] = $value;
    }

    /**
     * Is the binding set.
     *
     * @param $key
     *
     * @return bool
     */
    protected function hasRouteBinding($key): bool
    {
        return isset($this->routeBindings[$key]);
    }

    public function uri(): string
    {
        $bindingsPatterns = array_map(
            function ($item) {
                return ':' . $item;
            },
            array_keys($this->routeBindings)
        );

        $url = str_replace($bindingsPatterns, array_values($this->routeBindings), $this->baseRoute());

        if (Str::contains($url, ':')) {
            throw new \InvalidArgumentException('One or more route bindings are not set.');
        }

        return $url;
    }

    /**
     * Base route without binding.
     *
     * @return string
     */
    abstract public function baseRoute(): string;
}
