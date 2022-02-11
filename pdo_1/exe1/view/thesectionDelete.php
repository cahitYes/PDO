<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'une section</title>
</head>

<body>
    <h1>Suppression d'une section</h1>
    <nav>
        <a href="./">Accueil</a> | <a href="./?add">Ajouter une section</a>
    </nav>
    <hr>
    <?php
    if (isset($error)) :
    ?>
        <h3>Erreur lors de la suppression, veuillez recommencer</h3>
    <?php
    endif;
    ?>
    <h4>Voulez-vous vraiment supprimer</h4>
    <h3><?= $recupThesection['idthesection'] ?> - <?= $recupThesection['thesectiontitle'] ?></h3>
    <h5><a href="?delete=<?= $recupThesection['idthesection'] ?>&confirm">OUI</a> | <a href="./">NON</a></h5>

</body>

</html>