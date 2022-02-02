# PDO exercice 1

## Sur la base de donnée pdo_1

- Remplir `config.php` avec les constantes nécessaires à la connexion PDO à la base de donnée `pdo_1`
- Charger `config.php` dans `index.php`
- Charger `model\thesectionManager.php`
- Créer (instancier) une connexion PDO avec le `try catch` et les erreurs activées dans `index.php`

- Modifiez `thesectionSelectAll` dans `model\thesectionManager.php` pour récupérer toutes les sections ordonnées par `thesectiontitle` ascendant dans un tableau indexé contenant des **tableaux associatifs**. Cette requête ne doit pas être préparée. `try catch` non nécessaire.

- Créer un routeur dans `index.php` :
  - **Pas de variables get** : appelez la fonction `thesectionSelectAll` dans une variable puis chargez `view\thesectionHomePage.php` pour afficher toutes les sections.
  -
