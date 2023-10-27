import {apiNRVEvent} from './Config.js';
//programmation.html, répétition des genres:

//TODO : récupérer les genres pr boutons et générer boutons avec classes, id et onclick
//TODO : récup les lieux pr boutons et générer boutons avec classes, id et onclick
//TODO : function pr récup l'id du bouton cliqué
//TODO : filtre genre (avec id)
//TODO : filtre lieu (avec id)
//TODO : filtre date (avec valeur input)

fetch(`${apiNRVEvent}boutons_theme`)
    .then(response => response.json())
    .then(data => {

      const container = document.getElementsByClassName('filtres');
      const nbGenres = data.length;
      for (let i = 0; i < nbGenres; i++) {
        const boutonGenre = document.createElement('button');
        boutonGenre.className = 'filtres-genre-item';
        boutonGenre.id = data[i];
        boutonGenre.innerHTML = data[i];
        boutonGenre.setAttribute('onclick', 'filtreGenre(this.id)');
        container.appendChild(boutonGenre);

      }
    })
    .catch(error => {
      console.error('Erreur lors de la récupération des genres musicaux :', error);
    });

function filtreGenre(genre) {
  const boutonGenre = document.getElementById(genre);
  const genreValeur = boutonGenre.value;
  console.log("Le genre sélectionné est : ", genreValeur);

  fetch(`${apiNRVEvent}theme`)
      .then(response => response.json())
      .then(data => {

      })
      .catch(error => {
        console.error('Erreur lors de la récupération des genres musicaux :', error);
      });

}

fetch(`${apiNRVEvent}boutons_lieu`)
    .then(response => response.json())
    .then(data => {

      const container = document.getElementsByClassName('filtres');
      const nbLieux = data.length;
      for (let i = 0; i < nbLieux; i++) {
        const boutonLieu = document.createElement('button');
        boutonLieu.className = 'filtres-lieu-item';
        boutonLieu.id = data[i];
        boutonLieu.innerHTML = data[i];
        boutonLieu.setAttribute('onclick', 'filtreLieu(this.id)');
        container.appendChild(boutonLieu);
      }
    })
    .catch(error => {
      console.error('Erreur lors de la récupération des genres musicaux :', error);
    });




  //programmation.html, répéter les soirées:

  fetch(`${apiNRVEvent}soirees`)
  .then(response => response.json())
  .then(data => {
    // Traitez les données de la base de données ici
    // Parcourez les données pour chaque soirée
    // Créez une nouvelle section pour chaque soirée et ajoutez-la au conteneur
    const container = document.getElementsByClassName('list');

    //l'action renvoie un tableau avec un DTO pr chaque soirée
    data.forEach(soiree => {
      const sectionSoiree = document.createElement('section');
      sectionSoiree.className = 'soiree';

      const soireeContainer = document.createElement('div');
      soireeContainer.className = 'soiree-container';
      sectionSoiree.appendChild(soireeContainer);

      const imageSoiree = document.createElement('img');
      imageSoiree.className = 'soiree-image';
      imageSoiree.src = soiree.image;
      imageSoiree.alt = 'image de la soirée';
      soireeContainer.appendChild(imageSoiree);

      const infosSoiree = document.createElement('div');
      infosSoiree.className = 'soiree-infos';

      const dateSoiree = document.createElement('p');
      dateSoiree.className = 'soiree-infos-date';
      dateSoiree.textContent = `Date de la soirée: ${soiree.date}`;
      infosSoiree.appendChild(dateSoiree);

      const titreSoiree = document.createElement('h2');
      titreSoiree.className = 'soiree-infos-titre';
      titreSoiree.textContent = soiree.titre;
      infosSoiree.appendChild(titreSoiree);

      const lieuSoiree = document.createElement('p');
      lieuSoiree.className = 'soiree-infos-lieu';
      lieuSoiree.textContent = `Lieu de la soirée: ${soiree.lieu}`;
      infosSoiree.appendChild(lieuSoiree);

      soireeContainer.appendChild(infosSoiree);

      sectionSoiree.appendChild(soireeContainer);

      // Créez les boutons pour la soirée
      const buttonsSoiree = document.createElement('div');
      buttonsSoiree.className = 'soiree-buttons';

      const enSavoirPlusButton = document.createElement('button');
      enSavoirPlusButton.className = 'soiree-buttons-1';
      enSavoirPlusButton.textContent = 'En savoir +';
      buttonsSoiree.appendChild(enSavoirPlusButton);

      const reserverButton = document.createElement('button');
      reserverButton.className = 'soiree-buttons-2';
      reserverButton.textContent = 'Réserver';
      buttonsSoiree.appendChild(reserverButton);

      sectionSoiree.appendChild(buttonsSoiree);

      // Ajoutez la nouvelle section de soirée au conteneur des soirées
      container.appendChild(sectionSoiree);
    });
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des soirées :', error);
  });