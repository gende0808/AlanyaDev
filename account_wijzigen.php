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
//pass werkt nog niet goed dus even gecomment.
//$currentpass = htmlspecialchars($_SESSION['account_password']);
$loggedmail = htmlspecialchars($_SESSION['account_email']);
$loggedtoken = htmlspecialchars($_SESSION['account_token']);
$Y = 'Y';

$accountvoornaam = $_POST['voornaam'];
$accountachternaam = $_POST['achternaam'];
$accountstraatnaam = $_POST['straatnaam'];
$accounthuisnummer = $_POST['huisnummer'];
$accounttoevoeging = $_POST['toevoeging'];
$accountplaats = $_POST['plaats'];
$accounttelefoonnummer = $_POST['telefoonnummer'];

$account = new account($DB_con);
$account->setUserfirstname($accountvoornaam);
$account->setUserlastname($accountachternaam);
$account->setUserstreetname($accountstraatnaam );
$account->setUserhousenumber($accounthuisnummer);
$account->setUseraddition($accounttoevoeging);
$account->setUsercityid($accountplaats);
$account->setUserphonenumber($accounttelefoonnummer);
$account->setUseremail($loggedmail);
$account->setToken($loggedtoken);
//pass werkt nog niet goed dus even gecomment.
//$account->setUserpassword($currentpass);
$account->setstatus($Y);
$account->update($id);
?>
<script>
    window.location.href = "account.php";
</script>
