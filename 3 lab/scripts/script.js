let countOfLines = 0;
let countOfLinesDid = 0;

function createTable() {
    try {
        deleteText();
        creatingHeadForTable();
        unDisableOtherButtons();
    } catch (err) {
       alert("ВАЩЕТА... В смысле, вы уже создали таблицу. Перезагрузите страницу, чтобы создать новую," +
           " при этом удалится текущая, иначе нажмите \"ОК\".");
    }

}

function addLine() {
    if (countOfLines % 2 === 0) {
        createLineEven();
    } else {
        createLineOdd();
    }
    countOfLines++;
    countOfLinesDid++;
}

function deleteLine() {
        let text = document.getElementById("deleteLineText").value;
        let validate = isItCorrect(text);
        if (validate) {
            deleteTheLine(text);
        } else {
            alert("НИЗЯ! Такого номера строки нет");
        }
}

function deleteText() {
    let tableContainerText = document.getElementById("tableContainerText");
    tableContainerText.remove();
}

function creatingHeadForTable() {
    let table = document.createElement("table");
    table.className = "createdTable";
    table.id = "createdTable";

    let placeForTable = document.getElementById("placeForTable");
    placeForTable.append(table);

    let trHead = document.createElement("tr");
    trHead.className = "rowHead"
    table.append(trHead);

    let th1 = document.createElement("th");
    let th2 = document.createElement("th");
    let th3 = document.createElement("th");

    th1.className = "columnHead";
    th2.className = "columnHead";
    th3.className = "columnHead";

    trHead.append(th1);
    trHead.append(th2);
    trHead.append(th3);

    th1.append("Номер");
    th2.append("Имя персонажа");
    th3.append("Уровень персонажа");

}

function unDisableOtherButtons() {
    let addButton = document.getElementById("addLine");
    let deleteButton = document.getElementById("deleteLine");

    addButton.disabled = false;
    deleteButton.disabled = false;

}

function createLineEven() {
    let table = document.getElementById("createdTable");

    let tr = document.createElement("tr");
    tr.className = "row";
    tr.id = "row" + (countOfLinesDid + 1);
    table.append(tr);

    let td1 = document.createElement("td");
    let td2 = document.createElement("td");
    let td3 = document.createElement("td");

    td1.className = "columnEven";
    td2.className = "columnEven";
    td3.className = "columnEven";

    tr.append(td1);
    tr.append(td2);
    tr.append(td3);

    td1.append(countOfLinesDid + 1);
    let td2Text = createName();
    td2.append(td2Text);
    let td3Text = createLevel();
    td3.append(td3Text);

}

function createLineOdd() {
    let table = document.getElementById("createdTable");

    let tr = document.createElement("tr");
    tr.className = "row";
    tr.id = "row" + (countOfLinesDid + 1);
    table.append(tr);

    let td1 = document.createElement("td");
    let td2 = document.createElement("td");
    let td3 = document.createElement("td");

    td1.className = "columnOdd";
    td2.className = "columnOdd";
    td3.className = "columnOdd";

    tr.append(td1);
    tr.append(td2);
    tr.append(td3);

    td1.append(countOfLinesDid + 1);
    let td2Text = createName();
    td2.append(td2Text);
    let td3Text = createLevel();
    td3.append(td3Text);

}

function createName() {
    let startLetter = ['А','Б','В','Г','Д','Е','Ш','С'];
    let partsOfNames = ['ни','ко','ла','й','ку','ри','ца','еж', "ры"];
    let randomName = [];
    let lenthOfName = randomInt(10);
    let randomPart1 = randomInt(7);
    randomName.push(startLetter[randomPart1]);
    for(let i = 0; i < lenthOfName; i++){
        let randomPart2 = randomInt(8);
        randomName.push(partsOfNames[randomPart2]);
    }
    return randomName.join("");
}

function createLevel() {
    return randomInt(100);
}

function randomInt(max) {
    return Math.floor(Math.random() * max);
}

function isItCorrect(text) {
    if (text === "" || text === " ") {
        return false;
    }
    if (document.getElementById("row" + text) === null) {
        return false;
    }
    return true;

}

function deleteTheLine(n) {
    let id = "row" + n
    let line = document.getElementById(id);
    line.remove();
    countOfLines--;
}