<?php
require_once "01-config.php";
require_once "connectPDO.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bindParam</title>
</head>

<body>
    <h1>bindParam</h1>
    <h3>PDOStatement::bindParam — Lie un paramètre à un nom de variable spécifique</h3>
    <p>Avec bindParam(), contrairement au bindValue(), la variable est liée comme référence et ne sera évaluée qu'au moment de l’appel de l’ execute().</p>
    <pre>
    // préparation de la requête
    $prepare1 = $db->prepare("SELECT * FROM thearticle 
                                    WHERE idthearticle 
                                    BETWEEN ? AND ? 
                                ORDER BY thearticletitle ASC");

    // valeurs que l'on veut passer en paramètre
    $begin = 5;
    $end = 15;

    // attribution des valeurs à la requête préparée
    $prepare1->bindParam(1, $begin, PDO::PARAM_INT);
    $prepare1->bindParam(2, $end, PDO::PARAM_INT);

    // exécution de la requête
    $prepare1->execute();

    // nombre de résultats (SELECT)
    $nb1 = $prepare1->rowCount();

    // transformation en tableau indexé (fetchAll) contenant des (pseudo) objets
    $result1 = $prepare1->fetchAll(PDO::FETCH_OBJ);
    </pre>
    <?php
    // préparation de la requête
    $prepare1 = $db->prepare("SELECT * FROM thearticle 
                                    WHERE idthearticle 
                                    BETWEEN ? AND ? 
                                ORDER BY thearticletitle ASC");

    // valeurs que l'on veut passer en paramètre
    $begin = 5;
    $end = 15;

    // attribution des valeurs à la requête préparée
    $prepare1->bindParam(1, $begin, PDO::PARAM_INT);
    $prepare1->bindParam(2, $end, PDO::PARAM_INT);

    // exécution de la requête
    $prepare1->execute();

    // nombre de résultats (SELECT)
    $nb1 = $prepare1->rowCount();

    // transformation en tableau indexé (fetchAll) contenant des (pseudo) objets
    $result1 = $prepare1->fetchAll(PDO::FETCH_OBJ);

    // portabilité
    $prepare1->closeCursor();

    // affichage des champs id et titre
    foreach ($result1 as $item) :
    ?>
        <h5><small><?= $item->idthearticle ?></small><?= $item->thearticletitle ?> </h5>
    <?php
    endforeach;
    ?>
    <p>On a donc <?= $nb1 ?> articles</p>


    <?php
    // valeurs qui sont déjà liées à prepare1
    $prepare1->execute();
    $nb2 = $prepare1->rowCount();
    $result2 = $prepare1->fetchAll(PDO::FETCH_OBJ);
    foreach ($result2 as $item) :
    ?>
        <h5><small><?= $item->idthearticle ?></small><?= $item->thearticletitle ?> </h5>
    <?php
    endforeach;
    ?>
    <p>On a donc <?= $nb2 ?> articles</p>
    <?php
    // valeurs qui sont déjà liées à prepare1
    $begin = 18;
    $end = 22;
    $prepare1->execute();
    $nb3 = $prepare1->rowCount();
    $result3 = $prepare1->fetchAll(PDO::FETCH_OBJ);
    foreach ($result3 as $item) :
    ?>
        <h5><small><?= $item->idthearticle ?></small><?= $item->thearticletitle ?> </h5>
    <?php
    endforeach;
    ?>
    <p>On a donc <?= $nb3 ?> articles</p>
    <h4>Avantages et inconvénients du bindParam</h4>
    <h5>Avantages</h5>
    <p>Permet de stocker la requête préparée et d'accéder très rapidement (système de cache) à un nombre élevé de requêtes en changeant juste les paramètres. Permet de vérifier de manière plus stricte ces variables. On utilise plus souvant cette méthodes sur des insert, delete ou update qui ne peuvent être effectués en 1 ligne.</p>
    <h5>Inconvéniants</h5>
    <p>Impossible de passer une valeur ou une fonction par référence !</p>
    <pre>
    // valeurs qui sont déjà liées à prepare1
    $begin = 1;
    $end = 3;
    $prepare1->execute();
    $nb2 = $prepare1->rowCount();
    $result2 = $prepare1->fetchAll(PDO::FETCH_OBJ);
    </pre>

    <h5>Le code suivant est impossible car on ne peut ni passer de valeurs ni de fonctions</h5>
    <pre>

    $prepare1->bindParam(1, 17, PDO::PARAM_INT);
    $prepare1->bindParam(2, mt_rand(20, 60), PDO::PARAM_INT);
    $prepare1->execute();
    $nb3 = $prepare1->rowCount();
    $result3 = $prepare1->fetchAll(PDO::FETCH_OBJ);
</pre>
</body>

</html>
<?php
// fermeture de la connexion pour la portabilité du code (autres DB que MySQL et MariaDB), à ne pas mettre en cas de connexion permanente !
$db = null;
?>