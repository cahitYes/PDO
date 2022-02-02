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
            <tr>
                <td>1</td>
                <td>titre 1</td>
                <td>description 1</td>
                <td><a href="./?update=1"><img src="https://raw.githubusercontent.com/WebDevCF2m2021/first-mvc-with-admin/main/public/img/update.png" alt="update" /></a></td>
                <td><a href="./?delete=1"><img src="https://raw.githubusercontent.com/WebDevCF2m2021/first-mvc-with-admin/main/public/img/delete.png" alt="delete" /></a></td>
            </tr>
        </tbody>
    </table>

</body>

</html>