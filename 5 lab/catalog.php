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
    //обращаемся к БД, чтобы вывести данные
    $connection = mysqli_connect("localhost:3306", "root", "", "items");
    //Проверка, что соединение установлено
    if ($connection -> connect_error) {
        die("Ошибка подклчюения к БД " . $connection -> connect_error); //НЕЛЬЗЯ ТАК, НО ПРИДЕТЬСЯ
    }
    $all = true; //переменная, чтобы контролировать сколько выводить - все или частично

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


    if ($_SERVER['REQUEST_METHOD'] === "POST") { //Обработка только при POST запросе
        //Получае все данные для обработки с помощью пост заброса
        $name = $_POST['name'];
        $minCost = $_POST['minCost'];
        $maxCost = $_POST['maxCost'];
        $description = $_POST['description'];
        $whatPrintArray = array(); //массив, в который буду записывать id предметов к выводу
        $rememberFirst = 0; //перменные, запомнят кол-во предметов уже к вывыду, нужно для реализации вывода
        $rememberSecond = 0;

        //Если USER вписал в поле "поиск по названию товара", то убираем печатанье всего   $all = false,
        //пишу переменную запроса, создаю пременную result, где данные.
        //Проверяю, что данные сущ. и  перебираю и добавляю в массив для вывода
        if ($name != "") {
            $all = false;
            $queryName = "SELECT * FROM `itemlist` WHERE name LIKE '%$name%' ";
            $result = $connection->query($queryName);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($whatPrintArray, $row['id']);
                }
                
            }
        }
        //Если USER указал ценовой диапозон (хотя бы 1), то проверяю его диапозон и убираю печатанье всех предметов
        //$all = false, далее создаю как и выше запрос, реализую его, а далее добавляю нужные данные в массив.
        if ($minCost != "" || $maxCost != "") {
            $rememberFirst = count($whatPrintArray); //запоминает сколько было до этого найдено
            if ($minCost == "") {
                $minCost = 0;
            }
            if ($maxCost == "") {
                $maxCost = 9999;
            }
            $all = false;
            $queryName = "SELECT * FROM `itemlist` WHERE price >= $minCost AND price <= $maxCost ";
            $result = $connection->query($queryName);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    array_push($whatPrintArray, $row['id']);
                }
                
            }
        }

        //Если USER указал описание, то убираю все на печать ($all = false), создаю массив, в котором будут все слова
        //которые  указал USER. Далее, создаю запрос и обрабатываю его как выше, но в цикле, который переберет все
        //слова из массива слов
        if ($description != "") {
            $all = false;
            $rememberSecond = count($whatPrintArray); //запоминает сколько было до этого найдено
            $descriptionArray = explode(" ", $description);
            for ($i = 0; $i < count($descriptionArray); $i++) {
                $queryName = "SELECT * FROM `itemlist` WHERE description LIKE '%$descriptionArray[$i]%' ";
                $result = $connection->query($queryName);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        array_push($whatPrintArray, $row['id']);
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
            //Если не было поиска, то выбираю SQL запросом все данные из таблицы и вывожу в нужных местах
            if ($all === true) {
                $queryForAll = "SELECT * FROM `itemlist`";
                $resultForAll = $connection->query($queryForAll);
                if ($resultForAll->num_rows > 0) {
                    while($row = $resultForAll->fetch_assoc()) {
            ?>

                    <div class="item">
                        <div class="item_pic">
                            <img src="<?php echo $row['img'] ?>" alt="Фото букета">
                        </div>
                        <div class="description">
                            <h2>Название: <?php echo $row['name'] ?></h2>
                            <h3>Цена: <?php echo $row['price'] ?> руб.</h3>
                            <h4>Описание: <?php echo $row['description'] ?></h4>
                        </div>
                        <div class="toCart">
                            <h3><a class="cartLink" href="?id=<?php echo $row['id']?>">Добавить в корзину</a></h3>
                        </div>
                    </div>

            <?php
                                                                }
                                                 }
                //Если был запрос, то $all = false и выполниться только эта часть
                //В ней: перебираю массив, который хранит id элементов на печать. По надобности вывожу
                // информацию("Далее поиск по ...") и с помощью SQL запроса по id, полученного из массива whatPrintArray
                // вывожу нужные данные, подставляя как и выше в них значения из БД.
            } else {
                for ($i = 0; $i < count($whatPrintArray); $i++) {
                    if ($rememberFirst != 0 && $rememberFirst == $i) {echo('<h2><b>Далее поиск по цене:</b></h2> </br>');}
                    if ($rememberSecond != 0 && $rememberSecond == $i) {echo('<h2><b>Далее поиск по описанию:</b></h2> </br>');}
                    $queryForSearch = "SELECT * FROM `itemlist` WHERE id=$whatPrintArray[$i] ";
                    $resultForSearch = $connection->query($queryForSearch);
                    if ($resultForSearch->num_rows > 0) {
                        while($row = $resultForSearch->fetch_assoc()) {
            ?>

                            <div class="item">
                                <div class="item_pic">
                                    <img src="<?php echo $row['img'] ?>" alt="Фото букета">
                                </div>
                                <div class="description">
                                    <h2>Название: <?php echo $row['name'] ?></h2>
                                    <h3>Цена: <?php echo $row['price'] ?> руб.</h3>
                                    <h4>Описание: <?php echo $row['description'] ?></h4>
                                </div>
                                <div class="toCart">
                                    <h3><a class="cartLink" href="?id=<?php echo $row['id']?>">Добавить в корзину</a></h3>
                                </div>
                            </div>

           <?php
                                }
                            }
                        }
                    }

            ?>
    </div>


<?php
    //Закрыаю подключение (единственное закрытие (выше не было) )
    $connection->close();
?>

</body>
</html>