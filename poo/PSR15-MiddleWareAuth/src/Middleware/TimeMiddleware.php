<?php

namespace Diginamic\Framework\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class TimeMiddleware implements MiddlewareInterface
{
    private string $source;

    public function __construct(string $source = 'global')
    {
        $this->source = $source;
    }

    public function process(ServerRequestInterface $request, callable $next): ResponseInterface
    {
        //Enregistrer le temps de début
        $startTime = microtime(true);

        //On passe au middleware suivant
        $response = $next($request);

        //Enregistrer le temps de fin
        $endTime = microtime(true);

        //On calcule le temps d'exécution en millisecondes
        $executionTime = ($endTime - $startTime) * 1000;

        //On formate avec deux décimales
        $formateTime = number_format($executionTime, 2) . 'ms';

        //On renvoie la réponse modifiée
        error_log("Temps d'exécution : " . $formateTime);
        $headerName = 'X-Execution-Time' . $this->source;
        return $response->withHeader($headerName, $formateTime);
    }
}