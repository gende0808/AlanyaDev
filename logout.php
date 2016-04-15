<?php
session_start();
if(isset($_SESSION['logged']))
    session_destroy();
    $_SESSION = array();

header('Location: index.php');
?>
