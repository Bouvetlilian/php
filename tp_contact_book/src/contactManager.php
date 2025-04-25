<?php

/**
 * Gestionnaire de contact - Cela centralise toutes les actions sur les contacts
 */
class ContactManager
{
    /**
     * Ajoute un nouveau contact dans la session
     * 
     * @param string $name Le nom du contact
     * @param string $email L'email du contact
     * @param bool $favorite Le statut favori (optionnel)
     * @return bool Succès de l'opération
     */
    public function addContact($name, $email, $favorite = false)
    {
        if (empty($name) || empty($email)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        //Génération d'un ID unique
        $id = uniqid();

        //Création du contact
        $contact = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'favorite' => $favorite,
        ];

        //Ajout du contact à la session 
        $_SESSION['contacts'][$id] = $contact;

        return true;
    }

    /**
     * Récupère tous les contacts
     * 
     * @return array Liste des contacts
     */
    public function getAllContacts()
    {
        if (!isset($_SESSION['contacts'])) {
            return [];
        }
        return $_SESSION['contacts'];
    }

    /**
     * Récupère un contact par son ID
     * 
     * @param string $id L'ID du contact
     * @return array|null Les données du contact ou null si non trouvé
     */
    public function getContactById($id)
    {
        if (isset($_SESSION['contacts'][$id])) {
            return $_SESSION['contacts'][$id];
        }
        return null;
    }

    /**
     * Mettre à jour un contact existant
     * 
     * @param string $id L'ID du contact
     * @param string $name Le nouveau nom
     * @param string $email Le nouvel email
     * @param bool $favorite Le nouveau statut favori (optionnel)
     * @return bool Succès de l'opération
     */
    public function updateContact($id, $name, $email, $favorite = null)
    {
        //Vérification si le contact existe
        if (!isset($_SESSION['contacts'][$id])) {
            return false;
        }

        //Vérification si les données sont valides
        if (empty($name) || empty($email)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        //Mettre à jour le contact
        $_SESSION['contacts'][$id]['name'] = $name;
        $_SESSION['contacts'][$id]['email'] = $email;

        //Mettre à jour favorite que si il est fourni
        if ($favorite !== null) {
            $_SESSION['contacts'][$id]['favorite'] = $favorite;
        }

        return true;
    }

    /**
     * Supprimer un contact
     * 
     * @param string $id L'ID du contact
     * @return bool Succès de l'opération
     */
    public function deleteContact($id)
    {
        if (isset($_SESSION['contacts'][$id])) {
            unset($_SESSION['contacts'][$id]);
            return true;
        }
        return false;
    }
}

//Création d'une instance stocker dans la variable globale $contactManager accessible depuis n'importe quelle page
$contactManager = new ContactManager();
