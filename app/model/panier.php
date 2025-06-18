<?php

// =============================
// Récupérer tous les items du panier (CORRIGÉ)
function panier_getItems($cart_id)
{
    $sql = "SELECT c.*, i.nom, i.prix, i.prix_promo, i.image_url, i.slug
            FROM collection c
            JOIN item i ON c.product_id = i.id_item
            WHERE c.cart_id = ? AND c.cart_status = 'active'
            ORDER BY c.date_added DESC";
    
    $stmt = db()->prepare($sql);
    $stmt->execute([$cart_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// =============================
// Ajouter un item au panier (CORRIGÉ)
function panier_addItem($cart_id, $item_id, $quantity = 1, $unit_price = 0)
{
    // Vérifier si l'item existe déjà dans le panier
    $existing = panier_getExistingItem($cart_id, $item_id);
    
    if ($existing) {
        // Mettre à jour la quantité
        $new_quantity = $existing['quantity'] + $quantity;
        return panier_updateQuantity($existing['cart_line_id'], $new_quantity);
    } else {
        // Ajouter un nouvel item
        $subtotal = $unit_price * $quantity;
        
        $sql = "INSERT INTO collection (cart_id, product_id, quantity, unit_price, subtotal, date_added, cart_status)
                VALUES (?, ?, ?, ?, ?, NOW(), 'active')";
        
        $stmt = db()->prepare($sql);
        return $stmt->execute([$cart_id, $item_id, $quantity, $unit_price, $subtotal]);
    }
}

// =============================
// Vérifier si un item existe déjà dans le panier (CORRIGÉ)
function panier_getExistingItem($cart_id, $item_id)
{
    $sql = "SELECT * FROM collection 
            WHERE cart_id = ? AND product_id = ? AND cart_status = 'active'";
    
    $stmt = db()->prepare($sql);
    $stmt->execute([$cart_id, $item_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// =============================
// Compter le nombre d'items dans le panier (CORRIGÉ)
function panier_getItemCount($cart_id)
{
    $sql = "SELECT SUM(quantity) as count 
            FROM collection 
            WHERE cart_id = ? AND cart_status = 'active'";
    
    $stmt = db()->prepare($sql);
    $stmt->execute([$cart_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return (int)($result['count'] ?: 0);
}

// =============================
// Calculer le total du panier (CORRIGÉ)
function panier_getTotal($cart_id)
{
    $sql = "SELECT SUM(subtotal) as total 
            FROM collection 
            WHERE cart_id = ? AND cart_status = 'active'";
    
    $stmt = db()->prepare($sql);
    $stmt->execute([$cart_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return (float)($result['total'] ?: 0);
}

// =============================
// Mettre à jour la quantité d'un item (CORRIGÉ)
function panier_updateQuantity($cart_line_id, $quantity)
{
    // Récupérer le prix unitaire
    $sql = "SELECT unit_price FROM collection WHERE cart_line_id = ?";
    $stmt = db()->prepare($sql);
    $stmt->execute([$cart_line_id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($item) {
        $subtotal = $item['unit_price'] * $quantity;
        
        $sql = "UPDATE collection 
                SET quantity = ?, subtotal = ? 
                WHERE cart_line_id = ?";
        
        $stmt = db()->prepare($sql);
        return $stmt->execute([$quantity, $subtotal, $cart_line_id]);
    }
    
    return false;
}

// =============================
// Supprimer un item du panier
function panier_removeItem($cart_line_id)
{
    $sql = "DELETE FROM collection WHERE cart_line_id = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([$cart_line_id]);
}

// =============================
// Vider complètement le panier
function panier_clear($cart_id)
{
    $sql = "DELETE FROM collection WHERE cart_id = ? AND cart_status = 'active'";
    $stmt = db()->prepare($sql);
    return $stmt->execute([$cart_id]);
}

// =============================
// Marquer le panier comme commandé
function panier_markAsOrdered($cart_id)
{
    $sql = "UPDATE collection 
            SET cart_status = 'ordered' 
            WHERE cart_id = ? AND cart_status = 'active'";
    
    $stmt = db()->prepare($sql);
    return $stmt->execute([$cart_id]);
}