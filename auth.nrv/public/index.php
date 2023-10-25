<?php
use App\Middleware\CorsMiddleware;
use \Slim\App ;

$app = new \Slim\App;


$app->add(new CorsMiddleware);

