<?php

namespace Diginamic\Framework\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class TestController
{
  public function test(ServerRequestInterface $request): ResponseInterface
  {

    $globalTime = $request->getHeaderLine('X-Execution-Time-Global') ?: 'Non disponible'; 
    $routeTime = $request->getHeaderLine('X-Execution-Time-Route') ?: 'Non disponible'; 

    $html = '<p>Temps d\'éxécution global :</p>' . $globalTime;
    $html .= '<p>Temps d\'éxécution route :</p>' . $routeTime;

    return new Response(
      200,
      ['Content-Type' => 'text/html'],
      $html
    );
  }
}
