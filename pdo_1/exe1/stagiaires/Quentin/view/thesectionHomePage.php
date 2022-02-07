<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil de thesection</title>
</head>

<body>
    <h1>Accueil de thesection</h1>
    <nav>
        <a href="./">Accueil</a> | <a href="./?add">Ajouter une section</a>
    </nav>
    <hr>
    <?php
    if (!empty($sections)) {
    ?>
        <table>
            <thead>
                <tr>
                    <th>idthesection</th>
                    <th>thesectiontitle</th>
                    <th>thesectiondesc</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($sections as $section) {
                ?>
                    <tr>
                        <td><?= $section["idthesection"] ?></td>
                        <td><?= $section["thesectiontitle"] ?></td>
                        <td><?= $section["thesectiondesc"] ?></td>
                        <td><a href="./?update=<?= $section["idthesection"] ?>"><img src="https://raw.githubusercontent.com/WebDevCF2m2021/first-mvc-with-admin/main/public/img/update.png" alt="update" /></a></td>
                        <td><a href="./?delete=<?= $section["idthesection"] ?>"><img src="https://raw.githubusercontent.com/WebDevCF2m2021/first-mvc-with-admin/main/public/img/delete.png" alt="delete" /></a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
    ?>
        <h1>Il n'y a pas encore de sections!</h1>
    <?php
    }
    ?>
</body>

</html>