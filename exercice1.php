<?php

$name = 'Lilian<br>';

echo $name;

$firstName = "Lilian";
$lastName = "Bouvet";

//Méthode 1 : concaténation
echo "bonjour, je m'appelle " . $firstName ." " . $lastName . ".<br>";


//Méthode 2 : Interpolation

echo "bonjour, je m'appelle $firstName $lastName.<br>";


//Exercice 3
$a = 5;
$b = 3;

//Somme
echo "leur somme : " . ($a + $b) . "<br>";

//différence
echo "leur différence : " . ($a - $b) . "<br>";

//produit
echo "leur produit : " . ($a * $b) . "<br>";

//Leur quotient
echo "leur quotient : " . ($a / $b) . "<br>";


//Exercice 4
$isLoggedIn = false;

echo "Utilisateur connecté : " . ($isLoggedIn ? "true" : "false") ."<br>";

$isLoggedIn = true;
echo "Utilisateur connecté : " . ($isLoggedIn ? "true" : "false") ."<br>";

//Exercice 5
$_1variable = "test";
$maVariable = "exemple";
$php_Class = "PHP";

//Exercice 6 

$temperature = 25;

echo "Première valeur : ";
var_dump($temperature);
echo "<br>";

$temperature = "Vingt-cinq degrés";

echo "Deuxième valeur : ";
var_dump($temperature);
echo "<br>";

?>