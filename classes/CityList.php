<?php

class CityList
{
    /**
     * @var array
     */
    private $listofcities = array();
    /**
     * @var PDO
     */
    private $db;

    function __construct($dbconnection)
    {
        $this->db = $dbconnection; // moet nog error handling bij

            try
            {
                $stmt = $this->db->prepare("SELECT plaatsID FROM plaats");
                $stmt->execute();
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $this->listofcities[] = new City($this->db, $result['plaatsID']);
                }

            }
            catch (PDOException $e)
            {
                echo $e->getMessage();
            }

    }

    /**
     * @return City[]
     */
    function getlistofcities()
    {
        return $this->listofcities;
    }

}