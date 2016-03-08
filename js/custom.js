/**
 * Created by Gregory on 28-2-2016.
 */
// onderstaande functie is voor het verzenden van een request naar tabledata.php met ajax om producten op te halen.

function showProducts(str) {
    if (str == "") {
        document.getElementById("tablecontainer").innerHTML = "";
        return;
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
                document.getElementById("tablecontainer").innerHTML = xmlhttp.responseText;
                var oTable = $('tablecontainer').dataTable({"sPaginationType": "full_numbers"});
                var rows = oTable.fnGetNodes();
                {
                    oTable.fnUpdate('X', rows[i], 4);
                }
            }
        };
        xmlhttp.open("GET", "adminaccount/tabledata.php?catID=" + str, true);
        xmlhttp.send();


    }
}function showProductsMenu(str) {


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
//onderstaande functie is de zoekfunctie voor adminaccount
function doSearch() {
    var searchText = document.getElementById('search').value;
    var targetTable = document.getElementById('producttable');
    var targetTableColCount;

    //Loop through table rows
    for (var rowIndex = 0; rowIndex < targetTable.rows.length; rowIndex++) {
        var rowData = '';

        //Get column count from header row
        if (rowIndex == 0) {
            targetTableColCount = targetTable.rows.item(rowIndex).cells.length;
            continue; //do not execute further code for header row.
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
window.onload = function() {
    showProductsMenu(1);
};


