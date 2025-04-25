<?php

/**
 * Script de migration des données de session vers un fichier JSON
 */

 session_start();

 //Chemin vers le fichier JSON
 $jsonFilePath = __DIR__ . '/data/contacts.json';

 // Création du répertoire data s'il n'existe pas
$dataDir = dirname($jsonFilePath);
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

//Récupération des contacts depuis la session

$sessionContacts = isset($_SESSION['contacts']) ? $_SESSION['contacts'] : [];

//Enregistrement des contacts dans le fichier JSON

$jsonContent = json_encode($sessionContacts, JSON_PRETTY_PRINT);
file_put_contents($jsonFilePath, $jsonContent);

//Affichage message confirmation
echo "Migration des données de session vers le fichier JSON terminée<br>";
echo "Nombre de contacts migrés : " . count($sessionContacts) . "<br>";
echo "Fichier JSON créé : " . $jsonFilePath . "<br>";

?>