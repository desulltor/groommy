<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/header.php'?>
    <main class="ms">
        <section class="container master" id="master">
            <div class="verh">
                <h2>Наши мастера</h2>
            </div>
            <div class="row">
                <?php foreach ($masters as $master): ?>
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img src="<?= htmlspecialchars($master['avatar'])?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($master['firstname'] . ' ' . $master['lastname'])?></h5>
                                <p class="card-text"><?= htmlspecialchars($master['post']) ?></p>
                                <a href="#zap" class="btn">Записаться</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
        <section class="zap" id="zap">
        <div class="container">
            <h2 class="text-center"> Записаться на услугу</h2>
            <div class="row">
                <div class="col-6">
                    <div class="card" style="width: 38rem;">
                        <img src="assets/media/zap_1.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">Позвоните или напишите в мессенджер</h5>
                            <div class="socials">
                                <a href="#" class="btn"><img src="assets/media/vk.png" alt="" width="60"></a>
                                <a href="#" class="btn"><img src="assets/media/tg.png" alt="" width="70"></a>
                                <a href="#" class="btn"><img src="assets/media/inst.png" alt="" width="50"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card" style="width: 38rem;">
                        <img src="assets/media/zap_2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">Либо оставьте онлайн‑заявку</h5>
                            <a href="#zap" class="btn t">Записать питомца</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <section class="container adress" id="adress">
            <h2 class="text-center">Адреса салонов в Магнитогорске</h2>
            <div class="cart">
                <script type="text/javascript" charset="utf-8" async
                    src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A4d190b9156614e88dc72ff6eec81d3b224bd05f2fe6b5627c6f05ba17dfe2ef3&amp;width=1058&amp;height=720&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
        </section>
        <!-- Модальное окно -->
        <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="appointmentModalLabel">Запись на услугу</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if (!isLoggedIn()): ?>
                            <p class="text-center auth-message">Для записи необходимо <a href="login" class="auth-link">войти</a> или <a href="register" class="auth-link">зарегистрироваться</a></p>
                        <?php else: ?>
                        <div class="text-center mb-4">
                            <p class="lead-text">Запишитесь онлайн на удобное для вас время</p>
                            <a href="/record" class="btn btn-lg">Записаться онлайн</a>
                        </div>
                        <div class="text-center">
                            <p class="lead-text">Или оставьте заявку и мы свяжемся с вами</p>
                        </div>
                        <form id="appointmentForm" method="post" class="appointment-form">
                            <div class="form-section">
                                <div class="form-group">
                                    <label for="ownerName" class="form-label">Ваше имя</label>
                                    <input type="text" class="form-control" id="ownerName" name="owner_name"
                                           value="<?= isset($_POST['owner_name']) ? htmlspecialchars($_POST['owner_name']) : '' ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="phoneNumber" class="form-label">Телефон</label>
                                    <input type="tel" class="form-control" id="phoneNumber" name="phone"
                                           value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>" required>
                                    <div class="form-hint">Формат: +7 (XXX) XXX-XX-XX</div>
                                </div>
                                <div class="form-group">
                                    <label for="ownerName" class="form-label"> Порода питомца</label>
                                    <input type="text" class="form-control" id="breed_pet" name="breed_pet"
                                           value="<?= isset($_POST['breed_pet']) ? htmlspecialchars($_POST['breed_pet']) : '' ?>" required>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-submit">Записаться на прием</button>
                            </div>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/footer.php'?>
