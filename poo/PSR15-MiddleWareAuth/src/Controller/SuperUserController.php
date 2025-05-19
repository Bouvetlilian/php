<?php

namespace Diginamic\Framework\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class SuperUserController
{
  public function superuser(ServerRequestInterface $request): ResponseInterface
  {
    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      '<h1>Page de votre super profil</h1>'
    );
  }
  public function index(ServerRequestInterface $request): ResponseInterface
{
    $html = '<h1>Page Super Utilisateur</h1>';
    $html .= '<p>Bienvenue sur la page réservée aux super utilisateurs!</p>';
    $html .= '<p>Cette page est protégée par authentification.</p>';
    $html .= '<p><a href="/logout">Se déconnecter</a></p>';
    $html .= '<a href="/">Retour à l\'accueil</a>';

    return new Response(
        200,
        ['Content-Type' => 'text/html; charset=utf-8'],
        $html
    );
}
}
