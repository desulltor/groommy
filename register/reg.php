<?
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/header.php';
?>
<main >
    <h2 class="text-center regh">Регистрация</h2>
    <form action="" method="post" class="vhod container" enctype="multipart/form-data">
        <input type="text" name="lastname" placeholder="Фамилия" class="<?php echo isset($_ERROR_VALID['lastname']) ? 'error' : ''; ?>" required>
        <?php if (isset($_ERROR_VALID['lastname'])):?>
            <div class="error-message"><? echo $_ERROR_VALID['lastname']?></div>
        <?php endif; ?>
        <br>
        <input type="text" name="firstname" placeholder="Имя" class="<?php echo isset($_ERROR_VALID['firstname']) ? 'error' : ''; ?>" required>
        <?php if (isset($_ERROR_VALID['firstname'])):?>
            <div class="error-message"><? echo $_ERROR_VALID['firstname']?></div>
        <?php endif; ?>
        <br>
        <input type="text" name="patronymic" placeholder="Отчество" class="<?php echo isset($_ERROR_VALID['patronymic']) ? 'error' : ''; ?>">
        <?php if (isset($_ERROR_VALID['patronymic'])):?>
            <div class="error-message"><? echo $_ERROR_VALID['patronymic']?></div>
        <?php endif; ?>
        <br>
        <input type="email" name="email" placeholder="Введите логин" class="<?php echo isset($_ERROR_VALID['email']) ? 'error' : ''; ?>" required>
        <?php if (isset($_ERROR_VALID['email'])):?>
            <div class="error-message"><? echo $_ERROR_VALID['email']?></div>
        <?php endif; ?>
        <br>
        <input type="tel" name="phone" placeholder="Введите номер телефона" class="<?php echo isset($_ERROR_VALID['phone']) ? 'error' : ''; ?>" required>
        <?php if (isset($_ERROR_VALID['phone'])):?>
            <div class="error-message"><? echo $_ERROR_VALID['phone']?></div>
        <?php endif; ?>
        <br>
        <input type="password" name="password" placeholder="Придумайте пароль" class="<?php echo isset($_ERROR_VALID['password']) ? 'error' : ''; ?>" required>
        <?php if (isset($_ERROR_VALID['password'])):?>
            <div class="error-message"><? echo $_ERROR_VALID['password']?></div>
        <?php endif; ?>
        <br>
        <input type="password" name="toopassword" placeholder="Подтвердите пароль" class="<?php echo isset($_ERROR_VALID['toopassword']) ? 'error' : ''; ?>" required>
        <?php if (isset($_ERROR_VALID['toopassword'])):?>
            <div class="error-message"><? echo $_ERROR_VALID['toopassword']?></div>
        <?php endif; ?>
        <br>
        <input type="hidden" name="action" value="register">
        <input class="zareg" type="submit" value="Зарегистрироваться" id="button">
    </form>
</main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/footer.php';?>