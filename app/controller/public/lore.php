<?php

function lore(){
    require('../config/db.php');
    $stmt = $pdo->query('SELECT * FROM item');
    $items = $stmt->fetchAll();
    $pageCss = 'styles_lors.css';
    render('lore/lore.php', ['items'=> $items, 'head_tittle' => 'Catalogue | Seedarrt', 'pageCss' => $pageCss]);
}