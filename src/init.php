<?php

session_start();

require_once __DIR__ . '/db.php';

// require des utilitaires *utils*

// require les classes

$user = false;
if (isset($_SESSION['user_id'])) {
    $pdo = requeteConnexion();
    $st = $pdo->prepare('SELECT * FROM user WHERE id = :user_id');
    $st->execute(['user_id' => $_SESSION['user_id']]);
    $user = $st->fetch(PDO::FETCH_OBJ);
    } 
