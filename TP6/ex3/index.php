<?php
require_once("poemes/donnees.php");
$squelette = "defaut";
$poeme = '';
if (!key_exists('poeme', $_GET)) {
    $titrePage = "Poèmes";
    $contenu = "Bienvenue sur ce site de poèmes. Choisir un poème dans le menu.";
} else {
    $poemeURL = $_GET['poeme'];
    if (key_exists($poemeURL, $donnees)) {
        $poeme = $donnees[$poemeURL];
        $titrePage = $poeme['titre'];
        $squelette = "poeme";
    } else {
        $titrePage = "Erreur";
        $contenu = "Le poème demandé n'existe pas.";
    }
}
include("squel/{$squelette}.php");    //A créer ....!
?>

