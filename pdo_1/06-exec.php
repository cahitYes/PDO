<?php
// chargement des dépendances


// Nos constantes de configuration
require_once "01-config.php";


// connexion PDO
require_once "05-connectPDO.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exec</title>
</head>

<body>
    <h3>Exec</h3>
    <p>$connexion->exec("sql") Pour Creat, update ou delete</p>
    <h4>INSERT</h4>
    <?php
    try {
        // insertion non unique
        $nbInsert = $db->exec("INSERT INTO theuser (theuserlogin,theusername) VALUES ('youpie','steve')");
    } catch (Exception $e) {
        // erreurs par défauts
        echo "Erreur ligne {$e->getLine()} du fichier {$e->getFile()} : <br> Code : {$e->getCode()} <br> Message : {$e->getMessage()}<hr>";
        die();
    }
    ?>
    <p><?= $nbInsert ?> entrée insérée</p>
    <?php



    // bonne pratique (sauf si connexion permanante), fermeture de la connexion
    $db = null;
    ?>
</body>

</html>