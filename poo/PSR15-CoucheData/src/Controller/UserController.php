<?php 

namespace Diginamic\Framework\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;
use Diginamic\Framework\Repository\UserRepository;

class UserController
{
    private UserRepository $userRepository;

    /**
     * Constructeur - initialise le repository
     */
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * Affiche la liste de tous les utilisateurs
     * Route: GET /users
     */
    public function findAll(ServerRequestInterface $request): ResponseInterface
    {
        // Récupérer tous les utilisateurs depuis la base de données
        $users = $this->userRepository->findAll();
        
        // Créer le HTML pour afficher les utilisateurs
        $html = '<h1>Liste des utilisateurs</h1>';
        $html .= '<a href="/users/create">Créer un nouvel utilisateur</a>';
        $html .= '<table border="1" style="margin-top: 20px;">';
        $html .= '<tr>';
        $html .= '    <th>ID</th>';
        $html .= '    <th>Login</th>';
        $html .= '    <th>Email</th>';
        $html .= '    <th>Date de création</th>';
        $html .= '    <th>Actions</th>';
        $html .= '</tr>';

        // Boucler sur chaque utilisateur pour créer une ligne du tableau
        foreach ($users as $user) {
            $html .= '<tr>';
            $html .= '    <td>' . htmlspecialchars($user->id) . '</td>';
            $html .= '    <td>' . htmlspecialchars($user->login) . '</td>';
            $html .= '    <td>' . htmlspecialchars($user->email) . '</td>';
            $html .= '    <td>' . htmlspecialchars($user->created_at) . '</td>';
            $html .= '    <td>';
            $html .= '        <a href="/users/' . $user->id . '/edit">Modifier</a> | ';
            $html .= '        <a href="/users/' . $user->id . '/delete" onclick="return confirm(\'Êtes-vous sûr ?\')">Supprimer</a>';
            $html .= '    </td>';
            $html .= '</tr>';
        }

        $html .= '</table>';

        // Retourner la réponse HTTP
        return new Response(
            200,
            ['Content-Type' => 'text/html; charset=utf-8'],
            $html
        );
    }

    /**
     * Affiche le formulaire de création d'utilisateur
     * Route: GET /users/create
     */
    public function create(ServerRequestInterface $request): ResponseInterface
    {
        $html = '<h1>Créer un nouvel utilisateur</h1>';
        $html .= '<form method="post" action="/users">';
        $html .= '    <div style="margin-bottom: 10px;">';
        $html .= '        <label for="login">Login :</label><br>';
        $html .= '        <input type="text" id="login" name="login" required>';
        $html .= '    </div>';
        $html .= '    <div style="margin-bottom: 10px;">';
        $html .= '        <label for="email">Email :</label><br>';
        $html .= '        <input type="email" id="email" name="email" required>';
        $html .= '    </div>';
        $html .= '    <div style="margin-bottom: 10px;">';
        $html .= '        <label for="password">Mot de passe :</label><br>';
        $html .= '        <input type="password" id="password" name="password" required>';
        $html .= '    </div>';
        $html .= '    <div>';
        $html .= '        <button type="submit">Créer</button>';
        $html .= '        <a href="/users">Annuler</a>';
        $html .= '    </div>';
        $html .= '</form>';

        return new Response(
            200,
            ['Content-Type' => 'text/html; charset=utf-8'],
            $html
        );
    }

    /**
     * Traite la création d'un utilisateur
     * Route: POST /users
     */
    public function add(ServerRequestInterface $request): ResponseInterface
    {
        // Récupérer les données du formulaire
        $formData = $request->getParsedBody();
        
        // Créer un nouvel objet User
        $user = new \Diginamic\Framework\Model\User();
        $user->login = $formData['login'] ?? '';
        $user->email = $formData['email'] ?? '';
        $user->password = $formData['password'] ?? ''; // En production, il faudrait hasher le mot de passe !
        
        // Sauvegarder en base de données
        $success = $this->userRepository->save($user);

        if ($success) {
            // Rediriger vers la liste des utilisateurs
            return new Response(
                302,
                ['Location' => '/users'],
                null
            );
        } else {
            // En cas d'erreur
            return new Response(
                500,
                ['Content-Type' => 'text/html; charset=utf-8'],
                '<h1>Erreur lors de la création de l\'utilisateur</h1>'
            );
        }
    }

