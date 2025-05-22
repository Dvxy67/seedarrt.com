<?php

function lore(){
    $stmt = db()->query('SELECT * FROM item');
    $items = $stmt->fetchAll();
    $pageCss = 'styles_lors.css';
    render('lore/lore.php', ['items'=> $items, 'head_tittle' => 'Catalogue | Seedarrt', 'pageCss' => $pageCss]);
}