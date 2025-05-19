<?php
// src/Routes/api.php

namespace Diginamic\Lilian\Routes;

use Diginamic\Lilian\Controller\BookController;

class Api
{
    /**
     * Gère les routes de l'API et redirige vers les méthodes du contrôleur appropriées
     * @param string $requestMethod Méthode HTTP (GET, POST, PUT, DELETE)
     * @param string $uri URI de la requête
     * @return void
     */
    public static function route($requestMethod, $uri)
    {
        // Créer une instance du contrôleur
        $controller = new BookController();

        // Router les requêtes vers les méthodes appropriées du contrôleur
        if (preg_match('#^/books$#', $uri)) {
            // Route pour la liste des livres ou la création d'un livre
            switch ($requestMethod) {
                case 'GET':
                    // GET /api/books - Liste tous les livres
                    echo $controller->getAll();
                    break;
                case 'POST':
                    // POST /api/books - Ajoute un nouveau livre
                    echo $controller->create();
                    break;
                default:
                    // Méthode non supportée
                    header('Content-Type: application/json');
                    http_response_code(405);
                    echo json_encode(['error' => 'Méthode non autorisée']);
                    break;
            }
        } elseif (preg_match('#^/books/(\d+)$#', $uri, $matches)) {
            // Récupérer l'ID du livre à partir de l'URL
            $id = $matches[1];
            
            // Route pour un livre spécifique
            switch ($requestMethod) {
                case 'GET':
                    // GET /api/books/{id} - Affiche les détails d'un livre spécifique
                    echo $controller->getOne($id);
                    break;
                case 'PUT':
                    // PUT /api/books/{id} - Met à jour un livre existant
                    echo $controller->update($id);
                    break;
                case 'DELETE':
                    // DELETE /api/books/{id} - Supprime un livre
                    echo $controller->delete($id);
                    break;
                default:
                    // Méthode non supportée
                    header('Content-Type: application/json');
                    http_response_code(405);
                    echo json_encode(['error' => 'Méthode non autorisée']);
                    break;
            }
        } else {
            // Route non trouvée
            header('Content-Type: application/json');
            http_response_code(404);
            echo json_encode(['error' => 'Route non trouvée']);
        }
    }
}