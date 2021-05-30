<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-01
 * Time: 14:19.
 */

namespace Stainless\Client\Test\Base\Data\Response;

use Carbon\Carbon;
use Stainless\Client\Response\Api\BaseResponse;

/**
 * Class TestResponse.
 *
 * Test Response
 *
 * @property-read \stdClass $test
 * @property-read Carbon    $test_date
 */
class TestResponse extends BaseResponse
{
    protected array $dates
        = [
            'test_date',
        ];

    public function getTestAttribute(): \stdClass
    {
        $obj = new \stdClass();
        $obj->test = $this->data['test'];

        return $obj;
    }
}
