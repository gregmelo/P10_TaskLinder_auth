# TaskLinker

<p align="center">
  <img src="public/img/logo.png" alt="TaskLinker Logo" width="200"/>
</p>

<p align="center">
  <strong>Application de gestion de projets et de tâches</strong>
</p>

<p align="center">
  <a href="#-à-propos">À propos</a> •
  <a href="#-fonctionnalités">Fonctionnalités</a> •
  <a href="#️-technologies">Technologies</a> •
  <a href="#-installation">Installation</a> •
  <a href="#-utilisation">Utilisation</a> •
  <a href="#-structure-du-projet">Structure</a>
</p>

---

## 📚 À propos

**TaskLinker** est le **Projet 8** de la formation **OpenClassrooms** - **Concepteur Développeur d'Application PHP/Symfony**.

Ce projet consiste à développer une application web de gestion de projets et de tâches permettant aux équipes de collaborer efficacement. L'application permet de créer des projets, d'y assigner des employés et de gérer les tâches associées avec un système de suivi de statut (To Do, Doing, Done).

### 🎯 Objectifs pédagogiques

- Concevoir et développer une application web avec le framework **Symfony**
- Mettre en place une architecture **MVC** robuste
- Utiliser **Doctrine ORM** pour la gestion de la base de données
- Implémenter des relations complexes entre entités
- Créer des formulaires dynamiques avec validation
- Développer une interface utilisateur intuitive avec **Twig**
- Appliquer les bonnes pratiques de développement PHP

---

## ✨ Fonctionnalités

### 📁 Gestion des Projets
- ✅ Création, modification et suppression de projets
- ✅ Archivage des projets terminés
- ✅ Assignation de membres à un projet
- ✅ Vue détaillée avec les tâches associées

### 📋 Gestion des Tâches
- ✅ Création de tâches liées à un projet
- ✅ Attribution d'une tâche à un employé
- ✅ Système de statut : **To Do** → **Doing** → **Done**
- ✅ Définition de deadlines
- ✅ Description détaillée des tâches

### 👥 Gestion des Employés
- ✅ Création et modification des profils employés
- ✅ Gestion des statuts employés (CDI, CDD, Freelance, etc.)

### 🏠 Tableau de bord
- ✅ Vue d'ensemble des projets actifs

---

## 🛠️ Technologies

