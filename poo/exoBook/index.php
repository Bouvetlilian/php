<?php
// index.php

// Inclure l'autoloader de Composer
require_once __DIR__ . '/vendor/autoload.php';

use Diginamic\Lilian\Routes\Api;

// Activer les en-têtes CORS pour permettre l'accès à l'API depuis n'importe quelle origine
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Si c'est une requête OPTIONS (préflight), terminer ici
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Récupérer l'URL demandée et la méthode HTTP
$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

// Extraire le chemin de l'URL (sans les paramètres de requête)
$uri = parse_url($requestUri, PHP_URL_PATH);

// Définir le préfixe de l'API
$prefix = '/api';

// Vérifier si l'URL commence par le préfixe
if (strpos($uri, $prefix) !== 0) {
    header('Content-Type: application/json');
    http_response_code(404);
    echo json_encode(['error' => 'Route non trouvée']);
    exit;
}

// Supprimer le préfixe de l'URL
$uri = substr($uri, strlen($prefix));

// Appeler le routeur de l'API
Api::route($requestMethod, $uri);