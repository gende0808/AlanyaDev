<?php

class ProductList
{
    /**
     * @var array
     */
    private $listofproducts = array();


    /**
     * @var array
     */
    private $listofids = array();
    /**
     * @var PDO
     */
    private $db;

    function __construct($dbconnection,$categoryID)
    {
        $this->db = $dbconnection; // moet nog error handling bij


        if (!is_numeric($categoryID)) {
            throw new InvalidArgumentException("CategorieID is geen getal!");
        }
        if (empty($categoryID)) {
            $categoryID = 1;
        }

        try {
            $stmt = $this->db->prepare("SELECT id FROM product WHERE categorieID= :catid");
            $stmt->bindParam(':catid', $categoryID, PDO::PARAM_INT);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->listofids[] = $result['id'];
            }

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }



    }

    function getids()
    {
        return $this->listofids;
    }






}


?>