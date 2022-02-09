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

    #var_dump($_POST);
    // si on a envoyé le formulaire
    if (isset($_POST['thesectiontitle'], $_POST['thesectiondesc'])) {

        // traitement des champs de formulaires
        $thesectiontitle = htmlspecialchars(strip_tags(trim($_POST['thesectiontitle'])), ENT_QUOTES);
        $thesectiondesc = htmlspecialchars(strip_tags(trim($_POST['thesectiondesc'])), ENT_QUOTES);

        // si ils sont valides (pas vide et de longueur moindre que la maximale dans la DB)
        if (
            !empty($thesectiontitle)
            && !empty($thesectiondesc)
            && strlen($thesectiontitle) < 81
            && strlen($thesectiondesc) < 256
        ) {
            // insertion dans la table
            $insertok = thesectionInsert($db, $thesectiontitle, $thesectiondesc);

            // si réussite
            if ($insertok) {
                // redirection sur l'accueil
                header("Location: ./");
                die();
            } else {
                // affichage de l'erreur dans la vue
                $error = 1;
            }

            // var_dump($insertok);
            // format d'un champs non valide    
        } else {
            // affichage de l'erreur dans la vue
            $error = 1;
        }
    }

    // la vue
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

    // pas de GET de routage    
} else {


    // chargement dans le modèle
    $allThesection = thesectionSelectAll($db);

    // var_dump($allThesection);

    include "view/thesectionHomePage.php";
}
