# Checklist Atelier

## Fonctionnalités attendues

- [x] Affichage de la liste des items  
- [x] Page détail pour chaque item  
- [ ] Recherche simple par mot-clé et categorie + theme  
- [x] Interface admin sécurisée (login + session) 
- [x] CRUD complet sur les items
- [x] Upload image

## Base de données

- [x] Table `items` (structure complète)  
- [x] Table `tags` (catégories et thèmes)
  - [ ] Distinction par `type ENUM('categorie', 'theme', 'libre')` **ou** `parent_id`
- [ ] Table `items_tags` (relation many-to-many)  
- [ ] Clés primaires et étrangères définies + contraintes unicites et ON DELETE
- [ ] Script SQL complet et fonctionnel  
- [x] Connexion PDO centralisée et memoizee

## Frontend & Code

- [x] HTML sémantique : balises structurantes correctement utilisées  
- [ ] Accessibilité minimale assurée :
  - [x] Attributs `alt` sur les images  
  - [x] Titres hiérarchisés  
  - [ ] `label` associé à chaque champ de formulaire  
  - [x] Navigation clavier fonctionnelle  
- [x] CSS dans des fichiers externes uniquement
  - [ ] Aucun `<style>` ni `style=""` dans le HTML  
- [x] JavaScript non obstrusif
  - [x] Aucun événement inline (`onclick`, etc.)  
  - [x] Scripts déclenchés proprement après chargement  
- [ ] Mode sombre implémenté (CSS + JS) 
- [ ] DRY strictement respecté : aucun duplicat inutile dans le HTML ou le PHP
- [x] Separation of concern: respecter MVC

## Sécurité minimale

- [x] Authentification avec mot de passe hashé  
- [ ] Vérification de session sur toutes les pages admin  
- [ ] Requêtes SQL préparées (anti-injection)  
- [x] Aucune donnée sensible stockée en clair

## Organisation et qualité

- [x] Structure de fichiers claire et logique  
- [x] Code lisible, aéré, et commenté  
- [ ] Aucune répétition inutile : application stricte de DRY et CoC
- [ ] Présence d’un README avec instructions d’installation

## Validation finale

- [x] Toutes les fonctionnalités testées manuellement (CRUD, recherche)  
- [x] Affichage sans image fonctionne sans erreur  
- [x] Responsive testé sur mobile, tablette, et ordinateur  
- [x] Accessibilité clavier testée  
- [ ] Aucun message d’erreur en console navigateur ou PHP
- [ ] Tester dans 2 navigateurs