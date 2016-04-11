function ShowIMG(waarde) {
    $(document).ready(function () {
        $("#placehere img:last-child").remove();
        $('#placehere').prepend('<img id="cat' + waarde + '" src="images/cat' + waarde + '.png" />');
    })
}


//onderstaande functie kan gebruikt worden om te kijken of twee wachtwoorden overeenkomen.
String.prototype.isEmpty = function () {
    return (this.length === 0 || !this.trim());
};

function checkPassAcc() {
    var accpass1 = document.getElementById('accwachtwoord1');
    var accpass2 = document.getElementById('accwachtwoord2');
    var accmessage = document.getElementById('accconfirmMessage');
    var accgoodColor = "#66cc66";
    var accbadColor = "#ff6666";
    if (accpass1.value == accpass2.value) {
        accpass2.style.backgroundColor = accgoodColor;
        accmessage.style.color = accgoodColor;
        accmessage.innerHTML = "Wachtwoorden komen overeen!"
    } else {
        accpass2.style.backgroundColor = accbadColor;
        accmessage.style.color = badColor;
        accmessage.innerHTML = "Wachtwoorden komen niet overeen, heeft u een typfout gemaakt?"
    }
}
//voor registratieformulier
function checkPass() {
    var pass1 = document.getElementById('wachtwoord1');
    var pass2 = document.getElementById('wachtwoord2');
    var message = document.getElementById('confirmMessage');
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    if (pass1.value == pass2.value) {
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Wachtwoorden komen overeen!"
    } else {
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Wachtwoorden komen niet overeen, heeft u een typfout gemaakt?"
    }
}

function showProductsMenu(str) {


    if (str == "") {

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("tablecontainermenu").innerHTML = xmlhttp.responseText;
                var oTable = $('tablecontainermenu').dataTable({"sPaginationType": "full_numbers"});
                var rows = oTable.fnGetNodes();
                {
                    oTable.fnUpdate('X', rows[i], 4);
                }
            }
        };
        xmlhttp.open("GET", "menu/tabledatamenu.php?catID=" + str, true);
        xmlhttp.send();


    } else {

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("tablecontainermenu").innerHTML = xmlhttp.responseText;
                var oTable = $('tablecontainermenu').dataTable({"sPaginationType": "full_numbers"});
                var rows = oTable.fnGetNodes();
                {
                    oTable.fnUpdate('X', rows[i], 4);
                }
            }
        };
        xmlhttp.open("GET", "menu/tabledatamenu.php?catID=" + str, true);
        xmlhttp.send();


    }
}
//onderstaande zoekfunctie voor tabellen
function doSearch() {
    var searchText = document.getElementById('search').value;
    var targetTable = document.getElementById('producttable');
    var targetTableColCount;

    for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
        var rowData = '';

        if (rowIndex == 0) {
            targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
            continue;
        }

        //Process data rows. (rowIndex >= 1)
        for (var colIndex = 0; colIndex < targetTableColCount; colIndex++) {
            rowData += targetTable.rows.item(rowIndex).cells.item(colIndex).textContent;
        }

        //If search term is not found in row data
        //then hide the row, else show
        if (rowData.toUpperCase().indexOf(searchText.toUpperCase()) == -1)
            targetTable.rows.item(rowIndex).style.display = 'none';
        else
            targetTable.rows.item(rowIndex).style.display = 'table-row';
    }
}


//
function buttonreferral(bref) {
    showProductsMenu(bref);
    ShowIMG(bref);
}

