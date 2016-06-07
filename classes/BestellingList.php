<?php

class BestellingList
{
    /**
     * @var array
     */
    private $listoforders = array();

    /**
     * @var array
     */
    private $orderlist = array();
    
    /**
     * @var PDO
     */
    private $db;

    function __construct($dbconnection)
    {
        $this->db = $dbconnection; // moet nog error handling bij

        try
        {
            $stmt = $this->db->prepare("SELECT * FROM bestelling ORDER BY bestelTijd DESC");
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->listoforders[] = new Bestelling($this->db, $result['bestellingNummer']);
            }

        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    public function Orderproduct()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM bestellingproduct WHERE bestellingNummer = :orderid");
            $stmt->bindParam(":orderid",$this->orderid);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->orderlist[] = new BestellingProduct($this->db, $prodid="", $result);
            }

        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }
    }


    /**
     * @return Bestelling[]
     */
    function getlistoforders()
    {
        return $this->listoforders;
    }

    /**
     * @return BestellingProduct[]
     */
    function getOrderlist()
    {
        return $this->orderlist;
    }

}