<?php
//session_start();
//session comes later!

include_once "connection.php";
include_once "interfaces/CRUD.php";
include_once "classes/Account.php";
include_once "classes/AccountList.php";

$email = $_POST['loginemail'];
$password = $_POST['loginpass'];
$waarde = false;
        try
        {
                $accountlist = new AccountList($DB_con);
                $listofaccounts = $accountlist->getlistofaccounts();
                foreach($listofaccounts as $account){
                        $accemail = $account->getUseremail();
                        $accpassword = $account->getUserpassword();

                        if($email === $accemail && $password === $accpassword){
                                echo $account->getUserfirstname().' '.$account->getUserlastname();
                                $waarde = true;
                                exit;
                        }
                }

        }
        catch(PDOException $e)
        {
                echo 'er is iets fout gegaan';
        }
        if (!$waarde)
        {
                echo "fout wachtwoord/gebruikersnaam";
        }
        if ($waarde)
        {
                echo "er komt een wachtwoord overeen!";
        }


?>
<!--window.location.href = "index.php";-->
</script>
