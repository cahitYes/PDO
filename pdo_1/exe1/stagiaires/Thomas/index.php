<?php

/*Chargement des dépendances*/
require_once '../05-try-catch-errors-requests-PDOconnect.php';

/**Connexion PDO*/
require_once '../connectPDO.php';


/**
 * Routeur (index.php est l'unique contrôleur)
 */
require_once 'connectPDO.php';


// fichier /INDEX.PHP:
require_once('model/model.php');
$oArtiste = new Artiste($cxn);
require('view/show.php')
