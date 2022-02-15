<?php
// normalement pas nécessaire car ce fichier est déjà appelé dans nos pages, mais le 'once' retire tout risques de conflict et permet de tester la connexion dpuis ce fichier
require_once "01-config.php";

// tentative de connexion ... Essai
try {
    /** 
     * création (instanciation de PDO) d'une connexion permanente, c'est à dire qui ne se ferme pas pour l'utilisateur qui est sur votre site (1 user = 1 connexion), 
     * 
     * NE pas utiliser $maconnexion = null en fin de code, sinon rupture de la connexion permanente !
     * 
     * Ce qui permet d'être plus rapide, la personne étant connecté de manière permanente à le DB
     * 
     * Attention, risque de l'erreur "too many connections" si on dépasse la capacité de la base de donnée
     * 
     * Active également la possibilité de faire les transactions sur certaines DB (mysql et mariadb acceptent les transactions sans connexion permanente ! En InnoDB, pas en MyISAM)
     * 
     * En effet les connexion permanentes ne fonctionnent que sur des DB acceptant les propriétées ACID :
     * 
     * https://fr.wikipedia.org/wiki/Propri%C3%A9t%C3%A9s_ACID
     * 
     * Une connexion permanente est activée PENDANT la connexion, les setAttribute() ne peuvent pas le faire ! 
     * 
     * Il faut passer cette proporiété dans un tableau en fin de connexion ($options)
     */
    $db = new PDO(
        DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET,
        DB_LOGIN,
        DB_PWD,
        [PDO::ATTR_PERSISTENT => true,] // ici et non pas dans un setAttribute
    );

    /*
    utilisation de setAttribute() pour remplir (ou changer) les options de connexions
    */

    // activation de l'affichage des erreurs POUR les requêtes SQL (pas pour les erreurs de connexion)
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // pour l'activation du fetch mode par défaut en tableau associatif en ASSOC
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Sinon on a une erreur, on capture l'erreur  dans $e en utilisant la classe native PDOexception ou de préférence Exception (elles sont liées dans l'installation de PHP)   
} catch (Exception $e) {
    echo "Code erreur : " . $e->getCode();
    echo "<br>Message d'erreur : " . $e->getMessage();
    // arrêt du script en cas d'erreur de connexion exit ou die
    exit("<h3>Site en maintenance</h3>");
}
