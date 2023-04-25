<?php
require_once("Lib.php");
$action = key_exists('action', $_GET) ? trim($_GET['action']) : null;
$sauvegarde = key_exists('sauvegarde', $_GET) ? trim($_GET['sauvegarde']) : null;
switch ($action) {
    case "liste": //liste complète
        $corps = "<h1>Liste des personnes</h1>";
        $connection = connecter();
        $requete = "SELECT * FROM personne";

        // On envois la requète
        $query = $connection->query($requete);

        // On indique que nous utiliserons les résultats en tant qu'objet
        $query->setFetchMode(PDO::FETCH_OBJ);

        // Nous traitons les résultats en boucle
        $corps .= "<h4><span class='c1'><b><u>IdP</u></span> <span class='c1'>Nom</span><span class='c1'>Prenom</span>  </span><span class='c1'>Action</b></span></h4>";

        while ($enregistrement = $query->fetch()) {
            //$tab_Personne[$enregistrement->idP]=array($enregistrement->nom,$enregistrement->prenom);
            // Affichage des enregistrements
            $idP = $enregistrement->idP;
            $nom = $enregistrement->nom;
            $prenom = $enregistrement->prenom;
            $tab_Personne[$idP] = array($nom, $prenom);
            $corps .= "<span class='c1'><u><b>" . $idP . "</b></u></span> <span class='c1'>" . $nom . " </span><span class='c1'>" . $prenom . "</span>";
            $corps .= '<span class=\'c1\'><a href="index.php?action=select&idP=' . $idP . '"><span class="glyphicon glyphicon-eye-open"></span></a>';
            $corps .= '<a href="index.php?action=update&idP=' . $idP . '"><span class="glyphicon glyphicon-pencil"></span></a>';
            $corps .= '<a href="index.php?action=delete&idP=' . $idP . '"><span class="glyphicon glyphicon-trash"></span></a></span>';
            $corps .= "<br>";

        }
        $zonePrincipale = $corps;
        $query = null;
        $connection = null;
        break;

    case "insert": //Saisie  via le formulaire	et insertion dans la base de données
        $cible = 'insert';
        if (!isset($_POST["nom"]) && !isset($_POST["prenom"]) && !isset($_POST["dateN"]) && !isset($_POST["telephone"]) && !isset($_POST["adresse"])) /* et autres champs*/ {
            include("formulairePersonne.html");
        } else {
            $nom = key_exists('nom', $_POST) ? trim($_POST['nom']) : null;
            $prenom = key_exists('prenom', $_POST) ? trim($_POST['prenom']) : null;
            $dateN = key_exists('dateN', $_POST) ? trim($_POST['dateN']) : null;
            $telephone = key_exists('telephone', $_POST) ? trim($_POST['telephone']) : null;
            $adresse = key_exists('adresse', $_POST) ? trim($_POST['adresse']) : null;

            if ($nom == "") $erreur["nom"] = "il manque un nom";
            if ($prenom == "") $erreur["prenom"] = "il manque un prenom";
            if ($dateN == "") $erreur["dateN"] = "il manque la date de naissance";
            if ($telephone == "") $erreur["telephone"] = "il manque un numéro de téléphone";
            elseif (!preg_match("/^(0|\\+33|0033)[1-9][0-9]{8}$/", $telephone)) $erreur["telephone"] = "Le numéro de téléphone est invalide";
            if ($adresse == "") $erreur["adresse"] = "il manque une adresse";
            $compteur_erreur = count($erreur);
            foreach ($erreur as $cle => $valeur) {
                if ($valeur == null) $compteur_erreur = $compteur_erreur - 1;
            }

            if ($compteur_erreur == 0) {
                $connection = connecter();
                $corps = "Connection etablie<br/>";

                $req = "INSERT INTO personne (nom, prenom, dateN, telephone, adresse) VALUE (:nom, :prenom, :dateN, :telephone, :adresse)";
                $prep_req = $connection->prepare($req);
                $data = array(
                    ':nom' => $nom,
                    ':prenom' => $prenom,
                    ':dateN' => $dateN,
                    ':telephone' => $telephone,
                    ':adresse' => $adresse
                );
                $prep_req->execute($data);
                $patient = new PersonnE($connection->lastInsertId(), $nom, $prenom, $dateN);
                $corps .= "Saisie de : " . $patient;

                $zonePrincipale = $corps;
                $connection = null;
            } else {
                include("formulairePersonne.html");
            }
        }
        break;
    case 'select':
        $idP = key_exists('idP', $_GET) ? $_GET['idP'] : null;
        $connection = connecter();
        $req = "SELECT * FROM personne WHERE idP=:idP";

        $prep_req = $connection->prepare($req);
        $data = array(':idP' => $idP);
        $prep_req->execute($data);
        $personne = $prep_req->fetch();
        $nom = $personne["nom"];
        $prenom = $personne["prenom"];
        $dateN = $personne["dateN"];
        $telephone = $personne["telephone"];
        $adresse = $personne["adresse"];

        $corps = "<h1>$nom $prenom</h1>";
        $corps .= "<h2>Date de naissance: $dateN</h2>";
        $corps .= "<h2>Numéro de téléphone: $telephone</h2>";
        $corps .= "<h2>Adresse: $adresse</h2>";

        $zonePrincipale = $corps;
        $query = null;
        $connection = null;
        $corps = "<h1></h1>";
        break;
    case 'sauvegarde':
        $connection = connecter();
        $idP = key_exists('idP', $_POST) ? $_POST['idP'] : null;
        $type = key_exists('type', $_POST) ? $_POST['type'] : null;
        $req = key_exists('sql', $_POST) ? $_POST['sql'] : null;
        if ($type == 'confirmupdate') {
            $corps = "<h1>Mise à jour de la personne " . $idP . "</h1>";
        } else {
            $prep_req = $connection->prepare($req);
            $data = array(':ipP' => $idP);
            $prep_req->execute($data);
            $corps = "<h1>Personne $idP supprimée!</h1>";
        }
        $zonePrincipale = $corps;
        $connection = null;
        break;
    case "update":
        # à compléter

        break;
    case "delete":
        $idP = key_exists('idP', $_GET) ? $_GET['idP'] : null;
        $corps = "Connection etablie<br/>";

        $req = "DELETE FROM personne WHERE idP=:ipP";

        $corps = "<form action='index.php?action=sauvegarde' method='post'>";
        $corps .= "<input type='hidden' name='type' value='confirmdelete'/>";
        $corps .= "<input type=\"hidden\" name=\"idP\" value=\"$idP\"/>";
        $corps .= "<input type=\"hidden\" name=\"sql\" value=\"$req\"/>";
        $corps .= "Etes vous sûr de vouloir supprimer cette personne ?";
        $corps .= "<p>
    <input type=\"submit\" value=\"Supprimer\" class=\"btn btn-danger\">
    <a href=\"index.php\" class=\"btn btn-secondary\">Annuler</a>
</p>";
        $corps .= "</form>";
        $zonePrincipale = $corps;
        break;
    default:
        $zonePrincipale = "";
        break;
}
include("squelette.php");
