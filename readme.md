# SoigneMoi

Bienvenue dans l'application SoigneMoi !

## Description

SoigneMoi est une application développée par **Develop-Solution** pour l'hôpital SoigneMoi, situé dans la région lilloise en France. Cette application vise à améliorer l'efficacité de l'hôpital en proposant des outils informatisés pour la gestion des admissions, des séjours et des prescriptions médicales.

## Technologies utilisées

- PHP 8.2.12 (CLI)
- Symfony 6.4
- Composer
- MySQL

## Fonctionnalités

L'application web de SoigneMoi permet aux utilisateurs de créer un compte, de planifier leur séjour à l'hôpital et de consulter leur historique de séjours.
Les administrateurs peuvent gérer les plannings des médecins en créant des médecins et en définissant leur emploi du temps.

## Utilisation en ligne

Pour utiliser l'application en ligne, veuillez vous rendre sur le lien suivant:

```bash

[https://soignemoi-chu-19a585dde838.herokuapp.com](https://soignemoi-chu-19a585dde838.herokuapp.com/)

```

## Installation locale

### Prérequis

Assurez-vous d'avoir les éléments suivants installés avant de commencer :

- GIT
- PHP 8 ou plus
- Composer
- Symfony CLI

### Installation

1. Clonez ce dépôt sur votre machine locale:

```bash
    git clone https://github.com/Maryonete/chu
```

2. Naviguez jusqu'au répertoire du projet:

```bash
    cd chu
```

3. Installez les dépendances:

```bash
    composer install
```

4. Modifier le fichier `.env` à la racine du projet avec les informations de votre base de données et ajoutez les variables suivantes:

```bash
    ### Data base access ###
    DATABASE_URL= Votre Base de données

    ###> lexik/jwt-authentication-bundle ###
    JWT_SECRET_KEY=%kernel.project_dir%/config/jwt/private.pem
    JWT_PUBLIC_KEY=%kernel.project_dir%/config/jwt/public.pem
    JWT_PASSPHRASE=passphrase

    ###> nelmio/cors-bundle ###
    CORS_ALLOW_ORIGIN='^https?://(localhost|127\.0\.0\.1)(:[0-9]+)?$'

```

5. Générer les clés privée et publique JWT:

```bash
    openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
    openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

6. Exécuter les migrations et créer la structure de la base de données:

```bash
  `php bin/console doctrine:migrations:migrate`
```

7. Insérer des enregistrements dans la base de données

```bash
  `php bin/console doctrine:fixtures:load`
```

8. Lancez le serveur Symfony

```bash
  `symfony server:start`
```

9. Enfin, accéder à l'application:

```bash
  `http://localhost:8000`
   ou l'adresse définie dans la configuration de votre serveur web
```

### Utilisation

#### Identifiants des utilisateurs tests

- **Patient**:

  - Email: john.do@test.fr
  - Mot de passe: test

- **Administrateur**:
  - Email: admin@studi.fr
  - Mot de passe: test
