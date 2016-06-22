<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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
        $_SESSION['iactivatedmyaccount'] = true;
        //veranderen naar localhost als het onderstaande voor een lokale pc moet werken
        header("Location: http://www.alanya-krommenie.nl/index");
    } else {
        include_once "header.php";
        echo "er is een fout gedetecteerd bij het activeren van het account.";
        include_once "footer.php";
    }
        } catch(Exception $e){
        echo $e->getMessage();
    }
}