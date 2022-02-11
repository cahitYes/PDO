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

    // traitement de la variable get pour la convertir en entier
    $id = (int) $_GET['update'];

    //var_dump($_POST);
    // si on a envoyé le formulaire
    if (isset($_POST['idthesection'], $_POST['thesectiontitle'], $_POST['thesectiondesc'])) {

        // protection des variables
        $idthesection = (int) $_POST['idthesection'];
        $thesectiontitle = htmlspecialchars(strip_tags(trim($_POST['thesectiontitle'])), ENT_QUOTES);
        $thesectiondesc = htmlspecialchars(strip_tags(trim($_POST['thesectiondesc'])), ENT_QUOTES);

        // si ils sont valides (pas vide et de longueur moindre que la maximale dans la DB)
        if (
            !empty($idthesection)
            && !empty($thesectiontitle)
            && !empty($thesectiondesc)
            && strlen($thesectiontitle) < 81
            && strlen($thesectiondesc) < 256
        ) {

            // on essaie de mettre à jour la section
            $updateok = thesectionUpdate($db, $idthesection, $thesectiontitle, $thesectiondesc);
            // si la mise à jour a été effectuée
            if ($updateok) {
                // si la modification a réussi
                header("location: ./");
                // arrêt du script (qui permet également d'éviter 2 else)
                exit;
            }
            // echec lors de la mise à jour
            $error = true;
        }
    }


    //affichage de l'article dans le formulaire    


    // chargement de l'article via son id en tableau associatif
    $recupThesection = thesectionSelectOneById($db, $id);

    // si on ne récupère pas d'articles (tableau vide)
    if (empty($recupThesection)) {
        // appel de la vue 404
        include "view/thesection404.php";
        // arrêt du script ()
        exit();
    }

    // var_dump($recupThesection);

    // appel de la vue
    include "view/thesectionUpdate.php";


    /**
     * Suppression - cruD
     */
} elseif (isset($_GET['delete']) && ctype_digit($_GET['delete'])) {

    // traîtement de ma variable string vers int
    $idDelete = (int) $_GET['delete'];

    // var_dump($_GET);

    // si confirm existe (on veut supprimer!)
    if (isset($_GET['confirm'])) {
        $deleteOk = thesectionDelete($db, $idDelete);
    }

    // chargement de l'article via son id en tableau associatif
    $recupThesection = thesectionSelectOneById($db, $idDelete);

    // si on ne récupère pas d'articles (tableau vide)
    if (empty($recupThesection)) {
        // appel de la vue 404
        include "view/thesection404.php";
        exit();
    }

    // appel de la vue
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
