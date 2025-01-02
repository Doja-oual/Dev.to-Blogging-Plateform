# Dev.to Platform  

## **Description du projet**  
La plateforme Dev.to est un système complet de gestion de contenu permettant aux développeurs de :  
- Partager des articles.  
- Explorer du contenu pertinent.  
- Collaborer efficacement dans une communauté technologique.  

Elle comprend deux principales parties :  
- **Front Office** : Une interface utilisateur fluide pour la navigation et la gestion des articles.  
- **Back Office** : Un tableau de bord puissant pour les administrateurs permettant la gestion des utilisateurs, des catégories, des tags et des articles.  

---

## **Fonctionnalités principales**  

### **Partie Back Office (Administrateurs)**  
- **Gestion des catégories** :  
  - Création, modification et suppression des catégories.  
  - Association de plusieurs articles à une catégorie.  
  - Visualisation des statistiques via des graphiques.  
- **Gestion des tags** :  
  - Création, modification et suppression des tags.  
  - Association des tags aux articles.  
  - Visualisation des statistiques des tags sous forme de graphiques.  
- **Gestion des utilisateurs** :  
  - Consultation et gestion des profils utilisateurs.  
  - Attribution de permissions pour devenir auteur.  
  - Suspension ou suppression d’utilisateurs.  
- **Gestion des articles** :  
  - Consultation, acceptation ou refus des articles soumis.  
  - Archivage des articles inappropriés.  
  - Consultation des articles les plus lus.  
- **Tableau de bord** :  
  - Affichage détaillé des entités (utilisateurs, articles, catégories, tags).  
  - Graphiques interactifs sur les meilleures catégories et tags.  

### **Partie Front Office (Utilisateurs)**  
- **Inscription et connexion** :  
  - Création d’un compte utilisateur sécurisé.  
  - Connexion selon le rôle (admin ou utilisateur).  
- **Navigation et recherche** :  
  - Recherche interactive d’articles, de catégories ou de tags.  
- **Espace auteur** :  
  - Création, modification et suppression d’articles.  
  - Gestion des articles depuis un tableau de bord personnel.  

---

## **Technologies utilisées**  
- **Langage** : PHP 8 (Programmation orientée objet)  
- **Base de données** : MySQL avec PDO  
- **CSS Framework** : Responsive design avec un framework CSS au choix  
- **Graphiques** : Chart.js pour les visualisations interactives  
- **Version Control** : Git et GitHub  

---

## **Architecture du projet**  
Le projet suit une architecture **MVC** (Modèle-Vue-Contrôleur) pour une organisation claire et maintenable :  
- **Modèle (Models)** : Contient la logique métier et les interactions avec la base de données.  
- **Vue (Views)** : Gère l'affichage des interfaces utilisateur.  
- **Contrôleur (Controllers)** : Contient la logique de traitement des requêtes et des réponses.  
- **Routes** : Implémentation avec un routage basé sur `switch-case`.  

---

## **Installation**  

### **Prérequis**  
- Serveur local (ex. : XAMPP, WAMP, ou Laragon).  
- PHP 8 ou version ultérieure.  
- MySQL ou MariaDB.  
- Composer (si vous utilisez des bibliothèques PHP supplémentaires).  

### **Étapes d'installation**  
1. **Cloner le repository GitHub** :  
   ```bash
   git clone https://github.com/Doja-oual/Dev.to-Blogging-Plateform.gitdev-to-platform.git
   cd dev-to-platform