### Backend
| Technologie | Version | Description |
|-------------|---------|-------------|
| ![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?logo=php&logoColor=white) | 8.2+ | Langage de programmation |
| ![Symfony](https://img.shields.io/badge/Symfony-7.4-000000?logo=symfony&logoColor=white) | 7.4 | Framework PHP |
| ![Doctrine](https://img.shields.io/badge/Doctrine-ORM-FC6A31?logo=doctrine&logoColor=white) | 3.x | ORM pour la base de données |
| ![Twig](https://img.shields.io/badge/Twig-3.x-bacf29?logo=twig&logoColor=white) | 3.x | Moteur de templates |

### Frontend
| Technologie | Description |
|-------------|-------------|
| ![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white) | Structure des pages |
| ![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white) | Styles personnalisés |
| ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?logo=javascript&logoColor=black) | Interactions dynamiques |
| ![Font Awesome](https://img.shields.io/badge/Font%20Awesome-6.x-528DD7?logo=fontawesome&logoColor=white) | Icônes |
| ![Select2](https://img.shields.io/badge/Select2-4.1-5897fb) | Sélecteurs améliorés |

### Base de données
| Technologie | Description |
|-------------|-------------|
| ![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white) | Système de gestion de base de données |

### Outils de développement
| Outil | Description |
|-------|-------------|
| ![Composer](https://img.shields.io/badge/Composer-885630?logo=composer&logoColor=white) | Gestionnaire de dépendances PHP |
| ![Docker](https://img.shields.io/badge/Docker-2496ED?logo=docker&logoColor=white) | Conteneurisation (optionnel) |
| ![Git](https://img.shields.io/badge/Git-F05032?logo=git&logoColor=white) | Contrôle de version |
| ![Symfony CLI](https://img.shields.io/badge/Symfony%20CLI-000000?logo=symfony&logoColor=white) | Serveur de développement |

---

## 📦 Installation

### Prérequis

- **PHP** >= 8.2
- **Composer** >= 2.x
- **MySQL** >= 8.0 ou **MariaDB** >= 10.x
- **Symfony CLI** (recommandé)
- **Node.js** (optionnel, pour les assets)

### Étapes d'installation

#### 1. Cloner le repository

```bash
git clone https://github.com/gregmelo/P8_TaskLinder.git
cd P8_TaskLinder
```

#### 2. Installer les dépendances PHP

```bash
composer install
```

#### 3. Configurer l'environnement

Copier le fichier `.env` et configurer la base de données :

```bash
cp .env .env.local
```

Modifier le fichier `.env.local` avec vos paramètres de base de données :

```env
DATABASE_URL="mysql://username:password@127.0.0.1:3306/tasklinker?serverVersion=8.0"
```

#### 4. Créer la base de données

```bash
# Créer la base de données
symfony console doctrine:database:create

# Exécuter les migrations
symfony console doctrine:migrations:migrate
```

#### 5. Charger les données de démonstration (optionnel)

```bash
symfony console doctrine:fixtures:load
```

#### 6. Lancer le serveur de développement

```bash
symfony server:start
```

L'application est maintenant accessible à l'adresse : **http://127.0.0.1:8000**

---

## 🚀 Utilisation

### Accès à l'application

Une fois le serveur lancé, accédez à l'application via votre navigateur :

```
http://127.0.0.1:8000
```

### Navigation principale

| Section | URL | Description |
|---------|-----|-------------|
| 🏠 Accueil | `/` | Tableau de bord principal |
| 📁 Projets | `/projet` | Liste des projets actifs |
| ➕ Nouveau Projet | `/projet/new` | Créer un nouveau projet |
| 👁️ Consulter un Projet | `/projet/{id}` | Consulter un projet |
| ✏️ Éditer un Projet | `/projet/{id}/edit` | Éditer un projet |
| ➕ Nouvelle Tâche | `/tache/{id}/new/{statut}` | Créer une nouvelle tâche |
| ✏️ Consulter/Modifier une Tâche | `/tache/{id}` | Consulter ou modifier une tâche |
| 👥 Employés | `/employe` | Gestion des employés |
| ✏️ Modifier un Employé | `/employe/{id}` | Modification d'un employé |


### Workflow type

1. **Créer un projet** avec un titre
2. **Ajouter des membres** au projet
3. **Créer des tâches** associées au projet
4. **Assigner les tâches** aux membres de l'équipe
5. **Suivre l'avancement** via les statuts (To Do → Doing → Done)
6. **Archiver le projet** une fois terminé

---

## 📂 Structure du projet

```
P8_TaskLinder/
│
├── 📁 assets/                    # Assets frontend (JS, CSS)
│   ├── controllers/              # Contrôleurs Stimulus
│   └── styles/                   # Styles SCSS/CSS
│
├── 📁 config/                    # Configuration Symfony
│   ├── packages/                 # Configuration des bundles
│   └── routes/                   # Configuration des routes
│
├── 📁 migrations/                # Migrations Doctrine
│
├── 📁 public/                    # Fichiers publics
│   ├── css/                      # Styles CSS compilés
│   ├── img/                      # Images (logo, etc.)
│   └── js/                       # Scripts JavaScript
│
├── 📁 src/                       # Code source PHP
│   ├── Controller/               # Contrôleurs
│   │   ├── HomeController.php
│   │   ├── ProjetController.php
│   │   ├── TacheController.php
│   │   └── EmployeController.php
│   │
│   ├── Entity/                   # Entités Doctrine
│   │   ├── Projet.php
│   │   ├── Tache.php
│   │   ├── Employe.php
│   │   ├── StatutEmploye.php
│   │   └── StatusEnum.php
│   │
│   ├── Form/                     # Types de formulaires
│   │   ├── ProjetType.php
│   │   ├── TacheType.php
│   │   └── EmployeType.php
│   │
│   ├── Repository/               # Repositories Doctrine
│   │   ├── ProjetRepository.php
│   │   ├── TacheRepository.php
│   │   ├── EmployeRepository.php
│   │   └── StatutEmployeRepository.php
│   │
│   ├── DataFixtures/             # Données de test
│   │   └── AppFixtures.php
│   │
│   ├── Factory/                  # Factories Foundry
│   │   ├── ProjetFactory.php
│   │   ├── TacheFactory.php
│   │   └── EmployeFactory.php
│   │
│   └── Twig/                     # Extensions Twig
│       └── Extension/
│
├── 📁 templates/                 # Templates Twig
│   ├── base.html.twig            # Template de base
│   ├── components/               # Composants réutilisables
│   │   ├── _header.html.twig
│   │   └── _nav.html.twig
│   ├── home/                     # Pages d'accueil
│   ├── projet/                   # Pages projets
│   ├── tache/                    # Pages tâches
│   └── employe/                  # Pages employés
│
├── 📁 tests/                     # Tests unitaires et fonctionnels
│
├── 📁 var/                       # Cache et logs
│
├── 📁 vendor/                    # Dépendances Composer
│
├── 📄 .env                       # Variables d'environnement
├── 📄 composer.json              # Dépendances PHP
├── 📄 symfony.lock               # Lock Symfony
└── 📄 README.md                  # Ce fichier
```

---

## 🗄️ Modèle de données

### Diagramme des entités

```
┌─────────────────┐       ┌─────────────────┐       ┌─────────────────┐
│     Projet      │       │      Tache      │       │    Employe      │
├─────────────────┤       ├─────────────────┤       ├─────────────────┤
│ id              │       │ id              │       │ id              │
│ titre           │──────<│ titre           │>──────│ prenom          │
│ estArchive      │ 1   N │ description     │ N   1 │ nom             │
│                 │       │ deadline        │       │ email           │
│                 │       │ statut (Enum)   │       │ dateEntree      │
└────────┬────────┘       └─────────────────┘       └────────┬────────┘
         │                                                   │
         │ N                                                 │ N
         │                                                   │
         └───────────────────┬───────────────────────────────┘
                             │
                             │ M:N (membres)
                             │
                    ┌────────┴────────┐
                    │  projet_employe │
                    │  (table pivot)  │
                    └─────────────────┘

┌─────────────────┐
│  StatutEmploye  │
├─────────────────┤
│ id              │
│ libelle         │──────< Employe.statut
└─────────────────┘

┌─────────────────┐
│   StatusEnum    │
├─────────────────┤
│ Todo = "To Do"  │
│ Doing = "Doing" │──────< Tache.statut
│ Done = "Done"   │
└─────────────────┘
```

### Relations

| Relation | Type | Description |
|----------|------|-------------|
| Projet → Taches | OneToMany | Un projet contient plusieurs tâches |
| Projet ↔ Employes | ManyToMany | Un projet peut avoir plusieurs membres, un employé peut être sur plusieurs projets |
| Tache → Projet | ManyToOne | Une tâche appartient à un seul projet |
| Tache → Employe | ManyToOne | Une tâche peut être assignée à un employé |
| Employe → StatutEmploye | ManyToOne | Un employé a un statut (CDI, CDD, etc.) |

---

## 📝 Commandes utiles

```bash
# Vider le cache
symfony console cache:clear

# Créer une migration
symfony console make:migration

# Exécuter les migrations
symfony console doctrine:migrations:migrate

# Charger les fixtures
symfony console doctrine:fixtures:load

# Créer une entité
symfony console make:entity

# Créer un contrôleur
symfony console make:controller

# Créer un formulaire
symfony console make:form
```

---

## 👨‍💻 Auteur

**Véricel Grégory**

- Formation : OpenClassrooms - Concepteur Développeur d'Application PHP/Symfony
- Projet : P8 - TaskLinker

---

## 📄 Licence

Ce projet est développé dans le cadre de la formation OpenClassrooms. Tous droits réservés.

---

<p align="center">
  <img src="public/img/logo.png" alt="TaskLinker" width="100"/>
  <br>
  <em>TaskLinker - Gérez vos projets efficacement</em>
</p>
