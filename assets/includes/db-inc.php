<?php
try {
    $pdo = new PDO('mysql:host=MySQL-8.2;dbname=groommy', 'admin', 'admin123');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES "utf8"');
} catch (PDOException $e) {
    $error='Невозможно подключиться к серверу баз данных.';
    exit();
}
