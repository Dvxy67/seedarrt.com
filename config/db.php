<?php

function db(){
    static $pdo;
    if($pdo === null){
        $host = 'localhost';
        $db   = 'seedarrt';
        $user = 'seedarrt';
        $pass = 'seedarrt';
        $charset = 'utf8mb4';
        
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, $user, $pass, $options);
    }
    return $pdo;
}

?>