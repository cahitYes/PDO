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
    $sql = "SELECT * FROM thesection ORDER BY thesectiontitle ASC;";
    $querySection = $con->query($sql);
    return  $querySection->fetchAll();
    // doit renvoyer un tableau si pas de résultats
    return [];
}
