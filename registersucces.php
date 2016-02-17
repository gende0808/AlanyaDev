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
        $account->setUserstreetname(htmlspecialchars($_POST['street']));
        $account->setUserhousenumber(htmlspecialchars($_POST['number']));
        $account->setUsercityid(htmlspecialchars($_POST['city']));
        $account->setUserphonenumber(htmlspecialchars($_POST['phone']));
        $account->create();
    } catch(PDOException $e){
        echo "This went wrong: ".$e->getMessage();
    }

    }

?>
