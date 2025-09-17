<?php

function checkin(){
    $pageCss = 'styles_login.css';
    
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        render('login/login.php', ['pageCss' => $pageCss]);
    } else {
        // Récupérer l'utilisateur par login (utilisant le nom actuellement)
        $stmt = db()->prepare('SELECT id_operateur, nom, prénom, login, mot_de_passe, niveau_acces 
                               FROM operateur 
                               WHERE login = ? AND statut = "actif"');
        $stmt->execute([$_POST['username']]);
        $operateur = $stmt->fetch();
        
        // Vérifier le mot de passe avec password_verify
        if (!$operateur || !password_verify($_POST['mot_de_passe'], $operateur['mot_de_passe'])) {
            render('login/login.php', [
                'error' => 'Identifiant ou mot de passe incorrect', 
                'pageCss' => $pageCss
            ]);
        } else {
            // Stocker les informations de session
            $_SESSION['active_user'] = $operateur['id_operateur'];
            $_SESSION['user_name'] = $operateur['prénom'] . ' ' . $operateur['nom'];
            $_SESSION['user_level'] = $operateur['niveau_acces'];
            
            // Mettre à jour la dernière connexion
            $updateStmt = db()->prepare('UPDATE operateur SET derniere_connexion = NOW() WHERE id_operateur = ?');
            $updateStmt->execute([$operateur['id_operateur']]);
            
            header('Location: /admin');
            exit;
        }
    }
}

function bye()
{
    session_destroy();
    header('Location: /');
    exit;
}