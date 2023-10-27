<?php

use Ramsey\Uuid\Uuid;

require '/var/www/vendor/autoload.php';

$faker = Faker\Factory::create();

$uuidsLieu = [];
$uuidsSoiree = [];
$uuidsSpectacle = [];

// Génération des lieux et images de lieu
for ($i = 1; $i <= 5; $i++) {
    $uuidLieu = Uuid::uuid4();
    $uuidsLieu[] = $uuidLieu;
    echo "INSERT INTO Lieu (idLieu, nom, adresse, nbPlacesAssises, nbPlacesDebout) VALUES ('$uuidLieu', '" . $faker->company . "', '" . $faker->address . "', " . $faker->numberBetween(100, 500) . ", " . $faker->numberBetween(100, 500) . ");\n";
    for ($j = 1; $j <= 3; $j++) {
        $idImg = (($i - 1) * 3) + $j;
        echo "INSERT INTO ImgLieu (idImg, img, idLieu) VALUES ($idImg, 'image_lieu_" . $i . "_" . $j . ".jpg', '$uuidLieu');\n";
    }
}

// Génération des soirées
for ($i = 1; $i <= 42; $i++) {
    $uuidSoiree = Uuid::uuid4();
    $uuidsSoiree[] = $uuidSoiree;
    $randomUuidLieu = $uuidsLieu[array_rand($uuidsLieu)];
    echo "INSERT INTO Soiree (idSoiree, nom, theme, date, horaireDebut, tarifNormal, tarifReduit, idLieu) VALUES ('$uuidSoiree', 'Soirée " . $i . "', '" . $faker->word . "', '" . $faker->date . "', '" . $faker->time . "', " . $faker->randomFloat(2, 10, 100) . ", " . $faker->randomFloat(2, 5, 50) . ", '$randomUuidLieu');\n";
}

// Génération des spectacles et artistes associés
for ($i = 1; $i <= 126; $i++) {
    $uuidSpectacle = Uuid::uuid4();
    $randomUuidSoiree = $uuidsSoiree[array_rand($uuidsSoiree)];

    // 1. Insérer le spectacle d'abord
    echo "INSERT INTO Spectacle (idSpectacle, titre, description, urlVideo, horairePrevionnel, idSoiree) VALUES ('$uuidSpectacle', 'Spectacle " . $i . "', '" . $faker->sentence . "', 'video_spectacle_" . $i . ".mp4', '" . $faker->dateTimeThisYear->format('Y-m-d H:i:s') . "', '$randomUuidSoiree');\n";

    // 2. Ensuite, insérer les images associées à ce spectacle
    $numImages = $faker->numberBetween(1, 3);
    for ($j = 1; $j <= $numImages; $j++) {
        $idImgSpectacle = ($i - 1) * 3 + $j;
        echo "INSERT INTO ImgSpectacle (idImg, img, idSpectacle) VALUES ($idImgSpectacle, 'image_spectacle_" . $i . "_" . $j . ".jpg', '$uuidSpectacle');\n";
    }

    // 3. Enfin, insérer les artistes associés à ce spectacle
    $numArtists = $faker->numberBetween(1, 3);
    for ($j = 1; $j <= $numArtists; $j++) {
        $uuidArtiste = Uuid::uuid4();
        echo "INSERT INTO Artiste (idArtiste, nom, idSpectacle) VALUES ('$uuidArtiste', '" . $faker->name . "', '$uuidSpectacle');\n";
    }
}

