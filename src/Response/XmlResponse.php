<?php
namespace Rest\Response;

use Rest\Interfaces\ResponseInterface;

class XmlResponse implements ResponseInterface {
    private $headers = array(
                        'Content-Type: application/xml');
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
        $status = $this->statusCode;
        $data = $this->body;

        $response = array(
                $status => 'status',
                $data => 'data');

        $xml = new \SimpleXMLElement('<response/>');
        array_walk_recursive($response, array($xml, 'addChild'));

        echo $xml->asXML();
    }
}