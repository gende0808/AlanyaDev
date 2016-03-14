<?php
include_once "header.php";

$email = $_GET['loginemail'];
$password = $_GET['loginpass'];

function login($email, $password) {
    // Password : 874e0cc1eb15bdaf323800180d19d69fe4ba2cedd2954ab332e25a2a85ab3248
        try
        {
                $sql = "SELECT *
                        FROM account
                        WHERE userEmail = :email
                        AND userPassword = :pass ";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(":email", $email);
                $stmt->bindparam(":pass", $password);
                $stmt->execute();

                return "Goed";
        }
        catch(PDOException $e)
        {
                return "Fout".$e;
        }
}
?>
<!--<script>-->
<!--window.location.href = "index.php";-->
<!--</script>-->
