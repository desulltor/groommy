<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/header.php'?>
    <main class="dog">
        <section class="container kl">
            <h2>Стрижка собак</h2>
            <div class="mb-3 fl">
                <form action="" method="post">
                    <input type="text" class="form-control" name="inpBreed" id="exampleFormControlInput1" placeholder="Поиск">
                    <button class="btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="row pr">
                <h4 class="col-1">Породы:</h4>
                <span class="porod col-6">
                    <a href="/?dog&size=small" class="<?= ($_GET['size'] ?? 'small') === 'small' ? 'eto' : '' ?>">Мелкие</a>
                    <a href="/?dog&size=middle" class="<?= ($_GET['size'] ?? '') === 'middle' ? 'eto' : '' ?>">Средние</a>
                    <a href="/?dog&size=big" class="<?= ($_GET['size'] ?? '') === 'big' ? 'eto' : '' ?>">Крупные</a>
                </span>
            </div>
            <div class="vidy">
                <?php if($inputBreed !== ''):
                    foreach ($filteredBreeds as $name => $image):?>
                    <a>
                        <div class="item_dog">
                            <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($name) ?>">
                        </div>
                        <div class="item_dog_title">
                            <?= htmlspecialchars($name) ?>
                        </div>
                    </a>
                <? endforeach;  else:
                $selectedSize = $_GET['size'] ?? 'small';
                if(isset($breeds[$selectedSize])):
                    foreach ($breeds[$selectedSize] as $name => $image):?>
                <a>
                    <div class="item_dog">
                        <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($name) ?>">
                    </div>
                    <div class="item_dog_title">
                        <?= htmlspecialchars($name) ?>
                    </div>
                </a>
                <? endforeach; endif; endif;?>
            </div>
        </section>
        <section class="usl container">
            <h2>Все услуги</h2>
            <div class="cusl">
                <div class="row">
                    <p class="col-8">Комплекс со стрижкой</p>
                    <p class="col-2 t">~ 130 мин</p> 
                    <p class="col-2">от 2 480 ₽</p>
                </div>
                <div class="row">
                    <p class="col-8">Комплекс с экспресс-линькой</p>
                    <p class="col-2 t">~ 90 мин</p>
                    <p class="col-2">от 2 480 ₽</p>
                </div>
                <div class="row">
                    <p class="col-8">Подготовка к выставке</p>
                    <p class="col-2 t">~ 190 мин</p>
                    <p class="col-2">от 3 310 ₽</p>
                </div>
                <div class="row">
                    <p class="col-8">Мытье-сушка, включая гигиену</p>
                    <p class="col-2 t">~ 90 мин</p>
                    <p class="col-2">от 1 660 ₽</p>
                </div>
                <div class="row">
                    <p class="col-8">Папильотки</p>
                    <p class="col-2 t">~ 130 мин</p>
                    <p class="col-2">от 2 480 ₽</p>
                </div>
                <div class="row">
                    <p class="col-8">Подстричь и выщипать уши</p>
                    <p class="col-2 t">~ 20 мин</p>
                    <p class="col-2">от 480 ₽</p>
                </div>
                <div class="row i">
                    <p class="col-12">Для уточнения стоимости услуги перейдите на страницу конкретной породы или свяжитесь с нами любым удобным способом</p>
                </div>
            </div>
        </section>
        <section class="zap container" id="zap">
            <h2 class="text-center"> Записаться на услугу</h2>
            <div class="row">
                <div class="col-xl-6 col-12">
                    <div class="card">
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
                <div class="col-xl-6 col-12">
                    <div class="card">
                        <img src="assets/media/zap_2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-center">Либо оставьте онлайн‑заявку</h5>
                            <a href="#zap" class="btn t">Записать питомца</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="container master" id="master">
            <div class="verh">
                <h2>Наши мастера</h2>
                <a href="?master"><button>Все мастера &#8594</button></a>
            </div>
            <div class="row">
                <?php foreach ($limited_masters as $master): ?>
                    <div class="col-xl-3 col-md-6 col-12">
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
        <section class="container pod">
        <div class="row">
        <div class="col-6">
            <h2 class="ct">Подробнее о стрижке собак</h2>
            <p>Груминг для собак пользуется большой популярностью среди владельцев хвостатых разных пород.
            
            Оно и ясно, ведь профессиональный уход за собаками, во-первых, существенно облегчает жизнь хозяевам хвостатых в
            городских джунглях. А, во-вторых, регулярный груминг – профилактика серьезных проблем со здоровьем собак.</p>
            <div class="grey">
                <h3>Груминг для собак</h3>
                <p> В момент активной линьки заботливые руки грумера могут помочь владельцу собаки избавиться от шерстяных завалов в
                        квартире. Удаление старых отмерших волосков будет способствовать благоприятному росту новой здоровой и блестящей шерсти
                        пса.
                        
                        Многих хозяев беспокоит вопрос: как распутать колтуны у собаки? Ведь спутанная шерсть – это благоприятная среда для
                    развития грибка и микроорганизмов. Помимо всего прочего колтуны могут вызывать сильный зуд и боль.</p>
            </div>
        </div>
        <div class="col-6">
            <div class="grey">
                <h3>Стрижка когтей у собак</h3>
                <p>У других же владельцев хвостатых проблемы со стрижкой когтей своим любимцам. Собака вертится, скулит, вечно норовит
                убежать. Одно неловкое движение и стрижка когтей превращается в драму с повреждением сосуда. А если когти не стричь, то
                это чревато еще более серьезными последствиями: от врастания когтя в подушечку лапы до болезней внутренних органов. Так
                как подстричь когти собаке?
                
                Ответ на любой запрос прост – профессиональный груминг для собак рядом с домом в зоосалоне GROOM. И гладкошерстные
                собаки и длинношерстные собаки заслуживают тщательный уход в груминг салоне.
                
                Регулярная и системная забота о питомце – это лучшая профилактика спутанной шерсти, длинных когтей и грязи дома.</p>
            </div>
        </div>
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
