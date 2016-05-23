<?php
function pr($var)
{
    print '<pre>';
    print_r($var);
    print '</pre>';
}

session_start();
if (!empty($_POST['prodid'])) {
    $array = array();

    if(empty($_SESSION['productencart'])){
        $_SESSION['productencart'] = array();
    }
    $array['productid'] = htmlspecialchars($_POST['prodid']);
    if (!empty($_POST['removable'])) {
        $array['removable'] = htmlspecialchars($_POST['removable']);
    }
    if (!empty($_POST['addable'])) {
        $array['addable'] = htmlspecialchars($_POST['addable']);
    }
    if (!empty($_POST['radio'])) {
        $array['radio'] = htmlspecialchars($_POST['radio']);
    }
    if (!empty($array)) {
        array_push($_SESSION['productencart'], $array);
        print_r($_SESSION['productencart']);
    }
}
?>