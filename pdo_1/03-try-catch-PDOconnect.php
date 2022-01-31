<?php
// chargement des dépendances
require_once "01-config.php";

// tentative de connexion ... Essai
try {
    // création d'une connexion
    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET, DB_LOGIN, DB_PWD);

    // Sinon on a une erreur, on capture l'erreur  dans $e en utilisant la classe native PDOexception ou de préférence Exception (elles sont liées dans l'installation de PHP)   
} catch (PDOException $e) {
    echo "Code erreur : " . $e->getCode();
    echo "<br>Message d'erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>03</title>
</head>

<body>
    <h4>Qu'il y ai une erreur ou pas, cette page s'affichera</h4>
    <p>Il manque le die() ou exit() dans le catch()</p>
</body>

</html>