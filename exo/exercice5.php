<?php

//EXERCICE 1
$i = 1;

for ($i = 1; $i <= 10; $i++) {
    echo $i . "<br>";
}

//EXERCICE 2

$somme = 0;

$i = 1;

while ($i <= 10) {
    $somme = $somme + $i;

    $i++;
}

echo "la somme des nombres de 1 à 10 est : " . $somme;


//EXERCICE 3

$i = 1;

do {
    echo $i . "<br>";

    $i++;
} while ($i <= 5);



//EXERCICE 4 

$fruits = [
    "pomme",
    "banane",
    "orange",
    "kiwi",
];

$nombreDeFruits = count($fruits);

for ($i = 0; $i < $nombreDeFruits; $i++) {
    echo $fruits[$i] . "<br>";
}

//EXERCICE 5 

$personne = [
    "nom" => "Dupont",
    "age" => 25,
];

foreach ($personne as $cle => $valeur) {
    echo "La" . $cle . "de la personne est : " . $valeur . "<br>";
}

//EXERCICE 6

for ($i = 1; $i <= 10; $i++) {
    if ($i == 5) {
        continue;
    }

    echo $i . "<br>";
}

//EXERCICE 7 

$nombres = [
    1, 2, 3, 4, 5, 6
];
foreach ($nombres as $nombre) {
    if ($nombre % 2 == 0) {
        echo $nombre . "<br>";
    }
}

//EXERCICE 8 

for ($i = 10; $i >= 1; $i--) {

    echo $i . "<br>";
}

//EXERCICE 9 

$nombre = $_GET["nombre"] ?? 1;

$nombre = (int)$nombre;

$factorielle = 1;

$i = $nombre;

while ($i > 1) {
    $factorielle = $factorielle * $i;
    $i--;
}

echo "la factorielle de " . $nombre . "est" . $factorielle;


//EXERCICE 10

if (!isset($_POST['mot'])) {
    $mot = $_POST['mot'];

    $_SESSION['mots'][] = $mot;

    if ($mot === "stop") {
        $_SESSION['mots'] = ["La boucle est terminé car vous avez saisi 'stop'"];
    }
}


?>

