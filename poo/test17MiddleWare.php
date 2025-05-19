<?php

$request = "requête initiale";

function controler($request) {
    return "response";
}

function middleWare1($request, $next) {
    // Modification de la requête
    $request .= "1";
    // passe au suivant 
    $next($request, $next);
}

function middleWare2($request, $next) {
    $request .= "2";
}

middleWare1($request, $middleWare2);