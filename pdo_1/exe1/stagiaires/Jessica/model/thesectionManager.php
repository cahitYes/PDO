<?php

/**
 * Fonction qui sélectionne tous les champs de la table `thesection` 
 * ordonnée par `thesectiontitle` ascendant et qui renvoie un tableau vide si pas de résultats,
 * et un tableau indexé contenant des tableaux associatifs si on a un résultat.
 * Cette requête ne doit pas être préparée. try catch non nécessaire.
 * 
 * @param \PDO $con
 * @return array
 */
function thesectionSelectAll(PDO $con): array
{
    $a = $con->query("SELECT *
    FROM thesection
    ORDER BY thesectiontitle ASC;");
    return $a->fetchAll(PDO::FETCH_ASSOC);
    // doit renvoyer un tableau si pas de résultats
    //return [];
}



/**
 * Fonction qui sélectionne tous les champs de la table `thesection` 
 * quand l'idthesection vaut $id et qui renvoie un tableau vide si pas de résultats,
 * et un tableau associatif si on a un résultat.
 * Cette requête DOIT être préparée. try catch nécessaire!
 * 
 *Modifier thesectionSelectOneById dans model\thesectionManager.php pour récupérer tous les champs de la table thesection grâce à son id dans un tableau associatif. En cas d'erreur ou pas d'article sélectionné renvoie un tableau vide. Cette requête DOIT être préparée. try catch nécessaire.
 * 
 * @param \PDO $con
 * @param int $id
 * @return array
 */
function thesectionSelectOneById(PDO $con, int $id): array
/*$sql ="SELECT *
    FROM thesection
    WHERE idthesection = $id";

$prepare =$con->prepare($sql)*/

{
    // doit renvoyer un tableau si pas de résultats

    return [];
}



/**
 * Fonction qui insert 2 champs dans la table `thesection` 
 * Si l'insertion échoue, envoyer false 
 * (probablement un DUPLICATE CONTENT sur `thesectiontitle`)
 * En cas de réussite, envoie true
 * Cette requête DOIT être préparée. try catch nécessaire pour gérer les duplicate content!
 * Mais le catch ne renvoie que false
 * 
 * @param \PDO $con
 * @param string $title
 * @param string $desc
 * @return bool
 */
function thesectionInsert(PDO $con, string $title, string $desc): bool
{
    // doit renvoyer false si l'insertion échoue
    return false;
}


/**
 * Fonction qui update 2 champs dans la table `thesection` quand l'id correspond
 * Si l'update échoue, envoyer false 
 * (probablement un DUPLICATE CONTENT sur `thesectiontitle`)
 * En cas de réussite, envoyer true
 * Cette requête DOIT être préparée. try catch nécessaire pour gérer les duplicate content!
 * Mais le catch ne renvoie que false
 * 
 * @param \PDO $con
 * @param int $id
 * @param string $title
 * @param string $desc
 * @return bool
 */
function thesectionUpdate(PDO $con, int $id, string $title, string $desc): bool
{
    // doit renvoyer false si l'update échoue
    return false;
}



/**
 * Fonction qui delete une entrée dans la table `thesection` quand l'id correspond
 * Si le delete échoue, envoyer false 
 * En cas de réussite, envoyer true
 * Cette requête DOIT être préparée. try catch nécessaire!
 * Mais le catch ne renvoie que false
 * 
 * @param \PDO $con
 * @param int $id
 * @return bool
 */
function thesectionDelete(PDO $con, int $id): bool
{
    /*  $sql = pdo_prepare ($con,"DELETE FROM thesection WHERE idthesection=?");
    pdo_stmt_bind_param($sql, "i", $idesection);*/

    // doit renvoyer false si le delete échoue

    return false;
}
