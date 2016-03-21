<?php
include_once "header2.php";
include_once "classes/ProductList.php";
include_once "classes/Product.php";
include_once "classes/Category.php";
include_once "classes/CategoryList.php";

	//print_r($_POST);

	if ($_POST['productid'] == 32) {
        $array = array();
        $array['id'] = 32;
        $array['Productnummer'] = 101;
        $array['Productnaam'] = "Pizza";
        $array['Productomschrijving'] = "De lekkerste ronde schijf";
        $array['prijs'] = 13.77;
        $array['catid'] = 2;
    } else {
        $array = array();
        $array['id'] = 9;
        $array['nummer'] = 103;
        $array['naam'] = "Kebap";
        $array['omschrijving'] = "Van Ap!";
        $array['prijs'] = 3.11;
        $array['catid'] = 3;
    }

	echo json_encode($array);