    /**
     * Affiche le formulaire de modification d'utilisateur
     * Route: GET /users/{id}/edit
     */
    public function edit(ServerRequestInterface $request, array $routeParams = []): ResponseInterface
    {
        // Récupérer l'ID depuis les paramètres de route
        $id = $routeParams['id'] ?? null;
        
        if (!$id) {
            return new Response(
                400,
                ['Content-Type' => 'text/html; charset=utf-8'],
                '<h1>ID d\'utilisateur manquant</h1>'
            );
        }

        // Récupérer l'utilisateur depuis la base de données
        $user = $this->userRepository->findById($id);
        
        if (!$user) {
            return new Response(
                404,
                ['Content-Type' => 'text/html; charset=utf-8'],
                '<h1>Utilisateur non trouvé</h1>'
            );
        }

        // Créer le formulaire pré-rempli
        $html = '<h1>Modifier l\'utilisateur</h1>';
        $html .= '<form method="post" action="/users/' . $user->id . '">';
        $html .= '    <input type="hidden" name="_method" value="PUT">'; // Simuler la méthode PUT
        $html .= '    <div style="margin-bottom: 10px;">';
        $html .= '        <label for="login">Login :</label><br>';
        $html .= '        <input type="text" id="login" name="login" value="' . htmlspecialchars($user->login) . '" required>';
        $html .= '    </div>';
        $html .= '    <div style="margin-bottom: 10px;">';
        $html .= '        <label for="email">Email :</label><br>';
        $html .= '        <input type="email" id="email" name="email" value="' . htmlspecialchars($user->email) . '" required>';
        $html .= '    </div>';
        $html .= '    <div style="margin-bottom: 10px;">';
        $html .= '        <label for="password">Nouveau mot de passe (laisser vide pour ne pas changer) :</label><br>';
        $html .= '        <input type="password" id="password" name="password">';
        $html .= '    </div>';
        $html .= '    <div>';
        $html .= '        <button type="submit">Modifier</button>';
        $html .= '        <a href="/users">Annuler</a>';
        $html .= '    </div>';
        $html .= '</form>';

        return new Response(
            200,
            ['Content-Type' => 'text/html; charset=utf-8'],
            $html
        );
    }

    /**
     * Traite la modification d'un utilisateur
     * Route: POST /users/{id} (avec _method=PUT)
     */
    public function update(ServerRequestInterface $request, array $routeParams = []): ResponseInterface
    {
        $id = $routeParams['id'] ?? null;
        
        if (!$id) {
            return new Response(
                400,
                ['Content-Type' => 'text/html; charset=utf-8'],
                '<h1>ID d\'utilisateur manquant</h1>'
            );
        }

        // Récupérer l'utilisateur existant
        $user = $this->userRepository->findById($id);
        
        if (!$user) {
            return new Response(
                404,
                ['Content-Type' => 'text/html; charset=utf-8'],
                '<h1>Utilisateur non trouvé</h1>'
            );
        }

        // Récupérer les données du formulaire
        $formData = $request->getParsedBody();
        
        // Mettre à jour les propriétés
        $user->login = $formData['login'] ?? $user->login;
        $user->email = $formData['email'] ?? $user->email;
        
        // Si un nouveau mot de passe est fourni
        if (!empty($formData['password'])) {
            $user->password = $formData['password']; // En production, hasher le mot de passe !
        }
        
        // Sauvegarder les modifications
        $success = $this->userRepository->save($user);

        if ($success) {
            return new Response(
                302,
                ['Location' => '/users'],
                null
            );
        } else {
            return new Response(
                500,
                ['Content-Type' => 'text/html; charset=utf-8'],
                '<h1>Erreur lors de la modification de l\'utilisateur</h1>'
            );
        }
    }

    /**
     * Supprime un utilisateur
     * Route: GET /users/{id}/delete
     */
    public function delete(ServerRequestInterface $request, array $routeParams = []): ResponseInterface
    {
        $id = $routeParams['id'] ?? null;
        
        if (!$id) {
            return new Response(
                400,
                ['Content-Type' => 'text/html; charset=utf-8'],
                '<h1>ID d\'utilisateur manquant</h1>'
            );
        }

        // Supprimer l'utilisateur
        $success = $this->userRepository->delete($id);

        if ($success) {
            return new Response(
                302,
                ['Location' => '/users'],
                null
            );
        } else {
            return new Response(
                500,
                ['Content-Type' => 'text/html; charset=utf-8'],
                '<h1>Erreur lors de la suppression de l\'utilisateur</h1>'
            );
        }
    }
}

