<?PHP
include_once "header.php";
include_once "connection.php";
include_once "classes/ProductList.php";
include_once "classes/Product.php";
include_once "classes/Category.php";
include_once "classes/CategoryList.php";
?>
    <div class="container text-center">
        <img src="images/testlogo2.png">
        <?PHP


        try {

            $categorylist = new CategoryList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt
            echo '<form action="" method="get">';
            foreach ($categorylist->getcategories() as $category) { //hij haalt alle categoriën op in een array.
                echo '<button name="catID" value="' . $category['categorieID'] . '">' . $category['categorieNaam'] . '</button>';
                //hierboven worden simpele buttons geprint waarvan in de post de ID word meegegeven maar de waarde in de knop is de categorieNaam.
            }
            echo '</form>';
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        ?>
        <div class="col-md-8 col-md-offset-2 text-center">

            <?php

            echo "<table id='testTable' class='table table-striped table-hover table-responsive'>";
            echo "
    <thead>
        <tr>
            <th class='text-center'>ProductNummer</th>
            <th class='text-center'>Productnaam</th>
            <th class='text-center'>Omschrijving</th>
            <th class='text-center'>Prijs (€)</th>
        </tr>
     </thead>";

            echo "<tbody>";
            // __________________________________
            try {

                if (!isset($_GET['catID'])) {
                    $category_ID = 1; //als er geen $_GET['catid'] is meegegeven is catid standaard 1
                } else {
                    $category_ID = $_GET['catID'];
                }
                $productlist = new ProductList($DB_con, $category_ID); // //de post word meegegeven
                $listofproducts = $productlist->getlistofproducts(); //hiermee word een array opgehaald waarin producten met hun waarden zitten
                foreach ($listofproducts as $product) { //in deze foreach loopt hij over ieder individueel product en print hij de waarden in die array
                    echo "<tr>";
                    echo "<td style='width: 150px;'>" . $product['productNummer'] . "</td>";
                    echo "<td style='width: 150px;'>" . $product['productNaam'] . "</td>";
                    echo "<td style='width: 150px;'>" . $product['productOmschrijving'] . "</td>";
                    echo "<td style='width: 150px;'>" . $product['productPrijs'] . "</td>";
                    echo "</tr>";
                    echo "\n";
                };
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            ?>
            </tbody>
            </table>

        </div>
    </div>


<?php
include_once "footer.php";
?>