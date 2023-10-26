  import { apiNRVAuth } from './Config.js';

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

      const checkbox = document.createElement("input");
      checkbox.type = "checkbox";
      checkbox.name = "item";

      const lieu = document.createElement("div");
      lieu.className = "panier-lieu";
      lieu.textContent = data[i].lieu; // Assurez-vous que la structure des données de l'API correspond à cela

      const soiree = document.createElement("div");
      soiree.className = "panier-soiree";
      soiree.textContent = data[i].soiree; // Assurez-vous que la structure des données de l'API correspond à cela

      const type = document.createElement("div");
      type.className = "panier-type";
      type.textContent = data[i].type; // Assurez-vous que la structure des données de l'API correspond à cela

      const prix = document.createElement("div");
      prix.className = "panier-prix";
      prix.textContent = data[i].prix; // Assurez-vous que la structure des données de l'API correspond à cela

      const quantite = document.createElement("div");
      quantite.className = "panier-quantite";
      quantite.textContent = data[i].quantite; // Assurez-vous que la structure des données de l'API correspond à cela

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