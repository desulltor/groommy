<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/header.php';?>
    <main>
        <section class="priv">
            <div class="row">
                <div class="in col-xl-6 col-md-12 col-12">
                    <h2>Стрижка <br>
                        собак и <br>
                        кошек</h2>
                    <p>Ухоженные питомцы, с гладкой шерстью и <br>
                        красивой стрижкой, как дорогая известная <br>
                        картина, которой любуется весь мир</p>
                    <a href="#zap" class="btn-zap">
                        Записать питомца!
                    </a>
                    <a href="#akc" class="">
                        <button>
                            <i class="fa-solid fa-angle-down"></i>
                        </button>
                    </a>
                </div>
                <div class="col-xl-6">
                    <img src="assets/media/p.png" alt="">
                </div>
            </div>
        </section>
        <section class="uslg text-center" id="uslg">
            <h2>
                Наши услуги на популярные <br>
                породы питомцев
            </h2>
            <span class="porod">
                <a href="?breed=Шпиц" class="<?= ($breed_name === 'Шпиц') ? 'eto' : '' ?>" id="p">Шпиц</a>
                <a href="?breed=Йорк" class="<?= ($breed_name === 'Йорк') ? 'eto' : '' ?>" id="p">Йоркширский терьер</a>
                <a href="?breed=Пудель" class="<?= ($breed_name === 'Пудель') ? 'eto' : '' ?>" id="p">Пудель</a>
                <a href="?breed=Чихуахуа" class="<?= ($breed_name === 'Чихуахуа') ? 'eto' : '' ?>" id="p">Чихуахуа</a>
                <a href="?breed=Мальтезе" class="<?= ($breed_name === 'Мальтезе') ? 'eto' : '' ?>" id="p">Мальтезе</a>
            </span>
            <div class="row">
                <div id="carouselExample" class="carousel slide col-xl-4 col-md-12" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php if (!empty($limited_image_paths)): ?>
                            <?php foreach ($limited_image_paths as $index => $image_path): ?>
                                <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>">
                                    <img src="assets/media/<?php echo $image_path; ?>" class="d-block w-100" alt="Image <?php echo $index + 1; ?>">
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No images found for <?php echo htmlspecialchars($breed_name); ?></p>
                        <?php endif; ?>
                    </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            </div>
                <div class="accordion accordion-flush col-4" id="accordionFlushExample">
                <?php
                $current_breed = null;
                if ($results) {
                    foreach ($results as $row) {
                        if ($row['breed'] != $current_breed) {
                            if ($current_breed !== null) {
                                echo '          </div>'; // accordion-body
                                echo '        </div>'; // accordion-collapse
                                echo '      </div>'; // accordion-item
                            }
                            $current_breed = $row['breed'];
                            $id = str_replace(' ', '', $current_breed);
                            $active_class = ($breed_name == $current_breed) ? 'eto' : '';
                            echo '      <div class="accordion-item">';
                            echo '        <h2 class="accordion-header">';
                            echo '          <button class="accordion-button collapsed breed-button ' . $active_class . '" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse' . $id . '" aria-expanded="false" aria-controls="flush-collapse' . $id . '" id="breed-button-' . $id . '">';
                            echo htmlspecialchars($current_breed);
                            echo '          </button>';
                            echo '        </h2>';
                            echo '        <div id="flush-collapse' . $id . '" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">';
                            echo '          <div class="accordion-body">';
                        }
                        echo '            <div class="service-item">';
                        echo '                <div class="service-title-price">';
                        echo '                    <h3 class="service-title">' . htmlspecialchars($row['title']) . '</h3>';
                        echo '                    <span class="service-price">' . htmlspecialchars(number_format($row['price'], 0, '', ' ')) . ' ₽</span>';
                        echo '                </div>';
                        if ($row['description'] != '') {
                            echo '                <p class="service-description">' . htmlspecialchars($row['description']) . '</p>';
                        }
                        echo '                <hr class="service-divider">';
                        echo '            </div>';
                    }
                    if ($current_breed !== null) {
                        echo '          </div>'; // end accordion-body
                        echo '        </div>'; // end accordion-collapse
                        echo '      </div>'; // end accordion-item
                    }
                }
                echo '      <div class="accordion-item rec">';
                echo '        <h4 class="accordion-header">';
                echo '          Рекомендуем делать гигиену минимум 1 раз в месяц, а комплекс 1 раз в 2 месяца';
                echo '        </h4>';
                echo '      </div>'; // end accordion-item
                echo '    </div>'; // end accordion-flush
                ?>
            </div>
        </section>
        <section class="container akc" id="akc">
            <h2> Акции и спецпредложения</h2>
            <div class="row">
                <div class="col-xl-6 col-md-12 col-12">
                    <div class="card">
                        <img src="assets/media/akc_1.jpeg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Программа лояльности «Заботливый хозяин»</h5>
                          <p class="card-text">При посещении салона каждый месяц мы фиксируем скидку 20%, если вы приходите раз в 2 месяца -10%.</p>
                          <a href="#zap" class="btn">Записаться</a>
                        </div>
                      </div>
                </div>
                <div class="col-xl-6 col-md-12 col-12">
                    <div class="card">
                        <img src="assets/media/akc_2.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">-20% для щенков до 6 месяцев</h5>
                          <p class="card-text1">Дарим скидку самым маленьким</p>
                          <a href="#zap" class="btn">Записаться</a>
                        </div>
                      </div>
                </div>
            </div>
        </section>
        <section class="my" id="my">
        <div class="ctn">
            <div class="row">
                <div class="col-xl-2 col-md-4 col-4">
                    <img src="assets/media/1.jpg" alt="">
                </div>
                <div class="col-xl-2 col-md-4 col-7">
                    <p>Лучший салон в городе</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-7 col-4">
                    <img src="assets/media/3.jpg" alt="">
                </div>
                <div class=" col-xl-6 col-md-4 col-6">
                    <div class="o">
                       <p>На протяжении 11 лет заботимся о ваших питомцах</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl"></div>
                <div class="col-xl"></div>
                <div class="col-xl col-md-8 col-7">
                    <p>Салон года 2017 и 2020</p>
                </div>
                <div class="col-xl col-md-4 col-3">
                    <img src="assets/media/2.jpg" alt="">
                </div>
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
        <section class="container strij" id="strij">
            <div class="row">
                <div class="col-xl-4  col-md-12 col-12">
                    <img src="assets/media/str_1.jpg" alt="" width="400">
                </div>
                <div class="col-xl-4  col-md-12 col-12">
                    <img src="assets/media/str_2.jpg" alt="" width="400">
                </div>
                <div class="col-xl-4  col-md-6 col-12">
                    <img src="assets/media/str_3.jpg" alt="" width="400">
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4  col-md-12 col-12">
                    <img src="assets/media/str_4.jpg" alt="" width="400">
                </div>
                <div class="col-xl-4  col-md-12 col-12">
                    <img src="assets/media/str_5.jpg" alt="" width="400">
                </div>
                <div class="col-xl-4  col-md-12 col-12">
                    <img src="assets/media/str_6.jpg" alt="" width="400">
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
        <section class="container adress" id="adress">
            <h2 class="text-center">Адреса салонов в Магнитогорске</h2>
            <div class="cart">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A4d190b9156614e88dc72ff6eec81d3b224bd05f2fe6b5627c6f05ba17dfe2ef3&amp;lang=ru_RU&amp;scroll=true" class="cr"></script>
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
<?php include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/footer.php';?>
