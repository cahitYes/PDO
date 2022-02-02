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
    // doit renvoyer un tableau si pas de résultats
    return [];
}

/**
 * Fonction qui sélectionne tous les champs de la table `thesection` 
 * quand l'id vaut $id et qui renvoie un tableau vide si pas de résultats,
 * et un tableau associatif si on a un résultat.
 * Cette requête DOIT être préparée. try catch nécessaire pour les duplicate content!
 * 
 * @param \PDO $con
 * @param int $id
 * @return array
 */
function thesectionSelectOneById(PDO $con, int $id): array
{
    // doit renvoyer un tableau si pas de résultats
    return [];
}
