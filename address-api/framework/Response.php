<?php

namespace Framework;

/**
 *
 */
class Response
{
    /**
     * @return $this
     */
    public function contentOk(): Response
    {
        header('HTTP/1.1 200 OK');
        return $this;
    }

    /**
     * @return $this
     */
    public function contentCreated(): Response
    {
        header('HTTP/1.1 204 No Content');
        return $this;
    }

    /**
     * @param $data
     * @return void
     */
    public function jsonResponse($data): void
    {
        $jsonResponse = json_encode($data);
        header('Content-Type: application/json');
        echo $jsonResponse;
    }
}