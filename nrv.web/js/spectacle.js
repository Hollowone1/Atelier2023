import {apiNRVEvent} from './modules/config.js';

const str = window.location;
const url = new URL(str);
const id= url.searchParams.get("id");

function retourSoiree(idSoiree) {
        window.location.href = "soiree.html" + "?id=" + idSoiree;
}

fetch(`${apiNRVEvent}spectacles/${id}`)
    .then(response => response.json())
    .then(data => {
        const main = document.getElementById("detail");
        const boutonRetour = document.createElement("button");
        boutonRetour.className = "retour-bouton";
        boutonRetour.innerHTML = "Retourner à la soirée correspondante";
        boutonRetour.addEventListener("click", () => {
                retourSoiree(data.idSoiree);
        });
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

    })
    .catch(error => {
        console.error('Erreur lors de la récupération des soirées :', error);
    });