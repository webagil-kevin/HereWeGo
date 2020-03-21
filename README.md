# Présentation

HereWeGo est un projet de la formation "Développeur Web et Web Mobile" à l'ISFAC de Poitiers (2019-2020).

# Installation

## 1. Récupérer la dernière MAJ via Git

## 2. Paramétrer la config locale :

1. A la racine du projet, créer une copie du fichier "**.env**" et le nommer "**.env.local**"
2. Dans le fichier **.env.local**, modifier les infos (route, login, password) de la BDD

## 3. Mettre à jour les bibliothèques composer :

```bash
composer update
```

## 4. Mettre à jour la structure de la BDD :

```bash
php bin/console doctrine:migrations:migrate
```

## 5. Installer le jeu de données :

### La première fois
```bash
php bin/console doctrine:fixtures:load -n
```

### Les fois suivantes
Permet de réinitialiser les AUTO_INCREMENT à 0
```bash
php bin/console doctrine:schema:drop --force
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load -n
```