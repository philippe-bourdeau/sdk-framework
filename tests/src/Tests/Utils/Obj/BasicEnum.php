<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-01
 * Time: 15:25.
 */

namespace Stainless\Client\Test\Tests\Utils\Obj;

use MabeEnum\Enum;
use Stainless\Client\Utils\Contracts\Enums\EnumToStringLowerTrait;
use Stainless\Client\Utils\Contracts\Enums\IEnumInsensitive;
use Stainless\Client\Utils\Contracts\Impl\PrimalValuedEnumTrait;
use Stainless\Client\Utils\Contracts\PrimalValued;

/**
 * Class BasicEnum.
 *
 * @method static BasicEnum OTHER()
 * @method static BasicEnum TEST()
 */
class BasicEnum extends Enum implements PrimalValued, IEnumInsensitive
{
    use PrimalValuedEnumTrait,
        EnumToStringLowerTrait;

    const TEST  = 'test';
    const OTHER = 'other';
}
