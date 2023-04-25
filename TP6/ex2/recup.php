<?php
// var_dump($_POST);
$nom = $_POST["nom"];
$langues = $_POST["langue"];
$couleur = $_POST["couleur"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>recup.php</title>
    <style>
        body {
            background-color: <?php
                if ($couleur == "bleu") {echo "blue";}
                elseif ($couleur == "rouge") {echo "red";}
                elseif ($couleur == "vert") {echo "green";}
                ?>;
        }
    </style>
</head>
<body>
<p><?php
    $res = "";
    foreach ($langues as $langue) {
        if ($langue == "fr") {
            $res .= "Bonjour $nom!<br>";
        } elseif ($langue == "en") {
            $res .= "Hello $nom!<br>";
        } elseif ($langue == "de") {
            $res .= "Guten Tag $nom!<br>";
        }
    }
    echo $res;
    ?></p>
</body>
</html>
