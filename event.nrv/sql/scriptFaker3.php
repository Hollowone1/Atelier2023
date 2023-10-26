<?php
require '/var/www/vendor/autoload.php';

use Ramsey\Uuid\Uuid;

$faker = Faker\Factory::create();

// Génération des lieux et images de lieu
for ($i = 1; $i <= 5; $i++) {
    $uuidLieu = Uuid::uuid4()->toString();
    echo "INSERT INTO Lieu (idLieu, nom, adresse, nbPlacesAssises, nbPlacesDebout, idImg) VALUES ('$uuidLieu', '" . $faker->company . "', '" . $faker->address . "', " . $faker->numberBetween(100, 500) . ", " . $faker->numberBetween(100, 500) . ", '$uuidLieu');\n";
    for ($j = 1; $j <= 3; $j++) {
        $uuidImgLieu = Uuid::uuid4()->toString();
        echo "INSERT INTO ImgLieu (idImg, img, idLieu) VALUES ('$uuidImgLieu', 'image_lieu_" . $i . "_" . $j . ".jpg', '$uuidLieu');\n";
    }
}

// Génération des soirées
for ($i = 1; $i <= 42; $i++) {
    $uuidSoiree = Uuid::uuid4()->toString();
    echo "INSERT INTO Soiree (idSoiree, nom, theme, date, horaireDebut, tarifNormal, tarifReduit, idLieu) VALUES ('$uuidSoiree', 'Soirée " . $i . "', '" . $faker->word . "', '" . $faker->date . "', '" . $faker->time . "', " . $faker->randomFloat(2, 10, 100) . ", " . $faker->randomFloat(2, 5, 50) . ", " . $faker->numberBetween(1, 5) . ");\n";
}

// Génération des spectacles et artistes associés
for ($i = 1; $i <= 126; $i++) {
    $uuidSpectacle = Uuid::uuid4()->toString();
    echo "INSERT INTO Spectacle (idSpectacle, titre, description, urlVideo, horairePrevionnel, idSoiree, idImg) VALUES ('$uuidSpectacle', 'Spectacle " . $i . "', '" . $faker->sentence . "', 'video_spectacle_" . $i . ".mp4', '" . $faker->dateTimeThisYear->format('Y-m-d H:i:s') . "', " . $faker->numberBetween(1, 42) . ", '$uuidSpectacle');\n";

    // Associer 1 à 3 artistes au spectacle
    $numArtists = $faker->numberBetween(1, 3);
    for ($k = 1; $k <= $numArtists; $k++) {
        $uuidArtiste = Uuid::uuid4()->toString();
        echo "INSERT INTO Artiste (idArtiste, nom, idSpectacle) VALUES ('$uuidArtiste', '" . $faker->name . "', '$uuidSpectacle');\n";
    }

    // Associer 1 à 3 images au spectacle
    $numImages = $faker->numberBetween(1, 3);
    for ($j = 1; $j <= $numImages; $j++) {
        $uuidImgSpectacle = Uuid::uuid4()->toString();
        echo "INSERT INTO ImgSpectacle (idImg, img, idSpectacle) VALUES ('$uuidImgSpectacle', 'image_spectacle_" . $i . "_" . $j . ".jpg', '$uuidSpectacle');\n";
    }
}
