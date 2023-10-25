<?php

use Illuminate\Database\Capsule\Manager as Eloquent;
use Slim\Factory\AppFactory;

$dep = require_once __DIR__ . '/container.php';

$builder = new DI\ContainerBuilder();
$builder->addDefinitions($dep);
$container = $builder->build();

$app = AppFactory::createFromContainer($container);

$eloquent = new Eloquent();
$eloquent->addConnection(parse_ini_file(__DIR__ . '/event.db.ini'), 'event');
$eloquent->addConnection(parse_ini_file(__DIR__ . '/billet.db.ini'), 'billet');
$eloquent->setAsGlobal();
$eloquent->bootEloquent();

$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

return $app;