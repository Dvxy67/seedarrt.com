<?php
// var_dump($_GET);
var_dump($_SERVER["REQUEST_URI"]);

$uri_parts = explode('/', $_SERVER["REQUEST_URI"]);
// var_dump($uri_parts);

array_shift($uri_parts);
// var_dump($uri_parts);

$controller = $uri_parts[0];
$controller_path = __DIR__. "/../app/controller/public/$controller.php";

// var_dump($controller_path);
if(file_exists($controller_path)){
    include $controller_path;
}
else{
    http_response_code(404);
}