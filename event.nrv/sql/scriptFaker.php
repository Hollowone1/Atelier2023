<?php
require '/var/www/vendor/autoload.php'; // Assurez-vous d'avoir installé la bibliothèque Faker.

$faker = Faker\Factory::create();


// Génération des lieux et images de lieu
for ($i = 1; $i <= 5; $i++) {
    echo "INSERT INTO Lieu (idLieu, nom, adresse, nbPlacesAssises, nbPlacesDebout, idImg) VALUES ($i, '" . $faker->company . "', '" . $faker->address . "', " . $faker->numberBetween(100, 500) . ", " . $faker->numberBetween(100, 500) . ", " . $i . ");\n";
    for ($j = 1; $j <= 3; $j++) {
        $idImgLieu = ($i - 1) * 3 + $j;
        echo "INSERT INTO ImgLieu (idImg, img, idLieu) VALUES ($idImgLieu, 'image_lieu_" . $i . "_" . $j . ".jpg', " . $i . ");\n";
    }
}

// Génération des soirées
for ($i = 1; $i <= 42; $i++) {
    echo "INSERT INTO Soiree (idSoiree, nom, theme, date, horaireDebut, tarifNormal, tarifReduit, idLieu) VALUES ($i, 'Soirée " . $i . "', '" . $faker->word . "', '" . $faker->date . "', '" . $faker->time . "', " . $faker->randomFloat(2, 10, 100) . ", " . $faker->randomFloat(2, 5, 50) . ", " . $faker->numberBetween(1, 5) . ");\n";
}

// Génération des spectacles et artistes associés
for ($i = 1; $i <= 126; $i++) {
    echo "INSERT INTO Spectacle (idSpectacle, titre, description, urlVideo, horairePrevionnel, idSoiree, idImg) VALUES ($i, 'Spectacle " . $i . "', '" . $faker->sentence . "', 'video_spectacle_" . $i . ".mp4', '" . $faker->dateTimeThisYear->format('Y-m-d H:i:s') . "', " . $faker->numberBetween(1, 42) . ", " . $faker->numberBetween(1, 378) . ");\n";

    // Associer 1 à 3 artistes au spectacle
    $numArtists = $faker->numberBetween(1, 3);
    $idArtiste = range(1, 50);
    shuffle($idArtiste);
    $idArtiste = array_slice($idArtiste, 0, $numArtists);
    foreach ($idArtiste as $id) {
        echo "INSERT INTO Artiste (idArtiste, nom, idSpectacle) VALUES ('$id" . "'," . $faker->name . ", " . $i . ");\n";
    }

    // Associer 1 à 3 images au spectacle
    $numImages = $faker->numberBetween(1, 3);
    for ($j = 1; $j <= $numImages; $j++) {
        $idImgSpectacle = ($i - 1) * 3 + $j;
        echo "INSERT INTO ImgSpectacle (idImg, img, idSpectacle) VALUES ($idImgSpectacle, 'image_spectacle_" . $i . "_" . $j . ".jpg', " . $i . ");\n";
    }
}
?>
