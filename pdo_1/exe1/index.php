<?php

/**
 * Chargement des dépendances
 */
require_once "config.php";
require_once "model/thesectionManager.php";
/**
 * Connexion PDO
 */
try {
    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET, DB_LOGIN, DB_PWD);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Code erreur : " . $e->getCode();
    echo "<br>Message d'erreur : " . $e->getMessage();
}

// var_dump($db);

/**
 * Routeur (index.php est l'unique contrôleur)
 */


$allThesection = thesectionSelectAll($db);

// var_dump($allThesection);

include "view/thesectionHomePage.php";
