import {apiNRVEvent} from './modules/Config.js';
import { apiNRVAuth } from './modules/Config.js';

//profil.html, récupérer les données utilisateurs

const profilContainer = document.getElementsByClassName("infos"); 

fetch(`${apiNRVAuth}users`)
  .then(response => response.json())
  .then(data => {

    const infosItem = document.createElement("div");
    infosItem.className = "infos-item";
    infosItem.innerHTML = 
    `
            <p class="infos-nom"><strong>Nom :</strong>${data.nomComplet}</p>
            <p class="infos-email"><strong>E-mail :</strong>${data.email}</p>
    `
    profilContainer.appendChild(infosItem);
  })
  .catch(error => {
    console.error('Erreur lors de la récupération du profil utilisateur :', error);
  });


//profil.html, récupérer les données des billets et fetch la data du panier


const billetsContainer = document.getElementsByClassName("billets"); 

fetch(`${apiNRVEvent}billets`)
  .then(response => response.json())
  .then(data => {
    
    data.billets.forEach(billet => {
      // Créez une nouvelle div pour chaque élément de billet
      const billetsItemDiv = document.createElement("div");
      billetsItemDiv.className = "billets-item";
      billetsItemDiv.innerHTML = 
      `
      <div class="billets-lieu">${billet.lieu}</div>
      <div class="billets-soiree">${billet.soiree}</div>
      <div class="billets-type">${billet.type}</div>
      `

      // Ajoutez la nouvelle div de l'élément de billet au conteneur
      billetsContainer.appendChild(billetsItemDiv);
    });
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des données de billets :', error);
  });
