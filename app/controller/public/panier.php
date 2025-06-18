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
        $quantity = (int)($_POST['quantity'] ?? 1);
        
        if ($item_id && $quantity > 0) {
            $cart_id = getCartId();
            $item = item_getById($item_id);
            
            if ($item) {
                $price = $item['prix_promo'] ?: $item['prix'];
                $success = panier_addItem($cart_id, $item_id, $quantity, $price);
                
                if ($success) {
                    // Redirection avec message de succès
                    $_SESSION['cart_message'] = "Article ajouté au panier avec succès !";
                    header('Location: /panier');
                    exit;
                } else {
                    $_SESSION['cart_error'] = "Erreur lors de l'ajout au panier.";
                }
            } else {
                $_SESSION['cart_error'] = "Article non trouvé.";
            }
        } else {
            $_SESSION['cart_error'] = "Données invalides.";
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
        $quantity = (int)($_POST['quantity'] ?? 1);
        
        if ($cart_line_id && $quantity > 0) {
            $success = panier_updateQuantity($cart_line_id, $quantity);
            if ($success) {
                $_SESSION['cart_message'] = "Quantité mise à jour.";
            } else {
                $_SESSION['cart_error'] = "Erreur lors de la mise à jour.";
            }
        } else {
            $_SESSION['cart_error'] = "Données invalides.";
        }
    }
    
    header('Location: /panier');
    exit;
}

// =============================
// Supprimer un item du panier
function remove($cart_line_id = null)
{
    if (!$cart_line_id && isset($_POST['cart_line_id'])) {
        $cart_line_id = $_POST['cart_line_id'];
    }
    
    if ($cart_line_id) {
        $success = panier_removeItem($cart_line_id);
        if ($success) {
            $_SESSION['cart_message'] = "Article supprimé du panier.";
        } else {
            $_SESSION['cart_error'] = "Erreur lors de la suppression.";
        }
    }
    
    header('Location: /panier');
    exit;
}

// =============================
// Vider le panier
function clear()
{
    $cart_id = getCartId();
    $success = panier_clear($cart_id);
    
    if ($success) {
        $_SESSION['cart_message'] = "Panier vidé.";
    } else {
        $_SESSION['cart_error'] = "Erreur lors du vidage du panier.";
    }
    
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
        $_SESSION['cart_error'] = "Votre panier est vide.";
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
            $_SESSION['cart_error'] = "Votre panier est vide.";
            header('Location: /panier');
            exit;
        }
        
        // Traitement de la commande (à implémenter selon vos besoins)
        // Par exemple : enregistrer la commande, envoyer un email, etc.
        
        // Marquer le panier comme commandé
        $success = panier_markAsOrdered($cart_id);
        
        if ($success) {
            // Créer un nouveau cart_id pour les futurs achats
            unset($_SESSION['cart_id']);
            $_SESSION['order_success'] = "Votre commande a été traitée avec succès !";
            header('Location: /panier/confirmation');
            exit;
        } else {
            $_SESSION['cart_error'] = "Erreur lors du traitement de la commande.";
        }
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
// API pour récupérer le nombre d'items dans le panier (AJAX) - CORRIGÉ
function cart_count()
{
    // Démarrer la session si ce n'est pas fait
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    header('Content-Type: application/json');
    header('Cache-Control: no-cache, must-revalidate');
    
    try {
        $cart_id = getCartId();
        $item_count = panier_getItemCount($cart_id);
        
        echo json_encode([
            'success' => true,
            'count' => $item_count
        ]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => 'Erreur lors du calcul du panier',
            'message' => $e->getMessage()
        ]);
    }
    exit;
}
