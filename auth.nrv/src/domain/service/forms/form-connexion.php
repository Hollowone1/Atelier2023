<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = array(); 

    if (isset($_POST["email"])) {
        $email = $_POST["email"];
        if (empty($email)) {
            $errors[] = "L'adresse e-mail est obligatoire.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse e-mail n'est pas valide.";
        }
    } else {
        $errors[] = "L'adresse e-mail n'a pas été soumise.";
    }

    if (isset($_POST["motdepasse"])) {
        $motdepasse = $_POST["motdepasse"];
        if (empty($motdepasse)) {
            $errors[] = "Le mot de passe est obligatoire.";
        } 
        } 
        else {
        $errors[] = "Le mot de passe n'a pas été soumis.";
    }

    if (empty($errors)) {
        header("Location: accueil.html");
        exit();
    } else {
        // Il y a des erreurs, affichez-les à l'utilisateur
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}