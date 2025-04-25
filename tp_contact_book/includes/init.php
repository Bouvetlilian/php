<?php
// Inclusion du fichier de configuration
require_once dirname(__DIR__) . '/includes/config.php';

// Récupération des messages de session
$message = '';
$messageType = '';

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $messageType = $_SESSION['message_type'] ?? '';
    
    // Une fois récupérés, on les supprime de la session
    unset($_SESSION['message']);
    unset($_SESSION['message_type']);
}

// Fonction utilitaire pour rediriger
function redirect($url) {
    header("Location: $url");
    exit;
}