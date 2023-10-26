import {apiNRVEvent} from './Config.js';
//programmation.html, répétition des genres:

fetch(`${apiNRVEvent}genres`)
  .then(response => response.json())
  .then(data => {
    
    const genresContainer = document.getElementsByClassName('filtres');
    data.genres.forEach(genre => {
      const boutonGenre = document.createElement('button');
      boutonGenre.className = 'filtres-genre-item';
      boutonGenre.textContent = genre.nom; 
      boutonGenre.addEventListener('click', () => {
       
        console.log(`Genre musical sélectionné : ${genre.nom}`);
      });

    
      genresContainer.appendChild(boutonGenre);
    });
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
    const soireesContainer = document.getElementsByClassName('list');
    data.soirees.forEach(soiree => {
      const sectionSoiree = document.createElement('section');
      sectionSoiree.className = 'soiree';

      // Créez le contenu de la section pour la soirée
      const soireeContainer = document.createElement('div');
      soireeContainer.className = 'soiree-container';

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
      soireesContainer.appendChild(sectionSoiree);
    });
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des soirées :', error);
  });