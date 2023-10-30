<?php
declare(strict_types=1);

use nrv\event\api\actions\get\AccederBilletAction;
use nrv\event\api\actions\get\AccederSoireeAction;
use nrv\event\api\actions\get\AccederSoireesAction;
use nrv\event\api\actions\get\AccederSpectacleAction;
use nrv\event\api\actions\get\AccederSpectaclesAction;
use nrv\event\api\actions\get\HomeAction;
use nrv\event\api\actions\post\CreerSpectacleAction;

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

    $app->get('/soirees[/]', AccederSoireesAction::class)
        ->setName('soirees');

    $app->get('/soirees/{idSoiree}[/]', AccederSoireeAction::class)
        ->setName('soiree');

    //TODO : rajouter route et action pour récupérer les boutons de thème/genre : /boutons_theme
    //TODO : rajouter route et action pour récupérer les boutons de lieu : /boutons_lieu
    //TODO : rajouter route et action pour récupérer les soirées par thème : /theme
    //TODO : rajouter route et action pour récupérer les soirées par lieu : /lieu
    //TODO : rajouter route et action pour récupérer les soirées par date : /date

};