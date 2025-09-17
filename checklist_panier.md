# 🛒 Check-list Panier d'Achat - Seedarrt

## 📊 État actuel
- [x] Architecture MVC en place
- [x] Contrôleur panier (`app/controller/public/panier.php`) ✅ COMPLET
- [x] Modèle panier (`app/model/panier.php`) ✅ COMPLET  
- [x] Table BDD `collection` ✅ FONCTIONNELLE
- [x] CSS panier (`public/css/styles_panier.css`) ✅ ÉCRIT
- [ ] Vue panier (`app/view/public/panier/panier.php`) ⚠️ **VIDE**
- [ ] Boutons "Ajouter au panier" sur les pages produits
- [ ] Badge panier dans navbar
- [ ] Page checkout fonctionnelle

---

## 🎯 PHASE 1 : PANIER DE BASE (CRITIQUE)
*Objectif : Avoir un panier qui fonctionne*

### ✅ 1.1 Créer la vue panier principale
**Fichier :** `app/view/public/panier/panier.php` (actuellement VIDE)

- [ ] Copier le contenu du CSS `styles_panier.css` pour comprendre la structure HTML attendue
- [ ] Créer la section hero avec titre "Mon Panier"
- [ ] Afficher la liste des articles du panier (`$data['cart_items']`)
- [ ] Pour chaque article :
  - [ ] Image produit
  - [ ] Nom et lien vers détail
  - [ ] Prix unitaire (avec promo si applicable)
  - [ ] Formulaire quantité avec boutons +/-
  - [ ] Bouton supprimer
  - [ ] Sous-total ligne
- [ ] Afficher le panier vide si `empty($data['cart_items'])`
- [ ] Section récapitulatif avec total général
- [ ] Boutons "Vider panier" et "Finaliser commande"

### ✅ 1.2 Ajouter boutons "Ajouter au panier" - Page Catalogue
**Fichier :** `app/view/public/catalogue/catalogue.php` (lignes 46-70)

Dans la boucle `foreach($data['items'] as $item)` :
- [ ] Ajouter formulaire après `<div class="art-price">` (ligne ~69)
- [ ] Form avec method="POST" action="/panier/add"
- [ ] Input hidden pour `item_id` 
- [ ] Input number pour quantité (défaut: 1)
- [ ] Button submit "Ajouter au panier"
- [ ] Vérifier si stock > 0 avant d'afficher le bouton

### ✅ 1.3 Ajouter formulaire "Ajouter au panier" - Page Détail  
**Fichier :** `app/view/public/detail/detail.php` (après ligne 28)

Après `<div class="artwork-price">` :
- [ ] Formulaire plus complet avec sélection quantité
- [ ] Affichage du stock disponible
- [ ] Bouton désactivé si rupture de stock
- [ ] Style cohérent avec la page

### ✅ 1.4 Connecter le CSS panier
**Fichier :** `app/controller/public/panier.php` (ligne 15)

Vérifier que `$pageCss = 'styles_panier.css';` est bien passé :
- [ ] Contrôler que le CSS est chargé dans la vue panier
- [ ] Tester l'affichage responsive

### ✅ 1.5 Test complet du flow de base
- [ ] Ajouter un article depuis le catalogue
- [ ] Vérifier redirection vers `/panier` 
- [ ] Modifier quantité dans le panier
- [ ] Supprimer un article
- [ ] Vider le panier complètement

---

## 🚀 PHASE 2 : EXPÉRIENCE UTILISATEUR

### ✅ 2.1 Badge panier dans la navbar
**Fichier :** `app/view/public/skeleton.html` (lignes 12-34)

Dans la navbar, après les liens de navigation :
- [ ] Ajouter lien vers `/panier` avec icône 🛒
- [ ] Badge avec nombre d'articles (utiliser `/panier/cart_count` API)
- [ ] Style cohérent avec la navbar existante

### ✅ 2.2 JavaScript panier dynamique
**Nouveau fichier :** `public/js/panier.js`

- [ ] Fonction ajout panier sans rechargement (AJAX)
- [ ] Mise à jour badge panier en temps réel
- [ ] Notifications toast pour confirmations
- [ ] Gestion erreurs (stock insuffisant, etc.)
- [ ] Animation badge quand ajout

### ✅ 2.3 Messages de feedback améliorés
**Fichier :** `app/view/public/panier/panier.php`

- [ ] Afficher `$_SESSION['cart_message']` en vert
- [ ] Afficher `$_SESSION['cart_error']` en rouge  
- [ ] Auto-suppression des messages après affichage
- [ ] Style cohérent avec le design existant

---

