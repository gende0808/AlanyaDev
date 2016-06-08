<?php

function check_for_discounts($databaseconnection,$prodid, $catid, $prodprice)
{
    //gebruikt de volgende classes:
    //DiscountList, Discount,
    $discountlist = (new DiscountList($databaseconnection))->getlistofdiscounts();
    $huidigeDatum = date('Y-m-d');
    $huidigeDatum = date('Y-m-d', strtotime($huidigeDatum));
    $huidigedag = date("l");
    $actieprijs = $prodprice;
    foreach ($discountlist as $discount) {
        //hieronder de code voor als een actie voor producten is

        if($discount->getDiscounttype() == 'product' && $prodid == $discount->getProductID() &&
            $discount->getDiscountprice() < $actieprijs)
        {
            if($discount->isMonday() == '1' && $huidigedag == "Monday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isTuesday()== '1' && $huidigedag == "Tuesday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isWednesday() == '1' && $huidigedag == "Wednesday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isThursday()== '1' && $huidigedag == "Thursday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isFriday()== '1' && $huidigedag == "Friday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isSaturday()== '1' && $huidigedag == "Saturday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isSunday()== '1' && $huidigedag == "Sunday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if ($huidigeDatum >= $discount->getBegindate() && $huidigeDatum <= $discount->getEnddate()){
                if($discount->getDiscountprice() < $prodprice){
                    $actieprijs = $discount->getDiscountprice();
                }
            }
        }

        //hieronder de code voor als een actie voor categoriën is
        if($discount->getDiscounttype() == 'category' && $catid == $discount->getCategorieID()&&
            $discount->getDiscountprice() < $actieprijs)
        {
            if($discount->isMonday() == '1' && $huidigedag == "Monday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isTuesday()== '1' && $huidigedag == "Tuesday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isWednesday() == '1' && $huidigedag == "Wednesday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isThursday()== '1' && $huidigedag == "Thursday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isFriday()== '1' && $huidigedag == "Friday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isSaturday()== '1' && $huidigedag == "Saturday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if($discount->isSunday()== '1' && $huidigedag == "Sunday"){
                if($discount->getDiscountprice() < $prodprice) {
                    $actieprijs = $discount->getDiscountprice();
                }
            }
            if ($huidigeDatum >= $discount->getBegindate() && $huidigeDatum <= $discount->getEnddate()){
                if($discount->getDiscountprice() < $prodprice){
                    $actieprijs = $discount->getDiscountprice();
                }
            }
        }
    }
    return $actieprijs;
}