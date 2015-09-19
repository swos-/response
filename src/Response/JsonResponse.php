<?php
namespace Rest\Response;

use Rest\Interfaces\ResponseInterface;

class JsonResponse implements ResponseInterface {
    private $headers = array(
                        'Content-Type: application/json');
    private $statusCode;
    private $body;

    public function __construct($body = 'OK', $statusCode = 200, $headers = false) {
        $this->setBody($body)->setStatusCode($statusCode)->setHeaders($headers);
    }

    private function setBody($body) {
        if($body) {
            $this->body = $body;
        }
        return $this;
    }

    private function setStatusCode($statusCode) {
        if($statusCode) {
            $this->statusCode = $statusCode;
        }
        return $this;
    }

    private function setHeaders($headers) {
        if($headers) {
            array_push($this->headers, $headers);
        }
        return $this;
    }

    public function send() {
        $response = array();
        $response['status'] = $this->statusCode;
        $response['data'] = $this->body;
        foreach($this->headers as $header) {
            header($header, true);
        }

        echo json_encode($response);
    }
}