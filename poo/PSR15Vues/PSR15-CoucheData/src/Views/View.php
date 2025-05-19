<?php

namespace Diginamic\Framework\Views;

class View
{
  // méthode de classe qui renvoie la base du html
  public static function baseTemplate($title = 'Mon Application', $insideBody = '', $currentPage = ''): string
  {
    // On génère le header en utilisant HeaderView
    $header = HeaderView::display($currentPage);
    // On génère le footer en utilisant FooterView
    $footer = FooterView::display();

    // On récupère les styles du header
    $headerStyles = HeaderView::getStyles();
    // On récupère les styles du footer
    $footerStyles = FooterView::getStyles();

    // Syntaxe Herédoc
    $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{$title}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  <style>
    {$headerStyles}
    {$footerStyles}
  </style>
</head>
<body>
  {$header}
  <div class="container">
    {$insideBody}
  </div>
</body>
  {$footer}
</html>
HTML;
    return $html;
  }
}
