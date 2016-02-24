<?PHP
include_once "header.php";
include_once "connection.php";
?>

<div class="container text-center">
    <img src="images/testlogo2.png">
    <div class="col-md-8 col-md-offset-2 text-center">

<?php

echo "<table id='testTable' class='table table-striped table-hover table-responsive'>";
echo "<tr>
            <th class='text-center'>Categorie</th>
            <th class='text-center'>Nummer</th>
            <th class='text-center'>Product</th>
            <th class='text-center'>Omschrijving</th>
            <th class='text-center'>Prijs (€)</th>
      </tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width: 150px;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}


try {;
    $stmt = $DB_con->prepare("SELECT categorie.categorieNaam, product.productNummer, product.productNaam,
                         product.productOmschrijving, product.productPrijs
                         FROM product
                         INNER JOIN categorie ON categorie.categorieID = product.categorieID
                         ORDER BY categorieNaam");
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

?>
 </div>
</div>

<?php
include_once "footer.php";
?>