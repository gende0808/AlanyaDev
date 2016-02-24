<?PHP
include_once "header.php";
include_once "connection.php";
?>

<div class="container text-center">
    <img src="images/testlogo2.png">
    <div class="col-md-8 col-md-offset-3 text-center">
        <?php

echo "<table style='border: solid 1px black;' class='table-striped'>";
echo "<tr><th>Product nummer</th><th>Product naam</th><th>Product omschrijving</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}


try {;
    $stmt = $DB_con->prepare("SELECT productNummer, productNaam, productOmschrijving FROM product");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";


include_once "footer.php";
