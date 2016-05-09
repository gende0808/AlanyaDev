<?php
if(isset($_POST['productid'])) {
    function printr($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

//TODO IF ISSET POST ID

    include_once "connection.php";
    include_once "interfaces/CRUD.php";
    include_once "classes/ProductAdditionList.php";
    include_once "classes/ProductAdditionRemovable.php";
    include_once "classes/ProductAddition.php";
    include_once "classes/ProductAdditionRadioList.php";
    include_once "classes/ProductRadioAddition.php";
    include_once "classes/Product.php";


    try {

        $lijstmettoevoegingen = new ProductAdditionList($DB_con, 1);
        $verwijderlijst = $lijstmettoevoegingen->getremovableadditions();
        $toevoeginglijst = $lijstmettoevoegingen->getaddableadditions();
        $radiolijst = $lijstmettoevoegingen->getradioadditions();
        //TODO mogelijk een if statement nodig voor als er verwijderbare dingen zijn
        foreach ($verwijderlijst as $verwijdering) {
            $removable_items[] = array("removalid" => $verwijdering->getId(), "name" => $verwijdering->getName());
        }
        foreach ($toevoeginglijst as $toevoeging) {
            $addable_items[] = array("additionid" => $toevoeging->getId(), "name" => $toevoeging->getName(), "formattedprice" => $toevoeging->getFormattedPrice(), "price" => $toevoeging->getPrice());
        }
        foreach ($radiolijst as $radiolist) {
            $additions = array();
            $additions['groupname'] = $radiolist->getGroupName();
            foreach ($radiolist->getListoflistofradios() as $radiobutton) {
                $additions[] = $radiobutton->getAdditionData();
            }
            $radioitems[] = $additions;
        }

        $super_array['removable'] = $removable_items;
        $super_array['addable'] = $addable_items;
        $super_array['radio'] = $radioitems;
        //echo json_encode($super_array);
        echo json_encode($super_array);
    } catch (Exception $e) {
        echo "error: " . $e->getMessage();
    }
}


