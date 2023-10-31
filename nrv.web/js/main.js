console.log("bla");

import {apiNRVEvent} from './modules/config.js';
import {apiNRVAuth} from './modules/config.js';
import commande from './modules/commande.js';

document.addEventListener("DOMContentLoaded", () => {
    commande.recup();
});
// logique bouton connexion-deconnexion

let isLoggedIn = false;

    function toggleLogin() {
      const loginButton = document.getElementsByClassName("nav-item deconnexion");

      if (isLoggedIn) {
        // L'utilisateur est connecté, nous le déconnectons
        isLoggedIn = false;
        loginButton.innerText = "Connexion";
      } else {
        // L'utilisateur est déconnecté, nous le connectons
        isLoggedIn = true;
        loginButton.innerText = "Déconnexion";
      }
    }

//logique bouton réserver.

    function redirectToReservationPage() {

      const newPageURL = 'panier.html';
      const username = fetch(`${apiNRVAuth}user`);
      const email = fetch(`${apiNRVAuth}user`);

      const postData = {
        username: username,
        email: email
      };

      // Options de la requête Fetch
      const fetchOptions = {
        method: 'GET', // Méthode de la requête (POST, GET, etc.)
        body: JSON.stringify(postData), // Données à envoyer
        headers: {
          'Content-Type': 'application/json'
        }
      };

      // Effectuer la redirection avec Fetch
      fetch(newPageURL, fetchOptions)
        .then(response => {
          if (response.ok) {
            window.location.href = newPageURL;
          } else {
            console.error('Échec de la requête Fetch');
          }
        })
        .catch(error => {
          console.error('Erreur de connexion réseau :', error);
        });
    }


    // redirection vers la page soirée:

    function redirectToSoiree(){
        window.location.href = 'soiree.html';     
    }


    // logique bouton voir plus

const voirPlusButton = document.getElementsByClassName("soiree-buttons-1")[0];
let offset = 6; 
const limit = 6;

voirPlusButton.addEventListener("click", () => {
  fetch(`${apiNRVEvent}soirees?offset=${offset}&limit=${limit}`)
    .then(response => response.json())
    .then(data => {
      data.soirees.forEach(soiree => {
        const displaySoiree = document.createElement('section');
        displaySoiree.innerHTML = `
          <div class="soiree-container">
              <img class="soiree-image" src="${soiree.img}" alt="image de la soirée">
              <div class="soiree-infos">
                  <p class="soiree-infos-date">${soiree.date}</p>
                  <h2 class="soiree-infos-titre">${soiree.titre}</h2>
                  <p class="soiree-infos-lieu">${soiree.lieu}</p>
              </div>
          </div>
          <div class="soiree-buttons">
              <button class="soiree-buttons-1">En savoir +</button>
              <button class="soiree-buttons-2" onclick="redirectToReservationPage()">Réserver</button>
          </div>
        `;
        const listSoiree = document.querySelector('.list');
        listSoiree.appendChild(displaySoiree);
      });

      offset += limit;
    })
    .catch(error => {
      if (error instanceof TypeError) {
        console.error("Erreur de type - Impossible de se connecter au serveur :", error);
      } else if (error instanceof SyntaxError) {
        console.error("Erreur de syntaxe JSON dans la réponse :", error);
      } else {
        console.error("Erreur lors de la récupération des données :", error);
      }
    });
});










