<?php

class DiscountList2
{
    /**
     * @var array
     */
    private $listofdiscounts2 = array();
    /**
     * @var PDO
     */
    private $db;

    function __construct($dbconnection)
    {
        $this->db = $dbconnection; // moet nog error handling bij

        try
        {
            $stmt = $this->db->prepare("SELECT actieID FROM actie2");
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->listofdiscounts2[] = new Discount2($this->db, $result['actieID']);
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
    function getlistofdiscounts2()
    {
        return $this->listofdiscounts2;
    }

}