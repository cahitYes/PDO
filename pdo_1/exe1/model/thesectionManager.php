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
    // requête de type select non préparée
    $result = $con->query("SELECT * FROM thesection ORDER BY thesectiontitle ASC");

    // si on a au moins 1 résultat
    if ($result->rowCount()) {
        // envoi des résultats
        return $result->fetchAll(PDO::FETCH_ASSOC);
        // sinon rowCount vaut 0    
    } else {
        // doit renvoyer un tableau si pas de résultats
        return [];
    }
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
    // préparation avec un marqueur non nommé (?)
    $prepare = $con->prepare("SELECT * FROM thesection WHERE idthesection=?");

    // essai
    try {

        // exécution
        $prepare->execute([$id]);

        // si on a récupéré un article (1== true)
        if ($prepare->rowCount()) {

            return $prepare->fetch(PDO::FETCH_ASSOC);
        } else {
            // doit renvoyer un tableau si pas de résultats
            return [];
        }


        // erreur    
    } catch (Exception $e) {
        echo $e->getMessage();
        // doit renvoyer un tableau si pas de résultats
        return [];
    }
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
    // préparation de la requête SQL avec des marqueurs nommés (avec :untext), règles identiques que le nommage de variables en PHP (et SQL)
    $sql = "INSERT INTO thesection (thesectiontitle,thesectiondesc) VALUES (:title, :sdesc)";
    // attribution de la variable $sql à notre connexion pour la requête préparée
    // BUT : éviter les injection SQL
    $prepare = $con->prepare($sql);

    // attribution des valeurs avec bindParam
    $prepare->bindParam(':title', $title, PDO::PARAM_STR);
    $prepare->bindParam(':sdesc', $desc, PDO::PARAM_STR);

    // on essaie d'exécuter notre requête
    try {

        // exécution de le requête, en cas d'échec, arrêt du script à cette ligne et appel du catch
        $prepare->execute();

        // pas d'erreurs, donc oin renvoie true
        return true;

        // si on a une erreur on l'attrape
    } catch (Exception $e) {
        // echo $e->getMessage();
        // doit renvoyer false si l'insertion échoue
        return false;
    }
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

    $sql = "update thesection
    set thesectiontitle=?,thesectiondesc=?
    where  idthesection=?
    
    ";
    $prepare = $con->prepare($sql);

    try {
        $prepare->execute([$title, $desc, $id]);
        /*

on est ICI
        */
        return true;
    } catch (Exception $e) {
        // doit renvoyer false si l'update échoue
        return false;
    }
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
    // doit renvoyer false si le delete échoue
    return false;
}
