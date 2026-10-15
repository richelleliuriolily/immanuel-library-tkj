<?php
$host = "localhost";
$dbname = "Immanuel_library";
$username ="root";
$password = "";

$dsn = "mysql:host=$host;dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $username, $password);

    $option = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO ::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false 
    ];
} catch (PDOException $error) {
    die("Koneksi ke database gagal :" . $error -> getMessage());

}
?>