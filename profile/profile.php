<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/header.php'; ?>
<main>
    <section class="section container prof">
        <h2 class="text-center">Личный кабинет</h2>
        <div class="row">
            <div class="av col">
                <?php if (!empty($avatar)): ?>
                    <img src="<?= htmlspecialchars($avatar) ?>" alt="Аватар пользователя" class="avatar-image">
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                    <?php if (empty($avatar)): ?>
                        <label class="avatar-upload">
                            <input type="file" name="avatar" class="visually-hidden"
                                   accept="image/jpeg, image/png, image/webp">
                            <img src="/assets/media/i.webp" alt="Загрузить аватар" class="avatar-placeholder">
                        </label>
                    <?php endif; ?>

                    <div class="button-row">
                        <?php if (!empty($avatar)): ?>
                            <label class="avatar-upload">
                                <input type="file" name="avatar" class="visually-hidden"
                                       accept="image/jpeg, image/png, image/webp">
                                <span class="btn btn-change">Изменить</span>
                            </label>
                        <?php endif; ?>
                        <button type="submit" name="submit_avatar" class="btn btn-submit">
                            <?= empty($avatar) ? 'Загрузить' : 'Сохранить' ?>
                        </button>
                    </div>
                </form>
            </div>
            <div class="info col">
                <div class="name">
                    <h3>ФИО: <?php echo htmlspecialchars($fio); ?></h3>
                </div>
                <div class="pets">
                    <?php if(!empty($pets)): ?>
                        <?php foreach ($pets as $pet): ?>
                            <div class="card">
                                <?php if (!empty($pet['avatar'])): ?>
                                    <img src="<?php echo htmlspecialchars($pet['avatar']); ?>" alt="Аватар питомца">
                                <?php else: ?>
                                    <label class="avatar-upload">
                                        <img src="/assets/media/i.webp" alt="Загрузить аватар" class="avatar-placeholder">
                                    </label>
                                <?php endif; ?>
                                <p>Кличка: <?php echo htmlspecialchars($pet['name']); ?></p>
                                <p>Вид: <?php echo htmlspecialchars($pet['view']); ?></p>
                                <a href="?info_pet=<?php echo htmlspecialchars($pet['id']); ?>" class="btn">Подробнее</a>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>У вас пока нет питомцев.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php if($i_pet): ?>
        <div class="cardpet row">
            <div class="av col">
                <?php if (!empty($i_pet['avatar'])): ?>
                    <img src="<?= htmlspecialchars($i_pet['avatar']) ?>" alt="Аватар питомца" class="avatar-image">
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                    <?php if (empty($i_pet['avatar'])): ?>
                        <label class="avatar-upload">
                            <input type="file" name="pet_avatar" class="visually-hidden"
                                   accept="image/jpeg, image/png, image/webp">
                            <img src="/assets/media/i.webp" alt="Загрузить аватар" class="avatar-placeholder">
                        </label>
                    <?php endif; ?>
                    <div class="button-row">
                        <?php if (!empty($i_pet['avatar'])): ?>
                            <label class="avatar-upload">
                                <input type="file" name="pet_avatar" class="visually-hidden"
                                       accept="image/jpeg, image/png, image/webp">
                                <span class="btn btn-change">Изменить</span>
                            </label>
                        <?php endif; ?>
                        <button type="submit" name="submit_pet_avatar" class="btn btn-submit">
                            <?= empty($i_pet['avatar']) ? 'Загрузить' : 'Сохранить' ?>
                        </button>
                    </div>
                </form>
            </div>
            <div class="info col">
                <?php if(!isset($_GET['edit_pet'])): ?>
                    <h3>Кличка: <?= htmlspecialchars($i_pet['name']) ?></h3>
                    <p>Вид: <?= htmlspecialchars($i_pet['view']) ?></p>
                    <p>Порода: <?= htmlspecialchars($i_pet['breed'] ?? 'Не указано') ?></p>
                    <p>Дата рождения: <?= htmlspecialchars($i_pet['birth_day'] ?? 'Не указано') ?></p>
                    <p>Пол: <?= htmlspecialchars($i_pet['sex'] ?? 'Не указано') ?></p>
                    <p>Заметки: <?= htmlspecialchars($i_pet['notes'] ?? 'Нет заметок') ?></p>
                    <a href="?info_pet=<?= htmlspecialchars($i_pet['id']) ?>&edit_pet=<?= htmlspecialchars($i_pet['id']) ?>" class="btn">Редактировать</a>
                <?php else: ?>
                    <form method="post" action="?info_pet=<?= htmlspecialchars($i_pet['id']) ?>&save_pet=<?= htmlspecialchars($i_pet['id']) ?>">
                        <h3>Кличка: <input type="text" name="name" value="<?= htmlspecialchars($i_pet['name']) ?>"></h3>
                        <p>Вид: <input type="text" name="view" value="<?= htmlspecialchars($i_pet['view']) ?>"></p>
                        <p>Порода: <input type="text" name="breed" value="<?= htmlspecialchars($i_pet['breed'] ?? '') ?>"></p>
                        <p>Дата рождения: <input type="date" name="birth_day" value="<?= htmlspecialchars($i_pet['birth_day'] ?? '') ?>"></p>
                        <p>Пол:
                            <select name="sex">
                                <option value="М" <?= ($i_pet['sex'] ?? '') == 'М' ? 'selected' : '' ?>>М</option>
                                <option value="Ж" <?= ($i_pet['sex'] ?? '') == 'Ж' ? 'selected' : '' ?>>Ж</option>
                            </select>
                        </p>
                        <p>Заметки: <textarea name="notes"><?= htmlspecialchars($i_pet['notes'] ?? '') ?></textarea></p>
                        <button type="submit" class="btn">Сохранить</button>
                        <a href="?info_pet=<?= htmlspecialchars($i_pet['id']) ?>" class="btn">Отмена</a>
                    </form>
                <?php endif; ?>
            </div>
        </div>
        <?php endif;?>
        <? if(isset($_GET['addPet'])):?>
        <div class="cardpet row">
            <form method="post" action="?addPet&save_pet">
                <div class="row">
                <div class="info col">
                    <p>Кличка: <input type="text" name="name" required></p>
                    <p>Вид: <input type="text" name="view" required></p>
                    <p>Порода: <input type="text" name="breed"></p>
                    <p>Дата рождения: <input type="date" name="birth_day"></p>
                    <p>Пол:
                        <select name="sex" required>
                            <option value="М">М</option>
                            <option value="Ж">Ж</option>
                        </select>
                    </p>
                    <p>Заметки: <textarea name="notes"></textarea></p>
                </div>
                </div>
                <button type="submit" class="btn">Сохранить</button>
                <a href="../profile" class="btn">Отмена</a>
            </form>
        </div>
        <? else:?>
        <a href="?addPet" class="btn">Добавить питомца</a>
        <? endif;?>
    </section>
</main>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/footer.php'; ?>
