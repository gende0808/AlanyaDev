<?PHP
include_once "header.php";
include_once "classes/Account.php";
include_once "classes/City.php";
include_once "classes/CityList.php";
include_once "classes/AccountList.php";

if(isset($_SESSION['order_id']) && isset($_SESSION['productencart']) ) {
}
else {
    echo "<script>window.location.replace(\"menu\");</script>";
}
?>
<div class="logo">
    <center><img src="images/testlogo3.png"></center>
</div>

<?php
include_once "modals/bestelling_bevestigen_modal.php";
?>

<?PHP
include_once "footer.php";
?>
