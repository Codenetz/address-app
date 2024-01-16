<?php

namespace Framework\Kernel;

use Framework\Request;
use Framework\Response;

class HttpKernel extends Kernel
{
    protected Request $request;
    protected Response $response;

    public function getResponse(): Response
    {
        return $this->response;
    }

    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }
}