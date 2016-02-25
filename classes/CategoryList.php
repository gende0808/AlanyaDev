<?php

class CategoryList
{
    /**
     * @var array
     */
    private $listofcategories = array();
    /**
     * @var PDO
     */
    private $db;

    function __construct($dbconnection)
    {
        $this->db = $dbconnection; // moet nog error handling bij

        try {
            $stmt = $this->db->prepare("SELECT * FROM `categorie` ORDER BY `categorieID`");
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->listofcategories[] = $result;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    function getcategories()
    {
        return $this->listofcategories;
    }


}