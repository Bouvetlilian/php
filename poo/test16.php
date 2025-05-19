<?php


//** Le principe du routage est de faire un lien entre le chemin d'une requête (ci-dessous : velomobiles)          https://velomobile.fr/velomobiles/   et un routeur **/


$requestPath = "velomobiles";

$routePath = "velomobiles";


//Par défaut en php, les fonctions crééent leur propre scope
//Cependant, le fonctionnement n'est pas le même qu'en JS.
// On a pas accès au scope global à l'intérieur de la fonction.
// Pour palier ce fonctionnement, on peut utiliser une clé use.


$matches = function (string $requestPath) use ($routePath): bool {
    //Si la route ne contient pas de paramètres, comparaison directe
    echo strpos($routePath, '{');
    if (strpos($routePath, '{') === false) {
        return $routePath === $requestPath;
    }
    return false;
};

if ($matches($requestPath)) {
    echo "les deux routes matchent";
} else {
    echo "les deux routes ne matchent pas";
};