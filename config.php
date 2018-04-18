<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");
define("BASE_URL", "http://localhost/");
global $bd;
try {
    $bd = new PDO("mysql:dbname=testemvc;host=localhost", "ghert", "");
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}