<?php

require '/var/www/vendor/autoload.php';

$faker = Faker\Factory::create();

for ($i = 1; $i <= 50; $i++) {
    $idUtilisateur = \Ramsey\Uuid\Uuid::uuid4()->toString(); // Générer un UUID
    $prenom = $faker->firstName;
    $nom = $faker->lastName;
    $email = $faker->email;
    $password = password_hash('mot_de_passe_par_defaut', PASSWORD_DEFAULT); // Assurez-vous de définir un mot de passe sécurisé
    $dateInscription = $faker->date;
    $activationToken = null;
    $activationTokenExpirationDate = null;
    $refreshToken = null;
    $refreshTokenExpirationDate = null;
    $resetPasswdToken = null;
    $resetPasswdTokenExpirationDate = null;

    // Limiter à un maximum de 3 utilisateurs avec le rôle 3
    $role = ($i <= 3) ? 3 : $faker->numberBetween(1, 2);

    echo "INSERT INTO Utilisateur (idUtilisateur, prenom, nom, email, password, dateInscription, activation_token, activation_token_expiration_date, refresh_token, refresh_token_expiration_date, reset_passwd_token, reset_passwd_token_expiration_date, role) 
          VALUES ('$idUtilisateur', '$prenom', '$nom', '$email', '$password', '$dateInscription', '$activationToken', '$activationTokenExpirationDate', '$refreshToken', '$refreshTokenExpirationDate', '$resetPasswdToken', '$resetPasswdTokenExpirationDate', '$role');\n";
}

