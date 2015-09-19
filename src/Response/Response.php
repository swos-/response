<?php
namespace Rest\Response;

use Rest\Interfaces\ResponseInterface;

class Response {
    private $response;

    public function __construct() {

    }

    public function setResponse(ResponseInterface $response) {
        $this->response = $response;
    }

    public function send() {
        $this->response->send();
    }
}