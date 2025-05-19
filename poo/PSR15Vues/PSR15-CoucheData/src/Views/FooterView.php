<?php

namespace Diginamic\Framework\Views;

class FooterView
{
  /**
   * Génère le footer
   * 
   * @return string Le HTML du footer
   */
  public static function display(): string
  {
    $currentYear = date('Y');
    
    $html = '<footer class="footer mt-5 py-4 bg-dark text-white">';
    $html .= '<div class="container">';
    $html .= '<div class="row">';
    
    // Colonne des mentions légales
    $html .= '<div class="col-md-6 text-center text-md-start">';
    $html .= '<p class="mb-0">Tous droits réservés : <strong>&reg;</strong>Diginamic' . $currentYear . '-D03</p>';
    $html .= '</div>';
    
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</footer>';
    
    return $html;
  }
  
  /**
   * Retourne le CSS personnalisé pour le footer
   * 
   * @return string Le CSS pour styliser le footer
   */
  public static function getStyles(): string
  {
    return '
      html, body {
        height: 100%;
      }
      body {
        display: flex;
        flex-direction: column;
      }
      .container {
        flex: 1 0 auto;
      }
      .footer {
        flex-shrink: 0;
        background-color: #343a40;
        margin-top: auto;
      }
      .footer a {
        color: #6c757d;
        transition: color 0.3s ease;
      }
      .footer a:hover {
        color: #adb5bd;
      }
    ';
  }
}