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
    <title>Problèmes de requêtes</title>
</head>

<body>
    <h3>Problèmes de requêtes</h3>
    <p>Si on a pas d'erreurs de connexion, on voit cette page s'afficher</p>
    <?php
    try {
        // insertion dans une table qui n'existe pas !!!!
        $db->exec("INSERT INTO tata ('yes','youpie')");
    } catch (Exception $e) {
        // erreurs par défauts
        echo "Erreur ligne {$e->getLine()} du fichier {$e->getFile()} : <br> Code : {$e->getCode()} <br> Message : {$e->getMessage()}<hr>";
    }

    try {
        // insertion dans une table qui n'existe pas !!!!
        $db->exec("INSERT INTO tutu ('yes','youpie')");
    } catch (Exception $e) {
        // affichage d'une erreur personnalisée
        echo ('La table tutu n\'existe pas');
    }


    // bonne pratique (sauf si connexion permanante), fermeture de la connexion
    $db = null;
    ?>
</body>

</html>