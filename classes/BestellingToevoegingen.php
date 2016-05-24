<?php

/**
 * Class BestellingAddable
 */

class BestellingAddable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $recordid;

    /**
     * @var int
     */
    private $addableid;

    /**
     * @var PDO
     */
    private $db;

    /**
     * @param $dbconnection
     * @param string $id
     */


    public function __construct($dbconnection, $id = "")
    {

        $this->db = $dbconnection;
        if ($id != "" && is_numeric($id)) {
            $this->read($id);
        }

    }

    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO bestellingaddable(
                                                           recordID,
                                                           addableID)
                                    VALUES(:recid, :addid)");
            $stmt->bindParam(":recid", $this->recordid);
            $stmt->bindParam(":addid", $this->addableid);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "er is iets misgegaan met de verbinding van de server!" . $e->getMessage();
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
            $stmt = $this->db->prepare("SELECT ID,
                                               recordID,
                                               addableID                             
                                                FROM bestellingaddable WHERE ID = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['ID'];
            $this->recordid = $result['recordID'];
            $this->addableid = $result['addableID'];
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
     * @return int
     */
    public function getRecordId()
    {
        return $this->recordid;
    }

    /**
     * @return int
     */
    public function getAddableId()
    {
        return $this->addableid;
    }

    /**
     * @param mixed $recordid
     */
    public function setRecordId($recordid)
    {
        $this->recordid = htmlentities($recordid);
    }

    /**
     * @param mixed $addableid
     */
    public function setAddableId($addableid)
    {
        $this->addableid = htmlentities($addableid);
    }

}


/**
 * Class BestellingRadio
 */

class BestellingRadio
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $recordid;

    /**
     * @var int
     */
    private $radioid;

    /**
     * @var PDO
     */
    private $db;

    /**
     * @param $dbconnection
     * @param string $id
     */


    public function __construct($dbconnection, $id = "")
    {

        $this->db = $dbconnection;
        if ($id != "" && is_numeric($id)) {
            $this->read($id);
        }

    }

    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO bestellingradio(
                                                           recordID,
                                                           radioID)
                                    VALUES(:recid, :radid)");
            $stmt->bindParam(":recid", $this->recordid);
            $stmt->bindParam(":radid", $this->radioid);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "er is iets misgegaan met de verbinding van de server!" . $e->getMessage();
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
            $stmt = $this->db->prepare("SELECT ID,
                                               recordID,
                                               radioID                             
                                                FROM bestellingradio WHERE ID = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['ID'];
            $this->recordid = $result['recordID'];
            $this->radioid = $result['radioID'];
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
     * @return int
     */
    public function getRecordId()
    {
        return $this->recordid;
    }

    /**
     * @return int
     */
    public function getRadioId()
    {
        return $this->radioid;
    }

    /**
     * @param mixed $recordid
     */
    public function setRecordId($recordid)
    {
        $this->recordid = htmlentities($recordid);
    }

    /**
     * @param mixed $radioid
     */
    public function setRadioId($radioid)
    {
        $this->radioid = htmlentities($radioid);
    }

}


/**
 * Class BestellingRemovable
 */

class BestellingRemovable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $recordid;

    /**
     * @var int
     */
    private $removableid;

    /**
     * @var PDO
     */
    private $db;

    /**
     * @param $dbconnection
     * @param string $id
     */


    public function __construct($dbconnection, $id = "")
    {

        $this->db = $dbconnection;
        if ($id != "" && is_numeric($id)) {
            $this->read($id);
        }

    }

    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO bestellingremovable(
                                                           recordID,
                                                           removableID)
                                    VALUES(:recid, :remid)");
            $stmt->bindParam(":recid", $this->recordid);
            $stmt->bindParam(":remid", $this->removableid);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "er is iets misgegaan met de verbinding van de server!" . $e->getMessage();
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
            $stmt = $this->db->prepare("SELECT ID,
                                               recordID,
                                               removableID                             
                                                FROM bestellingremovable WHERE ID = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['ID'];
            $this->recordid = $result['recordID'];
            $this->removableid = $result['removableID'];
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
     * @return int
     */
    public function getRecordId()
    {
        return $this->recordid;
    }

    /**
     * @return int
     */
    public function getRemovableId()
    {
        return $this->removableid;
    }

    /**
     * @param mixed $recordid
     */
    public function setRecordId($recordid)
    {
        $this->recordid = htmlentities($recordid);
    }

    /**
     * @param mixed $removableid
     */
    public function setRemovableId($removableid)
    {
        $this->removableid = htmlentities($removableid);
    }

}
?>

