<?php

namespace Stainless\Client\Request\Api;

interface WithNullableFields
{

    /**
     * Is the given field nullable
     *
     * @param $field
     *
     * @return bool
     */
    public function isNullable($field);

    /**
     * Check if the given field is nullable and if it should be included in the request
     *
     * @param $field
     *
     * @return bool
     *
     */
    public function isValueChanged($field);
}
