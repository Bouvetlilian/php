<?php

class Vehicule
{
    //attributs
    public string $marque;
    public string $couleur;
    public string $modele;

    public function __construct($brand, $color, $model)
    {
        $this->marque = $brand;
        $this->couleur = $color;
        $this->modele = $model;
    }
}

//Création de l'instance "peugeot" "blanc" "106"

$peugeot106 = new Vehicule("Peugeot", "Blanc", "106");
var_dump($peugeot106);

