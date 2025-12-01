# 📇 Système de Gestion de Contacts

<p align="center">
  Une application moderne et full-stack de gestion des contacts, construite avec Laravel 12, intégrant l’authentification JWT, une API RESTful et une belle interface web responsive.
</p>

---

## ✨ Fonctionnalités

### 🔐 Authentification
- ✅ Inscription et connexion des utilisateurs
- ✅ Authentification basée sur les tokens JWT
- ✅ Intégration Laravel Sanctum
- ✅ Hachage sécurisé des mots de passe (bcrypt)
- ✅ Mécanisme de rafraîchissement des tokens
- ✅ Fonctionnalité de déconnexion

### 📇 Gestion des Contacts
- ✅ **Créer** des contacts avec nom, email, téléphone, adresse et notes
- ✅ **Lire** tous les contacts ou les détails d’un contact spécifique
- ✅ **Mettre à jour** les informations d’un contact
- ✅ **Supprimer** des contacts avec confirmation
- ✅ Isolation des données par utilisateur (les utilisateurs ne voient que leurs contacts)

### 🎨 Belle Interface Web
- ✅ Design moderne avec dégradé violet
- ✅ Animations et transitions fluides
- ✅ Affichage des contacts sous forme de cartes
- ✅ Mises à jour en temps réel

### 🔧 Fonctionnalités pour Développeurs
- ✅ API RESTful avec documentation complète
- ✅ Tests automatisés (8 tests réussis)
- ✅ Page de test de l’API pour le débogage
- ✅ Collection Postman incluse

---

## 🚀 Démarrage Rapide

### Prérequis
- PHP 8.2 ou supérieur
- Composer
- MySQL ou SQLite

### Installation

1. **Cloner le dépôt**
   git clone https://github.com/rjabwaad/contact-management-system_laravel.git
   cd contact-management-system_laravel

2. **Installer les dépendances**


   composer install


3. **Configurer l’environnement**


   php artisan key:generate
   php artisan jwt:secret

4. **Configurer la base de données**

   Modifier le fichier `.env` avec vos identifiants :


   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nom_de_votre_base
   DB_USERNAME=votre_utilisateur
   DB_PASSWORD=votre_mot_de_passe


5. **Exécuter les migrations**


   php artisan migrate

6. **Démarrer le serveur**


   php artisan serve


7. **Ouvrir dans le navigateur**


   http://localhost:8000

🎉 **C’est prêt !** Vous pouvez maintenant créer un compte et gérer vos contacts.


## 🎯 Utilisation

### Interface Web

1. **Inscription** : Aller sur `http://localhost:8000` et créer un compte
2. **Connexion** : Utiliser vos identifiants pour vous connecter
3. **Ajouter des contacts** : Cliquer sur "Ajouter un nouveau contact" et remplir les informations
4. **Gérer** : Modifier ou supprimer les contacts via les boutons sur chaque carte
5. **Déconnexion** : Cliquer sur le bouton de déconnexion

### Endpoints API

#### Authentification

* `POST /api/register` - Inscrire un nouvel utilisateur
* `POST /api/login` - Se connecter et obtenir un token JWT
* `POST /api/logout` - Déconnexion (requiert authentification)
* `POST /api/refresh` - Rafraîchir le token JWT (requiert authentification)
* `GET /api/me` - Obtenir l’utilisateur courant (requiert authentification)

#### Contacts (tous nécessitent authentification)

* `GET /api/contacts` - Obtenir tous les contacts de l’utilisateur
* `POST /api/contacts` - Créer un nouveau contact
* `GET /api/contacts/{id}` - Obtenir un contact spécifique
* `PUT /api/contacts/{id}` - Mettre à jour un contact
* `DELETE /api/contacts/{id}` - Supprimer un contact

### Exemple API

Parfait ! Pour **Postman**, tu n’as pas besoin de `curl` : tu vas configurer chaque requête dans l’interface. Voici comment traduire tes trois commandes `curl` en étapes Postman :


### 1️⃣ Inscription (Register)

* **Méthode HTTP** : `POST`
* **URL** : `http://localhost:8000/api/register`
* **Headers** :

  * `Content-Type` : `application/json`
* **Body** → `raw` → JSON :

{
  "name": "example",
  "email": "example@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}


### 2️⃣ Connexion (Login)

* **Méthode HTTP** : `POST`
* **URL** : `http://localhost:8000/api/login`
* **Headers** :

  * `Content-Type` : `application/json`
* **Body** → `raw` → JSON :

{
  "email": "example@example.com",
  "password": "password123"
}


* **Remarque** : Après la connexion, Postman te renverra un token JWT dans la réponse. Copie-le pour l’utiliser dans la requête suivante.


### 3️⃣ Créer un contact (Create Contact)

* **Méthode HTTP** : `POST`
* **URL** : `http://localhost:8000/api/contacts`
* **Headers** :

  * `Content-Type` : `application/json`
  * `Authorization` : `Bearer VOTRE_TOKEN_ICI` (remplace `VOTRE_TOKEN_ICI` par le token obtenu à l’étape précédente)
* **Body** → `raw` → JSON :

{
  "name": "example",
  "email": "example@example.com",
  "phone": "+1234567890",
"address": "fffff",
"notes":"rrrr"
}



## 🧪 Tests

Exécuter la suite de tests automatisés :


php artisan test

Ou tester des fonctionnalités spécifiques :


php artisan test --filter ContactApiTest


Tous les 8 tests doivent passer ! ✅



## 📁 Structure du Projet

```
├── app/
│   ├── Http/Controllers/Api/
│   │   ├── AuthController.php
│   │   └── ContactController.php
│   └── Models/
│       ├── User.php
│       └── Contact.php
├── database/
│   ├── migrations/
│   └── factories/
├── public/
│   ├── index.html
│   ├── contacts.html
│   └── test-api.html
├── routes/
│   ├── api.php
│   └── web.php
└── tests/
    └── Feature/
        └── ContactApiTest.php
```

---

## 🔐 Sécurité

* ✅ Tokens JWT pour une authentification sans état
* ✅ Hachage des mots de passe avec bcrypt
* ✅ Routes API protégées
* ✅ Isolation des données par utilisateur
* ✅ CORS configuré
* ✅ Validation des entrées sur tous les endpoints
* ✅ Protection CSRF pour les routes Web


## 🛠️ Technologies

* **Backend** : Laravel 12
* **Authentification** : JWT (tymon/jwt-auth) + Laravel Sanctum
* **Base de données** : MySQL / SQLite
* **Frontend** : HTML5, CSS3, JavaScript (Vanilla)
* **Tests** : Pest PHP
* **API** : RESTful JSON API


## 📊 Schéma de Base de Données

### Table Users

* `id` - Clé primaire
* `name` - Nom complet
* `email` - Email unique
* `password` - Mot de passe haché
* `timestamps`

### Table Contacts

* `id` - Clé primaire
* `user_id` - Clé étrangère vers users
* `name` - Nom du contact (obligatoire)
* `email` - Email (optionnel)
* `phone` - Téléphone (optionnel)
* `address` - Adresse (optionnel)
* `notes` - Notes (optionnel)
* `timestamps`
