<?php

declare(strict_types=1);

use nrv\event\api\middleware\CorsMiddleware;

require_once __DIR__ . '/../vendor/autoload.php';

/* application boostrap */
$app = require_once __DIR__ . '/../config/bootstrap.php';


$app->run();
//$app->add(new CorsMiddleware);

