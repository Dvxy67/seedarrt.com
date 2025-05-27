<?php

// Récupère tous les utilisateurs
function model_user_getAll()
{
    $sql = "SELECT id_operateur, nom, prénom, login, email, telephone, niveau_acces, statut, date_creation, derniere_connexion 
            FROM operateur 
            ORDER BY date_creation DESC";
    $stmt = db()->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupère un utilisateur par son ID
function model_user_getById($id)
{
    $sql = "SELECT id_operateur, nom, prénom, login, email, telephone, niveau_acces, statut, date_creation, derniere_connexion 
            FROM operateur 
            WHERE id_operateur = ?";
    $stmt = db()->prepare($sql);
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Récupère un utilisateur par son login (pour l'authentification)
function model_user_getByLogin($login)
{
    $sql = "SELECT * FROM operateur WHERE login = ? AND statut = 'actif'";
    $stmt = db()->prepare($sql);
    $stmt->execute([$login]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Récupère un utilisateur par son email
function model_user_getByEmail($email)
{
    $sql = "SELECT * FROM operateur WHERE email = ?";
    $stmt = db()->prepare($sql);
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Crée un nouvel utilisateur
function model_user_create($data)
{
    try {
        $sql = "INSERT INTO operateur (nom, prénom, login, mot_de_passe, email, telephone, niveau_acces, statut) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = db()->prepare($sql);
        return $stmt->execute([
            $data['nom'],
            $data['prénom'],
            $data['login'],
            $data['mot_de_passe'],
            $data['email'],
            $data['telephone'],
            $data['niveau_acces'],
            $data['statut']
        ]);
    } catch (PDOException $e) {
        // En cas d'erreur (contrainte unique par exemple)
        return false;
    }
}

// Met à jour un utilisateur existant
function model_user_update($id, $data)
{
    try {
        // Construction dynamique de la requête selon les données fournies
        $fields = [];
        $values = [];
        
        if (isset($data['nom'])) {
            $fields[] = "nom = ?";
            $values[] = $data['nom'];
        }
        if (isset($data['prénom'])) {
            $fields[] = "prénom = ?";
            $values[] = $data['prénom'];
        }
        if (isset($data['login'])) {
            $fields[] = "login = ?";
            $values[] = $data['login'];
        }
        if (isset($data['mot_de_passe'])) {
            $fields[] = "mot_de_passe = ?";
            $values[] = $data['mot_de_passe'];
        }
        if (isset($data['email'])) {
            $fields[] = "email = ?";
            $values[] = $data['email'];
        }
        if (isset($data['telephone'])) {
            $fields[] = "telephone = ?";
            $values[] = $data['telephone'];
        }
        if (isset($data['niveau_acces'])) {
            $fields[] = "niveau_acces = ?";
            $values[] = $data['niveau_acces'];
        }
        if (isset($data['statut'])) {
            $fields[] = "statut = ?";
            $values[] = $data['statut'];
        }
        
        // Ajout de l'ID à la fin pour la clause WHERE
        $values[] = $id;
        
        $sql = "UPDATE operateur SET " . implode(', ', $fields) . " WHERE id_operateur = ?";
        $stmt = db()->prepare($sql);
        return $stmt->execute($values);
        
    } catch (PDOException $e) {
        return false;
    }
}

// Supprime un utilisateur
function model_user_delete($id)
{
    $sql = "DELETE FROM operateur WHERE id_operateur = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([$id]);
}

// Change le statut d'un utilisateur (actif/inactif)
function model_user_toggleStatus($id)
{
    $sql = "UPDATE operateur 
            SET statut = CASE 
                WHEN statut = 'actif' THEN 'inactif' 
                ELSE 'actif' 
            END 
            WHERE id_operateur = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([$id]);
}

// Met à jour la dernière connexion
function model_user_updateLastLogin($id)
{
    $sql = "UPDATE operateur SET derniere_connexion = NOW() WHERE id_operateur = ?";
    $stmt = db()->prepare($sql);
    return $stmt->execute([$id]);
}

// Vérifie si un login existe déjà
function model_user_loginExists($login, $excludeId = null)
{
    if ($excludeId) {
        $sql = "SELECT COUNT(*) FROM operateur WHERE login = ? AND id_operateur != ?";
        $stmt = db()->prepare($sql);
        $stmt->execute([$login, $excludeId]);
    } else {
        $sql = "SELECT COUNT(*) FROM operateur WHERE login = ?";
        $stmt = db()->prepare($sql);
        $stmt->execute([$login]);
    }
    return $stmt->fetchColumn() > 0;
}

// Vérifie si un email existe déjà
function model_user_emailExists($email, $excludeId = null)
{
    if ($excludeId) {
        $sql = "SELECT COUNT(*) FROM operateur WHERE email = ? AND id_operateur != ?";
        $stmt = db()->prepare($sql);
        $stmt->execute([$email, $excludeId]);
    } else {
        $sql = "SELECT COUNT(*) FROM operateur WHERE email = ?";
        $stmt = db()->prepare($sql);
        $stmt->execute([$email]);
    }
    return $stmt->fetchColumn() > 0;
}

// Statistiques des utilisateurs
function model_user_getStats()
{
    $sql = "SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN statut = 'actif' THEN 1 ELSE 0 END) as actifs,
                SUM(CASE WHEN statut = 'inactif' THEN 1 ELSE 0 END) as inactifs,
                SUM(CASE WHEN niveau_acces = 'admin' THEN 1 ELSE 0 END) as admins,
                SUM(CASE WHEN niveau_acces = 'superviseur' THEN 1 ELSE 0 END) as superviseurs,
                SUM(CASE WHEN niveau_acces = 'operateur' THEN 1 ELSE 0 END) as operateurs
            FROM operateur";
    $stmt = db()->query($sql);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}