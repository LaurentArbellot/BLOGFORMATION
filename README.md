
# BLOGFORMATION
## Example de structure de blog avec symfony 6.3
***
=======


## Exemple de structure de BLOG avec Administration avec Symfony 6.3 

***

### Pour cloner ce projet :
git clone https://github.com/VinceFormateur/BLOG_SF6.3.git


## Pour installer le projet après l'avoir cloner:
```
composer install (installation)
composer update (mise à jour)
symfony console doctrine:database:create (Création de la BDD en ayant renseigner le .ENV)
symfony console make:migration (Création d'une nouvelle migration)
symfony console doctrine:migrations:migrate (Application de la migration)
```

## l'Authentification :
```
symfony console make:user (Création de l'Utilisateur)
symfony console make:auth (Authentification -->> login/logout)
symfony console make:registration-form (Inscription)
composer require symfonycasts/verify-email-bundle (Bundle de Vérification d'Email)
```

## Les Entités :
```
symfony console doctrine:database:create (Création de la BDD)
symfony console make:entity (Création de l'entité)
symfony console doctrine:schema:validate (Validation du schéma de BDD)
symfony console make:migration (Création d'une migration)
symfony console doctrine:migrations:migrate (Application de la migration en BDD)
```

## MAIL :
```
composer require symfony/google-mailer (Bridge de connexion à gmail)
```

## SLUG :
composer require stof/doctrine-extensions-bundle
[ La Documentation ](https://symfony.com/bundles/StofDoctrineExtensionsBundle/current/index.html)
 et [  Pour le configurer  ](https://github.com/doctrine-extensions/DoctrineExtensions/blob/main/doc/sluggable.md)


## google RECAPTCHA :
```
aire un compte sur google recaptcha
rentrer les infos du site
mettre sous v3 
generer les clés
mettre ce code dans .env avec les clés

###> karser/recaptcha3-bundle ###
RECAPTCHA3_KEY=my_site_key
RECAPTCHA3_SECRET=my_secret
###< karser/recaptcha3-bundle ###

```
## fixtures
```
composer require --dev orm-fixtures
symfony console doctrine:fixtures:load --env=test
```