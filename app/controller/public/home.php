<?php
function home(){
    require('../config/db.php');
    $stmt = $pdo->query('SELECT * FROM item');
    $items = $stmt->fetchAll();
    render('home/home.php', ['items'=> $items, 'head_tittle' => 'Catalogue | Seedarrt']);

}

