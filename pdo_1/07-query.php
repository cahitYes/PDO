<?php
// dépendances
require_once "05-connectPDO.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO->Query</title>
</head>

<body>
    <h1>PDO->Query</h1>
    <h3>Pour les SELECT, on utilise la méthode query()</h3>
    <h4>Avec le fetch pour afficher les résultats</h4>
    <?php
    $sql = "SELECT * FROM thearticle WHERE idthearticle <= 10 ORDER BY idthearticle DESC";
    // exécution de la requête
    $queryArticles = $db->query($sql);
    // on veut compter le nombre de résultats
    $nbArticles = $queryArticles->rowCount();
    // on veut indiquer à PDO ce que l'on souhaite comme formatage de contenu
    $queryArticles->setFetchMode(PDO::FETCH_ASSOC);
    ?>
    <h4>Nous avons <?= $nbArticles ?> articles </h4>
    <?php
    while ($article = $queryArticles->fetch()) {
        echo $article['thearticletitle'] . " | ";
    }
    // on ferme le curseur des résultats, inutile pour mysql mais nécessaire pour la portabilité du code
    $queryArticles->closeCursor();
    while ($article = $queryArticles->fetch()) {
        echo $article['thearticletitle'] . " |- ";
    }
    echo "<hr>";

    $sql = "SELECT * FROM thearticle WHERE idthearticle <= 10 ORDER BY idthearticle DESC";
    // exécution de la requête
    $queryArticles = $db->query($sql);
    // on veut compter le nombre de résultats
    $nbArticles = $queryArticles->rowCount();
    ?>
    <h4>Nous avons <?= $nbArticles ?> articles </h4>
    <?php
    // identique mais avec l'application du format dans le fetch
    while ($article = $queryArticles->fetch(PDO::FETCH_ASSOC)) {
        echo $article['thearticletitle'] . " | ";
    }
    // on ferme le curseur des résultats, inutile pour mysql mais nécessaire pour la portabilité du code
    $queryArticles->closeCursor();
    while ($article = $queryArticles->fetch()) {
        echo $article['thearticletitle'] . " |- ";
    }

    echo "<hr><h4>Préférez le fetchAll si on peut avoir plus d'un résultat</h4>";

    $sql = "SELECT * FROM thearticle WHERE idthearticle <= 10 ORDER BY idthearticle DESC";
    // exécution de la requête
    $queryArticles = $db->query($sql);
    // on veut compter le nombre de résultats
    $nbArticles = $queryArticles->rowCount();
    $articles = $queryArticles->fetchAll(PDO::FETCH_ASSOC);
    $queryArticles->closeCursor();

    ?>
    <h4>Nous avons <?= $nbArticles ?> articles </h4>
    <?php
    // identique mais avec l'application du format dans le fetch
    foreach ($articles as $article) {
        echo $article['thearticletitle'] . " | ";
    }
    echo "<hr><h5>On veut afficher à l'envers, pas besoin d'une autre requête</h5>";

    krsort($articles); // inversion
    foreach ($articles as $article) {
        echo $article['thearticletitle'] . " | ";
    }
    ?>
</body>

</html>
<?php
$db = null;
?>