import {apiNRVEvent} from './modules/config.js';

const str = window.location;
const url = new URL(str);
const id= url.searchParams.get("id");

function allerSpectacle(idSpectacle) {
        window.location.href = "soiree.html" + "?id=" + idSpectacle;
}

fetch(`${apiNRVEvent}soiree/${id}`)
    .then(response => response.json())
    .then(data => {
        const infos = document.getElementsByClassName('element')[0];
        infos.innerHTML = `
                    <h4>${data.date} - ${data.horaire}</h4>
                    <h1>${data.nom}</h1>
                    <h4>${data.lieu}</h4>
                `;
        const image = document.getElementsByClassName('element')[1];
        image.innerHTML = `<img src="${data.image}" alt="image de la soirée">`;
        const reduit = document.getElementsByClassName('element')[2];
        reduit.innerHTML = `
                    <h3>Tarif réduit : ${data.tarifReduit}</h3>
        `;
        const normal = document.getElementsByClassName('element')[3];
        reduit.innerHTML = `
                    <h3>Tarif normal : ${data.tarifNormal}</h3>
        `;
        const description = document.getElementsByClassName('description')[0];
        description.innerHTML = data.description;
        const video = document.getElementsByTagName('iframe')[0];
        video.src = data.urlVideo;

        // en partant du principe que y a les spectacles, ou au moins leur id
        const spectacles = document.getElementsByClassName('soiree-buttons')[0];
        data.spectacles.forEach (spectacle => {
                const boutonSpec = document.createElement('button');
                boutonSpec.className = 'soiree-buttons-2';
                boutonSpec.innerHTML = spectacle.titre;
                boutonSpec.addEventListener('click', () => {
                        allerSpectacle(spectacle.idSpectacle);
                })
        })


    })
    .catch(error => {
        console.error('Erreur lors de la récupération des soirées :', error);
    });