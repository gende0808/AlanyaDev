<?php
session_start();
//session comes later!

include_once "connection.php";
include_once "interfaces/CRUD.php";
include_once "classes/Account.php";
include_once "classes/AccountList.php";

$email = $_POST['loginemail'];
$password = $_POST['loginpass'];
$waarde = false;
try {
    $accountlist = new AccountList($DB_con);
    $listofaccounts = $accountlist->getlistofaccounts();
    foreach ($listofaccounts as $account) {
        $accemail = $account->getUseremail();
        $accpassword = $account->getUserpassword();


        if ($email === $accemail && $password === $accpassword) {
            //als de invoer van email en wachtwoord overeenkomen met een account in de database word
            //de sessie 'logged' op true gezet en de sessie 'user_info' word gevuld met gegevens van de gebruiker.
            $_SESSION['logged'] = true;
            $_SESSION['user_info'] = $account->getUserInfo();
            $_SESSION['user_info'] = true;
            header('Location: index.php');
        }
    }

} catch (Exception $e) {
    echo 'er is iets fout gegaan met het zoeken van accounts in de database';
}
if ($waarde === true) {
    //code voor als er een wachtwoord gevonden is
    echo "er komt een wachtwoord overeen!";
}
if ($waarde === false) {
    //code voor als het wachtwoord niet overeenkomt
    echo "fout wachtwoord/gebruikersnaam";
}


?>

