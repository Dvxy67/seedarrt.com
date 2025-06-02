
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
        'item'        => $item,
        'head_tittle' => $item['nom'] . ' | Seedarrt',
        'pageCss'     => $pageCss
    ]);
}