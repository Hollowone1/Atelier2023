<?php
declare(strict_types=1);

use nrv\auth\api\action\LoginAction;
use nrv\auth\api\action\SigninAction;
use nrv\event\api\actions\get\HomeAction;
use Psr\Http\Message\RequestFactoryInterface as Request;
use Psr\Http\Message\ResponseFactoryInterface as Response;

use Slim\App;

return function (App $app):void {
    $app->get('/inscription', SigninAction::class)
        ->setName('inscription');

    $app->post('/', HomeAction::class)
        ->setName('home');

    $app->get('/connexion', LoginAction::class)
        ->setName('connexion');

    $app->post('/', HomeAction::class)
        ->setName('home');
};