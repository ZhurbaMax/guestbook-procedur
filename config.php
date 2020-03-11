<?php

session_start();
define("HOST", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DBNAME", "userlistdb");
define("CHARSET", "utf8");
define("SALT", "qwerty");

$dsn = "mysql:host=".HOST.";dbname=".DBNAME.";charset=".CHARSET;
try {
    $dbConn = new PDO($dsn, USER, PASSWORD);
}
catch (PDOException $e) {
    die('Подключение не удалось' .$e->getMessage());
}
