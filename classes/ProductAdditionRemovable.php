<?php

class ProductAdditionRemovable{
    /**
     * @var PDO
     */
    private $db;

    private $id;

    private $name;

    private $rem_info;

    private $groupid;

    public function __construct($dbconnection, $removableid = 0, $additionname = "")
    {
        $this->db = $dbconnection;
        if($removableid != 0){
            $this->id = $removableid;
        }
        if($additionname !=""){
            $this->name = $additionname;
        }
        if ($removableid != "" && is_numeric($removableid)) {
            $this->read($removableid);
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
            $stmt = $this->db->prepare("SELECT 	toevoegingverwijderenid,
                                           toevoegingnaam,
                                           toevoeginggroepid
                                                FROM toevoegingverwijderen WHERE toevoegingverwijderenid = :remid");
            $stmt->bindParam(':remid', $id, PDO::PARAM_INT);
            $stmt->execute();
            $this->rem_info = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $this->rem_info['toevoegingverwijderenid'];
            $this->groupid = $this->rem_info['toevoeginggroepid'];
            $this->name = $this->rem_info['toevoegingnaam'];
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
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



}