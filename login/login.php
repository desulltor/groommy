<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/header.php'; ?>
    <main>
        <h2 class="regh text-center">Вход</h2>
        <?php if (isset($_SESSION['loginError'])): ?>
            <p class="error"><?php echo htmlspecialchars($_SESSION['loginError']); unset($_SESSION['loginError']); ?></p>
        <?php endif; ?>
        <form class="vhod container" method="post">
            <input type="email" name="email" placeholder="Введите логин или номер телефона" id="" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            <br>
            <input type="password" name="password" placeholder="Введите пароль" id="">
            <br>
            <input type="hidden" name="action" value="login">
            <input type="submit" name="submit" value="Войти" id="button">
            <br>
            <p class="text-center">Нет аккаунта? | <a href="/register">Зарегистрироваться</a></p>
        </form>
    </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/footer.php'; ?>