<?php

class Produit
{
    public $nom;
    protected $prix;
    private $reference;

    public function __construct($nom, $prix, $reference)
    {

        $this->nom = "passoire";
        $this->prix = 12;
        $this->reference = "dodleo00";
    }

    public function get($nomPropriete) {
        foreach ($this as $propriete => $valeur) {
            if ($propriete === $nomPropriete) {
                return $valeur;
            }
        }

        return "La propriété '$nomPropriete' n'existe pas";
    }

    public function set($nomPropriete, $valeur) {

        $proprieteExiste = false;
        foreach ($this as $propriete => &$valeurActuelle) {
            if ($propriete === $nomPropriete) {
                $valeurActuelle = $valeur;
                $proprieteExiste = true;
                break;
            }

        }
        if (!$proprieteExiste) {
            echo "La propriété '$nomPropriete' n'existe pas" . PHP_EOL;
        }

        return $this;
    }
}

$produit = new Produit("Iphone", 999, "12345");

echo "Nom produit : " .$produit->get('nom') . PHP_EOL;
echo "Prix produit : " .$produit->get('prix') . "€" . PHP_EOL;
echo "Reference produit : " .$produit->get('reference') . PHP_EOL;
echo "Couleur produit : " .$produit->get('couleur') . PHP_EOL;

$produit->set('nom', 'Samsung');
$produit->set('prix', 500);
$produit->set('reference', '98765');
$produit->set('couleur', 'Noir');

echo "Nom produit : " .$produit->get('nom') . PHP_EOL;
echo "Prix produit : " .$produit->get('prix') . "€" . PHP_EOL;
echo "Reference produit : " .$produit->get('reference') . PHP_EOL;
