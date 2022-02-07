<?php

/**
 * Chargement des dépendances
 */
require_once "config.php";
require_once "./model/thesectionManager.php";
require_once "./view/thesectionHomePage.php";
require_once "./view/thesectionAdd.php";
require_once "./view/thesectionUpdate.php";
require_once "./view/thesectionDelete.php";
/**
 * Connexion PDO
 */
try {
  
    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET, DB_LOGIN, DB_PWD);

    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
} catch (Exception $e) {
    echo "Code erreur : " . $e->getCode();
    echo "<br>Message d'erreur : " . $e->getMessage();
    exit("<h3>Site en maintenance</h3>");

/**
 * Routeur (index.php est l'unique contrôleur)
 */
}

    
    