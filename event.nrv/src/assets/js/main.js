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

