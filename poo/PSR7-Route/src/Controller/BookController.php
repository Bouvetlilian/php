<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Model\Book;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class BookController
{
    public function getAll(ServerRequestInterface $request): ResponseInterface
    {
        // C'est la reponsabilité du contrôleur d'aller chercher les données 
        // En utilisant le modèle
        // Puis d'afficher en utilisant la vue
        // Utilisation de Book (le modèle) avec ces classes statiques
        $books = Book::getAll();


        return $this->createJsonResponse([
            'success' => true,
            'message' => 'Livre récupérés avec succès',
            'data' => $books
        ]);

    }
    public function getOne(ServerRequestInterface $request, array $routeParams): ResponseInterface
    {
        $id = $routeParams['id'];

        $book = Book::getById($id);

        // Si le livre n'est pas trouvé
        if ($book === null) {
            return $this->createJsonResponse([
                'success' => false,
                'message' => 'Livre non trouvé',
            ], 404);
        }

        // Si le livre est trouvé
        return $this->createJsonResponse([
            'success' => true,
            'message' => 'Livre récupéré avec succès',
            'data' => $book
        ]);
    }
    public function add(ServerRequestInterface $request): ResponseInterface
    {
        $newBook = $request->getBody()->getContents();
        $bookData = json_decode($newBook, true);

        if (!$bookData || !isset($bookData['title']) || !isset($bookData['author'])) {
            return $this->createJsonResponse([
                'success' => false,
                'message' => 'Données invalides, le titre et l\'auteur sont requis'
            ], 400);
        }

        $newBook = Book::add($bookData);

        return $this->createJsonResponse([
            'success' => true,
            'message' => 'Le livre a été ajouté avec succès'
        ], 200);
    }

    public function putOne(ServerRequestInterface $request, array $routeParams): ResponseInterface
    {
        $id = $routeParams['id'];

        $body = $request->getBody()->getContents();
        $bookData = json_decode($body, true);

        if (!$bookData || !isset($bookData['title']) || !isset($bookData['author'])) {
            return $this->createJsonResponse([
                'success' => false,
                'message' => 'Données invalides, le titre et l\'auteur sont requis'
            ], 400);
        }

        $updateBook = Book::update($id, $bookData);

        return $this->createJsonResponse([
            'success' => true,
            'message' => 'Le livre a été modifié avec succès',
            'data' => $updateBook,
        ], 200);
    }

    public function deleteOne(ServerRequestInterface $request, array $routeParams): ResponseInterface
    {
        $id = $routeParams['id'];

        $result = Book::delete($id);

        if($result) {
            return $this->createJsonResponse([
                'success' => true,
                'message' => 'Le livre a été supprimé avec succès'
            ], 200);
        } else {
            return $this->createJsonResponse([
                'success' => false,
                'message' => 'Erreur lors de la suppression du livre'
            ], 500);
        }
    }



    /**
     * Crée une réponse JSON
     */
    private function createJsonResponse(array $data, int $statusCode = 200): ResponseInterface
    {
        return new Response(
            $statusCode,
            [
                'Content-Type' => 'application/json',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
                'Access-Control-Allow-Headers' => 'Content-Type, Authorization'
            ],
            json_encode($data)
        );
    }
}
