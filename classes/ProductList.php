<?php

class ProductList
{
    /**
     * @var array
     */
    private $listofproducts = array();
    /**
     * @var PDO
     */
    private $db;

    function __construct($dbconnection, $categoryID = 1)
    {

        $this->db = $dbconnection; // moet nog error handling bij


        if (!is_numeric($categoryID)) {
            throw new InvalidArgumentException("CategorieID was niet geldig ingevoerd!");
        }
        if ($categoryID === null) {
            try {
                $stmt = $this->db->prepare("SELECT * FROM product ORDER BY `productNummer` ");
                $stmt->execute();
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $this->listofproducts[] = $result;
                }

            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        if (is_numeric($categoryID)) {
            try {
                $stmt = $this->db->prepare("SELECT * FROM product WHERE categorieID= :catid ORDER BY `productNummer`");
                $stmt->bindParam(':catid', $categoryID, PDO::PARAM_INT);
                $stmt->execute();
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $this->listofproducts[] = $result;
                }

            } catch (PDOException $e) {
                echo $e->getMessage();
            }

        }
    }

    function getlistofproducts()
    {
        return $this->listofproducts;
    }

    function getids()
    {
        return $this->listofproducts;
    }


}


?>