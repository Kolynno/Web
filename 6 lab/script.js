//делаю запрос общий для других функций
var request = new XMLHttpRequest();
request.open("GET", "test.json", true);
request.send();

//функция принимает массив чисел, по сути принимает id объектов на печать
function createAll(array) {
    //запрос для вывода
    var request = new XMLHttpRequest();
    request.open("GET", "test.json", true);
    request.send();
//если запрос корректен
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            //в цикле перебираю данные из json файла и записываю в переменные
            for (var i = 0; i < 8; i++) {
                if (array.includes(i)) {
                var id = JSON.parse(request.responseText)[i]["id"];
                var name = JSON.parse(request.responseText)[i]["name"];
                var price = JSON.parse(request.responseText)[i]["price"];
                var description = JSON.parse(request.responseText)[i]["description"];
                var src = JSON.parse(request.responseText)[i]["src"];

                //эти переменные отправляю в функцию, создающую элементы
                createElement(id, name, price, description, src);
                }
            }
        }
    }


    function createElement(id, name, price, description, src) {
        var mainDiv = document.getElementById("itemsList");

        var div = document.createElement("div");
        div.className = "item";
        mainDiv.append(div);

        var divPic = document.createElement("div");
        divPic.className = "item_pic";
        div.append(divPic);

        var img = document.createElement("img");
        img.src = src;
        divPic.append(img);

        var divDesc = document.createElement("div");
        divDesc.className = "description";
        div.append(divDesc);

        var h2 = document.createElement("h2");
        var h3 = document.createElement("h3");
        var h4 = document.createElement("h4");
        h2.innerHTML = "Название: " + name;
        h3.innerHTML = "Цена: " + price;
        h4.innerHTML = "Описание: " + description;
        divDesc.append(h2);
        divDesc.append(h3);
        divDesc.append(h4);

        var divCart = document.createElement("div");
        divCart.className = "toCart";
        div.append(divCart);

        var h3Cart = document.createElement("h3");
        div.append(h3Cart);

        var a = document.createElement("a");
        a.className = "cartLink";
        a.innerHTML = "Добавить в корзину"
        a.href = "?id=" + id;
        h3Cart.append(a);

    }
    //Если ничего не найдется
    if (array.length === 0) {
        var items = document.getElementById("itemsList");
        items.innerHTML ="<h2><b>По данным фильтрам ничего не нашлось :( </br>Попробуйте изменить фильтры и попробовть снова </b></h2>";

    }
}


function searching() {
    //удаляю предыдущий результат поиска
    deleteLast();

    //вспомогательные переменные
    var name = document.getElementById("nameOfProductText").value;
    var priceMin = document.getElementById("priceMin").value;
    var priceMax = document.getElementById("priceMax").value;
    var description = document.getElementById("description").value;

    //массив найденных и массив откинутых элементов
    var array = [];
    var banned = [];

    //обработка поиска
    if (name !== "") {
        nameSearching(name, array, banned);
    }

    if (priceMin !== "" || priceMax !== "" ) {
        priceSearching(priceMin, priceMax, array, banned);
    }

    if (description !== "") {
        descriptionSearching(description, array, banned);
    }

    //если все поля пустые, то массив заполнить ->  вывести все элементы
    if (name === "" && priceMin === "" && priceMax === "" && description === "") {
        array = [0,1,2,3,4,5,6,7];
    }
    //фильтрация массива найденных так, чтобы в новом массиве не было "забаненых" (отклоненных) элементов
    var searching = array.filter(x => !banned.includes(x));

    //создание элементов
    createAll(searching);
}

//Проверяю имя, если подходит, то идет в array, если нет, то в banned
function nameSearching(name, array, banned) {
    for (var i = 0; i < 8; i++) {
        var originalName = JSON.parse(request.responseText)[i]["name"];

        if (name.toLowerCase() === originalName.toLowerCase()) {
            array.push(i);
        } else {
            banned.push(i);
        }
    }
}
//Проверяю цену, если подходит, то идет в array, если нет, то в banned
function priceSearching(min, max, array, banned) {
    rememberFirst = array.length;

    if (min === "") {min = 0;}
    if (max === "") {max = 9999;}

    for (var i = 0; i < 8; i++) {
        var originalPrice = JSON.parse(request.responseText)[i]["price"];

        if (originalPrice <= max && originalPrice >= min) {
            if (!banned.includes(i)) {array.push(i);}
        } else {
            banned.push(i);
        }
    }

}
//Проверяю описание, если подходит, то идет в array, если нет, то в banned
function descriptionSearching(desc, array, banned) {
    rememberSecond = array.length;

    var searchingArrayDesc = desc.split(" ");

    for (var i = 0; i < searchingArrayDesc.length; i++) {
        for (var j = 0; j < 8; j++) {
                if (JSON.parse(request.responseText)[j]["description"].includes(searchingArrayDesc[i])) {
                    if (!banned.includes(j)) {array.push(j);}
                } else {
                    banned.push(j);
                }
        }
    }
}

//функция очищает результат поиска
function deleteLast() {
    var items = document.getElementById("itemsList");
    items.innerHTML =" ";
}