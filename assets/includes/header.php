<?php
session_start();
if(isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['loggedIn']);
    unset($_SESSION['email']);
    unset($_SESSION['user_id']);
    unset($_SESSION['avatar']);
    header('Location: index.php');
    exit();
}
function isLoggedIn() {
    return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true;
}?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik+Bubbles&family=Ubuntu+Sans+Mono:ital,wght@0,400..700;1,400..700&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5357972dff.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/styles/index.css">
    <title>GROOMMY - Грумминг салон</title>
</head>
<body class="vh">
<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h1>
                    <a href="/index.php">GROOMMY</a>
                </h1>
            </div>
            <nav class="col-8">
                <ul>
                    <li><a href="/?dog&size=small">СОБАКИ</a></li>
                    <li><a href="/?cat">КОШКИ</a></li>
                    <li><a href="/?master">Мастера</a></li>
                    <li>
                        <?php if (isLoggedIn()): ?>
                            <a href="/profile">Аккаунт</a>
                            <ul>
                                <li><a href="/?action=logout&goto=index.php">Выход</a></li>
                            </ul>
                        <?php else: ?>
                            <a href="/login">Аккаунт</a>
                            <ul>
                                <li><a href="/login">Вход</a></li>
                                <li><a href="/register">Регистрация</a></li>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
