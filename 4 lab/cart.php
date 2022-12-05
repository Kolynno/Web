<?php
    session_start();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 1:Cart</title>
    <link rel="stylesheet" href="styles/cart.css?v=2">
</head>
<body>
<header>
    <div class="header_text"><a class="links" href="/index.php">На главную страницу</a></div>
    <div class="header_text">Доставка и оплата</div>
    <div class="header_text">Отзывы</div>
    <div class="header_text">Спецпредложения</div>
    <div class="header_text">Контакты</div>
    <div class="header_text"><a class="links" href="/catalog.php?id=0">Каталог</a></div>
</header>
<?php
//Так же сложный способ хранение данных, как и в catalog.php
$catalogItems = [
    1 => '<div class="item">
                    <div class="item_pic">
                        <img src="https://www.6665666.ru/sites/default/files/inline/images/state43-1.jpg" alt="Фото букета">
                    </div>
                    <div class="description">
                        <h2>Название: Красивый букет 1</h2>
                        <h3>Цена: 2000 руб.</h3>
                        <h4>Описание: Содержит в себе 5 роз и 7 фиалок разных цветов. Ароматный запах и сочный цвет придают элегантность букету</h4>
                    </div>
                </div>',
    2 => '  <div class="item">
            <div class="item_pic">
                <img src="https://www.6665666.ru/sites/default/files/inline/images/state43-1.jpg" alt="Фото букета">
            </div>
            <div class="description">
                <h2>Название: Яркий день </h2>
                <h3>Цена: 2500 руб.</h3>
                <h4>Описание: Содержит в себе 3 роз и 15 фиалок разных цветов</h4>
            </div>
    </div>',
    3 => '<div class="item">
            <div class="item_pic">
                <img src="https://www.6665666.ru/sites/default/files/inline/images/state43-1.jpg" alt="Фото букета">
            </div>
            <div class="description">
                <h2>Название: Новый год 2017 </h2>
                <h3>Цена: 3500 руб.</h3>
                <h4>Описание: Отличный букет на 2017 год</h4>
            </div>
        </div>',
    4 => '<div class="item">
            <div class="item_pic">
                <img src="https://www.6665666.ru/sites/default/files/inline/images/state43-1.jpg" alt="Фото букета">
            </div>
            <div class="description">
                <h2>Название: Любимая </h2>
                <h3>Цена: 4990 руб.</h3>
                <h4>Описание: Наш лучший букет для вас</h4>
            </div>
        </div>',
    5 => '<div class="item">
            <div class="item_pic">
                <img src="https://www.6665666.ru/sites/default/files/inline/images/state43-1.jpg" alt="Фото букета">
            </div>
            <div class="description">
                <h2>Название: Королевский букет</h2>
                <h3>Цена: 1500 руб.</h3>
                <h4>Описание: 7 роз и 9 ромашек</h4>
            </div>
        </div>',
    6 => ' <div class="item">
            <div class="item_pic">
                <img src="https://www.6665666.ru/sites/default/files/inline/images/state43-1.jpg" alt="Фото букета">
            </div>
            <div class="description">
                <h2>Название: Новочеркасск </h2>
                <h3>Цена: 300 руб.</h3>
                <h4>Описание: 1 роза </h4>
            </div>
        </div>',
    7 => '<div class="item">
            <div class="item_pic">
                <img src="https://www.6665666.ru/sites/default/files/inline/images/state43-1.jpg" alt="Фото букета">
            </div>
            <div class="description">
                <h2>Название: Собачье счастье </h2>
                <h3>Цена: 500 руб.</h3>
                <h4>Описание: 11 одуванчиков</h4>
            </div>
        </div>',
    8 => ' <div class="item">
            <div class="item_pic">
                <img src="https://www.6665666.ru/sites/default/files/inline/images/state43-1.jpg" alt="Фото букета">
            </div>
            <div class="description">
                <h2>Название: Маяковскый</h2>
                <h3>Цена: 1500 руб.</h3>
                <h4>Описание: Я волком бы выгрыз бюрократизм.
                    К букетам почтения нету.
                    К любым чертям с матерями катись
                    любая цветочка. Но этот…[букет Маяковскый]</h4>
            </div>
            </div>',
];


$catalogItemsCost = [
    1=>2000,
    2=>2500,
    3=>3500,
    4=>4990,
    5=>1500,
    6=>300,
    7=>500,
    8=>1500,
];

if ($_SERVER['REQUEST_METHOD'] === "GET") { //Обработка только при GET запросе

    //Как и в catalog.php - очищение корзины
    $idToCart =  $_GET['id'];
    if ($idToCart == -1) {
        for ($i = 1; $i <= count($_SESSION["cart"]); $i++ ) {
            $_SESSION["cart"][$i] = 0;
        }
    }
    //ВРЕМЕННО: вспомогательные данные
    print("Данные из \$_SESSION['cart'], в которой хранятся данные о покупке: ");
    print_r($_SESSION["cart"]);
    print("</br>");
}
?>
<a href="?cart=clean&id=-1">Очистить корзину</a>
<div class="items">
<?php

    $sum = 0;//сумма к покупке
    $amount = 0;// кол-во предметов к покупке
    //Выбираю в цикле все значения из SESSION cart. А во внутр. цикле вывожу нужное кол-во раз предмет,
    // а еще считаю сумму и кол-во предметов к покупке
    for ($i = 1; $i <= count($_SESSION["cart"]); $i++ ){
       $count = $_SESSION['cart'][$i];
       for ($j = 0; $j < $count; $j++) {
           echo($catalogItems[$i]);
           $sum = $sum + $catalogItemsCost[$i];
           $amount++;
       }
    }
?>

    <h1> Сумма к оплате: <?php echo($sum); ?> руб.,
     количество цветов: <?php echo($amount); ?> шт.</h1>
</div>
</body>
</html>