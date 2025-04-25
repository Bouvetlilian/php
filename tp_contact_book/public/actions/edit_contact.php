<?php
// Inclusion du fichier d'initialisation
require_once '../../includes/init.php';

// Vérifier que la méthode est POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer l'ID du contact
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    
    if (empty($id)) {
        $_SESSION['message'] = 'ID de contact manquant.';
        $_SESSION['message_type'] = 'error';
        redirect('../index.php');
    }
    
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $favorite = isset($_POST['favorite']) ? true : false;
    
    if (empty($name) || empty($email)) {
        $_SESSION['message'] = 'Veuillez remplir tous les champs obligatoires.';
        $_SESSION['message_type'] = 'error';
        redirect("../edit.php?id=$id");
    }
    
    // Mise à jour du contact via le gestionnaire
    if ($contactManager->updateContact($id, $name, $email, $favorite)) {
        $_SESSION['message'] = 'Contact modifié avec succès.';
        $_SESSION['message_type'] = 'success';
        redirect('../index.php');
    } else {
        $_SESSION['message'] = 'Une erreur est survenue lors de la modification du contact.';
        $_SESSION['message_type'] = 'error';
        redirect("../edit.php?id=$id");
    }
} else {
    // Si quelqu'un accède directement à ce fichier sans POST
    redirect('../index.php');
}