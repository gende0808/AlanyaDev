<?php

/**
 * Created by PhpStorm.
 * User: Gregory
 * Date: 6-4-2016
 * Time: 11:42
 */
class ProductRadioAddition
{
    /**
     * @var PDO
     */
    private $db;
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $name;

    private $additiondata = array();

    /**
     * ProductRadioAddition constructor.
     * @param $dbconnection
     * @param int $toevoegingid
     * @param string $toevoegingnaam
     */

    public function __construct($dbconnection, $toevoegingid = 0, $toevoegingnaam = "")
    {

        $this->db = $dbconnection;
        if ($toevoegingid != 0){
            $this->id = $toevoegingid;
            $this->additiondata['radioid'] = $toevoegingid;
        }
        if ($toevoegingnaam != ""){
            $this->name = $toevoegingnaam;
            $this->additiondata['name'] = $toevoegingnaam;
        }


    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    public function getAdditionData(){
        return $this->additiondata;
    }
}