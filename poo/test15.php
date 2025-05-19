<?php

class MyClass
{
    //Attributs qui ont tous une valeur par défaut
    public $a = "Chine";
    protected $b = "Australie";
    private $c = "Espagne";
    /**
     * l'accesseur générique est une méthode qui va comparer les noms des attributs (les clés) avec l'argument passé en paramètre.
     * Dans le cas où l'argument correspond bien à un nom d'attribut, la méthode renvoie la valeur correspondante
     * Sinon la méthode renvoie la chaine de caractère, "cette propriété n'existe pas"
     * 
     * @param [type] $prop
     * @return void
     */
    public function getProp($prop)
    {
        //Parcours de l'instance en cours(dans mon exemple $this qui est une référence à $objet)
        foreach ($this as $key => $value) {
            if ($key == $prop) {
                return $value;
            }
        }

        return "Cette propriété n'existe pas";
    }

    public function setProp($prop, $value) {
        foreach ($this as $key) {
            if ($key == $prop) {
                $this->$key = $value;
                return $this;
            }
        }
        return $this;
    }
}

$objet = new MyClass();
echo "Valeurs originales : " . PHP_EOL;
echo $objet->getProp('a') . PHP_EOL;
echo $objet->getProp('b') . PHP_EOL;
echo $objet->getProp('c') . PHP_EOL;
echo $objet->getProp('d') . PHP_EOL;

echo "Modification des valeurs : " . PHP_EOL;
echo $objet->setProp('a', 'france')->getProp("a") . PHP_EOL;


//Sur le modèle de l'accesseur universel, coder le mutateur universel
