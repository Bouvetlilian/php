<?php
// Inclusion du fichier d'initialisation
require_once '../../includes/init.php';

// Vérifier que la méthode est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $favorite = isset($_POST['favorite']) ? true : false;
    
    if (empty($name) || empty($email)) {
        $_SESSION['message'] = 'Veuillez remplir tous les champs obligatoires.';
        $_SESSION['message_type'] = 'error';
        redirect('../create.php');
    }
    
    // Ajout du contact via le gestionnaire
    if ($contactManager->addContact($name, $email, $favorite)) {
        $_SESSION['message'] = 'Contact ajouté avec succès.';
        $_SESSION['message_type'] = 'success';
        redirect('../index.php');
    } else {
        $_SESSION['message'] = 'Une erreur est survenue lors de l\'ajout du contact.';
        $_SESSION['message_type'] = 'error';
        redirect('../create.php');
    }
} else {
    // Si quelqu'un accède directement à ce fichier sans POST
    redirect('../index.php');
}