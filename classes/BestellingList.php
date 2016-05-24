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
            $stmt = $this->db->prepare("SELECT * FROM bestelling");
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

    /**
     * @return Bestelling[]
     */
    function getlistoforders()
    {
        return $this->listoforders;
    }

}