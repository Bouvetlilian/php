<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Model\User;
use Diginamic\Framework\Repository\UserRepository;
use Diginamic\Framework\views\View;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class UserController
{
  // Attribut 
  private $userRepository;

  public function __construct()
  {
    $this->userRepository = new UserRepository();
  }
  public function findAll(ServerRequestInterface $request): ResponseInterface
{
    $title = "Administration des utilisateurs";
    
    // Commencer par le titre
    $html = "<h1>$title</h1>";
    
    // Ajouter le lien d'ajout
    $html .= '<p><a href="/users/add">➕ Ajouter un nouvel utilisateur</a></p>';
    
    // Récupérer les utilisateurs
    $users = $this->userRepository->findAll();
    
    // Commencer la liste
    $html .= '<ul>';
    
    // Parcours des utilisateurs
    foreach ($users as $user) {
        $html .= '<li>';
        $html .= "Login: $user->login<br>";
        $html .= "Email: $user->email<br>";
        $html .= "Créé le: $user->createdAt<br>";
        $html .= "<a href='/users/{$user->id}'>Mettre à jour</a> | ";
        $html .= "<a href='/users/delete/{$user->id}'>Supprimer</a>";
        $html .= '</li>';
    }
    
    $html .= '</ul>';
    
    return new Response(
        200,
        ['Content-Type' => 'text/html'],
        View::baseTemplate($title, $html)
    );
}
  public function displayAddForm(ServerRequestInterface $request): ResponseInterface
  {
    $html = '<form method="post" action="/users/add">';
    $html .= '    <div>';
    $html .= '        <label for="login">Login :</label>';
    $html .= '        <input type="text" id="login" name="login" required>';
    $html .= '    </div>';
    $html .= '    <div>';
    $html .= '        <label for="password">Password :</label>';
    $html .= '        <input type="password" id="password" name="password" required>';
    $html .= '    </div>';
    $html .= '    <div>';
    $html .= '        <label for="email">Email :</label>';
    $html .= '        <input type="email" id="email" name="email" required>';
    $html .= '    </div>';
    $html .= '    <div style="margin-top: 10px;">';
    $html .= '        <button type="submit">Créer un utilisateur</button>';
    $html .= '    </div>';
    $html .= '</form>';


    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>Ajout d\'un utilisateur </h1>' . $html
    );
  }

  public function add(ServerRequestInterface $request): ResponseInterface
  {
    // Récupération des données du formulaire dans le cadre du PSR-7 qui utilise les objets request et response
    $data = $request->getParsedBody();
    var_dump($data);

    // Création de l'entité User
    $userEntity = new User();

    // Hydratation de l'utilisation
    $userEntity->hydrate($data);


    // Appel au modèle ou au repository
    $this->userRepository->save($userEntity);



    // Utilisation des méthodes de UserRepository()

    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>Utilisateur enregistré </h1>',

    );
  }
  public function edit(ServerRequestInterface $request, array $routeParams = [])
  {
    // Récupération de l'id qui provient de la requête (le paramètre de la route)
    $id = $routeParams["id"];
    if (isset($id)) {
      // Récupération des données envoyées (pour modification) par le client via la requête
      $formData = $request->getParsedBody();

      // Création d'une instance de User avec la bonne id
      $user = new User();
      $user->hydrate($formData);
      $user->id = $id;

      // Modification de la base de données via le modèle donc via le repository
      if (!$this->userRepository->save($user)) {
        return new Response(
          418,
          ['Content-Type' => 'text/html'],
          '<h1>Problème dans la mise à jour </h1>'
        );
      }

      return new Response(
        200,
        ['Content-Type' => 'text/html'],
        '<h1>Utilisateur mis à jour </h1>'
      );
    }
    return new Response(
      400,
      ['Content-Type' => 'text/html'],
      '<h1>La requête HTTP a été mal formulée </h1>'
    );


    // Affiche les données du modèle dans un formulaire
  }
  public function displayFormEdit(ServerRequestInterface $request, array $routeParams = [])
  {
    // Récupération de l'id qui provient de la requête (le paramètre de la route)
    $id = $routeParams["id"];
    if (isset($id)) {
      // Récupération des données de l'utilisateur à modifier en passant par le repository
      $user = $this->userRepository->findById($id);

      // Si je n'ai pas d'utilisateur, je renvoie une erreur 404
      if (!$user) {
        return new Response(
          404,
          ['Content-Type' => 'text/html'],
          '<h1>Aucun utilisateur ne correspond ! </h1>'
        );
      }

      return new Response(
        200,
        ['Content-Type' => 'text/html'],
        '<h1>Formulaire de modification : </h1>' . $this->htmlUpdateForm($user)
      );
    }
    return new Response(
      400,
      ['Content-Type' => 'text/html'],
      '<h1>La requête HTTP a été mal forumlée </h1>'
    );


    // Affiche les données du modèle dans un formulaire
  }

  private function htmlUpdateForm($user)
  {
    $html = '<form method="post" action="/users/update/' . $user->id . '">';
    $html .= '    <div>';
    $html .= '        <label for="login">Login :</label>';
    $html .= '        <input type="text" id="login" value="' . $user->login . '" name="login" required>';
    $html .= '    </div>';
    $html .= '    <div>';
    $html .= '        <label for="password">Password :</label>';
    $html .= '        <input type="password" id="password" value="' . $user->password . '" name="password" required>';
    $html .= '    </div>';
    $html .= '    <div>';
    $html .= '        <label for="email">Email :</label>';
    $html .= '        <input type="email" id="email" value="' . $user->email . '" name="email" required>';
    $html .= '    </div>';
    $html .= '    <div style="margin-top: 10px;">';
    $html .= '        <button type="submit">Modifier</button>';
    $html .= '    </div>';
    $html .= '</form>';

    return $html;
  }
  public function delete(ServerRequestInterface $request, array $routeParams = []): ResponseInterface
  {
    // Récupération de l'id qui provient de la requête (le paramètre de la route)
    $id = $routeParams["id"] ?? null;

    if (!$id) {
      return new Response(400, ['Content-Type' => 'text/html'], '<h1>ID manquant</h1>');
    }
    // Supprimer l'utilisateur
    if ($this->userRepository->delete($id)) {
      return new Response(
        302,
        ['Location' => '/users'],
        null
      );
    } else {
      // Si échec
      return new Response(500, ['Content-Type' => 'text/html'], '<h1>Erreur de suppression</h1>');
    }
  }
}
