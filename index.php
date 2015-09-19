<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

require 'autoload.php';

use Rest\Response;
$type = $_SERVER['HTTP_ACCEPT'];
$response = new \Rest\Response\Response();

switch($type) {
    case 'application/xml':
        $response->setResponse(new \Rest\Response\XmlResponse());
        break;
    case 'application/json':
    default:
        $response->setResponse(new \Rest\Response\JsonResponse());
}

$response->send();