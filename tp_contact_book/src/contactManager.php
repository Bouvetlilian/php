<?php

/**
 * Gestionnaire de contact - Cela centralise toutes les actions sur les contacts
 * Version avec persistance JSON
 */
class ContactManager
{
    /**
     * @var string Chemin vers le fichier JSON
     */
    private $jsonFilePath;

    /**
     * @var array Tableau des contacts
     */
    private $contacts = [];

    /**
     * Constructeur
     * 
     * @param string $jsonFilePath Chemin vers le fichier JSON
     */
    public function __construct($jsonFilePath)
    {
        $this->jsonFilePath = $jsonFilePath;
        $this->loadContacts();
    }

    /**
     * Charge les contacts depuis le fichier JSON
     */
    private function loadContacts()
    {
        if (file_exists($this->jsonFilePath)) {
            $jsonContent = file_get_contents($this->jsonFilePath);
            $this->contacts = json_decode($jsonContent, true) ?: [];
        } else {
            // Créer le fichier avec un tableau vide s'il n'existe pas
            $this->saveContacts();
        }
    }

    /**
     * Enregistre les contacts dans le fichier JSON
     */
    private function saveContacts()
    {
        $jsonContent = json_encode($this->contacts, JSON_PRETTY_PRINT);
        file_put_contents($this->jsonFilePath, $jsonContent);
    }

    /**
     * Ajoute un nouveau contact
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

        // Génération d'un ID unique
        $id = uniqid();

        // Création du contact
        $contact = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'favorite' => $favorite,
        ];

        // Ajout du contact au tableau
        $this->contacts[$id] = $contact;

        // Enregistrement des changements
        $this->saveContacts();

        return true;
    }

    /**
     * Récupère tous les contacts
     * 
     * @return array Liste des contacts
     */
    public function getAllContacts()
    {
        return $this->contacts;
    }

    /**
     * Récupère un contact par son ID
     * 
     * @param string $id l'ID du contact
     * @return array|null Les données du contact ou null si non trouvé
     */
    public function getContactById($id)
    {
        if (isset($this->contacts[$id])) {
            return $this->contacts[$id];
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
        //Vérification si contact existe
        if (!isset($this->contacts[$id])) {
            return false;
        }

        //Vérification si les données sont valides

        if (empty($name) || empty($email)) {
            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        // Mettre à jour le contact
        $this->contacts[$id]['name'] = $name;
        $this->contacts[$id]['email'] = $email;

        // Mettre à jour favorite que si il est fourni
        if ($favorite !== null) {
            $this->contacts[$id]['favorite'] = $favorite;
        }

        // Enregistrement des changements
        $this->saveContacts();

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
        if (isset($this->contacts[$id])) {
            unset($this->contacts[$id]);

            // Enregistrement des changements
            $this->saveContacts();

            return true;
        }
        return false;
    }
}
