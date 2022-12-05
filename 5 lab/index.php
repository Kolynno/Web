<?php
    session_start();
    $cartArray = [
        1=>0,
        2=>0,
        3=>0,
        4=>0,
        5=>0,
        6=>0,
        7=>0,
        8=>0,
    ];
    $_SESSION["cart"] = $cartArray;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 1</title>
    <link rel="stylesheet" href="styles/style.css?v=1">
</head>
<body>
<!--
 COLORS:
 Buttons (lighter): #d89999
 Text and low block and footer (light): #ae7c78
 Text: white;
 -->
<header>
    <div class="header_text"><a class="links" href="/catalog.php?id=0">Каталог</a></div>
    <div class="header_text">Доставка и оплата</div>
    <div class="header_text">Отзывы</div>
    <div class="header_text">Спецпредложения</div>
    <div class="header_text">Контакты</div>
    <div class="header_text"><a class="links" href="/cart.php?id=0">Корзина</a></div>
</header>

<div class="fc">
    <div class="fc_text">
        <h1 class="fc_main_text">Авторские букеты<p><i> в Петербурге</i></p></h1>
        <h2 class="fc_second_text">Оригинальные свежие букеты<p>с доставкой по всему городу</p></h2>
        <div class="fc_button">
            <a class="links" href="/catalog.php?id=0">Смотреть каталог</a>
        </div>
    </div>
    <div class="fc_pict">
        <img class="fc_img"  src="img/fc_img.png">
    </div>
</div>

<div class="about">
    <div class="about_item">
        <div class="about_item_img">
            <img src="img/about_img1.png">
        </div>
        <div class="about_item_text">
            <h3>Быстрая доставка</h3>
            <p>Можем собрать букет и передать его в доставку всего за час.</p>
        </div>
    </div>
    <div class="about_item">
        <div class="about_item_img">
            <img src="img/about_img2.png">
        </div>
        <div class="about_item_text">
            <h3>Всегда свежие цветы</h3>
            <p>Тщательно следим за состоянием цветов, а опытные флористы отбирают для букетов каждый цветок.</p>
        </div>
    </div>
    <div class="about_item">
        <div class="about_item_img">
            <img src="img/about_img3.png">
        </div>
        <div class="about_item_text">
            <h3>Отправляем фото цветов</h3>
            <p>Перед доставкой сделаем фотографию букета и отправим вам.</p>
        </div>
    </div>
</div>
<div class="popular_title">
    <h1>Популярные букеты</h1>
</div>
<div class="popular">
    <div class="popular_text">
            <h1>Букет "Нежность"</h1>
            <h3>Элегантный букет, который станет отличным подарком на день рождения или юбилей</h3>
            <h3>30 x 40 см</h3>
            <h1>3600 руб.</h1>
            <div class="popular_button">
                Заказать
            </div>
    </div>
    <div class="popular_pict">
        <img src="img/popular.png">
    </div>
</div>
<div class="sale_container">
    <div class="sale_container_text">
        <h1>Скидка 10% на первый заказ</h1>
        <h2>Если заказываете у нас букет впервые - при оформлении заказа введите промокод "Botanika2021" и получите скидку 10%</h2>
    </div>
    <div class="sale_container_pict">
        <img src="img/sale_img.png">
    </div>
</div>
<div class="wrapper_comments_container">
    <div class="comments_container_title">
        <h1>Отзывы</h1>
    </div>
    <div class="comments_container">
        <div class="comments_container_item">
            <p class="comments_container_item_text">
                Все очень понравилось! Быстрое оформление заказа, выбор удобного времени доставки. Всем большое спасибо!
            </p>
            <p class="comments_container_item_name">
                    Марина
            </p>
        </div>
        <div class="comments_container_item">
            <p class="comments_container_item_text">
                Внимательные флористы, вежливые. Магазин находится прям рядом с метро. Букет очень понравился, буду еще заказывать!
            </p>
            <p class="comments_container_item_name">
                    Татьяна
            </p>
        </div>
        <div class="comments_container_item">
            <p class="comments_container_item_text">
                Выбор букетов на любой вкус и цену. Бывают хорошие скидки, а флористы всегда помогут и точно соберут красивый букет!
            </p>
            <p class="comments_container_item_name">
                    Ольга
            </p>
        </div>
    </div>
</div>
<footer>
    <div class="footer_text"><a class="links" href="/catalog.php?id=0">Каталог</a></div>
    <div class="footer_text">Доставка и оплата</div>
    <div class="footer_text">Отзывы</div>
    <div class="footer_text">Спецпредложения</div>
    <div class="footer_text">Контакты</div>
</footer>
</body>
</html>