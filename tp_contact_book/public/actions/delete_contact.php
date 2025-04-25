<?php
// Inclusion du fichier d'initialisation
require_once '../../includes/init.php';

// Récupérer l'ID du contact
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (empty($id)) {
    $_SESSION['message'] = 'ID de contact manquant.';
    $_SESSION['message_type'] = 'error';
    redirect('../index.php');
}

// Suppression du contact via le gestionnaire
if ($contactManager->deleteContact($id)) {
    $_SESSION['message'] = 'Contact supprimé avec succès.';
    $_SESSION['message_type'] = 'success';
} else {
    $_SESSION['message'] = 'Une erreur est survenue lors de la suppression du contact.';
    $_SESSION['message_type'] = 'error';
}

redirect('../index.php');