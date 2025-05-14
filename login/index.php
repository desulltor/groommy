<?php
//вход в профиль
session_start();
function authenticateUser($email, $password){
    include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/db-inc.php';
    try {
        $sql = 'SELECT id, password FROM users WHERE email = :email';
        $s = $pdo->prepare($sql);
        $s->bindValue(':email', $email);
        $s->execute();
        $row = $s->fetch();
        if ($row) {
            if (password_verify($password, $row['password'])) {
                $_SESSION['id'] = $row['id'];
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    } catch (PDOException $e) {
        error_log('Ошибка при входе: ' . $e->getMessage());
        return FALSE;
    }
}
if (isset($_POST['action'])) {
    if ($_POST['action'] == "login") {
        if (!isset($_POST['email']) or $_POST['email'] == '' or !isset($_POST['password']) or $_POST['password'] == '') {
            $_SESSION['loginError'] = 'Пожалуйста, заполните оба поля';
        } else {
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];
            if (authenticateUser($email, $password)) {
                $_SESSION['loggedIn'] = TRUE;
                $_SESSION['email'] = $email;
                header('Location: ../profile');
                exit();
            } else {
                $_SESSION['loginError'] = 'Указан неверный адрес электронной почты или пароль';
            }
        }
    }
}
include 'login.php';
