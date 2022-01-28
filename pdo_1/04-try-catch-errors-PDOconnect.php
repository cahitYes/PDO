<?php
// chargement des dépendances
require_once "01-config.php";

// tentative de connexion ... Essai
try {
    // création d'une connexion
    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET, DB_LOGIN, DB_PWD);

    // activation de l'affichage des erreurs POUR les requêtes SQL (pas pour les erreurs de connexion)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sinon on a une erreur, on capture l'erreur  dans $e en utilisant la classe native PDOexception ou de préférence Exception (elles sont liées dans l'installation de PHP)   
} catch (PDOException $e) {
    echo "Code erreur : " . $e->getCode();
    echo "<br>Message d'erreur : " . $e->getMessage();
    // arrêt du script en cas d'erreur de connexion exit ou die
    exit("<h3>Site en maintenance</h3>");
}

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
    // insertion dans une table qui n'existe pas !!!!
    // aucune erreur affichée, il faut activer le setAttribute juste après la connexion, et on verra donc une erreur (débugage)
    $db->exec("INSERT INTO tata ('yes','youpie')");


    // bonne pratique (sauf si connexion permanante), fermeture de la connexion
    $db = null;
    ?>
</body>

</html>