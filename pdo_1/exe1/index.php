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

/**
 * Ajout - Crud
 */
if (isset($_GET['add'])) {



    include "view/thesectionAdd.php";


    /**
     * Modification - crUd
     */
} elseif (isset($_GET['update']) && ctype_digit($_GET['update'])) {


    include "view/thesectionUpdate.php";


    /**
     * Suppression - cruD
     */
} elseif (isset($_GET['delete']) && ctype_digit($_GET['delete'])) {


    include "view/thesectionDelete.php";


    /**
     * Homepage - cRud
     */
} else {


    $allThesection = thesectionSelectAll($db);

    // var_dump($allThesection);

    include "view/thesectionHomePage.php";
}
