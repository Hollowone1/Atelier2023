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
