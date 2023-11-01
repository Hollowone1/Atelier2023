import {apiNRVEvent} from './modules/config.js';

const str = window.location.href;
const url = new URL(str);
const idSpectacle = url.searchParams.get("idSpectacle");
const idSoiree = url.searchParams.get("idSoiree");

function retourSoiree(idSoiree) {
    window.location.href = "soiree.html" + "?id=" + idSoiree;
}

fetch(`${apiNRVEvent}soirees/${idSoiree}/spectacles/${idSpectacle}`)
    .then(response => response.json())
    .then(data => {
        let artistesFetch = fetch(`${apiNRVEvent}spectacles/${idSpectacle}/artistes`).then(response => response.json());
        let imagesFetch = fetch(`${apiNRVEvent}spectacles/${idSpectacle}/images`).then(response => response.json());

        const main = document.getElementById("detail");
        const boutonRetour = document.createElement("button");
        boutonRetour.className = "retour-bouton";
        boutonRetour.innerHTML = "Retourner à la soirée correspondante";
        boutonRetour.addEventListener("click", () => {
            retourSoiree(data.idSoiree);
        });
        main.appendChild(boutonRetour);

        const containerVideo = document.createElement("div");
        containerVideo.className = "container"
        containerVideo.innerHTML = `
        <iframe width="560" height="315"  src="${data.urlVideo}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>-->
`;
        main.appendChild(containerVideo);

        const container = document.createElement("div");
        container.className = "container";
        container.innerHTML = `

            <div class="spec-infos element">
                <div class="spec-date">Date : ${data.horairePrevionnel}</div>
                <h1 class="spec-titre">Titre : ${data.titre}</h1>
                <div class="spec-lieu">Lieu</div>
            </div>
            `;
        main.appendChild(container);

        const section = document.createElement("section");
        section.className = "spec-details ";

        let date = data.horairePrevionnel.split(' ');
        let date2 = date[1];
        Promise.all([artistesFetch, imagesFetch])
            .then(([artistes, images]) => {
                artistes.forEach(artiste => {
                    const artisteItem = document.createElement("div");
                    artisteItem.className = "artistes-item";
                    artisteItem.innerHTML = `
                    <p class="artiste-nom">${artiste.nom}</p>
                    `;
                    section.querySelector(".artistes").appendChild(artisteItem);
                })
                images.forEach(image => {
                    const imageItem = document.createElement("img");
                    imageItem.className = "imageSpectacle";
                    imageItem.src = image;
                    section.querySelector(".images").appendChild(imageItem);
                })
            });


        section.innerHTML = `
            <h3 class="spec-duree"><strong>Horaire :</strong> ${date2}</h3>
            <p class="description">Description : ${data.description}</p>
            <h3>Artistes : </h3>
            <div class="artistes">
            </div>
            <h3>Images du spectacle : </h3>
            <div class="images">
            </div>
        `;
        main.appendChild(section);

    })
    .catch(error => {
        console.error('Erreur lors de la récupération des soirées :', error);
    });