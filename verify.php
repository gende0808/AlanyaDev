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
        //TODO hier moet een header die redirect naar een "uw account is geactiveerd pagina"
    } else {
        include_once "header.php";
        echo "er is een fout gedetecteerd bij het activeren van het account.";
        include_once "footer.php";
    }
        } catch(Exception $e){
        echo $e->getMessage();
    }
}