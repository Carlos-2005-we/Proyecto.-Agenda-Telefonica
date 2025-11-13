<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = getenv('DB_HOST') ?: 'sql212.infinityfree.com'; 
$db   = getenv('DB_NAME') ?: 'if0_40400076_proyecto_agenda';
$user = getenv('DB_USER') ?: 'if0_40400076';
$pass = getenv('DB_PASS') ?: 'hFM5z9kNeeR3Y';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    exit('Error al conectar a la base de datos.');
}
?>