## 💳 PHASE 3 : PROCESSUS DE COMMANDE

### ✅ 3.1 Page checkout
**Fichier :** `app/view/public/panier/checkout.php` (existe mais à vérifier)

- [ ] Récapitulatif commande (items + total)
- [ ] Formulaire informations client :
  - [ ] Nom, prénom, email, téléphone
  - [ ] Adresse de livraison complète
  - [ ] Instructions spéciales (optionnel)
- [ ] Calcul frais de livraison (fixe pour commencer)
- [ ] Total final
- [ ] Bouton "Confirmer la commande"

### ✅ 3.2 Traitement des commandes
**Nouveau :** Table BDD `commande`

```sql
CREATE TABLE commande (
  id_commande INT AUTO_INCREMENT PRIMARY KEY,
  cart_id VARCHAR(50),
  nom VARCHAR(100),
  prenom VARCHAR(100), 
  email VARCHAR(150),
  telephone VARCHAR(20),
  adresse_livraison TEXT,
  total DECIMAL(10,2),
  statut ENUM('en_cours', 'confirmee', 'expediee', 'livree'),
  date_commande DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

- [ ] Créer la table en BDD
- [ ] Implémenter `process_order()` dans controller
- [ ] Sauvegarder commande en BDD
- [ ] Marquer panier comme "ordered"
- [ ] Redirection vers confirmation

### ✅ 3.3 Page confirmation
**Fichier :** `app/view/public/panier/confirmation.php` (existe déjà)

- [ ] Message de confirmation
- [ ] Récapitulatif de la commande
- [ ] Informations de suivi/contact
- [ ] Lien retour catalogue

### ✅ 3.4 Email de confirmation (bonus)
- [ ] Template email HTML simple
- [ ] Envoi auto après commande validée  
- [ ] Récapitulatif commande dans email

---

## 🔧 PHASE 4 : OPTIMISATIONS

### ✅ 4.1 Gestion du stock
**Fichier :** `app/model/item.php`

- [ ] Fonction `verifier_stock($item_id, $quantite)`
- [ ] Bloquer ajout panier si stock insuffisant
- [ ] Décrémenter stock après commande validée
- [ ] Alertes stock faible dans admin

### ✅ 4.2 Validation et sécurité
- [ ] Validation quantités (min: 1, max: stock)
- [ ] Vérification existence produit avant ajout
- [ ] Nettoyage paniers abandonnés (>30 jours)
- [ ] Protection contre manipulation prix

### ✅ 4.3 Performance
- [ ] Cache calcul total panier
- [ ] Index BDD sur cart_id et product_id
- [ ] Optimisation requêtes N+1

---

## 📱 PHASE 5 : RESPONSIVE & FINITIONS

### ✅ 5.1 Mobile-first
- [ ] Panier responsive sur mobile
- [ ] Badge panier dans menu hamburger
- [ ] Checkout adapté mobile
- [ ] Test tablette

### ✅ 5.2 Tests finaux
- [ ] Parcours complet desktop
- [ ] Parcours complet mobile  
- [ ] Test avec plusieurs articles
- [ ] Test rupture de stock
- [ ] Test panier vide
- [ ] Compatibilité navigateurs (Chrome, Firefox, Safari)

---

## 🚨 POINTS D'ATTENTION

### Fichiers critiques à ne pas casser :
- `app/controller/public/panier.php` ✅ **DÉJÀ PARFAIT**
- `app/model/panier.php` ✅ **DÉJÀ PARFAIT** 
- `public/css/styles_panier.css` ✅ **DÉJÀ ÉCRIT**

### Architecture à respecter :
- [x] Utiliser sessions pour panier anonyme (déjà fait)
- [x] Passer par controller pour toutes actions (déjà fait)
- [x] Utiliser template engine pour vues (déjà fait)
- [x] CSS externe uniquement (déjà fait)

---

## 🎯 PROCHAINE ACTION IMMÉDIATE

**COMMENCER PAR :** Phase 1.1 - Créer la vue panier

Le fichier `app/view/public/panier/panier.php` est actuellement **VIDE**.
C'est le goulot d'étranglement qui bloque tout le reste !

Une fois cette vue créée, le panier sera immédiatement fonctionnel car tout le backend existe déjà. 🚀

---

## 📝 Notes de développement

- **Pas besoin de comptes utilisateurs** : Le système session fonctionne très bien
- **Checkout invité** : Demander juste infos livraison sans création compte
- **Réutiliser l'existant** : 70% du code est déjà écrit et fonctionnel !
- **Tester régulièrement** : Après chaque phase, vérifier que tout fonctionne