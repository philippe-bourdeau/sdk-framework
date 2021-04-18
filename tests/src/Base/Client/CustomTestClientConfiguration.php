<?php


namespace ZEROSPAM\Framework\SDK\Test\Base\Client;


use ZEROSPAM\Framework\SDK\Configuration\BaseConfiguration;

class CustomTestClientConfiguration extends BaseConfiguration
{
    public function defaultHeaders(string $token = null): array
    {
        return [
            'X-Custom-Test-Client-Header' => 'Test Value'
        ];
    }
}
