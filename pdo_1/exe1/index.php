<?php

/**
 * Chargement des dépendances
 */
require_once "config.php";
<<<<<<< HEAD
require_once "./model/thesectionManager.php";
require_once "./view/thesectionHomePage.php";
require_once "./view/thesectionAdd.php";
require_once "./view/thesectionUpdate.php";
require_once "./view/thesectionDelete.php";
=======
require_once "model/thesectionManager.php";
>>>>>>> 0ebfbba2882f21dfdd7a65fc98eb58980638b651
/**
 * Connexion PDO
 */
try {
<<<<<<< HEAD
  
    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET, DB_LOGIN, DB_PWD);

    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
} catch (Exception $e) {
    echo "Code erreur : " . $e->getCode();
    echo "<br>Message d'erreur : " . $e->getMessage();
    exit("<h3>Site en maintenance</h3>");
=======
    $db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET, DB_LOGIN, DB_PWD);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Code erreur : " . $e->getCode();
    echo "<br>Message d'erreur : " . $e->getMessage();
}

// var_dump($db);
>>>>>>> 0ebfbba2882f21dfdd7a65fc98eb58980638b651

/**
 * Routeur (index.php est l'unique contrôleur)
 */
<<<<<<< HEAD
}

    
    
=======

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
>>>>>>> 0ebfbba2882f21dfdd7a65fc98eb58980638b651
