<?php

//EXERCICE 1
$couleurs = ["bleu", "blanc", "rouge"];

foreach ($couleurs as $couleur) {
    echo $couleur . "<br>";
}

//EXERCICE 2

$personne = [
    "nom" => "Dupont",
    "age" => "25"
];

echo "Nom : " . $personne["nom"] . "<br>";
echo "Age : " . $personne["age"] . " ans";


//EXERCICE 3

$fruits = ["pomme", "banane"];

echo "tableau initial : <br>";
foreach ($fruits as $fruit) {
    echo $fruit . "<br>";
}

$fruits[] = "orange";


//EXERCICE 4

$animaux = ["chien", "chat", "lapin"];

echo "tableau initial : <br>";
foreach ($animaux as $animal) {
    echo $animal . "<br>";
}

$index = array_search("chat", $animaux);

if ($index !== false) {
    unset($animaux[$index]);
}

echo "Tableau après suppression : <br>";
foreach ($animaux as $animal) {
    echo $animal . "<br>";

}


//EXERCICE 5

$nombres = [5, 2, 9, 1, 7];

echo "Tableau initial : <br>";
foreach ($nombres as $nombre) {
    echo $nombre . "<br>";
}

sort($nombres);

echo "Tableau trié : <br>";
foreach ($nombres as $nombre) {
    echo $nombre . " ";
}

//EXERCICE 6

$fruits = ["pomme", "banane", "orange", "fraise", "kiwi"];

$nombre_de_fruits = count($fruits);

echo "Voici les fruits dans le tableau : <br>";
foreach ($fruits as $fruit) {
    echo $fruit . "<br>";
}

echo "Le tableau contient " . $nombre_de_fruits . "fruits";


//EXERCICE 7

$sports = ["football", "basketball", "tennis", "natation"]; 

$basketball_present = in_array("basketball", $sports);
foreach ($sports as $sport) {
    echo $sport . "<br>";
}

echo "<br>";
if ($basketball_present) {
    echo "Le basketball est présent dans la liste";
} else {
    echo "Le basketball n'est pas présent dans la liste";
}

//EXERCICE 8

$tableau1 = ["a", "b"];
$tableau2 = ["c", "d"];

echo "Tableau 1 : ";
foreach($tableau1 as $element) {
    echo $element . " ";
}
echo "<br>Tableau 2 : ";
foreach($tableau2 as $element) {
    echo $element . " ";
}

$tableau_fusion = array_merge($tableau1, $tableau2);

echo "<br><br>Tableau fusionné : ";
foreach ($tableau_fusion as $element) {
    echo $element . "<br>";
}


//EXERCICE 9

$capitales = [
    "France" => "Paris",
    "Espagne" => "Madrid",
    "Italie" => "Rome",
    "Allemagne" => "Berlin",
];

echo "Liste des pays et leurs capitales : <br>";
foreach ($capitales as $pays => $capitale) {
    echo $pays . " => " . $capitale . "<br>";
}

$pays = array_keys($capitales);
echo "<br>Listes des pays uniquement : <br>";
foreach ($pays as $nom_pays) {
    echo $nom_pays . "<br>";
}


//EXERCICE 10

$nombres = [1, 2, 3, 4, 5, 6];

echo "Tableau initial : ";
foreach ($nombres as $nombre) {
    echo $nombre . " ";
}

$nombres_pairs = array_filter($nombres, function($nombre) {
    return $nombre % 2 == 0;
});

echo "<br><br>Nombres pairs : ";
foreach ($nombres_pairs as $nombre) {
    echo $nombre . " ";
}


//EXERCICE 11

$fruits = ["banane", "orange"];

echo "tableau initial : <br>";
foreach ($fruits as $fruit) {
    echo $fruit . "<br>";
}

array_unshift($fruits, "pomme");

echo "<br>Tableau après ajout au début : <br>";
foreach ($fruits as $fruit) {
    echo $fruit . "<br>";
}


//EXERCICE 12


$personne1 = [
    "nom" => "Dupont",
    "age" => 25,
    "ville" => "Paris",
];
$personne2 = [
    "nom" => "Martin",
    "email" => "martin@example.com",
    "téléphone" => "0102030405",
];

echo "Personne 1 : <br>";
foreach ($personne1 as $clé => $valeur) {
    echo $clé . " : " . $valeur . "<br>";

}
echo "Personne 2 : <br>";
foreach ($personne2 as $clé => $valeur) {
    echo $clé . " : " . $valeur . "<br>";

}

$fusion_simple = array_merge($personne1, $personne2);

$fusion_avec_preservation = $personne1 + $personne2;

echo "<br> Fusion avec array_merge : <br>";
foreach ($fusion_simple as $clé => $valeur) {
    echo $clé . " : " . $valeur . "<br>";
}
echo "<br> Fusion avec l'opérateur + : <br>";
foreach ($fusion_avec_preservation as $clé => $valeur) {
    echo $clé . " : " . $valeur . "<br>";
}


//EXERCICE 13

$pays = ["France", "Espagne", "Italie", "Allemagne", "Portugal"];

echo "Liste des pays : <br>";
foreach ($pays as $index => $nom_pays) {
    echo "Position " . $index . " : " . $nom_pays . "<br>";
}

$position = array_search("Espagne", $pays);

echo "<br>";
if ($position !== false) {
    echo "L'Espagne se trouve à la position " . $position . " du tableau";
} else {
    echo "L'Espagne n'a pas été trouvée dans le tableau";
}



//EXERCICE 14

$utilisateur = [
    "nom" => "Dupont",
    "age" => 25,
    "email" => "dupont@example.com",
];

echo "Informations initiales de l'utilisateur : <br>";
foreach ($utilisateur as $clé => $valeur) {
    echo $clé . " : " . $valeur . "<br>";
}

$utilisateur["age"] = 26;

$utilisateur["ville"] = "Paris";

echo "<br> Informations de l'utilisateur après modifications : <br>";
foreach ($utilisateur as $clé => $valeur) {
    echo $clé . " : " . $valeur . "<br>";
}

//EXERCICE 15 

$lettres = ["a", "b", "c", "d", "e"];


echo "Tableau initial : ";
foreach ($lettres as $lettre) {
    echo $lettre . " ";
}

shuffle($lettres);

echo "<br><br>Tableau après mélange :";
foreach ($lettres as $lettre) {
    echo $lettre . " "; 
}







?>