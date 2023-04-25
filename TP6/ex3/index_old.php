<?php
include_once("poemes/donnees.php");
$titre = $donnees[$_GET["poeme"]]["titre"];
$image = $donnees[$_GET["poeme"]]["image"];
$auteur = $donnees[$_GET["poeme"]]["auteur"];
$fragment = $donnees[$_GET["poeme"]]["fragment"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title><?php echo $titre; ?></title>
    <meta charset="UTF-8"/>
</head>
<body>
<ul>
    <?php
    foreach ($donnees as $name => $poeme) {
        $un_titre = $poeme["titre"];
        echo "<li><a href='index.php?poeme=$name'>$un_titre</a></li>";
    }
    ?>
</ul>
<h1><?php echo $donnees[$_GET["poeme"]]["titre"]; ?></h1>
<?php echo file_get_contents("poemes/textes/$fragment.frg.html"); ?>
<p>-<i><?php echo $auteur ?></i></p>
<img src="<?php echo "poemes/images/$image"; ?>" alt=<?php echo $auteur; ?>>
</body>
</html>
