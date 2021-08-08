<?php

namespace Stainless\Client\Request\Type;

use MabeEnum\Enum;

/**
 * Class RequestType.
 *
 * Type of request
 *
 * @method static HTTP_METHOD HTTP_POST()
 * @method static HTTP_METHOD HTTP_GET()
 * @method static HTTP_METHOD HTTP_PUT()
 * @method static HTTP_METHOD HTTP_HEAD()
 * @method static HTTP_METHOD HTTP_DELETE()
 * @method static HTTP_METHOD HTTP_PATCH()
 */
class HTTP_METHOD extends Enum
{
    const HTTP_GET = 'GET';
    const HTTP_POST = 'POST';
    const HTTP_PUT = 'PUT';
    const HTTP_HEAD = 'HEAD';
    const HTTP_DELETE = 'DELETE';
    const HTTP_PATCH = 'PATCH';
}
