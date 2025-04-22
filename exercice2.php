<?php

//Exercice 1

$texte = "Bonjour";

$nombre = 45;

$estVrai = true;

echo "Type de \$texte : " . gettype($texte) . "<br>";
echo "Type de \$nombre : " . gettype($nombre) . "<br>";
echo "Type de \$estVrai : " . gettype($estVrai) . "<br>";

//Exercice 2

$a = "10";
$b = 5;

$resultat = $a + $b;

echo "Le résultat de \"10\" + 5 est : " . $resultat . "<br>";

echo "Détails du résultat : ";
var_dump($resultat);
echo "<br>";

//Exercice 3 

$chaine = "123";
$entier = (int) $chaine;

$decimal = 7.8;
$texte = (string) $decimal;

echo "Après conversion de \"123\" en entier : ";
var_dump($entier);
echo "<br>";

echo "Après conversion de 7.8 en chaine : ";
var_dump($texte);
echo "<br>";

//Exercice 4 

$value = 0;
echo "Pour \$value = 0 :<br>";
echo "is_int(\$value) : " .(is_int($value) ? "true" : "false") . "<br>";
?>