import {apiNRVEvent} from './modules/config.js';

const str = window.location.href;
const url = new URL(str);
const id = url.searchParams.get("id");

function allerSpectacle(idSpectacle) {
    window.location.href = "spectacle.html" + "?id=" + idSpectacle;
}

fetch(`${apiNRVEvent}soirees/${id}`)
    .then(response => response.json())
    .then(data => {
        let lieuFetch = fetch(`http://docketu.iutnc.univ-lorraine.fr:16584/soirees/${data.idSoiree}/lieu`).then(response => response.json());
        let imgFetch = fetch(`http://docketu.iutnc.univ-lorraine.fr:16584/soirees/${data.idSoiree}/image`).then(response => response.json());
        let spectaclesFetch = fetch(`http://docketu.iutnc.univ-lorraine.fr:16584/soirees/${data.idSoiree}/spectacles`).then(response => response.json());

        Promise.all([lieuFetch, imgFetch, spectaclesFetch])
            .then(([lieu, imageUrl, spectaclesData]) => {
                const infos = document.getElementsByClassName('element')[0];
                infos.innerHTML = `
                                    <h4>Date : ${data.date}</h4>
                                    <h1>${data.nom}</h1>
                                    <h4>Lieu : ${lieu}</h4>
                                `;
                const image = document.getElementsByClassName('element')[1];
                image.innerHTML = `<img src="${imageUrl}" alt="image de la soirée">`;
                const reduit = document.getElementsByClassName('element')[2];
                let tarifNormal = data.tarifNormal;
                let tarifReduit = data.tarifReduit;
                if (data.tarifNormal < data.tarifReduit) {
                    tarifNormal = data.tarifReduit;
                    tarifReduit = data.tarifNormal;
                }
                reduit.innerHTML = `
                                    <h3>Tarif normal : ${tarifNormal}</h3>
                                    `;
                const normal = document.getElementsByClassName('element')[3];
                normal.innerHTML = `
                                    <h3>Tarif réduit : ${tarifReduit}</h3>
                                    `;
                const description = document.getElementsByClassName('description')[0];
                description.innerHTML = 'Cette soirée a pour theme : ' + data.theme;

                // en partant du principe que y a les spectacles, ou au moins leur id
                const spectacles = document.getElementsByClassName('soiree-buttons')[0];
                spectaclesData.forEach(spectacle => {
                    const boutonSpec = document.createElement('button');
                    boutonSpec.className = 'soiree-buttons-2';
                    boutonSpec.innerHTML = spectacle.titre;
                    boutonSpec.addEventListener('click', () => {
                        allerSpectacle(spectacle.idSpectacle);
                    })
                    spectacles.appendChild(boutonSpec);
                });
            })



        // const infos = document.getElementsByClassName('element')[0];
        // infos.innerHTML = `
        //             <h4>${data.date} - ${data.horaire}</h4>
        //             <h1>${data.nom}</h1>
        //             <h4>${data.lieu}</h4>
        //         `;
        // const image = document.getElementsByClassName('element')[1];
        // image.innerHTML = `<img src="${data.image}" alt="image de la soirée">`;
        // const reduit = document.getElementsByClassName('element')[2];
        // reduit.innerHTML = `
        //             <h3>Tarif réduit : ${data.tarifReduit}</h3>
        // `;
        // const normal = document.getElementsByClassName('element')[3];
        // reduit.innerHTML = `
        //             <h3>Tarif normal : ${data.tarifNormal}</h3>
        // `;
        // const description = document.getElementsByClassName('description')[0];
        // description.innerHTML = data.description;
        // const video = document.getElementsByTagName('iframe')[0];
        // video.src = data.urlVideo;
        //
        // // en partant du principe que y a les spectacles, ou au moins leur id
        // const spectacles = document.getElementsByClassName('soiree-buttons')[0];
        // data.spectacles.forEach (spectacle => {
        //         const boutonSpec = document.createElement('button');
        //         boutonSpec.className = 'soiree-buttons-2';
        //         boutonSpec.innerHTML = spectacle.titre;
        //         boutonSpec.addEventListener('click', () => {
        //                 allerSpectacle(spectacle.idSpectacle);
        //         })
        //         spectacles.appendChild(boutonSpec);
        // })


    })
    .catch(error => {
        console.error('Erreur lors de la récupération des soirées :', error);
    });