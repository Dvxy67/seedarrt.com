<?php
define('SITE_ROOT', __DIR__.'/../');
require_once(SITE_ROOT.'app/view/public/template_engine.php');


// On découpe l’URL demandée (ex: /admin/item/create) en morceaux
$uri_parts = explode('/', $_SERVER["REQUEST_URI"]);
array_shift($uri_parts); // On supprime le premier élément vide (car l'URL commence par /)


//  Par défaut, on considère que la zone est "public"
$zone = 'public';
//  Si la première partie de l’URL est "admin", on passe dans la zone admin
if(!empty($uri_parts[0]) && $uri_parts[0] === 'admin'){
    $zone = 'admin';
    array_shift($uri_parts); // On supprime "admin"

}


if(empty($uri_parts[0])){
    $controller = 'home';
} else {
    $controller = $uri_parts[0];
}


if (empty($uri_parts[1])) {
    $action = $controller;
} else {
    $action = $uri_parts[1];
}


// Ici : sélectionne le bon dossier de contrôleur
$controller_path = SITE_ROOT . "app/controller/$zone/$controller.php";

$failedToLoad = false;
if (file_exists($controller_path)) {
    include $controller_path;
    if(function_exists($action)){
        call_user_func($action);
    } else {
        $failedToLoad = true;
    }
} else {
    $failedToLoad = true;
}

if($failedToLoad === true){
    http_response_code(404);
    echo "Erreur 404 : page non trouvée";
}
