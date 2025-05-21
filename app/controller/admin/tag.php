<?php

require_once __DIR__ . '/../../model/tag.php';
require_once __DIR__ . '/../../../config/db.php';


    // =============================
    function tag() {
        $items = $this->model->getAll();
        require __DIR__ . '/../../../view/admin/tag/tag.php';
    }

    // =============================
    function create() {
        require __DIR__ . '/../../../view/admin/tag/create.php';
    }

    // =============================
    function store() {
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

        $this->model->create($data);
        header('Location: /admin/tag');
        exit;
    }

    // =============================
    function edit($id) {
        $item = $this->model->getById($id);
        require __DIR__ . '/../../../view/admin/tag/edit.php';
    }

    // =============================
    function update($id) {
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

        $this->model->update($id, $data);
        header('Location: /admin/tag');
        exit;
    }

    // =============================
    function delete($id) {
        $this->model->delete($id);
        header('Location: /admin/tag');
        exit;
    }
