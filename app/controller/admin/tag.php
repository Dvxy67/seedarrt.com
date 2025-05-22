<?php

require_once __DIR__ . '/../../model/tag.php';

// =============================
function tag() {
    $tags = model_tag_getAll(); // Changé de tag_getAll() à model_tag_getAll()
    render('tag/index.php', ['tags' => $tags], 'admin');
}

// =============================
function tag_createForm() {
    render('tag/create.php', [], 'admin');
}

// =============================
function tag_store() {
    $data = [
        'slug' => $_POST['slug'],
        'nom' => $_POST['nom']
    ];

    model_tag_create($data); // Changé de tag_create() à model_tag_create()
    header('Location: /admin/tag');
    exit;
}

// =============================
function tag_edit($id) {
    $tag = model_tag_getById($id); // Changé de tag_getById() à model_tag_getById()
    require __DIR__ . '/../../../view/admin/tag/edit.php';
}

// =============================
function tag_update($id) {
    $data = [
        'slug' => $_POST['slug'],
        'nom' => $_POST['nom']
    ];

    model_tag_update($id, $data); // Changé de tag_update() à model_tag_update()
    header('Location: /admin/tag');
    exit;
}

// =============================
function tag_delete($id) {
    model_tag_delete($id); // Changé de tag_delete() à model_tag_delete()
    header('Location: /admin/tag');
    exit;
}