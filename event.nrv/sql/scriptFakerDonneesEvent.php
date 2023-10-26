<?php

use Ramsey\Uuid\Uuid;

require '/var/www/vendor/autoload.php';

$faker = Faker\Factory::create();

$uuidsLieu = []; // Nous allons utiliser ce tableau pour stocker les UUIDs générés pour la table Lieu

// Génération des lieux et images de lieu
for ($i = 1; $i <= 5; $i++) {
    $uuidLieu = Uuid::uuid4();
    $uuidsLieu[] = $uuidLieu; // Stockons les UUIDs pour une utilisation ultérieure
    $idImgLieu = (($i - 1) * 3) + 1; // Cette opération générera les ID suivants pour la première image de chaque lieu: 1, 4, 7, 10, 13.
    echo "INSERT INTO Lieu (idLieu, nom, adresse, nbPlacesAssises, nbPlacesDebout, idImg) VALUES ('$uuidLieu', '" . $faker->company . "', '" . $faker->address . "', " . $faker->numberBetween(100, 500) . ", " . $faker->numberBetween(100, 500) . ", $idImgLieu);\n";
    for ($j = 1; $j <= 3; $j++) {
        $idImg = (($i - 1) * 3) + $j; // Cette opération générera les ID suivants pour les images de chaque lieu: [1,2,3], [4,5,6], ...
        echo "INSERT INTO ImgLieu (idImg, img, idLieu) VALUES ($idImg, 'image_lieu_" . $i . "_" . $j . ".jpg', '$uuidLieu');\n";
    }
}

// Génération des soirées
for ($i = 1; $i <= 42; $i++) {
    $uuidSoiree = Uuid::uuid4();
    $randomUuidLieu = $uuidsLieu[array_rand($uuidsLieu)]; // Prenez un UUID aléatoire de notre tableau pour idLieu dans Soiree
    echo "INSERT INTO Soiree (idSoiree, nom, theme, date, horaireDebut, tarifNormal, tarifReduit, idLieu) VALUES ('$uuidSoiree', 'Soirée " . $i . "', '" . $faker->word . "', '" . $faker->date . "', '" . $faker->time . "', " . $faker->randomFloat(2, 10, 100) . ", " . $faker->randomFloat(2, 5, 50) . ", '$randomUuidLieu');\n";
}

// Génération des spectacles et artistes associés
for ($i = 1; $i <= 126; $i++) {
    $uuidSpectacle = Uuid::uuid4();
    echo "INSERT INTO Spectacle (idSpectacle, titre, description, urlVideo, horairePrevionnel, idSoiree, idImg) VALUES ('$uuidSpectacle', 'Spectacle " . $i . "', '" . $faker->sentence . "', 'video_spectacle_" . $i . ".mp4', '" . $faker->dateTimeThisYear->format('Y-m-d H:i:s') . "', '$uuidSoiree', " . $faker->numberBetween(1, 378) . ");\n";

    $numArtists = $faker->numberBetween(1, 3);
    for ($j = 1; $j <= $numArtists; $j++) {
        $uuidArtiste = Uuid::uuid4();
        echo "INSERT INTO Artiste (idArtiste, nom, idSpectacle) VALUES ('$uuidArtiste', '" . $faker->name . "', '$uuidSpectacle');\n";
    }

    $numImages = $faker->numberBetween(1, 3);
    for ($j = 1; $j <= $numImages; $j++) {
        $idImgSpectacle = ($i - 1) * 3 + $j;
        echo "INSERT INTO ImgSpectacle (idImg, img, idSpectacle) VALUES ($idImgSpectacle, 'image_spectacle_" . $i . "_" . $j . ".jpg', '$uuidSpectacle');\n";
    }
}

