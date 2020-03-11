# Présentation

HereWeGo est un projet de la formation "Développeur Web et Web Mobile" à l'ISFAC de Poitiers (2019-2020).

# Installation

## 1. Récupérer la dernière MAJ via Git

## 2. Paramétrer la config locale :

1. A la racine du projet, créer une copie du fichier "**.env**" et le nommer "**.env.local**"
2. Dans le fichier **.env.local**, modifier les infos (route, login, password) de la BDD

## 3. Mettre à jour les librairies composer :

```bash
composer update
```

## 4. Mettre à jour la structure de la BDD :

```bash
php bin/console doctrine:migrations:migrate
```

## 5. Installer le jeu de données :

```bash
php bin/console doctrine:fixtures:load

yes
```