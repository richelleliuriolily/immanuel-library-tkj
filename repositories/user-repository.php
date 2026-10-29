<?php
require_once __DIR__ . "/../config/database.php";

function getUsers()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getUser()
{
    global $pdo;
    
    // Pastikan session sudah aktif
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        return null;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $_SESSION['user_id']]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getProfile()
{
    global $pdo;
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        return null;
    }

    // Menyesuaikan dengan asumsi tabel profil bernama 'profiles' dengan foreign key 'user_id'
    $stmt = $pdo->prepare("SELECT * FROM profiles WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $_SESSION['user_id']]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function isEmailTaken($email){
    global $pdo;

    $query = "SELECT count(id) FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email]);
    $isEmailTaken = $stmt->fetchColumn() > 0;
    
    return $isEmailTaken;
}

function getUserByEmail($email){
    global $pdo;
    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    return $user;
}