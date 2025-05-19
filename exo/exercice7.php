<?php

//EXERCICE 1

function displayMessage($message) {
    echo $message;
}

displayMessage("Hello World !<br>");


//EXERCICE 2

function sum($nombre1, $nombre2) {
    $result = $nombre1 + $nombre2;
    return $result;
}

$total = sum(5, 3);
echo "La somme est" . $total . "<br>";


//EXERCICE 3

function average($numbers) {

    $sum = 0;
    foreach ($numbers as $number) {
        $sum += $number;
    }

    $count = count($numbers);

    if ($count == 0) {
        return 0;
    }

    $average = $sum / $count;
    return $average;
}

$notes = [15, 12, 18, 9, 16];
$moyenne = average($notes);
echo "La moyenne est : " . $moyenne . "<br>";


//EXERCICE 4

function displayPerson($person) {
    $nom = $person['nom'];
    $age = $person['age'];

    echo "nom: $nom, Age: $age <br>";
}

$john = [
    'nom' => 'John Doe',
    'age' => 30,
];

displayPerson($john);


//EXERCICE 5


function addToList($fruits, $newFruit) {
    $fruits[] = $newFruit;

    return $fruits;
}

$panier = ['pomme', 'banane', 'orange'];
echo "Panier initial : " .implode(", ", $panier) . "<br>";

$panier = addToList($panier, 'fraise');
echo "Nouveau panier : " . implode(", ", $panier) . "<br>";


//EXERCICE 6

function displayList($items) {

    foreach ($items as $item) {
        echo $item . "<br>";
    }
}

$fruits = ['pomme', 'banane', 'orange', 'fraise', 'kiwi'];
echo "Voici la liste des fruits : <br>";
displayList($fruits);


//EXERCICE 7


function displayStudents($students) {

    foreach ($students as $student) {

        $nom = $student['nom'];
        $note = $student['note'];

        echo "Nom: $nom, Note: $note <br>";
    }
}

$etudiants = [
    ['nom' => 'Alice', 'note' => 18],
    ['nom' => 'Bob', 'note' => 15],
    ['nom' => 'Charlie', 'note' => 12],
    ['nom' => 'Diana', 'note' => 16],
];

echo "Liste des étudiants et leurs notes : <br>";
displayStudents($etudiants);


//EXERCICE 8

$counter = 0;

function increment() {

    global $counter;

    $counter++;
}

echo "Valeur initiale : $counter <br>";

increment();
echo "Après le premier appel de la fonction : $counter <br>";

increment();
echo "Après le deuxième appel de la fonction : $counter <br>";

increment();
echo "Après le troisième appel de la fonction : $counter <br>";

//EXERCICE 9

function createList($string) {

    $characters = str_split($string);
    return $characters;
}

$mot = "bonjour";
$lettres = createList($mot);

echo "Le mot '$mot' décomposé en lettres : <br>";
print_r($lettres);


//EXERCICE 10

function printArrayRecursively($array) {

    foreach ($array as $element) {
        if (is_array($element)) {
            printArrayRecursively($element);
        } else {
            echo $element . "<br>";
        }
    }
}

$fruits = ['pomme','banane', 'orange'];
echo "Tableau simple :<br>";
printArrayRecursively($fruits);

$nested = [
    'fruits' => ['pomme', 'banane', 'orange'],
    'légumes' => ['carotte', 'poivron', ['brocoli', 'choux-fleur']],
    'viandes' => 'poulet'
];
echo "<br>Tableau multidimensionnel :<br>";
printArrayRecursively($nested);


?>