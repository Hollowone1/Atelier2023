<?php
declare(strict_types=1);

use nrv\event\api\actions\get\AccederBilletAction;
use nrv\event\api\actions\get\AccederSpectacleAction;
use nrv\event\api\actions\get\AccederSpectaclesAction;
use nrv\event\api\actions\get\HomeAction;
use nrv\event\api\actions\post\CreerSpectacleAction;
use Psr\Http\Message\ServeurRequestInterface as Request;
use Psr\Http\Message\ResponseFactoryInterface as Response;
use Slim\App;

return function (App $app):void {
    $app->get('/', HomeAction::class)
        ->setName('home');
    $app->get('/spectacles[/]', AccederSpectaclesAction::class)
        ->setName('spectacles');
    $app->get('/spectacles/{idSpectacle}[/]', AccederSpectacleAction::class)
        ->setName('spectacle');
    $app->post('/spectacle[/]', CreerSpectacleAction::class)
        ->setName('creer_spectacle');
    $app->get('/billets/{idBillet}[/]', AccederBilletAction::class)
        ->setName('billet');

};