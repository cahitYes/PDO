<!DOCTYPE html>
<html lang="fr">

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
<<<<<<< HEAD
    if (isset($error)) :
    ?>
        <h3>Pas encore de section a afficher</h3>
    <?php
    else :
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
            foreach ($allThesection as $item) :
                ?>
            <tr>
                <td>1</td>
                <td>titre 1</td>
                <td>description 1</td>
                <td><a href="./?update=1"><img src="https://raw.githubusercontent.com/WebDevCF2m2021/first-mvc-with-admin/main/public/img/update.png" alt="update" /></a></td>
                <td><a href="./?delete=1"><img src="https://raw.githubusercontent.com/WebDevCF2m2021/first-mvc-with-admin/main/public/img/delete.png" alt="delete" /></a></td>
            </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>

=======
    // pas encore de stions
    if (empty($allThesection)) :
    ?>
        <h3>Pas encore de sections à afficher</h3>
    <?php
    // on a au moins une section
    else :
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
                // tant qu'on a des articles à afficher
                foreach ($allThesection as $item) :
                ?>
                    <tr>
                        <td><?= $item['idthesection'] ?></td>
                        <td><?= $item['thesectiontitle'] ?></td>
                        <td><?= $item['thesectiondesc'] ?></td>
                        <td><a href="./?update=<?= $item['idthesection'] ?>"><img src="https://raw.githubusercontent.com/WebDevCF2m2021/first-mvc-with-admin/main/public/img/update.png" alt="update" /></a></td>
                        <td><a href="./?delete=<?= $item['idthesection'] ?>"><img src="https://raw.githubusercontent.com/WebDevCF2m2021/first-mvc-with-admin/main/public/img/delete.png" alt="delete" /></a></td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    <?php
    endif;
    ?>
>>>>>>> 0ebfbba2882f21dfdd7a65fc98eb58980638b651
</body>

</html>