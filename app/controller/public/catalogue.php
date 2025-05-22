
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
