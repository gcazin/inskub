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

## Plan du site

Non connecté
- Accueil | https://inskub.com/
- Inscription | https://inskub.com/inscription
- Connexion | https://inskub.com/connexion

Connecté - commun à tous les profils
- Fil d'actualité | https://inskub.com/index
- Découvrir | https://inskub.com/discover
    - Emplois | https://inskub.com/jobs
    - Formations | https://inskub.com/formations
- Projets | https://inskub.com/projects
- Profil | https://inskub.com/profil/[id-utilisateur]
    - Informations du compte | https://inskub.com/mon-compte
    - Options du profil | https://inskub.com/mon-compte/options
- Messagerie | https://inskub.com/chat
- Activité | https://inskub.com/activity
- Notifications | https://inskub.com/notifications
- Déconnexion | https://inskub.com/deconnexion

Connecté - commun aux experts & intermédiaires
- Sinistres | https://inskub.com/projects/sinisters
- Récapitulatif des compte-rendus d'expertises | https://inskub.com/projects/sinisters/pdfs

Connecté - en tant qu'expert
- Missions | https://inskub.com/expert/missions

Connecté - en tant qu'intermédiaire
- Rechercher un expert | https://inskub.com/experts
- Suivre un sinistre | https://inskub.com/sinister/index

Connecté - en tant qu'école
- Gestion de l'école | https://inskub.com/school
    - Gestion des classes | https://inskub.com/school/classroom
    - Gestion des professeurs | https://inskub.com/school/professor
    - Gestion des élèves | https://inskub.com/school/student

Connecté - en tant que super-admin
- Administration | https://inskub.com/admin
    - Gestion des utilisateurs | https://inskub.com/admin/users
    - Gestion des signalements | https://inskub.com/admin/reports
    - Gestion des FAQs | https://inskub.com/admin/faqs

## License

Ce projet n'a pas pour but d'être open-source, seules des fonctionnalités peuvent être extraite et mise sous forme de package pour permettre une ré-utilisation par un tiers.
