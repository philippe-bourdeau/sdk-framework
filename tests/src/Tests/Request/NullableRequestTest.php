<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-07-12
 * Time: 09:50
 */

namespace Stainless\Client\Test\Tests\Request;

use Stainless\Client\Test\Base\Request\NullableTestRequest;
use Stainless\Client\Test\Base\TestCase;

class NullableRequestTest extends TestCase
{

    /**
     *
     */
    public function testNullFieldInRequestSet(): void
    {
        $client = $this->prepareClientSuccess([]);

        $request = new NullableTestRequest();
        $request->setNullField(null);

        $client->getOAuthTestClient()->processRequest($request);

        $this->validateRequest($client, ['null_field' => null]);
    }

    /**
     *
     */
    public function testNullFieldInRequestNotSet(): void
    {
        $client = $this->prepareClientSuccess([]);

        $request = new NullableTestRequest();

        $client->getOAuthTestClient()->processRequest($request);

        $this->validateRequest($client, []);
    }
}
