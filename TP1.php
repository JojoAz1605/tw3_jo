<?php

// ----- Echauffement -----
echo "----- Echauffement -----\n";
// 1.
$jours = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
foreach ($jours as &$jour) {
    echo $jour . "\n";
}

// 2.
$tab = array();
for ($i = 0; $i < 100; $i++) {
    $tab[$i] = (3 * $i) + 2;
}

// 3.
foreach ($tab as &$item) {
    echo $item . ", ";
}
echo "\n";

// 4.
function afficher_triangle($motif, $taille) {
    for ($i = 0; $i < $taille; $i++) {
        if ($i < $taille / 2) {
            echo $motif * $i;
        } else {
            echo $motif * ($taille - $i);
        }
    }
}

// afficher_triangle("*", 2);

// 5.
function moyenne($tab) {
    $total = 0;
    foreach ($tab as $item) {
        $total += $item;
    }
    return $total / count($tab);
}

echo moyenne($tab);

// ----- Tableaux associatifs -----
echo "\n----- Tableaux associatifs -----\n";
// 1.
$pays_population = array(
    "Fronce" => 67595000,
    "Suede" => 9998000,
    "Suisse" => 8417000,
    "Kosovo" => 8417000,
    "Malte" => 434403,
    "Mexique" => 122273500,
    "Allemagne" => 82800000
);

// 2.
foreach ($pays_population as $pays => $population) {
    echo "La population de $pays est de $population habitants\n";
}

// 3. && 4.
function minimum($tab, $return_key = false) {
    $min = reset($tab);
    $key = "";
    foreach ($tab as $ze_key => $value) {
        if ($value < $min) {
            $min = $value;
            $key = $ze_key;
        }
    }
    if ($return_key) {
        return $key;
    } else {
        return min($tab);
    }
}
echo minimum($pays_population) . "\n";
echo minimum($pays_population, true) . "\n";

// 5.
function min_and_max($tab) {
    return array(min($tab), max($tab));
}
var_dump(min_and_max($pays_population));  // affiche le détail de la variable

// ----- Fonctions de tri de tableaux -----
echo "----- Fonctions de tri de tableaux -----";
// 1.
print_r($pays_population);
var_dump($pays_population);
var_export($pays_population);

// 2.
echo "\nasort\n";
asort($pays_population);
print_r($pays_population);

echo "arsort\n";
arsort($pays_population);
print_r($pays_population);

echo "ksort\n";
ksort($pays_population);
print_r($pays_population);

echo "krsort\n";
krsort($pays_population);
print_r($pays_population);

echo "sort\n";
sort($pays_population);
print_r($pays_population);

echo "rsort\n";
rsort($pays_population);
print_r($pays_population);

echo "shuffle\n";
shuffle($pays_population);
print_r($pays_population);

// ----- Recherche d'une valeur dans un tableau -----
echo "\n----- Recherche d'une valeur dans un tableau -----\n";
function contient_toto($tab) {
    if (array_search('toto', $tab) == false) {
        echo "Le tableau ne contient pas toto\n";
    } else {
        echo "Le tableau contient toto !!\n";
    }
}

$x = [ 'titi', 'toto', 'tutu' ];
contient_toto($x);
$y = [ 'tutu', 'titi', 'tete' ];
contient_toto($y);
$z = [ 'toto', 'titi', 'tutu' ];
contient_toto($z);
$t = [ 'titi', 'tutu', 0  ];
contient_toto($t);

// ---------- Exercice 2 ----------
echo "\n---------- Exercice 2 ----------\n";
$line = readline();
if ($line == strrev($line)) {
    echo "C'est un palindrome\n";
} else {
    echo "Ce n'est pas un palindrome\n";
}

echo "Il y a " . strlen($line) . " caractères dans cette string\n";

$pos = stripos("a", $line);
if ($pos === false) {
    echo "Il n'y a pas de 'a' dans votre string \n";
} else {
    echo "Vous avez un 'a' à la position $pos\n";
}