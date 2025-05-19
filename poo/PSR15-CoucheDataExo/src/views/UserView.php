<?php
namespace Diginamic\Framework\views;

class UserView {
    public static function displayAllUsers($users){
        //Syntaxe Herédoc
        $html = <<<HTML
        <h2>Ici prochainement la liste des utilisateurs</h2>
        HTML;
        return $html;
    }
}