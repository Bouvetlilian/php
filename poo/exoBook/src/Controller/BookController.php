<?php
// src/Controller/BookController.php

namespace Diginamic\Lilian\Controller;

use Diginamic\Lilian\Model\Book;

class BookController
{
    /**
     * Récupère et retourne tous les livres
     * @return string Liste des livres au format JSON
     */
    public function getAll()
    {
        // Utilisation du modèle Book pour récupérer tous les livres
        $books = Book::getAll();
        
        // Définir l'en-tête de réponse comme JSON
        header('Content-Type: application/json');
        
        // Retourner les livres au format JSON avec le code 200 (OK)
        http_response_code(200);
        return json_encode($books);
    }

    /**
     * Récupère et retourne un livre spécifique par son ID
     * @param int $id ID du livre à récupérer
     * @return string Détails du livre au format JSON ou message d'erreur
     */
    public function getOne($id)
    {
        // Utilisation du modèle Book pour récupérer le livre par son ID
        $book = Book::getById($id);
        
        // Définir l'en-tête de réponse comme JSON
        header('Content-Type: application/json');
        
        // Vérifier si le livre existe
        if ($book) {
            // Retourner le livre au format JSON avec le code 200 (OK)
            http_response_code(200);
            return json_encode($book);
        } else {
            // Retourner un message d'erreur avec le code 404 (Not Found)
            http_response_code(404);
            return json_encode(['error' => 'Livre non trouvé']);
        }
    }

    /**
     * Crée un nouveau livre à partir des données reçues
     * @return string Détails du livre créé au format JSON ou message d'erreur
     */
    public function create()
    {
        // Récupérer les données envoyées en POST au format JSON
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Définir l'en-tête de réponse comme JSON
        header('Content-Type: application/json');
        
        // Vérifier si les données requises sont présentes
        if (!isset($data['title']) || !isset($data['author']) || !isset($data['year']) || !isset($data['genre'])) {
            // Retourner un message d'erreur avec le code 400 (Bad Request)
            http_response_code(400);
            return json_encode(['error' => 'Données incomplètes. Titre, auteur, année et genre sont requis.']);
        }
        
        // Créer un nouveau livre avec les données reçues
        $newBook = [
            'title' => $data['title'],
            'author' => $data['author'],
            'year' => (int)$data['year'],
            'genre' => $data['genre']
        ];
        
        // Ajouter le livre avec le modèle Book
        $createdBook = Book::add($newBook);
        
        // Retourner le livre créé au format JSON avec le code 201 (Created)
        http_response_code(201);
        return json_encode($createdBook);
    }

    /**
     * Met à jour un livre existant à partir des données reçues
     * @param int $id ID du livre à mettre à jour
     * @return string Détails du livre mis à jour au format JSON ou message d'erreur
     */
    public function update($id)
    {
        // Récupérer les données envoyées en PUT au format JSON
        $data = json_decode(file_get_contents('php://input'), true);
        
        // Définir l'en-tête de réponse comme JSON
        header('Content-Type: application/json');
        
        // Vérifier si les données requises sont présentes
        if (!isset($data['title']) || !isset($data['author']) || !isset($data['year']) || !isset($data['genre'])) {
            // Retourner un message d'erreur avec le code 400 (Bad Request)
            http_response_code(400);
            return json_encode(['error' => 'Données incomplètes. Titre, auteur, année et genre sont requis.']);
        }
        
        // Préparer les données pour la mise à jour
        $updatedBook = [
            'title' => $data['title'],
            'author' => $data['author'],
            'year' => (int)$data['year'],
            'genre' => $data['genre']
        ];
        
        // Mettre à jour le livre avec le modèle Book
        $result = Book::update($id, $updatedBook);
        
        // Vérifier si la mise à jour a réussi
        if ($result) {
            // Retourner le livre mis à jour au format JSON avec le code 200 (OK)
            http_response_code(200);
            return json_encode($result);
        } else {
            // Retourner un message d'erreur avec le code 404 (Not Found)
            http_response_code(404);
            return json_encode(['error' => 'Livre non trouvé']);
        }
    }

    /**
     * Supprime un livre spécifique par son ID
     * @param int $id ID du livre à supprimer
     * @return string Message de confirmation ou d'erreur au format JSON
     */
    public function delete($id)
    {
        // Définir l'en-tête de réponse comme JSON
        header('Content-Type: application/json');
        
        // Supprimer le livre avec le modèle Book
        $result = Book::delete($id);
        
        // Vérifier si la suppression a réussi
        if ($result) {
            // Retourner un message de confirmation avec le code 200 (OK)
            http_response_code(200);
            return json_encode(['message' => 'Livre supprimé avec succès']);
        } else {
            // Retourner un message d'erreur avec le code 404 (Not Found)
            http_response_code(404);
            return json_encode(['error' => 'Livre non trouvé']);
        }
    }
}