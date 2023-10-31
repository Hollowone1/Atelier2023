import {apiNRVAuth} from './modules/config.js';

// logique div total panier row dans commande.html, répéter les éléments du panier:

fetch(`${apiNRVAuth}panier`)
  .then(response => response.json())
  .then(data => {
    const panier = document.querySelector('.panier');
    panier.innerHTML = ''; 

    data.forEach(item => {
      const panierItem = document.createElement('div');
      panierItem.classList.add('total', 'panier-row');
      panierItem.innerHTML = `
        <p class="panier-item">${item.description} - ${item.prix}€</p>
        <p><strong>Montant total :</strong> ${item.total}</p>
      `;
      panier.appendChild(panierItem);
    });
  })
  .catch(error => {
    console.error('Une erreur s\'est produite lors de la récupération des données du panier :', error);
  });


