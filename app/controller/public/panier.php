<?php

require_once __DIR__ . '/../../model/panier.php';
require_once __DIR__ . '/../../model/item.php';

// =============================
// Afficher le panier
function panier()
{
    $cart_id = getCartId();
    $cart_items = panier_getItems($cart_id);
    $total = panier_getTotal($cart_id);
    
    $pageCss = 'styles_panier.css';
    
    render('panier/panier.php', [
        'cart_items' => $cart_items,
        'total' => $total,
        'cart_count' => count($cart_items),
        'head_title' => 'Mon Panier | Seedarrt',
        'pageCss' => $pageCss
    ]);
}

// =============================
// Ajouter un item au panier
function add()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $item_id = $_POST['item_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;
        
        if ($item_id) {
            $cart_id = getCartId();
            $item = item_getById($item_id);
            
            if ($item) {
                $price = $item['prix_promo'] ?: $item['prix'];
                panier_addItem($cart_id, $item_id, $quantity, $price);
                
                // Redirection vers le panier
                header('Location: /panier');
                exit;
            }
        }
    }
    
    // Si erreur, redirection vers catalogue
    header('Location: /catalogue');
    exit;
}

// =============================
// Mettre à jour la quantité
function update()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cart_line_id = $_POST['cart_line_id'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;
        
        if ($cart_line_id && $quantity > 0) {
            panier_updateQuantity($cart_line_id, $quantity);
        }
    }
    
    header('Location: /panier');
    exit;
}

// =============================
// Supprimer un item du panier
function remove($cart_line_id = null)
{
    if ($cart_line_id) {
        panier_removeItem($cart_line_id);
    }
    
    header('Location: /panier');
    exit;
}

// =============================
// Vider le panier
function clear()
{
    $cart_id = getCartId();
    panier_clear($cart_id);
    
    header('Location: /panier');
    exit;
}

// =============================
// Page de checkout
function checkout()
{
    $cart_id = getCartId();
    $cart_items = panier_getItems($cart_id);
    $total = panier_getTotal($cart_id);
    
    if (empty($cart_items)) {
        header('Location: /panier');
        exit;
    }
    
    $pageCss = 'styles_checkout.css';
    
    render('panier/checkout.php', [
        'cart_items' => $cart_items,
        'total' => $total,
        'head_title' => 'Finaliser ma commande | Seedarrt',
        'pageCss' => $pageCss
    ]);
}

// =============================
// Traitement de la commande
function process_order()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $cart_id = getCartId();
        $cart_items = panier_getItems($cart_id);
        
        if (empty($cart_items)) {
            header('Location: /panier');
            exit;
        }
        
        // Traitement de la commande (à implémenter selon vos besoins)
        // Par exemple : enregistrer la commande, envoyer un email, etc.
        
        // Marquer le panier comme commandé
        panier_markAsOrdered($cart_id);
        
        // Redirection vers page de confirmation
        header('Location: /panier/confirmation');
        exit;
    }
    
    header('Location: /panier/checkout');
    exit;
}

// =============================
// Page de confirmation
function confirmation()
{
    $pageCss = 'styles_confirmation.css';
    
    render('panier/confirmation.php', [
        'head_title' => 'Commande confirmée | Seedarrt',
        'pageCss' => $pageCss
    ]);
}

// =============================
// Fonction utilitaire pour gérer l'ID du panier
function getCartId()
{
    if (!isset($_SESSION['cart_id'])) {
        $_SESSION['cart_id'] = 'cart_' . uniqid() . '_' . time();
    }
    return $_SESSION['cart_id'];
}

// =============================
// API pour récupérer le nombre d'items dans le panier (AJAX)
function count()
{
    header('Content-Type: application/json');
    
    $cart_id = getCartId();
    $count = panier_getItemCount($cart_id);
    
    echo json_encode(['count' => $count]);
    exit;
}