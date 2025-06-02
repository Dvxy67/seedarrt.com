<?php

require_once __DIR__ . '/../../model/item.php';


// =============================
function item()
{
    $items = item_getAll();
    render('item/index.php', ['items' => $items], 'admin');
}

// =============================
function create()
{
    $pageCss = 'styles_item_create.css';
    render('item/create.php', ['pageCss' => $pageCss], 'admin');
}

// =============================
function store()
{
    $data = [
        'slug' => $_POST['slug'],
        'nom' => $_POST['nom'],
        'description' => $_POST['description'],
        'prix' => $_POST['prix'],
        'prix_promo' => $_POST['prix_promo'] !== '' ? $_POST['prix_promo'] : null,
        'quantite_stock' => $_POST['quantite_stock'],
        'categorie_id' => $_POST['categorie_id'],
        'image_url' => $_POST['image_url'],
        'statut' => $_POST['statut'],
        'poids' => $_POST['poids']
    ];

    item_create($data);
    header('Location: /admin/item');
    exit;
}

// =============================
function edit($id)
{
    $items = item_getById($id);
    $pageCss = 'styles_item_create.css';
    render('item/edit.php', ['items' => $items, 'pageCss' => $pageCss], 'admin');
}

// =============================
function update($id)
{
    $data = [
        'slug' => $_POST['slug'],
        'nom' => $_POST['nom'],
        'description' => $_POST['description'],
        'prix' => $_POST['prix'],
        'prix_promo' => $_POST['prix_promo'],
        'quantite_stock' => $_POST['quantite_stock'],
        'categorie_id' => $_POST['categorie_id'],
        'image_url' => $_POST['image_url'],
        'statut' => $_POST['statut'],
        'poids' => $_POST['poids']
    ];

    item_update($id, $data);
    header('Location: /admin/item');
    exit;
}

// =============================
function delete($id)
{
    item_delete($id);
    header('Location: /admin/item');
    exit;
}


