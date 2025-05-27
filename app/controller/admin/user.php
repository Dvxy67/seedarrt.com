<?php

require_once __DIR__ . '/../../model/user.php';

// =============================
// Liste tous les utilisateurs (operateurs)
function user() {
    $users = model_user_getAll();
    render('user/index.php', ['users' => $users], 'admin');
}

// =============================
// Affiche le formulaire de création
function user_createForm() {
    $pageCss = 'styles_user_create.css';
    render('user/create.php', ['pageCss' => $pageCss], 'admin');
}

// =============================
// Traite la création d'un utilisateur
function user_store() {
    $data = [
        'nom' => $_POST['nom'],
        'prénom' => $_POST['prénom'],
        'login' => $_POST['login'],
        'mot_de_passe' => password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT), // Hash du mot de passe
        'email' => $_POST['email'],
        'telephone' => $_POST['telephone'] ?? null,
        'niveau_acces' => $_POST['niveau_acces'] ?? 'operateur',
        'statut' => $_POST['statut'] ?? 'actif'
    ];

    $result = model_user_create($data);
    
    if ($result) {
        header('Location: /admin/user');
    } else {
        // En cas d'erreur (email/login déjà existant par exemple)
        $error = "Erreur lors de la création de l'utilisateur. Email ou login déjà existant.";
        render('user/create.php', ['error' => $error], 'admin');
    }
    exit;
}

// =============================
// Affiche le formulaire d'édition
function user_edit($id) {
    $user = model_user_getById($id);
    if (!$user) {
        header('Location: /admin/user');
        exit;
    }
    render('user/edit.php', ['user' => $user], 'admin');
}

// =============================
// Traite la mise à jour d'un utilisateur
function user_update() {
    $id = $_POST['id_operateur'];
    
    $data = [
        'nom' => $_POST['nom'],
        'prénom' => $_POST['prénom'],
        'login' => $_POST['login'],
        'email' => $_POST['email'],
        'telephone' => $_POST['telephone'] ?? null,
        'niveau_acces' => $_POST['niveau_acces'] ?? 'operateur',
        'statut' => $_POST['statut'] ?? 'actif'
    ];

    // Si un nouveau mot de passe est fourni, on le hash et l'ajoute
    if (!empty($_POST['mot_de_passe'])) {
        $data['mot_de_passe'] = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    }

    $result = model_user_update($id, $data);
    
    if ($result) {
        header('Location: /admin/user');
    } else {
        $error = "Erreur lors de la mise à jour de l'utilisateur.";
        $user = model_user_getById($id);
        render('user/edit.php', ['user' => $user, 'error' => $error], 'admin');
    }
    exit;
}

// =============================
// Supprime un utilisateur
function user_delete($id) {
    // Vérification de sécurité : on ne peut pas supprimer son propre compte
    // (à adapter selon votre système de session)
    /*
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id) {
        header('Location: /admin/user?error=cannot_delete_self');
        exit;
    }
    */
    
    model_user_delete($id);
    header('Location: /admin/user');
    exit;
}

// =============================
// Fonction pour changer le statut (actif/inactif) rapidement
function user_toggle_status($id) {
    model_user_toggleStatus($id);
    header('Location: /admin/user');
    exit;
}

// =============================
// ALIAS pour le routeur (nécessaires pour votre système de routing)
function create() {
    user_createForm();
}

function store() {
    user_store();
}

function edit($id) {
    user_edit($id);
}

function update() {
    user_update();
}

function delete($id) {
    user_delete($id);
}

function toggle_status($id) {
    user_toggle_status($id);
}