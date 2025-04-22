<?php


//EXERCICE 1

$age = 17;

if ($age >= 18) {
    echo "La personne est majeure.";
} else {
    echo "La personne est mineure.";
}

//EXERCICE 2

$nombre = 25;

if ($nombre > 0) {
    echo "Le nombre est positif";
} elseif ($nombre < 0) {
    echo "Le nombre est négatif";
} else {
    echo "Le nombre est égal à 0";
}

//EXERCICE 3 

$nombre = 25;

if ($nombre % 2 == 0) {
    echo "le nombre est pair";
} else {
    echo "le nombre est impair";
}

//EXERCICE 4

$age = 25;

if ($age >= 18 && $age <= 65) {
    echo "La personne ayant $age est dans la plage d'âge 18-65 ans.";
} else {
    echo "La personne ayant $age n'est pas dans la plage d'âge 18-65 ans.";
}

//EXERCICE 5 

$password = "1234";

if ($password === "1234") {
    echo "Mot de passe correct";
} else {
    echo "Mot de passe incorrect";
}

//EXERCICE 6 

$nombre = 5;

if (($nombre % 3 == 0) && ($nombre % 5 == 0)) {
    echo "Le nombre $nombre est divisible à la fois par 3 et par 5.";
} else {
    echo "Le nombre $nombre n'est pas divisible à la fois par 3 et par 5.";
}

//EXERCICE 7 

$temperature = 10;

if ($temperature > 30) {
    echo "La température est chaude";
} elseif ($temperature >= 15 && $temperature <= 30) {
    echo "La température est modérée";
} elseif ($temperature < 15) {
    echo ("La température est froide");
}

//EXERCICE 8

if (isset($_POST['nombre'])) {
    $saisie = $_POST['nombre'];

    if (is_numeric($saisie) && $saisie == intval($saisie)) {
        echo "vous avez saisi le nombre entier : " . $saisie;
    } else {
        echo "Veuillez saisir un nombre entier";
    }
}

//EXERCICE 9

$personne = [
    "nom" => "Dupont",
    "age" => "25",
    "ville" => "Nantes",
];

if (array_key_exists("ville", $personne)) {
    echo "La clé 'ville' existe dans le tableau. La valeur est : " . $personne["ville"];
} else {
    echo "la clé 'ville' n'existe pas dans le tableau.";
}

?>