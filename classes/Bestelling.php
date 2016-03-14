<?php

/**
 * Class Order
 */



class Order implements CRUD{
    /**
     * @var int
     */
    private $bestellingid;
    /**
     * @var int
     */
    private $productid;
    /**
     * @var int
     */
    private $categoryid;
    /**
     * @var int
     */
    private $productaddingid;
    /**
     * @var int
     */
    private $quantity;
    /**
     * @var string
     */
    private $productnote;

    /**
     * @var PDO
     */
    private $db;



    public function __construct($dbconnection){
        $this->db = $dbconnection;
    }

    public function create(){
        try {
            $stmt = $this->db->prepare("INSERT INTO bestelling(productID,categorieID,productToevoegingID,aantal,productAantekening)
                                    VALUES(:productid, :categoryid, :productaddingid, :quantity, :productnote)");
            $stmt->bindparam(":productid", $this->productid);
            $stmt->bindparam(":categoryid", $this->categoryid);
            $stmt->bindparam(":productaddingid", $this->productaddingid);
            $stmt->bindparam(":quantity", $this->quantity);
            $stmt->bindparam(":productnote", $this->productnote);
            $stmt->execute();

        } catch(PDOException $e){
            echo "Er is iets misgegaan met de verbinding van de server!Boodschap".$e->getMessage();
        }
    }
    public function read($id){

        try {
            $stmt = $this->db->prepare("SELECT * FROM bestelling WHERE bestellingID= :orderid");
            $stmt->bindParam(':order', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->bestellingid = $result['bestellingID'];
            $this->catdescription = $result['categorieOmschrijving'];
            $this->discountID = $result['actieID'];
        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }
    }
    public function update($id){

    }
    public function delete($id){

    }

    /**
     * @return PDO
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param PDO $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return string
     */
    public function getProductnote()
    {
        return $this->productnote;
    }

    /**
     * @param string $productnote
     */
    public function setProductnote($productnote)
    {
        $this->productnote = $productnote;
    }

    /**
     * @return int
     */
    public function getProductaddingid()
    {
        return $this->productaddingid;
    }

    /**
     * @param int $productaddingid
     */
    public function setProductaddingid($productaddingid)
    {
        $this->productaddingid = $productaddingid;
    }

    /**
     * @return int
     */
    public function getCategoryid()
    {
        return $this->categoryid;
    }

    /**
     * @param int $categoryid
     */
    public function setCategoryid($categoryid)
    {
        $this->categoryid = $categoryid;
    }

    /**
     * @return int
     */
    public function getProductid()
    {
        return $this->productid;
    }

    /**
     * @param int $productid
     */
    public function setProductid($productid)
    {
        $this->productid = $productid;
    }

    /**
     * @return int
     */
    public function getBestellingid()
    {
        return $this->bestellingid;
    }

//    /**
//     * @param int $bestellingid
//     */
//    public function setBestellingid($bestellingid)
//    {
//        $this->bestellingid = $bestellingid;
//    }

}


?>