<?php

namespace Diginamic\Framework\Views;

class HeaderView
{
  /**
   * Génère le header avec le menu de nav
   * 
   * @param string $currentPage l'URL de la page courante pour la mettre en surbrillance 
   * @return string Le HTML du header
   */

  public static function display($currentPage = ''): string
  {
    //On définit les pages du menu
    $menuItems = [
      ['url' => '/', 'label' => 'Accueil'],
      ['url' => '/users', 'label' => 'Administration des utilisateurs'],
    ];

    $html = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">';
    $html .= '<div class="container">';
    $html .= '<a class="navbar-brand" href="/">Mon Application</a>';

    // Menu principal
    $html .= '<ul class="navbar-nav">';

    foreach ($menuItems as $item) {
      //Vérif si page courante pour ajouter la classe active 
      $activeClass = ($currentPage === $item['url']) ? 'active' : '';
      $html .= '<li class="nav-item">';
      $html .= '<a class="nav-link ' . $activeClass . '" href="' . $item['url'] . '">' . $item['label'] . '</a>';
      $html .= '</li>';
    }
    $html .= '</ul>';
    $html .= '</div>';
    $html .= '</nav>';

    return $html;
  }
  /**
   * Retourne le CSS personnalisé pour le menu
   * 
   * @return string Le CSS pour styliser le menu actif
   */
  public static function getStyles(): string
  {
    return '
      .navbar-nav .nav-link.active {
        color: #fff !important;
        font-weight: bold;
        border-bottom: 2px solid #fff;
      }
    ';
  }
}
