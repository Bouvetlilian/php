<?php

session_start();

// Définition des constantes pour les chemins

define('ROOT_PATH', dirname(__DIR__));
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('SRC_PATH', ROOT_PATH . '/src');
define('PUBLIC_PATH', ROOT_PATH . '/public');
define('DATA_PATH', ROOT_PATH . '/data');


//Est-ce que le répertoire DATA existe ?

if (!is_dir(DATA_PATH)) {
    mkdir(DATA_PATH, 0755, true);
}

//Chemin vers le fichier JSON
define('CONTACTS_JSON_PATH', DATA_PATH . '/contacts.json');

//On inclus la classe ContactManager
require_once SRC_PATH . '/ContactManager.php';

//On créé une instance du gestionaire de contact
$contactManager = new ContactManager(CONTACTS_JSON_PATH);
