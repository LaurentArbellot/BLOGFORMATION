
# BLOGFORMATION
## Example de structure de blog avec symfony 6.3
***
=======


## Exemple de structure de BLOG avec Administration avec Symfony 6.3 

***
## l'authentification
```
symphonie console make:user (création de l'utilisateur)
symfony console make:auth (Authentification -->connexion/deconnexion)
```
## l'inscription
```
symfony console make:registration-form
composer require symfonycasts/verify-email-bundle(a installer)
```
## Les Entités :
```

symfony console doctrine:database:create (Création de la BDD)
symfony console make:entity (Création de l'entité)
symfony console doctrine:schema:validate (Validation du schéma de BDD)
symfony console make:migration (Création d'une migration)
symfony console doctrine:migrations:migrate (Application de la migration en BDD)
```

## SLUG :
composer require stof/doctrine-extensions-bundle

[la documentation] https://symfony.com/bundles/StofDoctrineExtensionsBundle/current/index.html
[pour le configurer] https://github.com/doctrine-extensions/DoctrineExtensions/blob/main/doc/sluggable.md

=======
```
