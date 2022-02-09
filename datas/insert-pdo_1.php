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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remplissage de pdo_1</title>
</head>

<body>
    <h1>Remplissage de pdo_1</h1>
    <h2>Avec fakerphp/faker</h2>
    <?php

    /* afficher un nom via faker
echo $faker->name();
echo "<br>" . $faker->email();
echo "<br>" . $faker->text();
*/

    // thesection
    $req = $connexion->prepare("INSERT INTO thesection VALUES (NULL, ?, ?) ; ");

    for ($i = 0; $i < 8; $i++) {

        $thesectiontitle = $faker->words(mt_rand(1, 3), true);
        $thesectiondesc = $faker->text($maxNbChars = 220);

        $req->bindParam(1, $thesectiontitle, PDO::PARAM_STR);
        $req->bindParam(2, $thesectiondesc, PDO::PARAM_STR);

        try {
            // exécution
            $req->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            continue;
        }
    }

    // récupération des sections
    $section = $connexion->query("SELECT * FROM thesection ORDER BY idthesection ASC;");
    ?>
    <h3>Table thesection (<?= $section->rowCount() ?>)</h3>
    <table border=1>
        <thead>
            <tr>
                <th>idthesection</th>
                <th>thesectiontitle</th>
                <th>thesectiondesc</th>
            </tr>
        </thead>
        <tbody>

            <?php
            while ($item = $section->fetch(PDO::FETCH_OBJ)) :
            ?>
                <tr>
                    <td><?= $item->idthesection ?></td>
                    <td><?= $item->thesectiontitle ?></td>
                    <td><?= $item->thesectiondesc ?></td>
                </tr>
            <?php
            endwhile;
            //exit();
            ?>

        </tbody>
    </table><br>
    <?php

    // theuser
    $req = $connexion->prepare("INSERT INTO theuser VALUES (NULL, ?, ?) ; ");

    for ($i = 0; $i < 30; $i++) {

        $theuserlogin = $faker->bothify('????????-########');
        $theusername = $faker->name(true);

        $req->bindParam(1, $theuserlogin, PDO::PARAM_STR);
        $req->bindParam(2, $theusername, PDO::PARAM_STR);


        try {
            // exécution
            $req->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            continue;
        }
    }

    // récupération des utilisateurs
    $users = $connexion->query("SELECT * FROM theuser ORDER BY idtheuser ASC;");
    ?>
    <h3>Table theuser (<?= $users->rowCount() ?>)</h3>
    <table border=1>
        <thead>
            <tr>
                <th>idtheuser</th>
                <th>theuserlogin</th>
                <th>theusername</th>
            </tr>
        </thead>
        <tbody>

            <?php
            while ($item = $users->fetch(PDO::FETCH_OBJ)) :
            ?>
                <tr>
                    <td><?= $item->idtheuser ?></td>
                    <td><?= $item->theuserlogin ?></td>
                    <td><?= $item->theusername ?></td>
                </tr>
            <?php
            endwhile;
            ?>

        </tbody>
    </table>
    <?php
    // thearticle
    $req = $connexion->prepare("INSERT INTO thearticle VALUES (NULL, ?, ?, ?, ?) ; ");

    for ($i = 0; $i < 300; $i++) {
        $thearticletitle = $faker->text($maxNbChars = 160);
        $thearticletext = $faker->text();
        $thearticledate = date("Y-m-d H:i:s", $faker->unixTime());
        // sélection d'un id usitilsateur existant
        $user = $connexion->query("SELECT idtheuser FROM theuser ORDER BY RAND() LIMIT 1");
        $userid = $user->fetch(PDO::FETCH_OBJ);
        $theuser_idtheuser = $userid->idtheuser;

        $req->bindParam(1, $thearticletitle, PDO::PARAM_STR);
        $req->bindParam(2, $thearticletext, PDO::PARAM_STR);
        $req->bindParam(3, $thearticledate, PDO::PARAM_STR);
        $req->bindParam(4, $theuser_idtheuser, PDO::PARAM_INT);


        try {
            // exécution
            $req->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            continue;
        }
    }
    // récupération des utilisateurs
    $articles = $connexion->query("SELECT * FROM thearticle ORDER BY idthearticle ASC;");
    ?>
    <h3>Table thearticle (<?= $articles->rowCount() ?>)</h3>
    <table border=1>
        <thead>
            <tr>
                <th>idthearticle</th>
                <th>thearticletitle</th>
                <th>thearticletext</th>
                <th>thearticledate</th>
                <th>theuser_idtheuser</th>
            </tr>
        </thead>
        <tbody>

            <?php
            while ($item = $articles->fetch(PDO::FETCH_OBJ)) :
            ?>
                <tr>
                    <td><?= $item->idthearticle ?></td>
                    <td><?= $item->thearticletitle ?></td>
                    <td><?= $item->thearticletext ?></td>
                    <td><?= $item->thearticledate ?></td>
                    <td><?= $item->theuser_idtheuser ?></td>
                </tr>
            <?php
            endwhile;
            // exit();
            ?>

        </tbody>
    </table>
    <?php
    // thearticle_has_thesection
    $req = $connexion->prepare("INSERT INTO thearticle_has_thesection VALUES (?, ?) ; ");

    for ($i = 0; $i < 800; $i++) {

        // sélection d'un id article existant
        $article = $connexion->query("SELECT idthearticle FROM thearticle ORDER BY RAND() LIMIT 1");
        $articleid = $article->fetch(PDO::FETCH_OBJ);
        $thearticle_idthearticle = $articleid->idthearticle;

        $section = $connexion->query("SELECT idthesection FROM thesection ORDER BY RAND() LIMIT 1");
        $sectionid = $section->fetch(PDO::FETCH_OBJ);
        $thesection_idthesection = $sectionid->idthesection;

        $req->bindParam(1, $thearticle_idthearticle, PDO::PARAM_INT);
        $req->bindParam(2, $thesection_idthesection, PDO::PARAM_INT);



        try {
            // exécution
            $req->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
            continue;
        }
    }

    // récupération des liens articles - sections
    $has = $connexion->query("SELECT * FROM thearticle_has_thesection ORDER BY thearticle_idthearticle ASC;");
    ?>
    <h3>Table thearticle_has_thesection (<?= $has->rowCount() ?>)</h3>
    <table border=1>
        <thead>
            <tr>
                <th>thearticle_idthearticle</th>
                <th>thesection_idthesection</th>
            </tr>
        </thead>
        <tbody>

            <?php
            while ($item = $has->fetch(PDO::FETCH_OBJ)) :
            ?>
                <tr>
                    <td><?= $item->thearticle_idthearticle ?></td>
                    <td><?= $item->thesection_idthesection ?></td>
                </tr>
            <?php
            endwhile;
            ?>

        </tbody>
    </table>
</body>

</html>