<?php
    session_start();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 1:Catalog</title>
    <link rel="stylesheet" href="styles/styleCatalog.css?v=2">
    <script src="script.js"></script>
</head>
<body>
<header>
    <div class="header_text"><a class="links" href="/index.php">На главную страницу</a></div>
    <div class="header_text">Доставка и оплата</div>
    <div class="header_text">Отзывы</div>
    <div class="header_text">Спецпредложения</div>
    <div class="header_text">Контакты</div>
    <div class="header_text"><a class="links" href="/cart.php?id=0">Корзина</a></div>
</header>

    <?php

    if ($_SERVER['REQUEST_METHOD'] === "GET") { //Обработка только при GET запросе

        $idToCart =  $_GET['id']; //получаю id предмета
        //инкрементирую нужное значение с помощью цикла, который перебирает все значения из SESSION cart, в которой хранятся значения кол-ва предметов к покупке
        for ($i = 1; $i <= count($_SESSION["cart"]); $i++ ){
            if ($idToCart == $i) {
                $_SESSION["cart"][$i]++;
            }
        }
        //В этом случае очизаю корзину (когда id=-1)
        if ($idToCart == -1) {
            for ($i = 1; $i <= count($_SESSION["cart"]); $i++ ) {
                $_SESSION["cart"][$i] = 0;
            }
        }
        //ВРЕМЕННО, показываю данные себе
        print("Данные из \$_SESSION['cart'], в которой хранятся данные о покупке: ");
        print_r($_SESSION["cart"]);
        print("</br>");
    }
  ?>

<a href="?cart=clean&id=-1">Очистить корзину</a>
<div class="main">
    <div class="searchOptions">
        <form> <!-- Скрипт выполнения и метод отправки-->
            Поиск по названию товара:<input id="nameOfProductText" type ="text" name = "name" size="30" maxlength="30"/> <br>
            Диапозон цен: <input id="priceMin"  type="number" name = "minCost" max="9999" min="0" /> -
            <input id="priceMax"  type="number" name = "maxCost" max="9999" min="0"/> руб.<br>
            Поиск по описанию товара:<input id="description"  type ="text" name = "description" size="30" maxlength="30"/> <br>

        </form>
        <button onclick="searching()">Отобрать</button>
    </div>

    <div class="items" id="itemsList">

        <script>
            //означанет, что при первой загрузке надо отобразить все букеты
            var arrayAll = [0,1,2,3,4,5,6,7];
            //функция из script.js
            createAll(arrayAll);
        </script>

    </div>




</body>
</html>