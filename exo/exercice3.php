<?php

//EXERCICE 1
$a = 8;
$b = 4;
$operation = '*';

if ($operation == '+') {
    $resultat = $a + $b; //addition
    echo "$a + $b = $resultat";
}elseif ($operation == '-') {
    $resultat = $a - $b; //soustraction
    echo "$a - $b = $resultat";
}elseif ($operation == '*') {
    $resultat = $a * $b; //multiplication
    echo "$a * $b = $resultat";
}elseif ($operation == '/') {
    if ($b != 0) {
        $resultat = $a / $b;
    } else {
        echo "Division par zéro impossible";
    }
} else {
    echo "Opération non reconnue";
}

//EXERCICE 2

$result = 5 + 3 * 2;
echo "Résultat sans parenthèse : $result";

$result_avec_parenthese = (5 + 3) * 2;
echo "Résultat avec parenthèse : $result_avec_parenthese";


//EXERCICE 3 

$x = 10;

echo "Résultat de \$x > 5 : ";
var_dump($x > 5);

echo "Résultat de \$x < 5 : ";
var_dump($x < 5);

echo "Résultat de \$x == 10 : ";
var_dump($x == 10);

echo "Résultat de \$x != 8 : ";
var_dump($x != 8);

echo "Résultat de \$x >= 10 : ";
var_dump($x >= 10);

echo "Résultat de \$x <= 9 : ";
var_dump($x <= 9);


//EXERCICE 4
$isAdmin = true;
$isLoggedIn = false;

echo "resultat de \isAdmin && \isLoggedIn : ";
var_dump($isAdmin && $isLoggedIn);

echo "resultat de \isAdmin || \isLoggedIn : ";
var_dump($isAdmin || $isLoggedIn);

echo "resultat de \isAdmin xor \isLoggedIn : ";
var_dump($isAdmin xor $isLoggedIn);

//EXERCICE 5

$score = 15;

$resultat = ($score >= 10) ? "Réussi" : "Echoué";

echo "Pour un score de $score, le résultat est : $résultat";


//EXERCICE 6 

$n = 4; 
echo "valeur initiale de \$n : $n";

$n += 3;
echo "Après \$n += 3 : $n";

$n *= 2;
echo "Après \$n *= 2 : $n";

$n -= 1;
echo "Après \$n -= 1 : $n";

$n %= 5;
echo "Après \$n %= 5 : $n";


//EXERCICE 7

$prenom = "Alice";
$nom = "Durand";

$nom_complet = $prenom . " " .$nom;
echo "nom complet : $nom_complet";

//EXERCICE 8 

$fichier = @fopen("fichier_inexistant.txt", "r");

if (!$fichier) {
    echo "Erreur personnalisée : le fichier n'as pas pu être ouvert.";
} else {
    fclose($fichier);
    echo "le fichier a été ouvert avec succès";
}

?>