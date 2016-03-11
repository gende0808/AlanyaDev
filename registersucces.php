<?PHP

include_once "header.php";
include_once "interfaces/CRUD.php";
include_once "classes/Account.php";
include_once "connection.php";


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if(!empty($_POST)) {
    try {
        $account = new Account($DB_con);
        $account->setUseremail(htmlspecialchars($_POST['email']));
        $account->setUserpassword(htmlspecialchars($_POST['password']));
        $account->setUserfirstname(htmlspecialchars($_POST['firstname']));
        $account->setUserlastname(htmlspecialchars($_POST['lastname']));
        $account->setUserstreetname(htmlspecialchars($_POST['street']));
        $account->setUserhousenumber(htmlspecialchars($_POST['number']));
        $account->setUsercityid(htmlspecialchars($_POST['city']));
        $account->setUserphonenumber(htmlspecialchars($_POST['phone']));
        $account->create();

        echo "<h1>Er is een eenmalige activatiecode naar uw E-mail adres gestuurd.</h1>";
        echo "<h2>Na de activatie kunt u meteen door met uw bestelling.</h2>";
    } catch(PDOException $e){
        echo "Het volgende is fout gegaan: ".$e->getMessage();
    }
    }


include_once "footer.php";
?>
