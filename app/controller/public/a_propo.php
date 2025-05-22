<?php

function a_propo(){
    $stmt = db()->query('SELECT * FROM item');
    $items = $stmt->fetchAll();
    $pageCss = 'styles_a_propos.css';
    render('a_propo/a_propo.php', ['items'=> $items, 'head_tittle' => 'Catalogue | Seedarrt', 'pageCss' => $pageCss]);

}