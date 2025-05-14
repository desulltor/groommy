<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/db-inc.php';
//получение данных пользователя и питомцев
try {
    $sql_user = 'SELECT lastname, firstname, patronymic, avatar, post FROM `users` WHERE id = :id';
    $stmt_user = $pdo->prepare($sql_user);
    $stmt_user->bindParam(':id', $_SESSION['id']);
    $stmt_user->execute();
    $result_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
    if($result_user) {
        if($result_user['post'] === 'Админ') {
            header('Location: /admin');
        }
        $lastname = $result_user['lastname'];
        $firstname = $result_user['firstname'];
        $patronymic = $result_user['patronymic'];
        $avatar = $result_user['avatar'];
    } else {
        $error_message = "Пользователь с ID " . $_SESSION['id'] . " не найден.";
        error_log($error_message);
    }
    $sql_pets = 'SELECT * FROM pets WHERE id_user = :id';
    $stmt_pets = $pdo->prepare($sql_pets);
    $stmt_pets->bindParam(':id', $_SESSION['id']);
    $stmt_pets->execute();
    $pets = $stmt_pets->fetchAll(PDO::FETCH_ASSOC);
    $i_pet = [];
    if (isset($_GET['info_pet'])) {
        $petId = $_GET['info_pet'];
        $sql_pet = 'SELECT * FROM pets WHERE id = :id';
        $stmt_pet = $pdo->prepare($sql_pet);
        $stmt_pet->bindParam(':id', $petId);
        $stmt_pet->execute();
        $i_pet = $stmt_pet->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    error_log('Ошибка при запросе к базе данных: ' . $error_message);
}

//формирование фио
function formatFIO($lastname, $firstname, $patronymic) {
    $parts = array_filter([$lastname, $firstname, $patronymic]);
    return implode(" ", $parts);
}
$fio = formatFIO($lastname ?? '', $firstname ?? '', $patronymic ?? '');

//загрузка и изменеие аватара пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_avatar'])) {
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['avatar'];
        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/assets/media/avatars/';
        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (in_array($file['type'], $allowedTypes)) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $newFilename = 'avatar_' . $_SESSION['id'] . '_' . time() . '.' . $ext;
            $destination = $uploadDir . $newFilename;
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                try {
                    if (!empty($avatar) && file_exists($_SERVER['DOCUMENT_ROOT'] . $avatar)) {
                        unlink($_SERVER['DOCUMENT_ROOT'] . $avatar);
                    }
                    $stmt = $pdo->prepare("UPDATE users SET avatar = ? WHERE id = ?");
                    $stmt->execute(['/assets/media/avatars/' . $newFilename, $_SESSION['id']]);
                    $_SESSION['message'] = 'Аватар успешно обновлён';
                    $avatar = '/assets/media/avatars/' . $newFilename;
                } catch (PDOException $e) {
                    $_SESSION['error'] = 'Ошибка базы данных';
                    if (file_exists($destination)) {
                        unlink($destination);
                    }
                }
            } else {
                $_SESSION['error'] = 'Ошибка при сохранении файла';
            }
        } else {
            $_SESSION['error'] = 'Допустимы только JPG, PNG и WebP изображения';
        }
    } else {
        $_SESSION['error'] = 'Файл не был выбран или произошла ошибка загрузки';
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}

//загрузка и изменение аватара питомца
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_pet_avatar']) && isset($_FILES['pet_avatar'])) {
    $file = $_FILES['pet_avatar'];
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/assets/media/avatars/';
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['error'] = match($file['error']) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'Файл слишком большой',
            UPLOAD_ERR_PARTIAL => 'Файл загружен частично',
            UPLOAD_ERR_NO_FILE => 'Файл не выбран',
            default => 'Ошибка загрузки файла',
        };
    }
    elseif (!in_array($file['type'], ['image/jpeg', 'image/png', 'image/webp'])) {
        $_SESSION['error'] = 'Допустимы только JPG, PNG и WebP изображения';
    }
    else {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $newFilename = 'pet_avatar_' . $i_pet['id'] . '_' . time() . '.' . $ext;
        $destination = $uploadDir . $newFilename;
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            try {
                if (!empty($i_pet['avatar']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $i_pet['avatar'])) {
                    unlink($_SERVER['DOCUMENT_ROOT'] . $i_pet['avatar']);
                }
                $stmt = $pdo->prepare("UPDATE pets SET avatar = ? WHERE id = ?");
                $stmt->execute(['/assets/media/avatars/' . $newFilename, $i_pet['id']]);

                $i_pet['avatar'] = '/assets/media/pet_avatars/' . $newFilename;
                $_SESSION['message'] = 'Аватар питомца успешно обновлён';
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Ошибка базы данных';
                if (file_exists($destination)) {
                    unlink($destination);
                }
            }
        } else {
            $_SESSION['error'] = 'Ошибка при сохранении файла';
        }
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
    exit();
}


if (isset($_GET['save_pet']) && isset($_POST['name'])) {
    $petId = $_GET['save_pet'];
    $name = $_POST['name'];
    $view = $_POST['view'];
    $breed = $_POST['breed'] ?? null;
    $birth_day = !empty($_POST['birth_day']) ? $_POST['birth_day'] : null;
    $sex = $_POST['sex'] ?? null;
    $notes = $_POST['notes'] ?? null;
if($petId){
    $stmt = $pdo->prepare("UPDATE pets SET name = ?, view = ?, breed = ?, birth_day = ?, sex = ?, notes = ? WHERE id = ?");
    $stmt->execute([$name, $view, $breed, $birth_day, $sex, $notes, $petId]);
    header("Location: ?info_pet=" . $petId);
    exit();
}else{
    $stmt = $pdo->prepare("INSERT INTO `pets` (`name`, `view`, `breed`, `birth_day`, `sex`, `notes`, `id_user`) 
                                  VALUES (:name, :view, :breed, :birth_day, :sex, :notes, :id_user)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':view', $view);
    $stmt->bindParam(':breed', $breed);
    $stmt->bindParam(':birth_day', $birth_day);
    $stmt->bindParam(':sex', $sex);
    $stmt->bindParam(':notes', $notes);
    $stmt->bindParam(':id_user', $_SESSION['id']);
    $stmt->execute();
    header("Location: ../index.php");
    exit();
}

}
include 'profile.php';