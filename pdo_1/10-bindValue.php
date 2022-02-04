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
    <title>bindValue - execute([])</title>
</head>

<body>
    <h1>bindValue</h1>
    <h3>PDOStatement::bindValue — Associe une valeur à un paramètre</h3>
    <p>Avec bindValue(), la variable n'est pas liée comme référence et elle sera évaluée immédiatement avant l’ execute().</p>
    <pre>
    // préparation de la requête
    $prepare1 = $db->prepare("SELECT * FROM thearticle 
                                    WHERE idthearticle 
                                    BETWEEN ? AND ? 
                                ORDER BY thearticletitle ASC");

    // valeurs que l'on veut passer en paramètre
    $begin = 5;
    $end = 10;

    // attribution des valeurs à la requête préparée
    $prepare1->bindParam(1, $begin, PDO::PARAM_INT);
    $prepare1->bindParam(2, $end, PDO::PARAM_INT);

    // exécution de la requête
    $prepare1->execute();

    // nombre de résultats (SELECT)
    $nb1 = $prepare1->rowCount();

    // transformation en tableau indexé (fetchAll) contenant des (pseudo) objets
    $result1 = $prepare1->fetchAll(PDO::FETCH_OBJ);

    // si on essaie de faire comme le bindParam:
    $begin = 50;
    $end = 60;
    $prepare1->execute(); // prend entre 5 et 10

    // redéclaration avec des valeurs ou des fonctions
    $prepare1->bindValue(1, 50, PDO::PARAM_INT);
    $prepare1->bindValue(2, mt_rand(60, 65), PDO::PARAM_INT);
    $prepare1->execute();  // prend entre 50 et de 60 à 65 au hasard

    // pour imiter le bindParam
    $begin = 18;
    $end = 22;
    // réattribution des valeurs à la requête préparée
    $prepare1->bindValue(1, $begin, PDO::PARAM_INT);
    $prepare1->bindValue(2, $end, PDO::PARAM_INT);
    $prepare1->execute();
    $nb3 = $prepare1->rowCount();
    $result3 = $prepare1->fetchAll(PDO::FETCH_OBJ);
    </pre>
    <?php
    // préparation de la requête
    $prepare1 = $db->prepare("SELECT * FROM thearticle 
                                    WHERE idthearticle 
                                    BETWEEN ? AND ? 
                                ORDER BY thearticletitle ASC");

    // valeurs que l'on veut passer en paramètre
    $begin = 5;
    $end = 10;

    // attribution des valeurs à la requête préparée
    $prepare1->bindValue(1, $begin, PDO::PARAM_INT);
    $prepare1->bindValue(2, $end, PDO::PARAM_INT);

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
    $begin = 50;
    $end = 60;
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
    // on peut choisir des valeurs ou même des fonctions
    $prepare1->bindValue(1, 50, PDO::PARAM_INT);
    $prepare1->bindValue(2, mt_rand(60, 65), PDO::PARAM_INT);
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
    <?php
    // valeurs qui sont déjà liées à prepare1
    $begin = 18;
    $end = 22;
    // réattribution des valeurs à la requête préparée
    $prepare1->bindValue(1, $begin, PDO::PARAM_INT);
    $prepare1->bindValue(2, $end, PDO::PARAM_INT);
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
    <h4>Avantages et inconvénients du bindValue</h4>
    <h5>Avantages</h5>
    <p>Permet de stocker la requête préparée et d'accéder très rapidement (système de cache) à un nombre élevé de requêtes mais on doit redéfinir les résultats. Permet de vérifier de manière plus stricte ces variables. On utilise plus souvant cette méthodes pour tout, mais en utilisant sa vesiion raccourcie</p>
    <h5>Inconvéniants</h5>
    <p>Pas de passages par référence, traîtement légèrement plus long, typage souvant moins stricte</p>
    <pre>
    // ne fonctionne pas
    $begin = 1;
    $end = 3;
    $prepare1->execute(); // entre 5 et 10

    // fonctionne 
    $prepare1->bindValue(1, 50, PDO::PARAM_INT);
    $prepare1->bindValue(2, mt_rand(60, 65), PDO::PARAM_INT);
    $prepare1->execute(); // entre 50 et de 60 à 65
    </pre>
    <h3>PDOStatement::execute avec un tableau de valeurs</h3>
    <p>Ceci est le mode raccourci utilisant bindValue() de manière implicite, la variable, valeur ou fonction n'est pas liée comme référence et elle sera évaluée immédiatement avant l’ execute().</p>
    <p>En génrél c'est le plus utilisé, il n'y a pas de vérification de type, il font donc les faire en amont</p>
    <h4>N'empèche que les injections SQL et garde la requête en cache</h4>
    <pre>
    // préparation de la requête avec des marqueurs nommés
    $prepare2 = $db->prepare("SELECT * FROM thearticle 
    WHERE idthearticle 
    BETWEEN :debut AND :fin 
ORDER BY thearticletitle ASC");
    $prepare2->execute(array(
        'debut' => 5, // marqueur nommé comme clef, ! sans les ':'
        'fin' => 10,
    ));
    $result4 = $prepare2->fetchAll(PDO::FETCH_OBJ);
    var_dump($result4);

    // préparation de la requête avec des ?
    $prepare3 = $db->prepare("SELECT * FROM thearticle 
    WHERE idthearticle 
    BETWEEN ? AND ?
ORDER BY thearticletitle ASC");
    // on met les valeurs par odre de lecture sans clef
    $prepare3->execute([
        10,
        mt_rand(12, 18),
    ]);
    $result5 = $prepare3->fetchAll(PDO::FETCH_OBJ);
    var_dump($result5);
    </pre>
    <?php
    // préparation de la requête avec des marqueurs nommés
    $prepare2 = $db->prepare("SELECT * FROM thearticle 
    WHERE idthearticle 
    BETWEEN :debut AND :fin 
ORDER BY thearticletitle ASC");
    $prepare2->execute(array(
        'debut' => 5, // marqueur nommé comme clef, ! sans les ':'
        'fin' => 10,
    ));
    $result4 = $prepare2->fetchAll(PDO::FETCH_OBJ);
    var_dump($result4);

    // préparation de la requête avec des ?
    $prepare3 = $db->prepare("SELECT * FROM thearticle 
    WHERE idthearticle 
    BETWEEN ? AND ?
ORDER BY thearticletitle ASC");
    // on met les valeurs par odre de lecture sans clef
    $prepare3->execute([
        10,
        mt_rand(12, 18),
    ]);
    $result5 = $prepare3->fetchAll(PDO::FETCH_OBJ);
    var_dump($result5);
    ?>
    <h4>Avantages et inconvénients du execute() avec un tableau de valeurs</h4>
    <h5>Avantages</h5>
    <p>Permet de stocker la requête préparée et d'accéder très rapidement (système de cache) à un nombre élevé de requêtes mais on peut redéfinir les résultats sans bindValue. On utilise plus souvant cette méthodes pour tout, car elle est simple et fait ce pour quoi une requête préparée est attendue (pas d'injections, mise en cache de la requête)</p>
    <h5>Inconvéniants</h5>
    <p>Ne permet pas de vérifier de manière stricte les valeurs. Pas de passages par référence, traîtement légèrement plus long.</p>
    <h4>Utilisation avec les marqueurs ? pour avoir un simple tableau de valeurs</h4>>
</body>

</html>
<?php
// fermeture de la connexion pour la portabilité du code (autres DB que MySQL et MariaDB), à ne pas mettre en cas de connexion permanente !
$db = null;
?>