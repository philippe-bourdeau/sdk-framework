<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-07-12
 * Time: 09:51
 */

namespace Stainless\Client\Test\Base\Request;

use Stainless\Client\Request\Api\HasNullableFields;
use Stainless\Client\Request\Api\WithNullableFields;
use Stainless\Client\Test\Base\Data\Request\TestRequest;

class NullableTestRequest extends TestRequest implements WithNullableFields
{
    use HasNullableFields;
    /**
     * @var null|string
     */
    private $nullField;

    /**
     * @param null|string $nullField
     *
     * @return $this
     */
    public function setNullField(?string $nullField)
    {
        $this->nullableChanged();
        $this->nullField = $nullField;

        return $this;
    }
}
