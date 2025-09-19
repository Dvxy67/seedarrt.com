<?php

require_once __DIR__ . '/../../model/categorie.php';

function catalogue() {
    // Récupération des paramètres de filtrage
    $categorieSlug = $_GET['categorie'] ?? null;
    $search = $_GET['search'] ?? null;
    $sort = $_GET['sort'] ?? 'recent';
    $page = (int)($_GET['page'] ?? 1);
    $itemsPerPage = 12;
    $offset = ($page - 1) * $itemsPerPage;
    
    // Construction de la requête SQL avec jointure
    $sql = "SELECT i.*, c.nom as categorie_nom, c.slug as categorie_slug 
            FROM item i 
            LEFT JOIN categorie c ON i.categorie_id = c.id_categorie 
            WHERE i.statut IN ('actif', 'en_promotion')"; // CORRIGÉ : Inclure les promotions
    
    $params = [];
    
    // Filtre par catégorie
    if ($categorieSlug) {
        $sql .= " AND c.slug = ?";
        $params[] = $categorieSlug;
    }
    
    // Filtre de recherche
    if ($search) {
        $sql .= " AND (i.nom LIKE ? OR i.description LIKE ?)";
        $searchTerm = "%$search%";
        $params[] = $searchTerm;
        $params[] = $searchTerm;
    }
    
    // Tri
    switch ($sort) {
        case 'price-asc':
            $sql .= " ORDER BY COALESCE(i.prix_promo, i.prix) ASC";
            break;
        case 'price-desc':
            $sql .= " ORDER BY COALESCE(i.prix_promo, i.prix) DESC";
            break;
        case 'name':
            $sql .= " ORDER BY i.nom ASC";
            break;
        default:
            $sql .= " ORDER BY i.date_ajout DESC";
    }
    
    // Pagination - compter le total
    $countSql = str_replace("SELECT i.*, c.nom as categorie_nom, c.slug as categorie_slug", "SELECT COUNT(*)", $sql);
    $countSql = preg_replace('/ORDER BY.*/', '', $countSql); // Retirer ORDER BY pour le count
    $countStmt = db()->prepare($countSql);
    $countStmt->execute($params);
    $totalItems = $countStmt->fetchColumn();
    $totalPages = ceil($totalItems / $itemsPerPage);
    
    // Récupération des items avec limite
    $sql .= " LIMIT ? OFFSET ?";
    $params[] = $itemsPerPage;
    $params[] = $offset;
    
    $stmt = db()->prepare($sql);
    $stmt->execute($params);
    $items = $stmt->fetchAll();
    
    // Récupération de toutes les catégories pour les filtres
    $categories = model_categorie_getAll();
    
    // Récupération de la catégorie actuelle pour le titre
    $currentCategorie = null;
    if ($categorieSlug) {
        $currentCategorie = model_categorie_getBySlug($categorieSlug);
    }
    
    $pageCss = 'styles_catalogue.css';

    render('catalogue/catalogue.php', [
        'items' => $items,
        'categories' => $categories,
        'currentCategorie' => $currentCategorie,
        'filters' => [
            'categorie' => $categorieSlug,
            'search' => $search,
            'sort' => $sort
        ],
        'pagination' => [
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalItems' => $totalItems,
            'itemsPerPage' => $itemsPerPage
        ],
        'head_title' => $currentCategorie ? 
            $currentCategorie['nom'] . ' | Catalogue | Seedarrt' : 
            'Catalogue | Seedarrt',
        'pageCss' => $pageCss
    ]);
}

function detail($slug)
{
    $item = db()->prepare('SELECT i.*, c.nom as categorie_nom, c.slug as categorie_slug 
                           FROM item i 
                           LEFT JOIN categorie c ON i.categorie_id = c.id_categorie 
                           WHERE i.slug = :slug');
    $item->execute([':slug' => $slug]);
    $item = $item->fetch();
    
    if(!$item) {
        http_response_code(404);
        echo "Item non trouvé";
        return;
    }
    
    $pageCss = 'styles_detail.css';
    render('detail/detail.php', [
        'item' => $item,
        'head_title' => $item['nom'] . ' | Seedarrt',
        'pageCss' => $pageCss
    ]);
}

// API pour la recherche AJAX
function search_ajax()
{
    header('Content-Type: application/json');
    
    $query = $_GET['q'] ?? '';
    if (strlen($query) < 2) {
        echo json_encode([]);
        exit;
    }
    
    $sql = "SELECT i.nom, i.slug, i.prix, i.prix_promo, i.image_url 
            FROM item i 
            WHERE i.statut IN ('actif', 'en_promotion') 
            AND (i.nom LIKE ? OR i.description LIKE ?) 
            LIMIT 10";
    
    $searchTerm = "%$query%";
    $stmt = db()->prepare($sql);
    $stmt->execute([$searchTerm, $searchTerm]);
    $results = $stmt->fetchAll();
    
    echo json_encode($results);
    exit;
}