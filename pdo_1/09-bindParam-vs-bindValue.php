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
    <title>bindParam, bindValue et execute([])</title>
</head>

<body>
    <h1>bindParam, bindValue et execute([])</h1>
    <h3>PDOStatement::bindParam — Lie un paramètre à un nom de variable spécifique</h3>
    <p>Avec bindParam(), contrairement au bindValue(), la variable est liée comme référence et ne sera évaluée qu'au moment de l’appel de l’ execute().</p>
    <pre>

    </pre>
    <?php

    ?>
</body>

</html>
<?php
// fermeture de la connexion pour la portabilité du code (autres DB que MySQL et MariaDB), à ne pas mettre en cas de connexion permanente !
$db = null;
?>