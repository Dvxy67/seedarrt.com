
<?php

function catalogue(){
    require('../app/config/db.php');
    $stmt = $pdo->query('SELECT * FROM item');
    $items = $stmt->fetchAll();
    render('catalogue/catalogue.php', ['items'=> $items, 'head_tittle' => 'Catalogue | Seedarrt']);

}

function tableau()
{
    echo 'catalogue tableau bb';
}

function les_print()
{
    echo 'catalogue les printes ';
}
function assets3D()
{
    echo 'catalogue des assets 3D ';
}