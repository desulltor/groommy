<?php
session_start();
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/db-inc.php';
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $patronymic = $_POST['patronymic'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $toopassword = $_POST['toopassword'];
    $_ERROR_VALID = [];
    $_VALUDATTION_RULE = [
        'firstname' => '/^[a-zA-Zа-яёА-ЯЁ\-]{3,50}$/u',
        'lastname' => '/^[a-zA-Zа-яёА-ЯЁ\-]{3,50}$/u',
        'patronymic' => '/^[a-zA-Zа-яёА-ЯЁ\-]{3,50}$/u',
        'email' => '/^(?=.*@)(?=.*\.)[a-zA-Zа-яёА-ЯЁ\d._%+-]{1,64}@(?:[a-zA-Zа-яёА-ЯЁ\d-]+\.)+[a-zA-Zа-яёА-ЯЁ\d-]+$/u',
        'phone' => '/^[0-9]{10,11}$/u',
        'password' => '/^(?=.*[0-9].*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*].*[!@#$%^&*].*[!@#$%^&*])[a-zA-Z!@#$%^&*\d]{6,20}$/'
    ];
    // Валидация полей
    if (isset($_POST['email']) && !preg_match($_VALUDATTION_RULE['email'], $email)) $_ERROR_VALID['email'] = "Некорректный email";
//    if (isset($_POST['password']) && !preg_match($_VALUDATTION_RULE['password'], $email)) $_ERROR_VALID['password'] = "Пароль должен содержать миниум 6 символов из которых 2 цифры, 3 спец символа и 1 заглавная буква";
    if (isset($_POST['lastname']) && !preg_match($_VALUDATTION_RULE['lastname'], $lastname)) $_ERROR_VALID['lastname'] = "Некорректная фамилия";
    if (isset($_POST['firstname']) && !preg_match($_VALUDATTION_RULE['firstname'], $firstname)) $_ERROR_VALID['firstname'] = "Некорректное имя";
    if (isset($_POST['patronymic']) && !preg_match($_VALUDATTION_RULE['patronymic'], $patronymic)) $_ERROR_VALID['patronymic'] = "Некорректное отчество";
    if (isset($_POST['phone']) && !preg_match($_VALUDATTION_RULE['phone'], $phone)) $_ERROR_VALID['phone'] = "Некорректный номер телефона";
    if ($password !== $toopassword) $_ERROR_VALID['toopassword'] = 'Пароли не совпадают';

    // Проверка уникальности email
    if (!isset($_ERROR_VALID['email'])) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($stmt->fetch()) {
            $_ERROR_VALID['email'] = "Этот email уже зарегистрирован";
        }
    }
    if (empty($_ERROR_VALID)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $sql = "INSERT INTO users (firstname, lastname, patronymic, phone, email, password, role)
                    VALUES (:firstname, :lastname, :patronymic, :phone, :email, :password, 'Клиент')";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':patronymic', $patronymic);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);
            if ($stmt->execute()) {
                header('Location: ../login');
                exit();
            }
        } catch (PDOException $e) {
            $_ERROR_VALID['reg'] = 'Ошибка регистрации пользователя: ' . $e->getMessage();
        }
    }
}

include 'reg.php';