<?php
session_start();
include_once 'connection.php';
include_once 'interfaces/CRUD.php';
include_once 'classes/Account.php';
include_once "header.php";
include_once "classes/City.php";
include_once "classes/CityList.php";
include_once "classes/AccountList.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = htmlspecialchars($_SESSION['account_id']);

$accountemail = $_POST['accountemail'];

$account = new account($DB_con);
$account->setUseremail($accountemail);
$account->update($id);
?>
<script>
    window.location.href = "account.php";
</script>
