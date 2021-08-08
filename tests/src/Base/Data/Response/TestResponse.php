<?php

namespace Stainless\Client\Test\Base\Data\Response;

use Carbon\Carbon;
use Stainless\Client\Response\Api\BaseResponse;
use stdClass;

/**
 * Class TestResponse.
 *
 * Test Response
 *
 * @property-read stdClass $test
 * @property-read Carbon    $test_date
 */
class TestResponse extends BaseResponse
{
    protected array $dates
        = [
            'test_date',
        ];

    public Company $company;
    public string $color;

    public function getTestAttribute(): \stdClass
    {
        $obj = new \stdClass();
        $obj->test = $this->data['test'];

        return $obj;
    }

    public function setColor(string $color)
    {
        $this->color = $color;
    }

    public function setCompany(array $properties)
    {
        $this->company = new Company(
            $properties['building'],
            $properties['stages']
        );
    }
}

class Company {
    public function __construct(
        public int $building = 0,
        public array $stages = []
    ) {

    }
}
