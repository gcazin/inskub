# Inskub

Inskub est une plateforme mettant en lien les acteurs de l'assurance.

## Installation

Avant toute chose, il faudra configurer le fichier de configuration globale pour y mettre vos informations de base de données.

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inskub
DB_USERNAME=root
DB_PASSWORD=root
```

Après que ceci soit fait, installer les dépendances Composer et NPM:

```shell script
composer install && npm install
```

Vous pouvez maintenant installer les migrations, et lancer la génération des données de base. 
* les rôles et permissions, 
* visibilité des publications, 
* compétences des utilisateurs, 
* département, 
* et compagnie.

```shell script
php artisan migrate && php artisan inskub:setup
```

Lors de l'exécution de cette commande, il vous sera demandé si vous souhaiter créer un super-admin, appuyez sur entrée pour le créer. Si vous souhaiter le faire plus tard, cette commande sera toujours accessible avec ``php artisan super-admin:create``.

*Si vous êtes en environnement de test, vous pouvez migrer des données de test via la commande* ``php artisan db:seed``

## Fonctionnalités

**Commandes:**

Génération des élements de base : ``php artisan inskub:setup``

Création des rôles et des permissions : ``php artisan roles:create``

Création d'un utilisateur super-admin : ``php artisan super-admin:create``

### Rôles et permissions

| Nom         | Rôles associés    | Description                                    |
|-------------|-------------------|------------------------------------------------|
| \*.\*       | super-admin       | A tous les droits                              |
| admin.*     | admin             | A tous les droits sur le rôle d'administrateur |
| professor.* | school            | A le droit de créer des professeurs            |
| class.*     | school            | A le droit de créer des classes                |
| classroom.* | other (professor) | A le droit de créer des projets de classe      |

*Format :* ``nom_de_la_permission.attributs``

Attributs : Create, view, update, delete. L'astérix permet d'avoir la possibilité d'exécuter toutes ses commandes.

## License

Ce projet n'a pas pour but d'être open-source, seules des fonctionnalités peuvent être extraite et mise sous forme de package pour mettre une ré-utilisation par un tiers.
