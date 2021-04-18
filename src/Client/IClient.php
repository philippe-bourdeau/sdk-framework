<?php

namespace ZEROSPAM\Framework\SDK\Client;

use ZEROSPAM\Framework\SDK\Configuration\IBaseConfiguration;
use ZEROSPAM\Framework\SDK\Request\Api\IRequest;
use ZEROSPAM\Framework\SDK\Response\Api\IResponse;

interface IClient
{
    /**
     * Process the given request and return an array containing the results.
     *
     * @param IRequest $request
     *
     * @return IResponse
     */
    public function processRequest(IRequest $request): IResponse;

    /**
     * @return IBaseConfiguration
     */
    public function getConfiguration(): IBaseConfiguration;
}
