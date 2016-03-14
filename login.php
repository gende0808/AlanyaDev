<?php
include_once "header.php";
include_once "classes/Account.php";

//$email = $_POST['loginemail'];
//$password = $_POST['loginpass'];

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
    // Password : 874e0cc1eb15bdaf323800180d19d69fe4ba2cedd2954ab332e25a2a85ab3248
        try
        {
                $account = new Account($DB_con,2);
                echo $account->getUseremail();

                return "Goed";
        }
        catch(PDOException $e)
        {
                echo "Fout".$e->getMessage();
        }

?>
<!--window.location.href = "index.php";-->
</script>
