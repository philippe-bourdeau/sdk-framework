<?php
/**
 * Created by PhpStorm.
 * User: aaflalo
 * Date: 18-06-20
 * Time: 11:10
 */

namespace Stainless\Client\Test\Base\Data\Collection;

use Stainless\Client\Response\Api\Collection\CollectionMetaData;
use Stainless\Client\Response\Api\Collection\CollectionResponse;
use Stainless\Client\Response\Api\IResponse;
use Stainless\Client\Test\Base\Data\Response\TestResponse;

class CollectionTestResponse extends CollectionResponse implements IResponse
{
    /**
     * CollectionTestResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct(new CollectionMetaData($data['meta']), $data['response']);
    }

    /**
     * Transform the basic data (string[]) into a response (IResponse)
     *
     * @param array $data
     *
     * @return IResponse
     */
    protected static function dataToResponse(array $data)
    {
        return new TestResponse($data);
    }
}
