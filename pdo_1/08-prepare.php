<?php

require_once "connectPDO.php";


$sql = "SELECT thesectiontitle FROM thesection ORDER BY idthesection ASC";

// on prépare la requête
$prepare1 = $db->prepare($sql);

// exécution de la requête
$prepare1->execute();

// on prend le nombre de résultats
$nbExe1 = $prepare1->rowCount();

// récupération des données dans un tableau indexé contenant les valeurs dans des tableaux associatifs (PDO::FETCH_ASSOC)
$exe1 = $prepare1->fetchAll(PDO::FETCH_ASSOC);

// portabilité du code, on remet le pointeur au début pour pouvoir réexécuter le code
$prepare1->closeCursor();

/**
 * exe2 avec des marqueurs nommés
 */
$sql = "SELECT * FROM thesection WHERE idthesection BETWEEN :debut AND :fin  ORDER BY idthesection ASC ";

// on prépare la requête
$prepare2 = $db->prepare($sql);

// paramètres par défauts
$begin = 5;
$end = 12;

// on attribue les valeurs au prepare avec bindParam, l'ordre n'est pas important mais bien le nom des marqueurs, PDO::PARAM_INT indique qu'on attend des entiers
$prepare2->bindParam(':fin', $end, PDO::PARAM_INT);
$prepare2->bindParam(':debut', $begin, PDO::PARAM_INT);

// exécution de la requête
$prepare2->execute();

// on prend le nombre de résultats
$nbExe2 = $prepare2->rowCount();



// récupération des données dans un tableau indexé contenant les valeurs dans des tableaux associatifs (PDO::FETCH_ASSOC)
$exe2 = $prepare2->fetchAll(PDO::FETCH_ASSOC);

// portabilité du code, on remet le pointeur au début pour pouvoir réexécuté le code
$prepare2->closeCursor();

// le bindParam permet de ne pas redéclarer les valeurs d'un prepare, il suffit de changer les valeurs qui sont passée "par référence"
$begin = 3;
$end = 16;

$prepare2->execute();

$nbExe2b = $prepare2->rowCount();

$exe2b = $prepare2->fetchAll(PDO::FETCH_ASSOC);

// portabilité du code, on remet le pointeur au début pour pouvoir réexécuter le code
$prepare2->closeCursor();

/**
 * exe3 avec des non nommés : ?
 */

$sql = "SELECT * FROM thesection WHERE idthesection BETWEEN ? AND ?  ORDER BY idthesection ASC ";

// on prépare la requête
$prepare3 = $db->prepare($sql);

// paramètres par défauts
$begin = 5;
$end = 10;

// on attribue les valeurs au prepare avec bindParam, l'ordre n'est pas important mais bien le nom des marqueurs, PDO::PARAM_INT indique qu'on attend des entiers
$prepare3->bindParam(1, $begin, PDO::PARAM_INT);
$prepare3->bindParam(2, $end, PDO::PARAM_INT);

// exécution de la requête
$prepare3->execute();

// on prend le nombre de résultats
$nbExe3 = $prepare3->rowCount();



// récupération des données dans un tableau indexé contenant les valeurs dans des tableaux associatifs (PDO::FETCH_ASSOC)
$exe3 = $prepare3->fetchAll(PDO::FETCH_ASSOC);

// portabilité du code, on remet le pointeur au début pour pouvoir réexécuter le code
$prepare3->closeCursor();

/**
 * exe4 ON EST ICI
 */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les requêtes préparées</title>
</head>

<body>
    <h1>Les requêtes préparées</h1>
    <h3>Exemple 1</h3>
    <p>Sans passage d'argument, pas très utile, sauf dans le cas où on gagne en performance grâce au cache </p>
    <h5>Nombre de section : <?= $nbExe1 ?></h5>
    <p>
        <?php
        foreach ($exe1 as $item) :
        ?>
            <?= $item['thesectiontitle'] ?><br>
        <?php
        endforeach;
        ?>
    </p>
    <h3>Exemple 2</h3>
    <p>Avec le passage d'arguments avec des marqueurs nommés (:debut et :fin) et l'attribution des valeurs avec bindParam, qui permet de mettre en cache la requête et la rappeler qu'avec son execute en changeant les variables liées</p>
    <h5>Nombre de section : <?= $nbExe2 ?></h5>
    <p>
        <?php
        foreach ($exe2 as $item) :
        ?>
            <?= $item['thesectiontitle'] ?><br>
        <?php
        endforeach;
        ?>
    </p>
    <h5>Nombre de section de exe2b : <?= $nbExe2b ?></h5>
    <p>
        <?php
        foreach ($exe2b as $item) :
        ?>
            <?= $item['thesectiontitle'] ?><br>
        <?php
        endforeach;
        ?>
    </p>
    <h3>Exemple 3</h3>
    <p>Avec le passage d'arguments avec des marqueurs non nommés (? et ?) et l'attribution des valeurs avec bindParam, qui permet de mettre en cache la requête et la rappeler qu'avec son execute en changeant les variables liées</p>
    <h5>Nombre de section : <?= $nbExe3 ?></h5>
    <p>
        <?php
        foreach ($exe3 as $item) :
        ?>
            <?= $item['thesectiontitle'] ?><br>
        <?php
        endforeach;
        ?>
    </p>
</body>

</html>