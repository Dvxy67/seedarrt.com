
<?php

function catalogue() {
    $stmt = db()->query('SELECT * FROM item');
    $items = $stmt->fetchAll();

    // On déclare le CSS spécifique à cette page
    $pageCss = 'styles_catalogue.css';

    // On passe toutes les données à la vue
    render('catalogue/catalogue.php', [
        'items' => $items,
        'head_tittle' => 'Catalogue | Seedarrt',
        'pageCss' => $pageCss
    ]);
}           


function detail($id)
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

    $item = 

    if (!$item) {
        http_response_code(404);
        echo "Item non trouvé";
        return;
    }

    $pageCss = 'styles_detail.css';
    render('detail/detail.php', [
        'item'        => $item,
        'head_tittle' => $item['nom'] . ' | Seedarrt',
        'pageCss'     => $pageCss
    ]);
}