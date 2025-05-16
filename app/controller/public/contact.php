<?php
function send()
{
    // save_message($_POST);
    // send_sms($_POST);

    echo 'function send()';
}

function form(){
    echo 'Page contacte rafiné';
}

function contact(){
    require('../config/db.php');
    $stmt = $pdo->query('SELECT * FROM item');
    $items = $stmt->fetchAll();
    render('contact/contact.php', ['items'=> $items, 'head_tittle' => 'Catalogue | Seedarrt']);

}