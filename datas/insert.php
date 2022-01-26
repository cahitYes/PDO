<?php

define('PARAM_DB','mysql');
define('PARAM_HOST','localhost');
define('PARAM_PORT','3307');
define('PARAM_DBNAME','pdo_1');
define('PARAM_CHARSET','UTF8');
define('PARAM_USER','root');
define('PARAM_PWD','');

require_once '../vendor/autoload.php';

try
{
    $connexion = new PDO(PARAM_DB.':host='.PARAM_HOST.';port='.PARAM_PORT.';dbname='.PARAM_DBNAME.';charset='.PARAM_CHARSET, PARAM_USER, PARAM_PWD);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
    echo 'Erreur : '.$e->getMessage().'<br />';
    echo 'N° : '.$e->getCode();
    die();
} 

// faker FR
$faker = Faker\Factory::create(('fr_FR'));

// thesection
$req = $connexion->prepare("INSERT INTO thesection VALUES (NULL, ?, ?) ; ");

for ($i = 0; $i < 20; $i++) {

    $thesectiontitle = $faker->sentence($nbWords = 3, $variableNbWords = true);
    $thesectiondesc = $faker->text($maxNbChars = 220);
    
    $req->bindParam(1,$thesectiontitle,PDO::PARAM_STR);
    $req->bindParam(2,$thesectiondesc,PDO::PARAM_STR);


    // exécution
    $req->execute();

  }
