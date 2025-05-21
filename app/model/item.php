<?php

// Récupère tous les items
function item_getAll()
{
    $sql = "SELECT * FROM item ORDER BY date_ajout DESC";
    $stmt = db()->query($sql);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

// Récupère un item par son ID
function item_getById($id)
{
    $sql = "SELECT * FROM item WHERE id_item = ?";
    $stmt = db()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Crée un nouvel item
function item_create($data)
{
    $sql = "INSERT INTO item (slug, nom, description, prix, prix_promo, quantite_stock, categorie_id, image_url, statut, poids)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = db()->prepare($sql);
    return $stmt->execute([
        $data['slug'],
        $data['nom'],
        $data['description'],
        $data['prix'],
        $data['prix_promo'],
        $data['quantite_stock'],
        $data['categorie_id'],
        $data['image_url'],
        $data['statut'],
        $data['poids']
    ]);
}

// Met à jour un item existant
function item_update($id, $data)
{
    $sql = "UPDATE item SET slug = ?, nom = ?, description = ?, prix = ?, prix_promo = ?, quantite_stock = ?, categorie_id = ?, image_url = ?, statut = ?, poids = ? WHERE id_item = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([
        $data['slug'],
        $data['nom'],
        $data['description'],
        $data['prix'],
        $data['prix_promo'],
        $data['quantite_stock'],
        $data['categorie_id'],
        $data['image_url'],
        $data['statut'],
        $data['poids'],
        $id
    ]);
}

// Supprime un item
function item_delete($id)
{
    $sql = "DELETE FROM item WHERE id_item = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([$id]);
}
