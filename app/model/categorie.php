<?php
// app/model/categorie.php

// Récupère toutes les catégories
function model_categorie_getAll()
{
    $sql = "SELECT * FROM categorie WHERE visible = 1 ORDER BY ordre, nom";
    $stmt = db()->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère toutes les catégories (même non visibles) pour l'admin
function model_categorie_getAllAdmin()
{
    $sql = "SELECT c.*, COUNT(i.id_item) as nb_items 
            FROM categorie c 
            LEFT JOIN item i ON c.id_categorie = i.categorie_id 
            GROUP BY c.id_categorie 
            ORDER BY c.ordre, c.nom";
    $stmt = db()->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère une catégorie par son ID
function model_categorie_getById($id)
{
    $sql = "SELECT * FROM categorie WHERE id_categorie = ?";
    $stmt = db()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Récupère une catégorie par son slug
function model_categorie_getBySlug($slug)
{
    $sql = "SELECT * FROM categorie WHERE slug = ? AND visible = 1";
    $stmt = db()->prepare($sql);
    $stmt->execute([$slug]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Crée une nouvelle catégorie
function model_categorie_create($data)
{
    $sql = "INSERT INTO categorie (nom, slug, description, image_url, parent_id, ordre, visible) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = db()->prepare($sql);
    return $stmt->execute([
        $data['nom'],
        $data['slug'],
        $data['description'] ?? null,
        $data['image_url'] ?? null,
        !empty($data['parent_id']) ? $data['parent_id'] : null,
        $data['ordre'] ?? 0,
        $data['visible'] ?? 1
    ]);
}

// Met à jour une catégorie existante
function model_categorie_update($id, $data)
{
    $sql = "UPDATE categorie 
            SET nom = ?, slug = ?, description = ?, image_url = ?, parent_id = ?, ordre = ?, visible = ?
            WHERE id_categorie = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([
        $data['nom'],
        $data['slug'],
        $data['description'] ?? null,
        $data['image_url'] ?? null,
        !empty($data['parent_id']) ? $data['parent_id'] : null,
        $data['ordre'] ?? 0,
        $data['visible'] ?? 1,
        $id
    ]);
}

// Supprime une catégorie
function model_categorie_delete($id)
{
    // Vérifier s'il y a des items associés
    $checkStmt = db()->prepare("SELECT COUNT(*) FROM item WHERE categorie_id = ?");
    $checkStmt->execute([$id]);
    $itemCount = $checkStmt->fetchColumn();
    
    if ($itemCount > 0) {
        return false; // Ne pas supprimer si des items sont associés
    }
    
    $sql = "DELETE FROM categorie WHERE id_categorie = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([$id]);
}

// Récupère les catégories parentes (pour les selects)
function model_categorie_getParents()
{
    $sql = "SELECT * FROM categorie WHERE parent_id IS NULL AND visible = 1 ORDER BY ordre, nom";
    $stmt = db()->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère les sous-catégories d'une catégorie
function model_categorie_getChildren($parent_id)
{
    $sql = "SELECT * FROM categorie WHERE parent_id = ? AND visible = 1 ORDER BY ordre, nom";
    $stmt = db()->prepare($sql);
    $stmt->execute([$parent_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Vérifie si un slug existe déjà
function model_categorie_slugExists($slug, $exclude_id = null)
{
    if ($exclude_id) {
        $sql = "SELECT COUNT(*) FROM categorie WHERE slug = ? AND id_categorie != ?";
        $stmt = db()->prepare($sql);
        $stmt->execute([$slug, $exclude_id]);
    } else {
        $sql = "SELECT COUNT(*) FROM categorie WHERE slug = ?";
        $stmt = db()->prepare($sql);
        $stmt->execute([$slug]);
    }
    return $stmt->fetchColumn() > 0;
}