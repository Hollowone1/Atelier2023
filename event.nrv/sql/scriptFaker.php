<?php
require 'vendor/autoload.php'; // Assurez-vous d'avoir installé la bibliothèque Faker.

$faker = Faker\Factory::create();

// Génération des artistes
for ($i = 1; $i <= 50; $i++) {
    echo "INSERT INTO Artiste (nom, idSpectacle) VALUES ('" . $faker->name . "', " . $faker->numberBetween(1, 126) . ");\n";
}

// Génération des lieux et images de lieu
for ($i = 1; $i <= 5; $i++) {
    echo "INSERT INTO Lieu (nom, adresse, nbPlacesAssises, nbPlacesDebout, idImg) VALUES ('" . $faker->company . "', '" . $faker->address . "', " . $faker->numberBetween(100, 500) . ", " . $faker->numberBetween(100, 500) . ", " . $i . ");\n";
    for ($j = 1; $j <= 3; $j++) {
        echo "INSERT INTO ImgLieu (img, idLieu) VALUES ('image_lieu_" . $i . "_" . $j . ".jpg', " . $i . ");\n";
    }
}

// Génération des soirées
for ($i = 1; $i <= 42; $i++) {
    echo "INSERT INTO Soiree (nom, theme, date, horaireDebut, tarifNormal, tarifReduit, idLieu) VALUES ('Soirée " . $i . "', '" . $faker->word . "', '" . $faker->date . "', '" . $faker->time . "', " . $faker->randomFloat(2, 10, 100) . ", " . $faker->randomFloat(2, 5, 50) . ", " . $faker->numberBetween(1, 5) . ");\n";
}

// Génération des spectacles et artistes associés
for ($i = 1; $i <= 126; $i++) {
    echo "INSERT INTO Spectacle (titre, description, urlVideo, horairePrevionnel, idSoiree, idImg) VALUES ('Spectacle " . $i . "', '" . $faker->sentence . "', 'video_spectacle_" . $i . ".mp4', '" . $faker->dateTimeThisYear->format('Y-m-d H:i:s') . "', " . $faker->numberBetween(1, 42) . ", " . $faker->numberBetween(1, 378) . ");\n";
    // Associer 1 à 3 artistes au spectacle
    $numArtists = $faker->numberBetween(1, 3);
    $artistIds = range(1, 50);
    shuffle($artistIds);
    $artistIds = array_slice($artistIds, 0, $numArtists);
    foreach ($artistIds as $artistId) {
        echo "INSERT INTO Artiste (nom, idSpectacle) VALUES ('" . $faker->name . "', " . $i . ");\n";
    }
    // Associer 1 à 3 images au spectacle
    $numImages = $faker->numberBetween(1, 3);
    for ($j = 1; $j <= $numImages; $j++) {
        echo "INSERT INTO ImgSpectacle (img, idSpectacle) VALUES ('image_spectacle_" . $i . "_" . $j . ".jpg', " . $i . ");\n";
    }
}
?>
