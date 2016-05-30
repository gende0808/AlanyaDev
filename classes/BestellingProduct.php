<?php

/**
 * Class Order
 */

class BestellingProduct
{

    /**
     * @param int
     */
    private $lastinsertedid;

    /**
     * @var int
     */
    private $recordid;

    /**
     * @var int
     */
    private $orderid;

    /**
     * @var int
     */
    private $productid;

    /**
     * @var int
     */
    private $number;

    /**
     * @var PDO
     */
    private $db;
    /**
     * @var array
     */
    private $listofremovables = array();
    /**
     * @var array
     */
    private $listofaddables = array();
    /**
     * @var array
     */
    private $listofradios = array();

    /**
     * @param $dbconnection
     * @param string $id
     */


    public function __construct($dbconnection, $id = "",$result ="")
    {

        $this->db = $dbconnection;
        if ($id != "" && is_numeric($id)) {
            $this->read($id);
        }
        if (!empty($result)){
            $this->number = $result['aantal'];
            $this->productid = $result['productID'];
            $this->recordid = $result['recordID'];
        }


    }

    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO bestellingproduct(
                                                           bestellingNummer,
                                                           productID,
                                                           aantal)
                                    VALUES(:besteln, :prodid, :aantal)");
            $stmt->bindParam(":besteln", $this->orderid);
            $stmt->bindParam(":prodid", $this->productid);
            $stmt->bindParam(":aantal", $this->number);
            $stmt->execute();
            $this->lastinsertedid = $this->db->lastInsertId();
        } catch (PDOException $e) {
            echo "er is iets misgegaan met de verbinding van de server!" . $e->getMessage();
        }
    }
    public function ProductAdditions()
    {
        try {
            $stmt = $this->db->prepare("SELECT addableID FROM bestellingaddable WHERE recordID = :recordid");
            $stmt->bindParam(":recordid", $this->recordid);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->listofaddables[] = new ProductAddition($this->db,$result['addableID']);
            }

        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }
        try {
            $stmt = $this->db->prepare("SELECT removableID FROM bestellingremovable WHERE recordID = :recordid");
            $stmt->bindParam(":recordid", $this->recordid);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->listofremovables[] = new ProductAdditionRemovable($this->db,$result['removableID']);
            }

        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }
        try {
            $stmt = $this->db->prepare("SELECT radioID FROM bestellingradio WHERE recordID = :recordid");
            $stmt->bindParam(":recordid", $this->recordid);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->listofradios[] = new ProductRadioAddition($this->db,$result['radioID']);
            }

        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
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
            $stmt = $this->db->prepare("SELECT recordID,
                                               bestellingNummer,
                                               productID,
                                               aantal                            
                                                FROM bestellingproduct WHERE recordID = :recordid");
            $stmt->bindParam(':recordID', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->recordid = $result['recordID'];
            $this->orderid = $result['bestellingNummer'];
            $this->productid = $this->productid['productID'];
            $this->number = $this->number['aantal'];
        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }
    }

    /**
     * @return mixed
     */
    public function getLastinsertedid()
    {
        return $this->lastinsertedid;
    }

    /**
     * @return int
     */
    public function getRecordid()
    {
        return $this->recordid;
    }

    /**
     * @return int
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * @return int
     */
    public function getProductid()
    {
        return $this->productid;
    }

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $orderid
     */
    public function setOrderid($orderid)
    {
        $this->orderid = htmlentities($orderid);
    }

    /**
     * @param mixed $productid
     */
    public function setProductid($productid)
    {
        $this->productid = htmlentities($productid);
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = htmlentities($number);
    }

    /**
     * @return ProductAdditionRemovable[]
     */
    public function getListofremovables()
    {
        return $this->listofremovables;
    }

    /**
     * @return ProductAddition[]
     */
    public function getListofaddables()
    {
        return $this->listofaddables;
    }

    /**
     * @return ProductRadioAddition[]
     */
    public function getListofradios()
    {
        return $this->listofradios;
    }

}
?>

