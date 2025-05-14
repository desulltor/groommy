<?php
session_start();
//главная страница
include $_SERVER['DOCUMENT_ROOT'] . '/assets/includes/db-inc.php';
$breed_name = isset($_GET['breed']) ? trim($_GET['breed']) : 'Шпиц';
$breed = $breed_name . '%';
$image_paths = [];
try{
    $sql = "SELECT * FROM services WHERE breed LIKE :breed";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':breed', $breed, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        foreach ($results as $service) {
            $image_path = $service['examples'] ?? '';
            $image_path = htmlspecialchars($image_path);
            $image_paths[] = $image_path;
        }
    }
    $max_images = 3;
    $limited_image_paths = array_slice($image_paths, 0, $max_images);
}catch (PDOException $e){
    $error_message = $e->getMessage();
}
//модальное окно
try{
    $sql_pets = 'SELECT * FROM pets WHERE id_user = :id';
    $stmt_pets = $pdo->prepare($sql_pets);
    $stmt_pets->bindParam(':id', $_SESSION['id']);
    $stmt_pets->execute();
    $pets = $stmt_pets->fetchAll(PDO::FETCH_ASSOC);
}catch (PDOException $e){
    $error_message = $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pet_id'])) {
    $pet_id = $_POST['pet_id'];
    header('Location: '.$_SERVER['PHP_SELF']);
    exit;
}
//мастера
$post = 'Груммер';
try {
    $sql_master = 'SELECT * FROM users WHERE post LIKE :post';
    $stmt_master = $pdo->prepare($sql_master);
    $stmt_master->bindValue(':post', '%' . $post . '%', PDO::PARAM_STR);
    $stmt_master->execute();
    $masters = $stmt_master->fetchAll(PDO::FETCH_ASSOC);
    $limited_masters = array_slice($masters, 0, 4);
} catch (PDOException $e) {
    $error_message = 'Ошибка при загрузке данных мастеров: ' . $e->getMessage();
}
//собаки
$breeds = [
    'small' => [
        'Шпиц' => 'assets/media/dog_1.jpg',
        'Йоркширский терьер' => 'assets/media/dog_2.jpg',
        'Чихуахуа' => 'assets/media/dog_3.jpg',
        'Мальтезе' => 'assets/media/dog_4.jpg',
        'Грифон' => 'assets/media/dog_5.jpg'
        ],
    'middle' => [
        'Пудель' => 'assets/media/dog_6.webp',
        'Мальтипу' => 'assets/media/dog_7.webp',
        'Ши-тцу' => 'assets/media/dog_8.webp',
        'Бишон фризе' => 'assets/media/dog_9.webp',
        'Корги' => 'assets/media/dog_10.webp',
        'Кавалер Кинг Чарльз Спаниель' => 'assets/media/dog_11.webp',
        'Вест Хайленд Уайт Терьер' => 'assets/media/dog_12.webp',
        'Французский бульдог' => 'assets/media/dog_13.webp',
        'Американский кокер спаниель' => 'assets/media/dog_14.webp',
        'Цвергшнауцер' => 'assets/media/dog_15.webp',
        'Пекинес' => 'assets/media/dog_16.webp',
        'Джек Рассел Терьер' => 'assets/media/dog_17.webp',
        'Китайская хохлатая' => 'assets/media/dog_18.webp',
        'Миттельшнауцер' => 'assets/media/dog_19.webp',
        'Сиба-ину' => 'assets/media/dog_20.webp',
        'Такса' => 'assets/media/dog_21.webp'
    ],
    'big' => [
        'Хаски' => 'assets/media/dog_22.webp',
        'Голден ретривер' => 'assets/media/dog_23.webp',
        'Бернский зенненхунд' => 'assets/media/dog_24.webp',
        'Метис' => 'assets/media/dog_25.webp',
        'Самоед' => 'assets/media/dog_26.webp',
        'Чау-чау' => 'assets/media/dog_27.webp',
        'Лабрадор' => 'assets/media/dog_28.webp'
    ]
];
$inputBreed = $_POST['inpBreed'] ?? '';
$filteredBreeds = [];
if (!empty($inputBreed)) {
    foreach ($breeds as $size => $sizeBreeds) {
        foreach ($sizeBreeds as $name => $image) {
            if (stripos($name, $inputBreed) !== false) {
                $_GET['size'] = $sizeBreeds;
                $filteredBreeds[$name] = $image;
            }
        }
    }
}

if(isset($_GET['master'])){
    include 'master.php';
    exit();
}else if(isset($_GET['dog'])){
    include 'dog.php';
    exit();
}else if(isset($_GET['cat'])){
    include 'cat.php';
    exit();
}
include 'groommy.php';
