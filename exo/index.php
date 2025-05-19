<?php

$var;

$MyVar = 'salut';
$var = 56;

echo '<p>$var</p>' . PHP_EOL;
echo "<p>$var</p>", PHP_EOL;
print $var . PHP_EOL;

echo '<pre>';
print_r([12, 7]);
var_dump([12, 7]);
echo '</pre>';


$userChoice = "salade";
$menu = match ($userChoice) {
    "plat principal" => "raviolis",
    "entrée", "salade" => "riz/thon/tomates",
    default => "plat non servi",
};
echo $menu, PHP_EOL;