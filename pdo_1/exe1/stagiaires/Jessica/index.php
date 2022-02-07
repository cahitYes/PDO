<?php

/**
 * Chargement des dépendances
 */
require_once "config.php";
require_once "model/thesectionManager.php";


/**
 * Connexion <PDO></PDO>*/
try {
    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET, DB_LOGIN, DB_PWD);

} catch (PDOException $e) {
    echo "Code erreur : " . $e->getCode();
    echo "<br>Message d'erreur : " . $e->getMessage();
    exit();
}

/**
 * Routeur (index.php est l'unique contrôleur)
 */
 $con = thesectionSelectAll ($dbConnect);
 require_once "view/thesectionHomePage.php";

