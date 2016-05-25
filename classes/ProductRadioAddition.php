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

    private $rad_info;

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
        if ($toevoegingid != "" && is_numeric($toevoegingid)) {
            $this->read($toevoegingid);
        }


    }

    public function read($id)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id is leeg!');
        }
        if (!is_numeric($id)) {
            throw new InvalidArgumentException("Id is geen getal!");
        }

        try {
            $stmt = $this->db->prepare("SELECT id,
                                           toevoegingnaam,
                                           radiotoevoegingid
                                                FROM toevoegingradio WHERE id = :radid");
            $stmt->bindParam(':radid', $id, PDO::PARAM_INT);
            $stmt->execute();
            $this->rad_info = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $this->rad_info['id'];
            $this->name = $this->rad_info['toevoegingnaam'];
        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
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