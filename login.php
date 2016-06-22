<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
include_once "connection.php";
include_once "interfaces/CRUD.php";
include_once "classes/Account.php";
include_once "classes/AccountList.php";

//include city verwijdered, waarschijnlijk niet nodig?
$email = $_POST['loginemail'];
$password = $_POST['loginpass'];
$waarde['logincorrect'] = false;
$waarde['notactive'] = false;

try {
    $accountlist = new AccountList($DB_con);
    $listofaccounts = $accountlist->getlistofaccounts();
    foreach ($listofaccounts as $account) {
        $accemail = $account->getUseremail();
        $accpassword = $account->getUserpassword();


        if ($email === $accemail && password_verify($password, $accpassword)) {

            if ($account->getstatus() == "Y") {
                //als de invoer van email en wachtwoord overeenkomen met een account in de database word
                //de sessie 'logged' op true gezet en de sessie 'user_info' word gevuld met gegevens van de gebruiker.
                $waarde['logincorrect'] = true;
                $_SESSION['logged'] = true;
                $_SESSION['account_id'] = $account->getUserid();
                $_SESSION['city_id'] = $account->getUsercityid();
                $_SESSION['user_info'] = $account->getUserInfo();
                echo json_encode($waarde);
            } else {
                $waarde['logincorrect'] = true;
                $waarde['notactive'] = true;
                $waarde['notactivemelding'] = "Uw account is nog niet geactiveerd!";
                echo json_encode($waarde);
            }
        }
    }

} catch (Exception $e) {
    echo 'er is iets fout gegaan met het zoeken van accounts in de database';
}

if ($waarde['logincorrect'] === false) {
    $waarde['loginfoutmelding'] = "E-mailadres / wachtwoord combinatie is ongeldig";
    echo json_encode($waarde);
}

?>
