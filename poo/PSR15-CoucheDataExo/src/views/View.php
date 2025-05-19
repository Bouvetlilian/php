<?php

namespace Diginamic\Framework\views;

class View
{
    //Méthode de class qui renvoie la base du html 
    public static function baseTemplate($title, $insideBody): string
    {
        //Syntaxe Herédoc
        $html = <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>$title</title>
        </head>
        <body>
        $insideBody
        </body>
        </html>
        HTML;
        return $html;
    }
}
