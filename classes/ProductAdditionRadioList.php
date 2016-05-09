<?php

/**
 * Created by PhpStorm.
 * User: Gregory
 * Date: 6-4-2016
 * Time: 11:42
 */
class ProductAdditionRadioList
{
    /**
     * @var int
     */
    private $radioadditionid;
    /**
     * @var PDO
     */
    private $db;
    /**
     * @var array
     */
    private $listoflistofradios = array();
    /**
     * @var string
     */
    private $groupname;

    /**
     * ProductRadioList constructor.
     * @param $dbconnection
     * @param int $radioadditionid
     */

    public function __construct($dbconnection, $radioadditionid = 0,$radiogroupname="")
    {
        $this->db = $dbconnection;
        if ($radioadditionid != 0) {
            $this->radioadditionid = $radioadditionid;
        }
        if ($radiogroupname != "") {
            $this->groupname = $radiogroupname;
        }
        $this->db = $dbconnection;
        try {
            $stmt = $this->db->prepare("SELECT A.radiotoevoegingid,
                                               A.radiogroepnaam,
                                               B.id,
                                               B.toevoegingnaam
                                        FROM toevoegingradiogroep A 
                                        INNER JOIN 
                                        toevoegingradio B
                                        ON A.radiotoevoegingid = B.radiotoevoegingid
                                        WHERE B.radiotoevoegingid = :toevid
                                        ");
            $stmt->bindParam(":toevid", $this->radioadditionid);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->listoflistofradios[] =
                    new ProductRadioAddition($this->db, $result['id'], $result['toevoegingnaam']);
            }


        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }
        public function getGroupName(){
        return $this->groupname;
    }

    /**
     * @return ProductRadioAddition[]
     */
    public function getListoflistofradios()
    {
        return $this->listoflistofradios;
    }

}