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
      const username = fetch();
      const email = fetch();

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

// logique bouton voir plus

    const soireesList = document.getElementsByClassName("soiree");
    const voirPlusButton = document.getElementsByClassName("button1");
    let offset = 6; // Compteur d'offset pour les requêtes API
    const limit = 6; // Nombre de soirées à charger à la fois

    voirPlusButton.addEventListener("click"), () => {
      // Requête API pour récupérer les soirées supplémentaires
      fetch(`https://exemple-api.com/soirees?offset=${offset}&limit=${limit}`)
        .then(response => response.json())
        .then(data => {
          // Parcourir les données et ajouter chaque soirée à la liste
          data.soirees.forEach(soiree => {
            const div = document.createElement("div");
            div.className = "soiree-container";
        
            // Image de la soirée
            const img = document.createElement("img");
            img.className = "soiree-image";
            img.src = "./soiree.jpg";
            img.alt = "image de la soirée";
            div.appendChild(img);
        
            // Informations sur la soirée
            const infosDiv = document.createElement("div");
            infosDiv.className = "soiree-infos";
        
            // Date de la soirée
            const dateP = document.createElement("p");
            dateP.className = "soiree-infos-date";
            dateP.textContent = "Date de la soirée: " + soiree.date; // Assurez-vous que la propriété "date" existe dans vos données
            infosDiv.appendChild(dateP);
        
            // Titre de la soirée
            const titreH2 = document.createElement("h2");
            titreH2.className = "soiree-infos-titre";
            titreH2.textContent = soiree.titre; // Assurez-vous que la propriété "titre" existe dans vos données
            infosDiv.appendChild(titreH2);
        
            // Lieu de la soirée
            const lieuP = document.createElement("p");
            lieuP.className = "soiree-infos-lieu";
            lieuP.textContent = "Lieu de la soirée: " + soiree.lieu; // Assurez-vous que la propriété "lieu" existe dans vos données
            infosDiv.appendChild(lieuP);
        
            div.appendChild(infosDiv);
        
            // Boutons pour en savoir plus et réserver
            const buttonsDiv = document.createElement("div");
            buttonsDiv.className = "soiree-buttons";
        
            // Bouton "En savoir +"
            const enSavoirPlusButton = document.createElement("button");
            enSavoirPlusButton.className = "soiree-buttons-1";
            enSavoirPlusButton.textContent = "En savoir +";
            buttonsDiv.appendChild(enSavoirPlusButton);
        
            // Bouton "Réserver"
            const reserverButton = document.createElement("button");
            reserverButton.className = "soiree-buttons-2";
            reserverButton.textContent = "Réserver";
            reserverButton.addEventListener("click", redirectToReservationPage);
            buttonsDiv.appendChild(reserverButton);
        
            div.appendChild(buttonsDiv);
        
            // Ajouter la soirée à la liste
            soireesList.appendChild(div);
          });

          offset += limit; // Incrémenter l'offset pour la prochaine requête
        })
        .catch(error => {
            if (error instanceof TypeError) {
                // Une erreur de type, par exemple, une erreur réseau (impossible de se connecter au serveur)
                console.error("Erreur de type - Impossible de se connecter au serveur :", error);
              } else if (error instanceof SyntaxError) {
                // Erreur de syntaxe dans la réponse JSON
                console.error("Erreur de syntaxe JSON dans la réponse :", error);
              } else {
                // Autres erreurs
                console.error("Erreur lors de la récupération des données :", error);
              }
    });
    }

// logique div total panier row dans commande.html, répéter les éléments du panier:


const panier = document.getElementById("panier");
    for (let i = 0; i < nombreDeBilletsAchetes; i++) {
        const panierItemDiv = document.createElement("div");
        panierItemDiv.className = "total panier-row";

        const panierItemP = document.createElement("p");
        panierItemP.className = "panier-item";
        panierItemP.textContent = "Blablabalablaba - 35€";

        const montantTotalP = document.createElement("p");
        montantTotalP.innerHTML = `<strong>Montant total :</strong> le montant total`;

        panierItemDiv.appendChild(panierItemP);
        panierItemDiv.appendChild(montantTotalP);

        panier.appendChild(panierItemDiv);
}