<?php

function checkin(){
    $pageCss = 'styles_login.css';
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        render('login/login.php', ['pageCss' => $pageCss]);
    } else {
        $stmt = db()-> prepare('SELECT id_operateur, mot_de_passe FROM operateur WHERE nom = ?');
        $stmt->execute([$_POST['username']]);
        $operateur = $stmt->fetch();
        if (!$operateur || $operateur['mot_de_passe'] !== $_POST['mot_de_passe']) {
            render('login/login.php', ['error' => 'Essaie encore Mon vladimir ou sinon Byyyyyyeeee Pétasse ', 'pageCss' => $pageCss]);
        } else {
            $_SESSION['active_user'] = $operateur['id_operateur'];
            header('Location: /admin');
        }
    }
}

function bye()
{
    session_destroy();
    header('Location: /');
}