<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-01
 * Time: 15:26.
 */

namespace Stainless\Client\Utils\Contracts\Impl;

use MabeEnum\Enum;

/**
 * Trait PrimalValuedEnumTrait
 *
 * Used with Mabe/Enum package
 *
 * @see     Enum
 * @package Stainless\Client\Utils\Contracts\Impl
 */
trait PrimalValuedEnumTrait
{
    public function toPrimitive()
    {
        return $this->getValue();
    }
}
