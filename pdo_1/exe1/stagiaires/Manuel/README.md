# PDO exercice 1

## Sur la base de donnée pdo_1

- Remplir `config.php` avec les constantes nécessaires à la connexion PDO à la base de donnée `pdo_1`

### dans index.php

- Charger `config.php` dans `index.php`
- Charger `model\thesectionManager.php`
- Créer (instancier) une connexion PDO avec le `try catch` et les erreurs activées dans `index.php`

- Créer un routeur dans `index.php` (unique contrôleur de cet exercice) :

  - **Pas de variables get** : Appeler la fonction `thesectionSelectAll` dans une variable, puis charger `view\thesectionHomePage.php` pour afficher toutes les sections.

  - **Variable get `add`** : charger `view\thesectionAdd.php`

    - **Si le formulaire POST est envoyé** : Appeler la fonction `thesectionInsert` en passant le titre et la description (**protégés!**), puis rediriger sur l'accueil en cas de succès, ou afficher une erreur au dessus du formulaire en cas d'échec (pas de détail, existence de `$error`)

  - **Variable get `update`** : Appeler la fonction `thesectionSelectOneById` en passant l'id, puis charger `view\thesectionUpdate.php` et afficher les 3 valeurs dans le formulaire. **! Si le format de `update` est faux ou la section n'existe pas, chargez `view\thesection404.php`**

    - **Si le formulaire POST est envoyé** : Appeler la fonction `thesectionUpdate` en passant l'id, le titre et la description (**protégés!**), puis rediriger sur l'accueil en cas de modification, ou afficher une erreur au dessus du formulaire en cas d'échec (pas de détail, existence de `$error`) **! Si le format de `update` est faux ou la section n'existe pas, chargez `view\thesection404.php`**

  - **Variable get `delete`** : Appeler la fonction `thesectionSelectOneById` en passant l'id, puis charger `view\thesectionDelete.php` et afficher l'id et le titre de la section. **! Si le format de `delete` est faux ou la section n'existe pas, chargez `view\thesection404.php`**
    - **Si on clique sur supprimer** (existence de la variable get `confirm`) : Appeler la fonction `thesectionDelete` en passant l'id, puis rediriger sur l'accueil en cas de suppression, ou afficher une erreur en cas d'échec (pas de détail, existence de `$error`) **! Si le format de `delete` est faux ou la section n'existe pas, chargez `view\thesection404.php`**

### dans model\thesectionManager.php

- Modifier `thesectionSelectAll` dans `model\thesectionManager.php` pour récupérer toutes les sections ordonnées par `thesectiontitle` ascendant dans un tableau indexé contenant des **tableaux associatifs**. Cette requête ne doit pas être préparée. `try catch` non nécessaire.

- Modifier `thesectionSelectOneById` dans `model\thesectionManager.php` pour récupérer tous les champs de la table `thesection` grâce à son id dans un **tableau associatif**. En cas d'erreur renvoie un tableau vide. Cette requête DOIT être préparée. `try catch` nécessaire.

- Modifier `thesectionInsert` dans `model\thesectionManager.php` pour insérer 2 champs dans la table `thesection` (1 ligne). En cas d'erreur envoie false . En cas de succès envoie true. Cette requête DOIT être préparée. `try catch` nécessaire.

- Modifier `thesectionUpdate` dans `model\thesectionManager.php` pour modifier le titre et la description dans la table `thesection` grâce à l'ID. En cas d'erreur envoie false . En cas de succès envoie true. Cette requête DOIT être préparée. `try catch` nécessaire.

- Modifier `thesectionDelete` dans `model\thesectionManager.php` pour supprimer une entrée dans la table `thesection` grâce à l'ID. En cas d'erreur envoie false . En cas de succès envoie true. Cette requête DOIT être préparée. `try catch` nécessaire.

### Les vues

Modifier les vues pour qu'elles soient fonctionnelles avec le contrôleur (`index.php`) et le modèle (`model\thesectionManager.php`)

A ne pas toucher :

- `view\thesection404.php`

A modifier :

- `view\thesectionHomePage.php`
- `view\thesectionAdd.php`
- `view\thesectionUpdate.php`
- `view\thesectionDelete.php`

## Bon travail !
