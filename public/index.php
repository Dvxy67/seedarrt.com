<?php
define('SITE_ROOT', __DIR__.'/../');

require_once(SITE_ROOT.'app/view/public/template_engine.php');

$uri_parts = explode('/', $_SERVER["REQUEST_URI"]);
array_shift($uri_parts);

$zone = 'public';
if(!empty($uri_parts[0]) && $uri_parts[0] === 'admin'){
    $zone = 'admin';
    array_shift($uri_parts);
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
// 🔄 Ici : sélectionne le bon dossier de contrôleur
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
