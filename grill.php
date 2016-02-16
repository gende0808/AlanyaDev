<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<?PHP
include_once "header.php";
include_once "sideshoppinglist.php";
include_once "connection.php";
?>
<body>

<div id="main-header">
    <div class="logo">
        <hr>
        <center><img src="images/testlogo2.png"></center>
    </div>
</div>

<div class="row">
    <div class="col-md-2">
        </div>
    <div class="col-md-8">
        <?php
        // Ascending Order
        if(isset($_POST['ASC']))
        {
            $asc_query = "SELECT * FROM product ORDER BY ProductPrijs ASC";
            $result = executeQuery($asc_query);
        }

// Descending Order
        elseif (isset ($_POST['DESC']))
        {
            $desc_query = "SELECT * FROM product ORDER BY ProductPrijs DESC";
            $result = executeQuery($desc_query);
        }

// Default Order
        else {
            $default_query = "SELECT * FROM product";
            $result = executeQuery($default_query);
        }

        ?>
        <form action="grill.php" method="post">

            <input type="submit" name="ASC" value="Ascending"><br><br>
            <input type="submit" name="DESC" value="Descending"><br><br>

            <table class="table table-striped table-hover table-responsive">
                <tr>
                    <th>Nummer</th>
                    <th>Product</th>
                    <th>Omschrijving</th>
                    <th>Prijs</th>
                </tr>
                <!-- populate table from mysql database -->
                <?php while ($row = mysqli_fetch_array($result)):?>
                    <tr>
                        <td><?php echo $row[1];?></td>
                        <td><?php echo $row[2];?></td>
                        <td><?php echo $row[3];?></td>
                        <td>€<?php echo $row[4];?></td>
                    </tr>
                <?php endwhile;?>
            </table>
        </form>

    </div>
        <div class="col-md-2">
        </div>
</div>


<?PHP
include_once "footer.php";
// include_once "sideshoppinglist.php";
?>


<!-- The scroll to top feature -->
<div class="scroll-top-wrapper ">
  <span class="scroll-top-inner">
<i class="fa fa-2x fa-arrow-circle-up"></i>
  </span>
</div>
<script src="js/vendor/jquery-1.11.0.min.js"></script>
<script src="js/vendor/jquery.gmap3.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/login.js"></script>
<script src="js/scrolltop.js"></script>
<script src="js/datatable.js"></script>

</body>
</html>