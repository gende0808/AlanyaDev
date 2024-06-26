<?php

class DiscountList
{
    /**
     * @var array
     */
    private $listofdiscounts = array();
    /**
     * @var array
     */
    private $highestid = array();
    /**
     * @var PDO
     */
    private $db;


    function __construct($dbconnection)
    {
        $this->db = $dbconnection; // moet nog error handling bij

        try
        {
            $stmt = $this->db->prepare("SELECT actie.ActieID FROM actie ORDER BY `ActieID`");
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->listofdiscounts[] = new Discount($this->db, $result['ActieID']);
            }



        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    /**
     * @return Discount[]
     */
    function getlistofdiscounts()
    {
        return $this->listofdiscounts;
    }
    /**
     * @return
     */
    function gethighestid()
    {
        return $this->highestid;
    }

}