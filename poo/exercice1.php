<?php
//EXERCICE 1
class Smartphone
{
    public $marque;
    public $modele;
    public $systemeExploitation;
    public $tailleEcran;

    public function allumer()
    {
        echo "Le smartphone s'allume"  . PHP_EOL;
    }

    public function charger()
    {
        echo "Le smartphone est en charge"  . PHP_EOL;
    }
}
//EXERCICE 2
$smartphone1 = new Smartphone();

$smartphone1->marque = "Apple";
$smartphone1->modele = "Iphone 13";
$smartphone1->systemeExploitation = "IOS";
$smartphone1->tailleEcran = 6.5;

$smartphone2 = new Smartphone();

$smartphone2->marque = "Samsung";
$smartphone2->modele = "S21";
$smartphone2->systemeExploitation = "Android";
$smartphone2->tailleEcran = 6.2;


//On affiche les infos du premier smartphone

echo "smartphone 1 :" . PHP_EOL;

echo "Marque : " . $smartphone1->marque . PHP_EOL;
echo "Modele : " . $smartphone1->modele . PHP_EOL;
echo "Système d'exploitation : " . $smartphone1->systemeExploitation . PHP_EOL;
echo "Taille d'écran : " . $smartphone1->tailleEcran . PHP_EOL;

$smartphone1->allumer();
$smartphone1->charger();


//On affiche les infos du second smartphone

echo "smartphone 2 :" . PHP_EOL;

echo "Marque : " . $smartphone2->marque . PHP_EOL;
echo "Modele : " . $smartphone2->modele . PHP_EOL;
echo "Système d'exploitation : " . $smartphone2->systemeExploitation . PHP_EOL;
echo "Taille d'écran : " . $smartphone2->tailleEcran . PHP_EOL;

$smartphone2->allumer();
$smartphone2->charger();



//EXERCICE 3


class CarteBancaire
{
    private $code;

    public $numero;
    public $dateExpiration;

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($nouveauCode)
    {
        if (is_numeric($nouveauCode) && strlen($nouveauCode) == 4) {
            $this->code = $nouveauCode;
            return true;
        } else {
            echo "Erreur: Le code doit contenir exactement 4 chiffres." . PHP_EOL;
            return false;
        }
    }
}

$cb1 = new CarteBancaire();

$cb1->setCode("32352");

echo $cb1->getCode();


//EXERCICE 4 


class Playlist
{
    private $chansons = [];

    public function ajouter($titre)
    {
        $this->chansons[] = $titre;

        return $this;
    }

    public function supprimer($titre)
    {
        $position = array_search($titre, $this->chansons);

        if ($position !== false) {
            unset($this->chansons[$position]);

            $this->chansons = array_values($this->chansons);
        }

        return $this;
    }

    public function getListe()
    {
        return $this->chansons;
    }

    public function vider()
    {
        $this->chansons = [];

        return $this;
    }
}

$maPlaylist = new Playlist();
$maPlaylist->ajouter("Chanson 1");
$maPlaylist->ajouter("Chanson 2");
$maPlaylist->ajouter("Chanson 3");

print_r($maPlaylist->getListe());

$maPlaylist->supprimer("Chanson 2");

print_r($maPlaylist->getListe());

$maPlaylist->vider();

print_r($maPlaylist->getListe());




//EXERCICE 5

class article
{

    public function __construct(
        private $titre,
        private $auteur,
        private $contenu,
        private $datePublication,
    ) {}

    public function getTitre()
    {
        return $this->titre;
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function getDatePublication()
    {
        return $this->datePublication;
    }
}

//EXERCICE 6

class PorteMonnai
{
    private $solde;
    private $monnaie;

    public function __construct($soldeInitial = 0, $monnaieInitial = "EUR")
    {
        if ($soldeInitial < 0) {
            echo "Erreur: le solde initial ne peut pas être négatif";
            $this->solde = 0;
        } else {
            $this->solde = $soldeInitial;
        }
        $this->monnaie = $monnaieInitial;
    }

    public function getSolde()
    {
        return $this->solde;
    }
    public function getMonnaie()
    {
        return $this->monnaie;
    }

    //Méthode pour déposer de l'argent 
    public function deposer($montant)
    {
        if ($montant > 0) {
            $this->solde += $montant;
            return true;
        } else {
            echo "Erreur: Le montant à déposer doit être positif.";
            return false;
        }
    }

    //Méthode pour retirer de l'argent
    public function retirer($montant)
    {
        if ($montant > 0 && $montant <= $this->solde) {
            $this->solde -= $montant;
            return true;
        } else {
            echo "Erreur: Montant invalide ou solde insuffisant.";
            return false;
        }
    }

    //Méthode pour convertir de la monnaie

    public function convertir($nouvelleMonnaie, $tauxDeChange)
    {
        if ($tauxDeChange <= 0) {
            echo "Erreur: le taux de change doit être positif";
            return false;
        }

        $this->solde = $this->solde * $tauxDeChange;
        $this->monnaie = $nouvelleMonnaie;

        return true;
    }

    public function afficherInfo()
    {
        echo "Solde: " . $this->solde . " " . $this->monnaie;
    }
}

//CORRECTION exo 6

class PorteMonnaie
{
    public function __construct(private float $solde, private string $devise) {}

    public function deposer(float $montant)
    {
        $this->solde += $montant;
        return $this;
    }

    public function retirer(float $montant) {
        if($montant <= $this->solde) {
           $this->solde -= $montant;
           return $this;
        }
    }
    public function convert($montant, string $deviseOrigine, string $deviseCible) {
        if($deviseOrigine == $this->$deviseCible) {
           return $montant;
        }
        return $montant;
    }
}
