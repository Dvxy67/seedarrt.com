<?php

require_once __DIR__ . '/../../model/tag.php';

// =============================
function tag() {
    $tags = model_tag_getAll(); 
    render('tag/index.php', ['tags' => $tags], 'admin');
}

// =============================
function create() {
    $pageCss = 'styles_tag_create.css';
    render('tag/alter.php', ['pageCss' => $pageCss], 'admin');
}

// =============================
function store() {
    $data = [
        'nom' => $_POST['nom'],
        'slug' => $_POST['slug'],
        'description' => $_POST['description'] ?? null,
        'couleur' => $_POST['couleur'] ?? '#333333',
        'parent_tag_id' => !empty($_POST['parent_tag_id']) ? $_POST['parent_tag_id'] : null,
        'visible' => $_POST['visible'] ?? 1
    ];
    
    model_tag_create($data);
    header('Location: /admin/tag');
    exit;
}

// =============================
function edit($id) {
    $tag = model_tag_getById($id); 
    $pageCss = 'styles_tag_create.css';
    render('tag/alter.php', ['pageCss' => $pageCss, 'tag' => $tag], 'admin');
}

// =============================
function update($id) {
    $data = [
        'nom' => $_POST['nom'],
        'slug' => $_POST['slug'],
        'description' => $_POST['description'] ?? null,
        'couleur' => $_POST['couleur'] ?? '#333333',
        'parent_tag_id' => !empty($_POST['parent_tag_id']) ? $_POST['parent_tag_id'] : null,
        'visible' => $_POST['visible'] ?? 1
    ];

    model_tag_update($id, $data); 
    header('Location: /admin/tag');
    exit;
}

// =============================
function delete($id) {
    model_tag_delete($id); 
    header('Location: /admin/tag');
    exit;
}