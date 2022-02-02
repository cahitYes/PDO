# PDO exercice 1

## Sur la base de donnée pdo_1

- Remplir `config.php` avec les constantes nécessaires à la connexion PDO à la base de donnée `pdo_1`
- Charger `config.php` dans `index.php`
- Charger `model\thesectionManager.php`
- Créer (instancier) une connexion PDO avec le `try catch` et les erreurs activées dans `index.php`

- Créer un routeur dans `index.php` :

  - **Pas de variables get** : Appeler la fonction `thesectionSelectAll` dans une variable, puis charger `view\thesectionHomePage.php` pour afficher toutes les sections.
  - **Variable get `add`** : charger `view\thesectionAdd.php`
    - **Si le formulaire POST est envoyé** : Appeler la fonction `thesectionInsert` en passant l'id, puis rediriger sur l'accueil
  - **Variable get `update`** : Appeler la fonction `thesectionSelectOneById` en passant l'id, puis charger `view\thesectionUpdate.php` et afficher les valeurs dans le formulaire.
    ICI

- Modifier `thesectionSelectAll` dans `model\thesectionManager.php` pour récupérer toutes les sections ordonnées par `thesectiontitle` ascendant dans un tableau indexé contenant des **tableaux associatifs**. Cette requête ne doit pas être préparée. `try catch` non nécessaire.
