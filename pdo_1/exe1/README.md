# PDO exercice 1

## Sur la base de donnée pdo_1

- Remplir `config.php` avec les constantes nécessaires à la connexion PDO à la base de donnée `pdo_1`
- Charger `config.php` dans `index.php`
- Charger `model\thesectionManager.php`
- Créer (instancier) une connexion PDO avec le `try catch` et les erreurs activées dans `index.php`

- Créer un routeur dans `index.php` :

  - **Pas de variables get** : Appeler la fonction `thesectionSelectAll` dans une variable, puis charger `view\thesectionHomePage.php` pour afficher toutes les sections.
  - **Variable get `add`** : charger `view\thesectionAdd.php`
    - **Si le formulaire POST est envoyé** : Appeler la fonction `thesectionInsert` en passant le titre et la description, puis rediriger sur l'accueil en cas de succès, ou afficher une erreur au dessus du formulaire en cas d'échec (pas de détail, existence de `$error`)
  - **Variable get `update`** : Appeler la fonction `thesectionSelectOneById` en passant l'id, puis charger `view\thesectionUpdate.php` et afficher les 3 valeurs dans le formulaire.
    - **Si le formulaire POST est envoyé** : Appeler la fonction `thesectionUpdate` en passant l'id, le titre et la description, puis rediriger sur l'accueil en cas de modification, ou afficher une erreur au dessus du formulaire en cas d'échec (pas de détail, existence de `$error`)

- Modifier `thesectionSelectAll` dans `model\thesectionManager.php` pour récupérer toutes les sections ordonnées par `thesectiontitle` ascendant dans un tableau indexé contenant des **tableaux associatifs**. Cette requête ne doit pas être préparée. `try catch` non nécessaire.
