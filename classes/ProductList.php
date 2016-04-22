<?php
//uitzoeken wat mysql aankan qua queries.
/**
 * Class ProductList
 */
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

    /**
     * @param $dbconnection
     * @param int $categoryID
     */
    function __construct($dbconnection, $categoryID = 1, $getall_products = false)
    {


        $this->db = $dbconnection; // moet nog error handling bij

        if (!is_numeric($categoryID)) {
            throw new InvalidArgumentException("CategorieID was niet geldig ingevoerd!");
        }
        if($getall_products === true)
        {
            try {
                $stmt = $this->db->prepare("
                SELECT *
                FROM  `product`
                ORDER BY  `product`.`categorieID` ASC
                ");
                $stmt->bindParam(':catid', $categoryID, PDO::PARAM_INT);
                $stmt->execute();
                while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    $this->listofproducts[] = new Product($this->db, $result['id']);
                }


            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        else {
            if (is_numeric($categoryID)) {
                try {
                    $stmt = $this->db->prepare("
                SELECT *
                    FROM product
                ORDER BY productNummer * 1, `productNummer` ASC");
                    $stmt->bindParam(':catid', $categoryID, PDO::PARAM_INT);
                    $stmt->execute();
                    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $this->listofproducts[] = new Product($this->db, $result['id']);
                    }


                } catch (PDOException $e) {
                    echo $e->getMessage();
                }

            }
        }
    }

    /**
     * @return Product[]
     */
    function getlistofproducts()
    {
        return $this->listofproducts;
    }

    /**
     * @return array
     */
    function getids()
    {
        return $this->listofproducts;
    }


}


?>