<?php
declare(strict_types=1);

use Psr\Http\Message\ServeurRequestInterface as Request;
use Psr\Http\Message\ResponseFactoryInterface as Response;
use nrv\event\api\app\actions\get\AccederSpectacleAction;
use Slim\App;

return function (App $app):void {
    $app->get('/', \nrv\event\api\app\actions\HomeAction::class)
        ->setName('home');
    $app->get('/spectacles[/]', \nrv\event\api\app\actions\get\AccederSpectaclesAction::class)
        ->setName('spectacles');
    $app->get('/spectacles/{idSpectacle}[/]', AccederSpectacleAction::class)
        ->setName('spectacle');
    $app->post('/spectacles/{idSpectacle}[/]', \nrv\event\api\app\actions\post\CreerSpectacleAction::class)
        ->setName('creer_spectacle');
    $app->get('/billets/{idBillet}[/]', \nrv\event\api\app\actions\get\AccederBilletAction::class)
        ->setName('billet');
    $app->post('/billets/{idBillet}[/]', \nrv\event\api\app\actions\post\ValiderBilletAction::class)
        ->setName('valider_billet');

};