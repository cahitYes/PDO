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
    $query = $con->query("SELECT * FROM thesection ORDER BY thesectiontitle ASC;");
    $toReturn = $query->fetchAll(PDO::FETCH_ASSOC);
    $query->closeCursor();
    return $toReturn;
}



/**
 * Fonction qui sélectionne tous les champs de la table `thesection` 
 * quand l'idthesection vaut $id et qui renvoie un tableau vide si pas de résultats,
 * et un tableau associatif si on a un résultat.
 * Cette requête DOIT être préparée. try catch nécessaire!
 * 
 * @param \PDO $con
 * @param int $id
 * @return array
 */
function thesectionSelectOneById(PDO $con, int $id): array
{
    try {
        $query = $con->prepare("SELECT * FROM thesection WHERE idthesection = ?;");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        $query->execute();
        $toReturn =  $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
    } catch (Exception $e) {
        $toReturn = [];
    }
    return $toReturn ? $toReturn : [];
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
    try {
        $query = $con->prepare("INSERT INTO thesection (`thesectiontitle`,`thesectiondesc`) VALUES (?,?);");
        $query->bindParam(1, $title, PDO::PARAM_STR);
        $query->bindParam(2, $desc, PDO::PARAM_STR);
        $toReturn =  $query->execute();
    } catch (Exception $e) {
        $toReturn = false;
    }
    return $toReturn;
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
    try {
        $query = $con->prepare("UPDATE thesection SET `thesectiontitle`= ?,`thesectiondesc`= ? WHERE idthesection = ?;");
        $query->bindParam(1, $title, PDO::PARAM_STR);
        $query->bindParam(2, $desc, PDO::PARAM_STR);
        $query->bindParam(3, $id, PDO::PARAM_INT);
        $toReturn =  $query->execute();
    } catch (Exception $e) {
        $toReturn = false;
    }
    return $toReturn;
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
    try {
        $query = $con->prepare("DELETE FROM thesection WHERE idthesection = ?;");
        $query->bindParam(1, $id, PDO::PARAM_INT);
        $toReturn =  $query->execute();
    } catch (Exception $e) {
        $toReturn = false;
    }
    return $toReturn;
}

/**
 * fonction qui regroupe htmlspecialchar, strip_tags et trim en une seule.
 * 
 * @param string $entry : user entry
 * @param int $flags : htmlspecialchars => ENT_QUOTES
 * @param string $characters : trim =>  \n\r\t\v\0
 * @param mixed $allowed_tags : strip_tags => null
 * @param string|null $encoding : htmlspecialchars => UTF-8
 * @param bool $double_encode : htmlspecialchars => true
 * @return string
 */
function userEntryProtection(
    string $entry,
    int $flags = ENT_QUOTES,
    string $characters = " \n\r\t\v\0",
    $allowed_tags = null,
    ?string $encoding = "UTF-8",
    bool $double_encode = true
): string {
    return htmlspecialchars(strip_tags(trim($entry, $characters), $allowed_tags), $flags, $encoding, $double_encode);
}
