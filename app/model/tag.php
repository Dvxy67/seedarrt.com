<?php

// Récupère tous les tags
function model_tag_getAll()
{
    $sql = "SELECT * FROM tag ORDER BY id_tag DESC";
    $stmt = db()->query($sql);
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

// Récupère un tag par son ID
function model_tag_getById($id)
{
    $sql = "SELECT * FROM tag WHERE id_tag = ?";
    $stmt = db()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Crée un nouveau tag
function model_tag_create($data)
{
    $sql = "INSERT INTO tag (nom, slug, description, couleur, parent_tag_id, visible) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = db()->prepare($sql);
    return $stmt->execute([
        $data['nom'],
        $data['slug'],
        $data['description'] ?? null,
        $data['couleur'] ?? '#333333',
        !empty($data['parent_tag_id']) ? $data['parent_tag_id'] : null,
        $data['visible'] ?? 1
    ]);
}

// Met à jour un tag existant
function model_tag_update($id, $data)
{
    $sql = "UPDATE tag SET slug = ?, nom = ? WHERE id_tag = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([
        $data['nom'],
        $data['slug'],
        $data['description'] ?? null,
        $data['couleur'] ?? '#333333',
        !empty($data['parent_tag_id']) ? $data['parent_tag_id'] : null,
        $data['visible'] ?? 1,
        $id
    ]);
}

// Supprime un tag
function model_tag_delete($id)
{
    $sql = "DELETE FROM tag WHERE id_tag = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([$id]);
}
