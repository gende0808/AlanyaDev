<?php
//session_start();
//session comes later!

include_once "connection.php";
include_once "interfaces/CRUD.php";
include_once "classes/Account.php";
include_once "classes/AccountList.php";

$email = $_POST['loginemail'];
$password = $_POST['loginpass'];


    // Password : 874e0cc1eb15bdaf323800180d19d69fe4ba2cedd2954ab332e25a2a85ab3248
        try
        {
                $accountlist = new AccountList($DB_con);
                $listofaccounts = $accountlist->getlistofaccounts();
                foreach($listofaccounts as $account){
                        $accemail = $account->getUseremail();
                        $accpassword = $account->getUserpassword();

                        if($email === $accemail && $password === $accpassword){
                                echo $account->getUserfirstname().' '.$account->getUserlastname();
                                echo " er komt een wachtwoord overeen!";
                                echo " het werkt!";
                                return $waarde = 'appel';
                        }
                }
        }
        catch(PDOException $e)
        {

        }
        if ($waarde = 'appel')
        {
                echo "fout wachtwoord/gebruikersnaam";
        }


?>
<!--window.location.href = "index.php";-->
</script>
