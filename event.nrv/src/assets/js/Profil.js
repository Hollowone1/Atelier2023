import {apiNRVEvent} from './Config.js';
import { apiNRVAuth } from './Config.js';
//profil.html, récupérer les données utilisateurs

const profilContainer = document.getElementsByClassName("infos"); // Obtenez le conteneur où vous ajouterez les informations du profil

fetch(`${apiNRVAuth}users`)
  .then(response => response.json())
  .then(data => {
    // Traitez les données du profil utilisateur ici
    // Assurez-vous que les données renvoyées correspondent à la structure attendue
    // Créez des éléments HTML pour afficher les informations du profil

    const infosItem = document.createElement("div");
    infosItem.className = "infos-item";

    const nomP = document.createElement("p");
    nomP.className = "infos-nom";
    nomP.innerHTML = `<strong>Nom :</strong> ${data.nomComplet}`; // Assurez-vous que la propriété 'nomComplet' existe dans les données
    infosItem.appendChild(nomP);

    const emailP = document.createElement("p");
    emailP.className = "infos-email";
    emailP.innerHTML = `<strong>E-mail :</strong> ${data.email}`; // Assurez-vous que la propriété 'email' existe dans les données
    infosItem.appendChild(emailP);

    profilContainer.appendChild(infosItem);
  })
  .catch(error => {
    console.error('Erreur lors de la récupération du profil utilisateur :', error);
  });


//profil.html, récupérer les données des billets et fetch la data du panier




const billetsContainer = document.getElementsByClassName("billets-items"); // Obtenez le conteneur où vous ajouterez les éléments

fetch(`${apiNRVEvent}billets`)
  .then(response => response.json())
  .then(data => {
    
    data.billets.forEach(billet => {
      // Créez une nouvelle div pour chaque élément de billet
      const billetsItemDiv = document.createElement("div");
      billetsItemDiv.className = "billets-item";

      // Créez les éléments de la ligne de billet
      const lieuDiv = document.createElement("div");
      lieuDiv.className = "billets-lieu";
      lieuDiv.textContent = billet.lieu; // Assurez-vous que la propriété 'lieu' existe dans les données

      const soireeDiv = document.createElement("div");
      soireeDiv.className = "billets-soiree";
      soireeDiv.textContent = billet.soiree; // Assurez-vous que la propriété 'soiree' existe dans les données

      const typeDiv = document.createElement("div");
      typeDiv.className = "billets-type";
      typeDiv.textContent = billet.type; // Assurez-vous que la propriété 'type' existe dans les données

      // Ajoutez les éléments à la div de l'élément de billet
      billetsItemDiv.appendChild(lieuDiv);
      billetsItemDiv.appendChild(soireeDiv);
      billetsItemDiv.appendChild(typeDiv);

      // Ajoutez la nouvelle div de l'élément de billet au conteneur
      billetsContainer.appendChild(billetsItemDiv);
    });
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des données de billets :', error);
  });
