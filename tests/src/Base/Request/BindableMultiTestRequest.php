<?php

namespace Stainless\Client\Test\Base\Request;

/**
 * Class BindableMultiTestRequest
 *
 * Request to test the URL Multi binding
 *
 * @package Stainless\Client\Test\Base\Request
 */
class BindableMultiTestRequest extends BindableTestRequest
{
    public function baseRoute(): string
    {
        return 'test/:testId/nice/:niceId/super/:niceId';
    }
}
