<?php

class OrderList
{
    /**
     * @var array
     */
    private $listoforders = array();
    /**
     * @var PDO
     */
    private $db;

    function __construct($dbconnection)
    {
        $this->db = $dbconnection; // moet nog error handling bij

        try
        {
            $stmt = $this->db->prepare("SELECT bestellingID FROM bestelling");
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->listoforders[] = new Order($this->db, $result['bestellingID']);
            }

        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    /**
     * @return Order[]
     */
    function getlistoforders()
    {
        return $this->listoforders;
    }

}