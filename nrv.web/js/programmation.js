import {apiNRVEvent} from './modules/config.js';

//programmation.html, répétition des genres:

function isUnique(item, position, array) {
    return array.indexOf(item) === position;
}

function allerSoiree(idSoiree) {
    window.location.href = "soiree.html" + "?id=" + idSoiree;
}

//programmation.html, répéter les soirées:
// 'https://cors-anywhere.herokuapp.com/
fetch(`${apiNRVEvent}/soirees`), {
    referrerPolicy: "unsafe_url",
    headers: {
        "Content-Security-Policy": "upgrade-insecure-requests"
    }
}
    .then(response => {
        if (response.ok) return response.json();})
    .then(data => {
        //récup le conteneur avec la liste des soirées
        const container = document.getElementById('list');
        const genres = [];
        const lieux = [];
        //on récup chaque soirée dans data
        data.forEach(soiree => {

            const sectionSoiree = document.createElement('section');
            sectionSoiree.classList.add('soiree', soiree.theme, soiree.lieu);

            let lieuFetch = fetch(`${apiNRVEvent}/soirees/${soiree.idSoiree}/lieu`).then(response => {
                if (response.ok) return response.json();});
            let imgFetch = fetch(`${apiNRVEvent}/soirees/${soiree.idSoiree}/image`).then(response => {
                if (response.ok) return response.json();});

            Promise.all([lieuFetch, imgFetch])
                .then(([lieu, imageUrl]) => {
                    sectionSoiree.innerHTML = `
            <div class="soiree-container">
                <img class="soiree-image" src="${imageUrl}" alt="image de la soirée">
                <div class="soiree-infos">
                    <p class="soiree-infos-date">${soiree.date}</p>
                    <h2 class="soiree-infos-titre">${soiree.nom}</h2>
                    <p class="soiree-infos-lieu">${lieu}</p>
                </div>
            </div>
            <div class="soiree-buttons">
                <button class="soiree-buttons-1">En savoir +</button>
  
                <button class="soiree-buttons-2">Réserver</button>
            </div>
        `;

                    let button1 = sectionSoiree.getElementsByClassName('soiree-buttons-1')[0];
                    button1.addEventListener('click', () => {
                        allerSoiree(soiree.idSoiree);
                        console.log(soiree.idSoiree);
                    });

                    container.appendChild(sectionSoiree);
                })
                .catch(error => {
                    console.error("Erreur lors de la récupération des données de la soirée:", error);
                });
            container.appendChild(sectionSoiree);
            genres.push(soiree.theme);
            lieux.push(soiree.lieu);
        });


        //récup les genres et lieux uniques
        genres.filter(isUnique);
        lieux.filter(isUnique);
        const filtres = document.getElementById('filtres');
        genres.forEach(genre => {
            const button = document.createElement('button');
            button.className = 'filtres-genre-item';
            button.innerHTML = genre;
            filtres.appendChild(button);
            button.addEventListener('click', () => {
                const soirees = document.getElementsByClassName('soiree');
                for (let i = 0; i < soirees.length; i++) {
                    if (soirees[i].className !== genre) {
                        soirees[i].style.display = 'none';
                    }
                }
            })
        })


        lieux.forEach(lieu => {
            const button = document.createElement('button');
            button.className = 'filtres-lieu-item';
            button.innerHTML = lieu;
            filtres.appendChild(button);
            button.addEventListener('click', () => {
                const soirees = document.getElementsByClassName('soiree');
                for (let i = 0; i < soirees.length; i++) {
                    if (soirees[i].className !== lieu) {
                        soirees[i].style.display = 'none';
                    }
                }
            })
        })

        const tout = document.getElementById('all');
        tout.addEventListener('click', () => {
            const soirees = document.getElementsByClassName('soiree');
            for (let i = 0; i < soirees.length; i++) {
                soirees[i].style.display = 'flex';
            }
        })

        const date = document.getElementById('input-filtre-date');
        date.addEventListener("change", (event) => {
            const soirees = document.getElementsByClassName('soiree');
            for (let i = 0; i < soirees.length; i++) {
                if (soirees[i].className !== event.target.value) {
                    soirees[i].style.display = 'none';
                }
            }
        });


    })
    .catch(error => {
        console.error('Erreur lors de la récupération des soirées :', error);
    });