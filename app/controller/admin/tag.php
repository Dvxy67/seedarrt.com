<?php

require_once __DIR__ . '/../../model/tag.php';

// =============================
function tag() {
    $tags = model_tag_getAll(); 
    render('tag/index.php', ['tags' => $tags], 'admin');
}

// =============================
function tag_createForm() {
    $pageCss = 'styles_tag_create.css';
    render('tag/create.php', ['pageCss' => $pageCss], 'admin');
}

// =============================
function tag_store() {
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
function tag_edit($id) {
    $tag = model_tag_getById($id); 
}

// =============================
function tag_update($id) {
    $data = [
        'slug' => $_POST['slug'],
        'nom' => $_POST['nom']
    ];

    model_tag_update($id, $data); 
    header('Location: /admin/tag');
    exit;
}

// =============================
function tag_delete($id) {
    model_tag_delete($id); 
    header('Location: /admin/tag');
    exit;
}

// ALIAS (me permet de télécommande fonctions) ou de délégué.
function create() {
    tag_createForm();
}

function store() {
    tag_store();
}

function edit($id) {
    tag_edit($id);
}

function update() {
    tag_update();
}

function delete($id) {
    tag_delete($id);
}