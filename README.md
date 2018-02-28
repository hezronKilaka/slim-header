# slim-header
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, Content-Type, accept");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//require '../vendor/autoload.php';
//require_once '../api-slim/database/registerdb.php';

$app = new \Slim\App;

//require_once '../api-slim/endpoints/register.php';

$app->run();
