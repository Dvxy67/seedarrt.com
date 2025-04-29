<?php
define('SITE_ROOT', __DIR__.'/../');
// var_dump($_GET);
// var_dump($_SERVER["REQUEST_URI"]);

$uri_parts = explode('/', $_SERVER["REQUEST_URI"]);
array_shift($uri_parts);

if(empty($uri_parts[0])){
    $controller = 'home';
}
else{
    $controller = $uri_parts[0];
}

if (empty($uri_parts[1])) {
    $action = $controller;
} else {
    $action = $uri_parts[1];
}

$controller_path = SITE_ROOT . "app/controller/public/$controller.php";

// var_dump($controller_path);
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
}