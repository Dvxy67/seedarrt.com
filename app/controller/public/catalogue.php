<?php

function catalogue() {
    $stmt = db()->query('SELECT * FROM item ORDER BY date_ajout DESC');
    $items = $stmt->fetchAll();

    $pageCss = 'styles_catalogue.css';

    render('catalogue/catalogue.php', [
        'items' => $items,
        'head_title' => 'Catalogue | Seedarrt',  // Corrigé: head_title (pas head_tittle)
        'pageCss' => $pageCss
    ]);
}           

function detail($slug)
{
    $item = db()->prepare('SELECT * FROM item WHERE slug=:slug');
    $item->execute([':slug' => $slug]);
    $item = $item->fetch();
    
    if(!$item) {
        http_response_code(404);
        echo "Item non trouvé";
        return;
    }
    
    $pageCss = 'styles_detail.css';
    render('detail/detail.php', [
        'item' => $item,  // Maintenant accessible via $data['item'] dans la vue
        'head_title' => $item['nom'] . ' | Seedarrt',  // Corrigé: head_title
        'pageCss' => $pageCss
    ]);
}