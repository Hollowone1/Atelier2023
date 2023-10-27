<?php

use Illuminate\Database\Capsule\Manager as Eloquent;
use Slim\Factory\AppFactory;
use DI\ContainerBuilder;

//$dep = require_once __DIR__ . '/container.php';
//
//$builder = new DI\ContainerBuilder();
//$builder->addDefinitions($dep);
//$container = $builder->build();

//$settings = require_once __DIR__ . '/settings.php';
//$dependencies = require_once __DIR__.'/services_dependencies.php';
//$actions= require_once __DIR__.'/actions_dependencies.php';

$builder = new ContainerBuilder();
//$builder->addDefinitions($settings);
//$builder->addDefinitions($dependencies);
//$builder->addDefinitions($actions);

$eloquent = new Eloquent();
$eloquent->addConnection(parse_ini_file(__DIR__ . "/event.db.ini"), 'event');
$eloquent->addConnection(parse_ini_file(__DIR__ . "/billet.db.ini"), 'ticket');
$eloquent->setAsGlobal();
$eloquent->bootEloquent();

try {
    $c = $builder->build();
    $app = AppFactory::createFromContainer($c);
    $app->addRoutingMiddleware();
    $app->addBodyParsingMiddleware();
    $errorMiddleware = $app->addErrorMiddleware(true, false, false);
    $errorHandler = $errorMiddleware->getDefaultErrorHandler();
    $errorHandler->forceContentType('application/json');
    $app->addErrorMiddleware(true, false, false);
    return $app;
} catch (Exception $e) {
    echo $e->getMessage();
}

