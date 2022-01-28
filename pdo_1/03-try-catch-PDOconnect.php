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
