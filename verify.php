<?php
include_once 'interfaces/CRUD.php';
include_once "connection.php";
require_once 'classes/Account.php';

if (empty($_GET['id']) || empty($_GET['code'])) {
    header("Location: Index.php");
}

if (!empty($_GET['id']) && !empty($_GET['code'])) {
    $id = $_GET['id'];
    $code = $_GET['code'];

    $statusY = "Y";
    $statusN = "N";
    try{
    $account = new Account($DB_con, $id);

    if ($account->getToken() == $code) {
        $account->setstatus($statusY);
        $account->update($id);
    } else {
        echo "er is een fout gedetecteerd bij het activeren van het account.";
    }

        } catch(Exception $e){
        echo $e->getMessage();
    }
}