<?php
// app/controller/admin/categorie.php

require_once __DIR__ . '/../../model/categorie.php';

// =============================
function categorie()
{
    $categories = model_categorie_getAllAdmin();
    render('categorie/index.php', ['categories' => $categories], 'admin');
}

// =============================
function create()
{
    $parentCategories = model_categorie_getParents();
    $pageCss = 'styles_categorie_create.css';
    render('categorie/alter.php', [
        'parentCategories' => $parentCategories,
        'pageCss' => $pageCss
    ], 'admin');
}

// =============================
function store()
{
    // Validation des données
    $errors = [];
    
    if (empty($_POST['nom'])) {
        $errors[] = "Le nom est obligatoire";
    }
    
    if (empty($_POST['slug'])) {
        $errors[] = "Le slug est obligatoire";
    } elseif (model_categorie_slugExists($_POST['slug'])) {
        $errors[] = "Ce slug existe déjà";
    }
    
    if (!empty($errors)) {
        $parentCategories = model_categorie_getParents();
        render('categorie/alter.php', [
            'errors' => $errors,
            'data' => $_POST,
            'parentCategories' => $parentCategories
        ], 'admin');
        return;
    }
    
    $data = [
        'nom' => trim($_POST['nom']),
        'slug' => trim($_POST['slug']),
        'description' => trim($_POST['description']) ?: null,
        'image_url' => trim($_POST['image_url']) ?: null,
        'parent_id' => !empty($_POST['parent_id']) ? $_POST['parent_id'] : null,
        'ordre' => (int)($_POST['ordre'] ?? 0),
        'visible' => $_POST['visible'] ?? 1
    ];
    
    if (model_categorie_create($data)) {
        header('Location: /admin/categorie?success=created');
    } else {
        header('Location: /admin/categorie?error=create_failed');
    }
    exit;
}

// =============================
function edit($id)
{
    $categorie = model_categorie_getById($id);
    if (!$categorie) {
        header('Location: /admin/categorie?error=not_found');
        exit;
    }
    
    $parentCategories = model_categorie_getParents();
    $pageCss = 'styles_categorie_create.css';
    render('categorie/alter.php', [
        'categorie' => $categorie,
        'parentCategories' => $parentCategories,
        'pageCss' => $pageCss
    ], 'admin');
}

// =============================
function update($id)
{
    $categorie = model_categorie_getById($id);
    if (!$categorie) {
        header('Location: /admin/categorie?error=not_found');
        exit;
    }
    
    // Validation des données
    $errors = [];
    
    if (empty($_POST['nom'])) {
        $errors[] = "Le nom est obligatoire";
    }
    
    if (empty($_POST['slug'])) {
        $errors[] = "Le slug est obligatoire";
    } elseif (model_categorie_slugExists($_POST['slug'], $id)) {
        $errors[] = "Ce slug existe déjà";
    }
    
    // Vérifier qu'on ne crée pas de référence circulaire
    if (!empty($_POST['parent_id']) && $_POST['parent_id'] == $id) {
        $errors[] = "Une catégorie ne peut pas être son propre parent";
    }
    
    if (!empty($errors)) {
        $parentCategories = model_categorie_getParents();
        render('categorie/alter.php', [
            'errors' => $errors,
            'categorie' => array_merge($categorie, $_POST),
            'parentCategories' => $parentCategories
        ], 'admin');
        return;
    }
    
    $data = [
        'nom' => trim($_POST['nom']),
        'slug' => trim($_POST['slug']),
        'description' => trim($_POST['description']) ?: null,
        'image_url' => trim($_POST['image_url']) ?: null,
        'parent_id' => !empty($_POST['parent_id']) ? $_POST['parent_id'] : null,
        'ordre' => (int)($_POST['ordre'] ?? 0),
        'visible' => $_POST['visible'] ?? 1
    ];
    
    if (model_categorie_update($id, $data)) {
        header('Location: /admin/categorie?success=updated');
    } else {
        header('Location: /admin/categorie?error=update_failed');
    }
    exit;
}

// =============================
function delete($id)
{
    $categorie = model_categorie_getById($id);
    if (!$categorie) {
        header('Location: /admin/categorie?error=not_found');
        exit;
    }
    
    if (model_categorie_delete($id)) {
        header('Location: /admin/categorie?success=deleted');
    } else {
        header('Location: /admin/categorie?error=has_items');
    }
    exit;
}

// =============================
// AJAX: Récupérer les sous-catégories
function get_subcategories($parent_id = null)
{
    header('Content-Type: application/json');
    
    if ($parent_id) {
        $subcategories = model_categorie_getChildren($parent_id);
    } else {
        $subcategories = [];
    }
    
    echo json_encode($subcategories);
    exit;
}