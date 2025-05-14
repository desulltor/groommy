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
    <link rel="stylesheet" href="/admin/assets/styles/index.css">
    <title>GROOMMY - Грумминг салон</title>
</head>
<body class="vh">
<div class="container">
    <div class="sidebar">

        <ul class="nav-list">
            <li class="nav-item active">Пользователи</li>
            <li class="nav-item">Питомцы</li>
            <li class="nav-item">Услуги</li>
            <li class="nav-item">Записи</li>
            <li class="nav-item">Отзывы</li>
            <li class="nav-item">График</li>
        </ul>
    </div>
    <div class="content-area">
        <h1>Управление пользователями</h1>
        <div>
            <form method="POST">
                <table>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>id</th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Телефон</th>
                        <th>Роль</th>
                        <th>Должность</th>
                    </tr>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><input type="checkbox" name="selected_users[]" value="<?= htmlspecialchars($user['id']) ?>"></td>
                            <td>
                                <?php if(isset($_GET['edit']) && $_GET['edit'] == $user['id']): ?>
                                    <button type="submit" name="save" value="<?= htmlspecialchars($user['id']) ?>">Сохранить</button>
                                <?php else: ?>
                                <i class="fas fa-pen"></i><a href="?edit=<?= htmlspecialchars($user['id']) ?>">Изменить</a>
                                <?php endif; ?>
                            </td>
                            <td><i class="fas fa-times delete-icon"></i><a href="delete_user.php?id=<?= htmlspecialchars($user['id']) ?>">Удалить</a></td>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td>
                                <?php if(isset($_GET['edit']) && $_GET['edit'] == $user['id']): ?>
                                    <input type="text" name="lastname" value="<?= htmlspecialchars($user['lastname']) ?>">
                                <?php else: ?>
                                    <?= htmlspecialchars($user['lastname']) ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(isset($_GET['edit']) && $_GET['edit'] == $user['id']): ?>
                                    <input type="text" name="firstname" value="<?= htmlspecialchars($user['firstname']) ?>">
                                <?php else: ?>
                                    <?= htmlspecialchars($user['firstname']) ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(isset($_GET['edit']) && $_GET['edit'] == $user['id']): ?>
                                    <input type="text" name="patronymic" value="<?= htmlspecialchars($user['patronymic'] ?? '') ?>">
                                <?php else: ?>
                                    <?= htmlspecialchars($user['patronymic'] ?? '') ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(isset($_GET['edit']) && $_GET['edit'] == $user['id']): ?>
                                    <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
                                <?php else: ?>
                                    <?= htmlspecialchars($user['phone']) ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(isset($_GET['edit']) && $_GET['edit'] == $user['id']): ?>
                                    <select name="role">
                                        <option value="admin" <?= $user['role'] == 'Сотрудник' ? 'selected' : '' ?>>Сотрудник</option>
                                        <option value="user" <?= $user['role'] == 'Пользователь' ? 'selected' : '' ?>>Пользователь</option>
                                    </select>
                                <?php else: ?>
                                    <?= htmlspecialchars($user['role']) ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if(isset($_GET['edit']) && $_GET['edit'] == $user['id']): ?>
                                    <input type="text" name="post" value="<?= htmlspecialchars($user['post'] ?? '') ?>">
                                <?php else: ?>
                                    <?= htmlspecialchars($user['post'] ?? '') ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <p>
                    Выбранные:
                    <button type="submit" name="batch_edit">Редактировать</button>
                    <button type="submit" name="batch_delete">Удалить</button>
                </p>
            </form>
        </div>
    </div>
</div>