<?php

namespace Diginamic\Framework\Controller;

use Diginamic\Framework\Views\View;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class HomeController
{
  public function index(ServerRequestInterface $request): ResponseInterface
  {
    $title = "Accueil";
    $content = "<h1>Bienvenue sur la page d'accueil</h1>";
    $content .= "<p>Ceci est la page d'accueil de notre application.</p>";
    
    // On passe '/' comme page courante pour activer le bon menu
    $html = View::baseTemplate($title, $content, '/');
    
    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      $html
    );
  }
}