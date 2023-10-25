<?php
use App\Middleware\CorsMiddleware;
use \Slim\App ;

$app = new \Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

/* application boostrap */
$app = require_once __DIR__ . '/../config/bootstrap.php';


$app->run();

$app->add(new CorsMiddleware);

