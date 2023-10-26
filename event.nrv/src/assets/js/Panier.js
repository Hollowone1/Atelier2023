import 'Config.js';
//panier.html, répétition fetch des éléments du panier:

fetch('https://votre-api.com/obtenir-elements-panier')
  .then(response => response.json())
  .then(data => {
    // Traitez les données de l'API ici
    // Parcourez les données pour chaque élément du panier
    // Créez une nouvelle ligne de panier pour chaque élément du panier
    data.forEach(element => {
      // Créez une nouvelle ligne de panier
      const newRow = document.createElement('div');
      newRow.className = 'row content';

      // Créez la case à cocher
      const checkbox = document.createElement('input');
      checkbox.type = 'checkbox';
      checkbox.name = 'item';

      // Créez les éléments de la ligne de panier
      const lieu = document.createElement('div');
      lieu.className = 'panier-lieu';
      lieu.textContent = element.lieu; 

      const soiree = document.createElement('div');
      soiree.className = 'panier-soiree';
      soiree.textContent = element.soiree;

      const type = document.createElement('div');
      type.className = 'panier-type';
      type.textContent = element.type;

      const prix = document.createElement('div');
      prix.className = 'panier-prix';
      prix.textContent = element.prix; 

      const quantite = document.createElement('div');
      quantite.className = 'panier-quantite';
      quantite.textContent = element.quantite;

      // Ajoutez la case à cocher et les éléments de la ligne au nouveau conteneur de ligne
      newRow.appendChild(checkbox);
      newRow.appendChild(lieu);
      newRow.appendChild(soiree);
      newRow.appendChild(type);
      newRow.appendChild(prix);
      newRow.appendChild(quantite);

      // Ajoutez la nouvelle ligne de panier au conteneur du panier
      const panier = document.getElementById('panier');
      panier.appendChild(newRow);
    });
  })
  .catch(error => {
    console.error('Erreur lors de la récupération des éléments de panier :', error);
  });


//panier.html, suppression des éléments du panier:

function supprimerLigne(button) {
    const row = button.parentElement; // L'élément parent du bouton (la ligne du panier)
    const checkbox = row.querySelector('input[type="checkbox"]');
    
    if (checkbox.checked) {
      row.remove(); // Supprime la ligne si la case à cocher est cochée
    }
  }