import {apiNRVEvent} from './modules/Config.js';
fetch(`${apiNRVEvent}spectacle`)
    .then(response => response.json())
    .then(data => {
        const img = document.getElementsByClassName('spec-img');
        img[0].src = data.image;
        const date = document.getElementsByClassName('spec-date');
        date[0].innerHTML = data.date;
        const titre = document.getElementsByClassName('spec-titre');
        titre[0].innerHTML = data.titre;
        const lieu = document.getElementsByClassName('spec-lieu');
        lieu[0].innerHTML = data.lieu;

        const duree = document.getElementsByClassName('spec-duree');
        duree[0].innerHTML = data.horairePrevionnel;
        const description = document.getElementsByClassName('description');
        description[0].innerHTML = data.description;

        //TODO : faire pr les artistes et pr les images et pr la soirée parente


    })
    .catch(error => {
        console.error('Erreur lors de la récupération des soirées :', error);
    });