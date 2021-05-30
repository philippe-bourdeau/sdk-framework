<?php

namespace Stainless\Client\Client;

use Stainless\Client\Request\Api\IRequest;
use Stainless\Client\Response\Api\IResponse;

interface IClient
{
    /**
     * Process the given request and return an array containing the results.
     *
     * @param IRequest $request
     *
     * @return IResponse
     */
    public function processRequest(IRequest $request);
}
