<?php
session_start();
if (!empty($_POST['prodid']) && !empty($_POST['aantal'])) {
    $array = array();


    if(empty($_SESSION['productencart'])){
        $_SESSION['productencart'] = array();
    }
    $array['aantal'] = $_POST['aantal'];
    $array['productid'] = $_POST['prodid'];
    if (!empty($_POST['removable'])) {
        $array['removable'] = $_POST['removable'];
    }
    if (!empty($_POST['addable'])) {
        $array['addable'] = $_POST['addable'];
    }
    if (!empty($_POST['radio'])) {
        $array['radio'] = $_POST['radio'];
    }
    if (!empty($array)) {
        array_push($_SESSION['productencart'], $array);
    }
}
?>