<?php

require_once __DIR__ . '/../../model/item.php';
require_once __DIR__ . '/../../model/categorie.php';

// =============================
function item()
{
    $items = item_getAll();
    render('item/index.php', ['items' => $items], 'admin');
}

// =============================
function create()
{
    $categories = model_categorie_getAll();
    $pageCss = 'styles_item_create.css';
    render('item/create.php', [
        'categories' => $categories,
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
    }
    
    if (empty($_POST['prix']) || !is_numeric($_POST['prix']) || $_POST['prix'] < 0) {
        $errors[] = "Le prix doit être un nombre positif";
    }
    
    if (!empty($errors)) {
        $categories = model_categorie_getAll();
        render('item/create.php', [
            'errors' => $errors,
            'data' => $_POST,
            'categories' => $categories
        ], 'admin');
        return;
    }

    $data = [
        'slug' => trim($_POST['slug']),
        'nom' => trim($_POST['nom']),
        'description' => trim($_POST['description']),
        'prix' => (float)$_POST['prix'],
        'prix_promo' => !empty($_POST['prix_promo']) ? (float)$_POST['prix_promo'] : null,
        'quantite_stock' => (int)($_POST['quantite_stock'] ?? 0),
        'categorie_id' => !empty($_POST['categorie_id']) ? (int)$_POST['categorie_id'] : null,
        'image_url' => trim($_POST['image_url']),
        'statut' => $_POST['statut'] ?? 'actif',
        'poids' => !empty($_POST['poids']) ? (float)$_POST['poids'] : null
    ];

    if (item_create($data)) {
        header('Location: /admin/item?success=created');
    } else {
        header('Location: /admin/item?error=create_failed');
    }
    exit;
}

// =============================
function edit($id)
{
    $item = item_getById($id);
    if (!$item) {
        header('Location: /admin/item?error=not_found');
        exit;
    }
    
    $categories = model_categorie_getAll();
    $pageCss = 'styles_item_create.css';
    render('item/edit.php', [
        'item' => $item,
        'categories' => $categories,
        'pageCss' => $pageCss
    ], 'admin');
}

// =============================
function update($id)
{
    $item = item_getById($id);
    if (!$item) {
        header('Location: /admin/item?error=not_found');
        exit;
    }
    
    // Validation des données
    $errors = [];
    
    if (empty($_POST['nom'])) {
        $errors[] = "Le nom est obligatoire";
    }
    
    if (empty($_POST['slug'])) {
        $errors[] = "Le slug est obligatoire";
    }
    
    if (empty($_POST['prix']) || !is_numeric($_POST['prix']) || $_POST['prix'] < 0) {
        $errors[] = "Le prix doit être un nombre positif";
    }
    
    if (!empty($errors)) {
        $categories = model_categorie_getAll();
        render('item/edit.php', [
            'errors' => $errors,
            'item' => array_merge($item, $_POST),
            'categories' => $categories
        ], 'admin');
        return;
    }

    $data = [
        'slug' => trim($_POST['slug']),
        'nom' => trim($_POST['nom']),
        'description' => trim($_POST['description']),
        'prix' => (float)$_POST['prix'],
        'prix_promo' => !empty($_POST['prix_promo']) ? (float)$_POST['prix_promo'] : null,
        'quantite_stock' => (int)($_POST['quantite_stock'] ?? 0),
        'categorie_id' => !empty($_POST['categorie_id']) ? (int)$_POST['categorie_id'] : null,
        'image_url' => trim($_POST['image_url']),
        'statut' => $_POST['statut'] ?? 'actif',
        'poids' => !empty($_POST['poids']) ? (float)$_POST['poids'] : null
    ];

    if (item_update($id, $data)) {
        header('Location: /admin/item?success=updated');
    } else {
        header('Location: /admin/item?error=update_failed');
    }
    exit;
}

// =============================
function delete($id)
{
    if (item_delete($id)) {
        header('Location: /admin/item?success=deleted');
    } else {
        header('Location: /admin/item?error=delete_failed');
    }
    exit;
}