<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'une section</title>
</head>

<body>
    <h1>Modification d'une section</h1>
    <nav>
        <a href="./">Accueil</a> | <a href="./?add">Ajouter une section</a>
    </nav>
    <hr>
    <?php
    if (isset($error)) :
    ?>
        <h3>Erreur lors de l'insertion, veuillez recommencer</h3>
    <?php
    endif;
    ?>
    <form name="updatethesection" method="POST" action="">
        <p>
            <label for="thesectiontitle">thesectiontitle:</label> <input type="text" id="thesectiontitle" name="thesectiontitle" value="ici le titre à modifier" maxlength="70" required>
        </p>
        <p>
            <label for="thesectiondesc">thesectiondesc:</label> <textarea id="thesectiondesc" name="thesectiondesc" maxlength="240" required>ici le texte à modifier</textarea>
        </p>
        <p>
            <label for="thesectiondesc">Modifier :</label> <input type="submit" value="modifier" />
        </p>
        <input type="hidden" name="idthesection" value="ici l'id" required>
    </form>

</body>

</html>