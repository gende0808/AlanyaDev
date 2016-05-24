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
                                               aantal,                             
                                                FROM bestellingproduct WHERE recordID :recordid");
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

}
?>

