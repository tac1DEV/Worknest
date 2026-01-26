# 🏢 WorkNest – Plateforme SaaS de réservation d’espaces de coworking

## 🧭 Introduction

**WorkNest** est une plateforme **SaaS** dédiée à la **réservation d’espaces de coworking** (bureaux, salles de réunion, espaces créatifs) à destination des **particuliers** et des **entreprises**.

L’application permet de consulter les espaces disponibles, de filtrer selon différents critères, de réserver un créneau horaire, d’effectuer un paiement sécurisé et d’accéder à un tableau de bord utilisateur.  
De plus, un espace d’administration permet la gestion complète des lieux, des réservations et des utilisateurs.

---

## ⚙️ Fonctionnalités principales

### 🗂️ Catalogue des espaces

- Consultation des espaces de coworking disponibles  
- Filtres avancés :
  - capacité
  - équipements
  - prix
  - type d’espace  
- Accès au détail complet d’un espace

### 📅 Réservation

- Consultation du planning
- Sélection d’un créneau horaire  
- Création d’une réservation  

### 💳 Paiement

- Paiement sécurisé des réservations via l'intégration Stripe

### 👤 Tableau de bord utilisateur

- Historique des réservations  
- Accès aux factures  
- Gestion du profil utilisateur

### 🛠️ Administration

- Gestion des espaces (CRUD)

Un **seeder** est déjà présent dans le projet et permet de créer automatiquement un compte administrateur.

Une fois le projet installé et les seeders exécutés, vous pouvez vous connecter au **backoffice** avec les identifiants suivants :

- **Email** : `admin@mail.com`
- **Mot de passe** : `password`
---

## 🏗️ Architecture

### 🧩 Architecture générale

- Architecture **MVC**
- **Backend** : API REST
- **Base de données** : relationnelle (MySQL)
- Gestion des rôles :
  - Admin
  - Client

### 🎨 Front-End

- Interface **responsive**
- Technologies :
  - Blade (Moteur de template Laravel)
  - HTML / CSS / JavaScript (intégration Stripe)
  - TailwindCSS

### 🖥️ Back-End

- Laravel
- Livewire

---

## 🔐 Sécurité & conformité RGPD

- Règles d’accès strictes par rôle  
- Hashage des mots de passe  
- Tokens d’authentification  
- Logs de sécurité (laravel.log)
- Conformité RGPD :
  - base légale
  - durée de conservation
  - droits utilisateurs (accès, modification, suppression)

---

## 🗄️ Base de données

- Tables principales :
  - utilisateurs
  - espaces
  - schedules

---

## 🧪 Tests & audit

### Plan de recettage – Features WorkNest

#### 1. Consultation & catalogue des espaces

**Objectif :** Vérifier l’accès et l’affichage des espaces disponibles.

- Affichage de la liste des espaces
- N'affiche pas les espaces indisponibles
- Affichage du nom, capacité, prix et équipements
- Filtrage par capacité
- Filtrage par équipements
- Filtrage par prix

---

#### 2. Détail d’un espace

**Objectif :** Vérifier la consultation d’un espace individuel.

- Accès à la page détail d’un espace existant pour un utilisateur connecté
- Redirection d'un utilisateur anonyme voulant consulter l'espace
- Affichage des informations complètes de l’espace
- Affichage du planning de disponibilité
- Gestion d’un identifiant d’espace inexistant (erreur 404)
- Accès refusé sans authentification

---

#### 3. Réservation d’un espace

**Objectif :** Garantir le bon fonctionnement du processus de réservation.

- Création d’une réservation valide
- Refus de réservation sur un créneau déjà réservé
- Validation des dates et horaires (format, ordre, dates futures)
- Association correcte de la réservation à l’utilisateur connecté
- Gestion des erreurs en cas de données manquantes ou invalides

---

#### 4. Paiement

**Objectif :** Vérifier la gestion du paiement des réservations.

- Déclenchement du paiement après la réservation
- Confirmation de la réservation après paiement accepté
- Annulation ou mise en attente après paiement refusé
- Correspondance entre montant payé et prix affiché
- Gestion des erreurs du service de paiement

---

#### 5. Authentification & gestion des rôles

**Objectif :** Sécuriser l’accès à la plateforme.

- Inscription d’un utilisateur
- Connexion avec identifiants valides
- Refus de connexion avec identifiants invalides
- Attribution correcte des rôles (admin, entreprise, client)
- Restriction d’accès aux fonctionnalités selon le rôle

---

#### 6. Tableau de bord utilisateur

**Objectif :** Vérifier l’espace personnel utilisateur.

- Affichage de l’historique des réservations
- Consultation des factures
- Accès limité aux données de l’utilisateur connecté
- Affichage correct lorsqu’aucune réservation n’existe

---

#### 7. Gestion du profil utilisateur

**Objectif :** Permettre la gestion des informations personnelles.

- Consultation du profil utilisateur
- Modification des informations personnelles

---

#### 8. Administration des espaces (Admin)

**Objectif :** Vérifier la gestion des espaces côté administrateur.

- Création d’un espace
- Modification d’un espace
- Suppression d’un espace
- Accès interdit aux utilisateurs non-admin

---

### Anomalies détectées & Correctifs envisagés

#### Paiement

- Annulation après paiement refusé
- Gestion des erreurs du service de paiementeee

#### Réservation / Planning

- Refus d’un créneau déjà réservé
- Validation des dates et horaires

Ces fonctionnalités ne sont pas encore implémentées, mais elles pourront être proposées comme tickets pour un développement futur.

---

## 🐳 Environnement & déploiement

### 🚀 Prérequis

Avant de commencer, assurez-vous d’avoir installé :

* [Docker](https://www.docker.com/)
* [Composer](https://getcomposer.org/)
* [PHP](https://www.php.net/)

---
1. **Cloner le projet**

```bash
git clone https://github.com/tac1DEV/Worknest.git
cd Worknest
```

2. **Installer les dépendances**

```bash
composer install
```

3. **Installer Laravel Sail**

```bash
composer require laravel/sail --dev
cp .env.example .env
php artisan sail:install
```
> Choisir mysql
> Modifier les variable stripe par des valides

4. **Lancer les containers Docker**

```bash
./vendor/bin/sail up -d
```

5. **Configurer l’environnement**

```bash
./vendor/bin/sail artisan key:generate
```

> Modifiez `.env` si nécessaire (base de données, stripe, ports…).

6. **Exécuter les migrations et seeders**

```bash
./vendor/bin/sail artisan migrate --seed
```

7. **Installer les packages et lancer l'application**

```bash
npm i
npm run dev
```

7. **Accéder à l’application**
   Ouvrez votre navigateur :

```
http://localhost:80
```

---

## 📦 Structure du projet

* `/app` : Contient le code principal de l’application
* `/database` : Migrations et seeders
* `/routes` : Définition des routes
* `/resources/views` : Templates Blade

---

## 🔧 Commandes utiles

* Lancer les tests:

```bash
./vendor/bin/sail artisan test
```

* Arrêter les containers :

```bash
./vendor/bin/sail down
```

* Voir l’état des containers :

```bash
./vendor/bin/sail ps
```

---
