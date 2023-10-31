<?php
declare(strict_types=1);

use nrv\event\api\actions\get\AccederBilletAction;
use nrv\event\api\actions\get\AccederImageSoireeAction;
use nrv\event\api\actions\get\AccederLieuSoireeAction;
use nrv\event\api\actions\get\AccederSoireeAction;
use nrv\event\api\actions\get\AccederSoireesAction;
use nrv\event\api\actions\get\AccederSpectacleAction;
use nrv\event\api\actions\get\AccederSpectaclesAction;
use nrv\event\api\actions\get\HomeAction;
use nrv\event\api\actions\post\CreerSpectacleAction;

use nrv\event\api\actions\post\DetailsSpectacle;
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

    $app->post('/spectacle/{idSpectacle}[/]', DetailsSpectacle::class)
        ->setName('details_spectacle');

    $app->get('/billets/{idBillet}[/]', AccederBilletAction::class)
        ->setName('billet');

    $app->get('/soirees[/]', AccederSoireesAction::class)
        ->setName('soirees');

    $app->get('/soirees/{idSoiree}[/]', AccederSoireeAction::class)
        ->setName('soiree');

    $app->get('/soirees/{idSoiree}/image[/]', AccederImageSoireeAction::class)
        ->setName('soiree_image');

    $app->get('/soirees/{idSoiree}/spectacles[/]', AccederSpectaclesAction::class)
        ->setName('soiree_spectacles');

    $app->get('/soirees/{idSoiree}/lieu[/]', AccederLieuSoireeAction::class)
        ->setName('soiree_lieu');

};