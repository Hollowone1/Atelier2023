import {apiNRVAuth} from './Config.js';

// logique div total panier row dans commande.html, répéter les éléments du panier:

const nombreDeBilletsAchetes = 2;
const panier = document.getElementsByClassName("panier-row"); 

// Assurez-vous d'ajuster l'URL de l'API en conséquence
fetch(`${apiNRVAuth}panier`)
  .then(response => response.json())
  .then(data => {
    // Traitez les données de l'API ici
    // Parcourez les données pour chaque élément du panier
    for (let i = 0; i < nombreDeBilletsAchetes; i++) {
      // Créez une nouvelle ligne de panier pour chaque élément
      const panierItemDiv = document.createElement("div");
      panierItemDiv.className = "total panier-row";

      const panierItemP = document.createElement("p");
      panierItemP.className = "panier-item";
      panierItemP.textContent = `${data[i].description} - ${data[i].prix}€`; // Assurez-vous que la structure des données de l'API correspond à cela

      const montantTotalP = document.createElement("p");
      montantTotalP.innerHTML = `<strong>Montant total :</strong> le montant total`;

      panierItemDiv.appendChild(panierItemP);
      panierItemDiv.appendChild(montantTotalP);

      // Ajoutez la nouvelle ligne de panier au conteneur du panier
      panier.appendChild(panierItemDiv);
    }
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des données du panier :', error);
  });

