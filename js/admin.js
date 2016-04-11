
// functie toont producten in het menu admin

function showProducts(str) {
    if (str == "") {
        document.getElementById("tablecontainer").innerHTML = "";
        return;
    } else {

        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
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
}