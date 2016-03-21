<?php

	if ($_POST['productid'] == 32) {
        $array = array();
        $array['id'] = 32;
        $array['nummer'] = 101;
        $array['productnaam'] = "Pizza";
        $array['omschrijving'] = "De lekkerste ronde schijf";
        $array['euro'] = 2;
        $array['cent'] = 50;
        $array['catid'] = 1;
    } else {
        $array = array();
        $array['id'] = 33;
        $array['nummer'] = 102;
        $array['productnaam'] = "Kebap";
        $array['omschrijving'] = "Van Ap!";
        $array['euro'] = 3;
        $array['cent'] = 30;
        $array['catid'] = 3;
    }

	echo json_encode($array);
