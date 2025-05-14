<?php
session_start();
function isLoggedIn() {
    return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
}
$isAdmin = false;
include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/db-inc.php';
try {
    $sql_admin = 'SELECT * FROM users WHERE post LIKE "Админ"';
    $admins = $pdo->query($sql_admin)->fetchAll(PDO::FETCH_ASSOC);
    foreach($admins as $admin) {
        if((int)$admin['id'] === (int)$_SESSION['id']) {
            $isAdmin = true;
            break;
        }
    }
} catch (PDOException $e) {
    $error_message = 'Ошибка при загрузке данных админа: ' . $e->getMessage();
}
if(!isLoggedIn()) {
    header('Location: /login');
    exit();
}

try{
    $sql_users = 'Select * from users';
    $users = $pdo->query($sql_users)->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e) {
    $error = 'Ошибка получения пользователей' . $e->getMessage();
}

if($_GET['edit']){
    foreach ($users as $user) {
        if($user['id'] === (int)$_GET['edit']) {
            $stmt = $pdo->prepare("UPDATE users SET lastname = ?, firstname = ?, patronymic = ?, phone = ?, role = ?, post = ? WHERE id = ?");
            echo $_POST['role'];
            $stmt->execute([
                $_POST['lastname'],
                $_POST['firstname'],
                $_POST['patronymic'] ?? null,
                $_POST['phone'],
                $_POST['role'],
                $_POST['post'] ?? null,
                (int)$_GET['edit']
            ]);        }
    }
}

if($isAdmin) {
    include 'admin.php';
} else {
    include 'notadmin.php';
}