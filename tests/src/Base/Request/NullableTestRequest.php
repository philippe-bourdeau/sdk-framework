<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-07-12
 * Time: 09:51
 */

namespace ZEROSPAM\Framework\SDK\Test\Base\Request;

use ZEROSPAM\Framework\SDK\Request\Api\HasNullableFields;
use ZEROSPAM\Framework\SDK\Request\Api\WithNullableFields;
use ZEROSPAM\Framework\SDK\Request\Type\HTTP_METHOD;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Request\TestRequest;

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

    /**
     * Type of request.
     *
     * @return HTTP_METHOD
     */
    public function getMethod(): HTTP_METHOD
    {
        return HTTP_METHOD::HTTP_POST();
    }

}
