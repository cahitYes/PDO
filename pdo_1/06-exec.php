<?php
// chargement des dépendances


// Nos constantes de configuration
require_once "01-config.php";

// dépendances pour fakerphp
require_once '../vendor/autoload.php';

// connexion PDO
require_once "05-connectPDO.php";

// Instanciation de faker FR
$faker = Faker\Factory::create('fr_FR');

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
    <p>$connexion->exec("sql") Pour Create, update ou delete</p>
    <h4>INSERT</h4>
    <?php
    try {
        $login = $faker->word();
        $name = $faker->name();
        // insertion non unique
        $nbInsert = $db->exec("INSERT INTO theuser (theuserlogin,theusername) VALUES ('$login','$name')");
    } catch (Exception $e) {
        // erreurs par défauts
        echo "Erreur ligne {$e->getLine()} du fichier {$e->getFile()} : <br> Code : {$e->getCode()} <br> Message : {$e->getMessage()}<hr>";
        die();
    }
    ?>
    <p><?= $nbInsert ?> entrée insérée</p>
    <?php
    if ($nbInsert) :
    ?>
        <p>Nouvel Article dont l'ID est <?= $db->lastInsertId() ?></p>
    <?php
    endif;
    ?>
    <h4>UPDATE</h4>
    <?php
    try {
        $nbUpdate = $db->exec("UPDATE thearticle SET theuser_idtheuser=1 WHERE thearticledate LIKE '1971-05%' ");
    } catch (Exception $e) {
        // erreurs par défauts
        echo "Erreur ligne {$e->getLine()} du fichier {$e->getFile()} : <br> Code : {$e->getCode()} <br> Message : {$e->getMessage()}<hr>";
        die();
    }


    ?>
    <p><?= $nbUpdate ?> entrée(s) modifiée(s) - (si trouvé mais non modifié, n'est pas renvoyé comme mis à jour !)</p>
    <h4>DELETE</h4>
    <?php
    try {
        $nbDelete = $db->exec("DELETE FROM thearticle WHERE idthearticle = " . mt_rand(1, 1000) . "");
    } catch (Exception $e) {
        // erreurs par défauts
        echo "Erreur ligne {$e->getLine()} du fichier {$e->getFile()} : <br> Code : {$e->getCode()} <br> Message : {$e->getMessage()}<hr>";
        die();
    }


    ?>
    <p><?= $nbDelete ?> entrée(s) supprimée(s)</p>

    <?php

    // bonne pratique (sauf si connexion permanante), fermeture de la connexion
    $db = null;
    ?>
</body>

</html>