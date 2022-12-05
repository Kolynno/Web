<?php
    session_start();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Lab 1:Catalog</title>
    <link rel="stylesheet" href="styles/styleCatalog.css?v=2">
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
    $all = true; //Переменная, нужная, чтобы выводить либо все, либо часть, найденную по поиску
    //Да, ужасный способ, но это массив, хранящий все текущие данные о вещях
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
                    <div class="toCart">
                        <h3><a class="cartLink" href="?id=1">Добавить в корзину</a></h3>
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
            <div class="toCart">
                <h3><a class="cartLink" href="?id=2">Добавить в корзину</a></h3>
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
            <div class="toCart">
                <h3><a class="cartLink" href="?id=3">Добавить в корзину</a></h3>
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
            <div class="toCart">
                <h3><a class="cartLink" href="?id=4">Добавить в корзину</a></h3>
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
            <div class="toCart">
                <h3><a class="cartLink" href="?id=5">Добавить в корзину</a></h3>
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
            <div class="toCart">
                <h3><a class="cartLink" href="?id=6">Добавить в корзину</a></h3>
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
            <div class="toCart">
                <h3><a class="cartLink" href="?id=7">Добавить в корзину</a></h3>
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
            <div class="toCart">
               <h3><a class="cartLink" href="?id=8">Добавить в корзину</a></h3>
            </div>
            </div>',
    ];
    if ($_SERVER['REQUEST_METHOD'] === "GET") { //Обработка только при GET запросе


        $idToCart =  $_GET['id'];//получаю id предмета
        //инкрементирую нужное значение с помощью цикла, который перебирает все значения из SESSION cart,
        // в которой хранятся значения кол-ва предметов к покупке
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

    if ($_SERVER['REQUEST_METHOD'] === "POST") { //Обработка только при POST запросе
        //Получае все данные для обработки с помощью пост заброса
        $name = $_POST['name'];
        $minCost = $_POST['minCost'];
        $maxCost = $_POST['maxCost'];
        $description = $_POST['description'];
        $whatPrintArray = array(); //массив, в который буду записывать id предметов к выводу
        $rememberFirst = 0; //перменные, запомнят кол-во предметов уже к вывыду, нужно для реализации вывода
        $rememberSecond = 0;

        //Да, плохая идея, но  далее 3 массива, хранящих данные о предметах
        $catalogItemsNames = [
                1=>'Красивый букет 1',
                2=>'Яркий день',
                3=>'Новый год 2017',
                4=>'Любимая',
                5=>'Королевский букет',
                6=>'Новочеркасск',
                7=>'Собачье счастье',
                8=>'Маяковскый',
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

        $catalogItemsDescription = [
                1=> "Содержит в себе 5 роз и 7 фиалок разных цветов. Ароматный запах и сочный цвет придают элегантность букету",
                2=> "Содержит в себе 3 роз и 15 фиалок разных цветов",
                3=> "Отличный букет на 2017 год",
                4=> "Наш лучший букет для вас",
                5=> "7 роз и 9 ромашек",
                6=> "1 роза",
                7=> "11 одуванчиков",
                8=> "Я волком бы выгрыз бюрократизм. К букетам почтения нету. К любым чертям с матерями катись любая цветочка. Но этот…[букет Маяковскый]",
        ];



        //Если USER вписал в поле "поиск по названию товара", то убираем печатанье всего   $all = false,
       //В цикле по кол-ву товаров перебираю так, чтобы можно было сравнить 2 переменные (Имя, которое указал USER == Имя, которое есть в массиве с именами)
        //Причем привожу к нижнему регистру. А далее добавляю в массив для вывода
            if ($name != "") {
                $all = false;
                for ($i = 1; $i < 9; $i++) {
                    $first = mb_strtolower($catalogItemsNames[$i]);
                    $second = mb_strtolower($name);
                    if ($first == $second ) {
                        array_push($whatPrintArray, $i);
                        //echo($catalogItems[$i]);
                    }
                }
            }
        //Если USER указал ценовой диапозон (хотя бы 1), то проверяю его диапозон и убираю печатанье всех предметов
        //$all = false, В цикле как и выше проверяю, что данные от USER совпадают с данными из массива цен и нужные
        //Предметы снова добавляю в массив на вывод
            if ($minCost != "" || $maxCost != "" ) {
                $rememberFirst = count($whatPrintArray); //запоминает сколько было до этого найдено
                if ($minCost == "") {$minCost = 0;}
                if ($maxCost == "") {$maxCost = 9999;}
                $all = false;
                for ($i = 1; $i < 9; $i++) {
                    if ( ($catalogItemsCost[$i] >= $minCost) && ($catalogItemsCost[$i] <= $maxCost) ) {

                        if ( !(in_array($i,$whatPrintArray) )) {
                            array_push($whatPrintArray, $i);
                        }
                        //echo($catalogItems[$i]);
                    }
                }
            }
            //Если USER указал описание, то убираю все на печать ($all = false), создаю массив, в котором будут все слова
            //которые  указал USER. В цикле перебираю как и раньше и нахожу подстроку в строке с описанием каждого предмета
            //Если такая сущ., то данный предмет добавляю в массив на вывод
            if ($description != "") {
                $rememberSecond = count($whatPrintArray); //запоминает сколько было до этого найдено
                $all = false;
                $descriptionArray = explode(" ", $description);
                for ($i = 0; $i < count($descriptionArray); $i++) {
                    for ($j = 1; $j < 9; $j++) {
                        if ( str_contains($catalogItemsDescription[$j], $descriptionArray[$i]) ) {
                            if ( !(in_array($i,$whatPrintArray) )) {
                                array_push($whatPrintArray, $j);

                            }
                        }
                    }
                }
            }
    }

    ?>
<a href="?cart=clean&id=-1">Очистить корзину</a>
<div class="main">
    <div class="searchOptions">
        <form action="/catalog.php" method="POST"> <!-- Скрипт выполнения и метод отправки-->
            Поиск по названию товара:<input type ="text" name = "name" size="30" maxlength="30"/> <br>
            Диапозон цен: <input type="number" name = "minCost" max="9999" min="0" /> -
            <input type="number" name = "maxCost" max="9999" min="0"/> руб.<br>
            Поиск по описанию товара:<input type ="text" name = "description" size="30" maxlength="30"/> <br>
            <input type="submit" value="Поиск" />
        </form>
    </div>
    <div class="items">
            <?php
            //Если не было поиска, то просто вывожу все предметы
                if ($all) {
                    for ($i = 1; $i < 9; $i++) {
                        echo($catalogItems[$i]);
                    }
                    //Если был запрос, то $all = false и выполниться только эта часть
                    //В ней: Перебираю все значения из массива на вывод (whatPrintArray) и по надобности вывожу
                    // информацию("Далее поиск по ..."). Такие образом печатаются только те, которые были отобраны,
                    //то есть записаны в массив на вывод
                } else {
            for ($i = 0; $i < count($whatPrintArray); $i++) {
                if ($rememberFirst != 0 && $rememberFirst == $i) {echo('<h2><b>Далее поиск по цене:</b></h2> </br>');}
                if ($rememberSecond != 0 && $rememberSecond == $i) {echo('<h2><b>Далее поиск по описанию:</b></h2> </br>');}
                echo($catalogItems[$whatPrintArray[$i]]);//печатать те позиции ,которые записаны в массив whatPrintArray
            }
            }

                ?>
        </div>

    <!--В будущем здесь бы были стрелочки для переключения страниц с выводом -->
    <div class="pages">

    </div>
</div>
</body>
</html>