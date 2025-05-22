<?php
function home(){
    $stmt = db()->query('SELECT * FROM item');
    $items = $stmt->fetchAll();
    $pageCss = 'styles_home.css';
    render('home/home.php', ['items'=> $items, 'head_tittle' => 'Catalogue | Seedarrt','pageCss' => $pageCss]);

}

