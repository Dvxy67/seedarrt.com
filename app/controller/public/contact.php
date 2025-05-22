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
    $stmt = db()->query('SELECT * FROM item');
    $items = $stmt->fetchAll();
    $pageCss = 'styles_contact.css';
    render('contact/contact.php', ['items'=> $items, 'head_tittle' => 'Catalogue | Seedarrt','pageCss' => $pageCss]);

}