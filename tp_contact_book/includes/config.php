<?php

session_start();

// Définition des constantes pour les chemins

define('ROOT_PATH', dirname(__DIR__));
define('INCLUDES_PATH', ROOT_PATH . '/includes');
define('SRC_PATH', ROOT_PATH . '/src');
define('PUBLIC_PATH', ROOT_PATH . '/public');


//Est-ce que la structure de session pour les contacts existent ? 

if (!isset($_SESSION['contacts'])) {
    $_SESSION['contacts'] = [];
}

require_once SRC_PATH . '/contactManager.php';
