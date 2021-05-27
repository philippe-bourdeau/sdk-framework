<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-01
 * Time: 15:38.
 */

namespace ZEROSPAM\Framework\SDK\Test\Base\Request;

use Psr\Http\Message\ResponseInterface;
use ZEROSPAM\Framework\SDK\Request\Api\BaseRequest;
use ZEROSPAM\Framework\SDK\Request\Api\IsBindable;
use ZEROSPAM\Framework\SDK\Response\Api\IResponse;
use ZEROSPAM\Framework\SDK\Test\Base\Data\Response\TestResponse;
use ZEROSPAM\Framework\SDK\Test\Tests\Utils\Obj\BasicEnum;

/**
 * Class BindableTestRequest
 *
 * Test Request to test Binding URL
 *
 * @package ZEROSPAM\Framework\SDK\Test\Base\Request
 */
class BindableTestRequest extends BaseRequest
{
    use IsBindable;

    private $test;

    /**
     * @param mixed $test
     *
     * @return $this
     */
    public function setTest($test)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * CAN'T OVERRIDE.
     *
     * @param $id
     *
     * @return $this
     */
    public function setNiceId($id)
    {
        $this->addRouteBinding('niceId', $id, false);

        return $this;
    }

    public function setTestId($id)
    {
        $this->addRouteBinding('testId', $id);

        return $this;
    }

    public function setTestEnum(BasicEnum $enum)
    {
        $this->addRouteBinding('testId', $enum);

        return $this;
    }

    /**
     * Base route without binding.
     *
     * @return string
     */
    public function baseRoute(): string
    {
        return 'test/:testId/nice/:niceId';
    }

    /**
     * Type of request.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'GET';
    }

    public function response(ResponseInterface $response): IResponse
    {
        return new TestResponse($response);
    }
}
