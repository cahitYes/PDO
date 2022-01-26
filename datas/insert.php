<?php

define('PARAM_DB', 'mysql'); // mysql => MySQL - MariaDB
define('PARAM_HOST', 'localhost');
define('PARAM_PORT', '3307');
define('PARAM_DBNAME', 'pdo_1');
define('PARAM_CHARSET', 'UTF8');
define('PARAM_USER', 'root');
define('PARAM_PWD', '');

// charge les dépendances (ici faker)
require_once '../vendor/autoload.php';

// on essaie 'try' de se connecter à notre DB pdo_1
try {
    // création d'une instance de PDO
    $connexion = new PDO(PARAM_DB . ':host=' . PARAM_HOST . ';port=' . PARAM_PORT . ';dbname=' . PARAM_DBNAME . ';charset=' . PARAM_CHARSET, PARAM_USER, PARAM_PWD);
    // activation de l'affichage des erreurs
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // si on a une erreur de connexion; on l'attrape avec 'catch' et on utilise la classe 'Exception'   
} catch (Exception $e) {
    // affichage des erreurs
    echo 'Erreur : ' . $e->getMessage() . '<br />';
    echo 'N° : ' . $e->getCode();
    die();
}

// Instanciation de faker FR
$faker = Faker\Factory::create('fr_FR');

// afficher un nom via faker
echo $faker->name();
echo "<br>" . $faker->email();
echo "<br>" . $faker->text();

// thesection
$req = $connexion->prepare("INSERT INTO thesection VALUES (NULL, ?, ?) ; ");

for ($i = 0; $i < 2; $i++) {

    $thesectiontitle = $faker->sentence($nbWords = 3, $variableNbWords = true);
    $thesectiondesc = $faker->text($maxNbChars = 220);

    $req->bindParam(1, $thesectiontitle, PDO::PARAM_STR);
    $req->bindParam(2, $thesectiondesc, PDO::PARAM_STR);


    // exécution
    $req->execute();
}

// theuser
$req = $connexion->prepare("INSERT INTO theuser VALUES (NULL, ?, ?) ; ");

for ($i = 0; $i < 2; $i++) {

    $theuserlogin = $faker->bothify('???????-#######');
    $theusername = $faker->name(true);

    $req->bindParam(1, $theuserlogin, PDO::PARAM_STR);
    $req->bindParam(2, $theusername, PDO::PARAM_STR);


    // exécution
    $req->execute();
}

// thearticle
$req = $connexion->prepare("INSERT INTO thearticle VALUES (NULL, ?, ?, ?, ?) ; ");

for ($i = 0; $i < 20; $i++) {

    $thearticletitle = $faker->text($maxNbChars = 160);;
    $thearticletext = $faker->text();
    $thearticledate = date("Y-m-d H:i:s", $faker->unixTime());
    $theuser_idtheuser = $faker->numberBetween(1, 2000);

    $req->bindParam(1, $thearticletitle, PDO::PARAM_STR);
    $req->bindParam(2, $thearticletext, PDO::PARAM_STR);
    $req->bindParam(3, $thearticledate, PDO::PARAM_STR);
    $req->bindParam(4, $theuser_idtheuser, PDO::PARAM_INT);


    // exécution
    $req->execute();
}

// thearticle_has_thesection 
$req = $connexion->prepare("INSERT INTO thearticle_has_thesection VALUES (?, ?) ; ");

for ($i = 0; $i < 800; $i++) {

    $thearticle_idthearticle = $faker->numberBetween(1, 200);
    $thesection_idthesection = $faker->numberBetween(1, 14);

    $req->bindParam(1, $thearticle_idthearticle, PDO::PARAM_INT);
    $req->bindParam(2, $thesection_idthesection, PDO::PARAM_INT);



    // exécution
    $req->execute();
}
