  import { apiNRVAuth } from './modules/Config.js';

// Logique pour récupérer les données du panier
const nombreDeBilletsAchetes = 2;
const panier = document.querySelector(".tab"); // Sélectionnez le conteneur de panier

// Assurez-vous d'ajuster l'URL de l'API en conséquence
fetch(`${apiNRVAuth}panier`)
  .then(response => response.json())
  .then(data => {
    // Traitez les données de l'API ici
    // Parcourez les données pour chaque élément du panier
    for (let i = 0; i < nombreDeBilletsAchetes; i++) {
      // Créez une nouvelle ligne de panier pour chaque élément
      const panierItemDiv = document.createElement("div");
      panierItemDiv.className = "row content";
      panierItemDiv.innerHTML = 
      `
                <input type="checkbox" id="panier-0" name="tout">
                <div class="panier-lieu">${data[i].lieu}</div>
                <div class="panier-soiree">${data[i].soiree}</div>
                <div class="panier-type">${data[i].type}</div>
                <div class="panier-prix">${data[i].prix}</div>
                <div class="panier-quantite">${data[i].quantite}</div>
      `
      // Ajoutez les éléments à la ligne de panier
      panierItemDiv.appendChild(checkbox);
      panierItemDiv.appendChild(lieu);
      panierItemDiv.appendChild(soiree);
      panierItemDiv.appendChild(type);
      panierItemDiv.appendChild(prix);
      panierItemDiv.appendChild(quantite);

      // Ajoutez la nouvelle ligne de panier au conteneur du panier
      panier.appendChild(panierItemDiv);
    }
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des données du panier :', error);
  });



//panier.html, suppression des éléments du panier:

function supprimerLigne(button) {
    const row = button.parentElement; // L'élément parent du bouton (la ligne du panier)
    const checkbox = row.querySelector('input[type="checkbox"]');
    
    if (checkbox.checked) {
      row.remove(); // Supprime la ligne si la case à cocher est cochée
    }
  }
