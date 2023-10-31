import {apiNRVEvent} from './modules/config.js';
fetch(`${apiNRVEvent}soirees`)
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('list');
        for (let i=0; i < 3; i++ ) {
            const sectionSoiree = document.createElement('section');
            sectionSoiree.className = 'soiree';
            sectionSoiree.innerHTML = `
                        <div class="soiree-container">
                            <img class="soiree-image" src="${data[i].image[0]}" alt="image de la soirée">
                            <div class="soiree-infos">
                                <p class="soiree-infos-date">${data[i].date}</p>
                                <h2 class="soiree-infos-titre">${data[i].nom}</h2>
                                <p class="soiree-infos-lieu">${data[i].lieu}</p>
                            </div>
                        </div>
                        <div class="soiree-buttons">
                            <button class="soiree-buttons-1" onclick='${soiree.id}'>En savoir +</button>
                            <button class="soiree-buttons-2">Réserver</button>
                        </div>
            `
            container.appendChild(sectionSoiree);
        }
    })
.catch(error => {
    console.error('Erreur lors de la récupération des soirées :', error);
});