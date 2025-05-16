
<?php

function catalogue(){
    require('../config/db.php');
    $stmt = $pdo->query('SELECT * FROM item');
    $items = $stmt->fetchAll();
    render('catalogue/catalogue.php', ['items'=> $items, 'head_tittle' => 'Catalogue | Seedarrt']);

}
