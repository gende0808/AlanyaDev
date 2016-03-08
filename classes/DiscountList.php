<?php

class DiscountList
{
    /**
     * @var array
     */
    private $listofdiscounts = array();
    /**
     * @var PDO
     */
    private $db;

    function __construct($dbconnection)
    {
        $this->db = $dbconnection; // moet nog error handling bij

        try
        {
            $stmt = $this->db->prepare("SELECT actieID FROM actie");
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->listofdiscounts[] = new Discount($this->db, $result['actieID']);
            }

        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    /**
     * @return 
     */
    function getlistofdiscounts()
    {
        return $this->listofdiscounts;
    }

}