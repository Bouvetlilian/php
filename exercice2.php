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

//test avec 0
$value = 0;
echo "Pour \$value = 0 :<br>";
echo "is_int(\$value) : " .(is_int($value) ? "true" : "false") . "<br>";
echo "empty(\$value) : " . (empty($value) ? "true" : "false") . "<br><br>";

//test avec null
$value = null;
echo "Pour \$value = null :<br>";
echo "is_int(\$value) : " .(is_int($value) ? "true" : "false") . "<br>";
echo "empty(\$value) : " . (empty($value) ? "true" : "false") . "<br><br>";


//test avec ""
$value = "";
echo "Pour \$value = \"\" (chaine vide) :<br>";
echo "is_int(\$value) : " .(is_int($value) ? "true" : "false") . "<br>";
echo "empty(\$value) : " . (empty($value) ? "true" : "false") . "<br><br>";


//test avec false
$value = false;
echo "Pour \$value = false :<br>";
echo "is_int(\$value) : " .(is_int($value) ? "true" : "false") . "<br>";
echo "empty(\$value) : " . (empty($value) ? "true" : "false") . "<br><br>";


//test avec []
$value = [];
echo "Pour \$value = [] (tableau vide) :<br>";
echo "is_int(\$value) : " .(is_int($value) ? "true" : "false") . "<br>";
echo "empty(\$value) : " . (empty($value) ? "true" : "false") . "<br><br>";


//EXERCICE 5 

$age = "35";

echo "Type initial de \$age :" . gettype($age) . "<br>";

settype($age, "integer");

echo "Type après settype() : " . gettype($age) . "<br>";


//EXERCICE 6 

var_dump("0" == false);
var_dump("0" === false);

// == PHP convertit les types avant de comparer
// === PHP compare les types ET les valeurs

//EXERCICE 7 
$tableau = [
    42,
    3.14,
    true,
    "bonjour",
    null,
    false
];

echo "contenu du tableau : <br>";
foreach ($tableau as $index => $element) {
    echo "Element $index : ";
    var_dump($element);
    echo "<br>";
}


?>