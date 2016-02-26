<?php

/**
 * Class Product
 */
class Product implements CRUD
{

    /**
     * @var
     */
    private $id;
    /**
     * @var PDO
     */
    private $db;
    /**
     * @var int
     */
    private $productnumber;
    /**
     * @var string
     */
    private $productname;
    /**
     * @var string
     */
    private $productdescription;
    /**
     * @var
     */
    private $productprice;

    /**
     * @var int
     */
    private $categoryid;

    /**
     * @var
     */
    private $productinfo = array();

    /**
     * @var
     */
    private $productid;

    /**
     * @param $dbconnection
     * @param string $productID
     */
    public function __construct($dbconnection, $productID="")
    {
        $this->db = $dbconnection;

        if (is_numeric($productID)){
            $this->read($productID);
        }
    }

    /**
     *
     */
    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO product(productNummer,productNaam,productOmschrijving,productPrijs, categorieID)
                                    VALUES(:prodnr, :prodname, :proddescription, :prodprice, :catid)");
            $stmt->bindparam(":prodnr", $this->productnumber);
            $stmt->bindparam(":prodname", $this->productname);
            $stmt->bindparam(":proddescription", $this->productdescription);
            $stmt->bindparam(":prodprice", $this->productprice);
            $stmt->bindparam(":catid", $this->categoryid);
            $stmt->execute();

        } catch (PDOException $e) {
            echo "er is iets misgegaan met het maken van het product!" . " " . $e->getMessage();
        }
    }

    /**
     * @param $id
     */
    public function read($id)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id is geen getal');
        }

        try {
            $stmt = $this->db->prepare("SELECT id,productNummer,productNaam,productOmschrijving,productPrijs,categorieID FROM product WHERE id=" . $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->productnumber = $result['productNummer'];
            $this->productname = $result['productNaam'];
            $this->productdescription = $result['productOmschrijving'];
            $this->productprice = $result['productPrijs'];
            $this->categoryid = $result['categorieID'];
            $this->id = $result['id'];
        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }

    }

    /**
     * @param $id
     */
    public function update($id)
    {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException('id is geen getal!');
        }
        try {
            $stmt = $this->db->prepare("UPDATE product SET productNummer = :prodnr,
                                                           productNaam = :prodname,
                                                           productOmschrijving = :proddescription,
                                                           productPrijs = :prodprice
                                                           categorieID = :catid;
                                                           WHERE id=".$id);
            $stmt->bindparam(":prodnr", $this->productnumber);
            $stmt->bindparam(":prodname", $this->productname);
            $stmt->bindparam(":proddescription", $this->productdescription);
            $stmt->bindparam(":prodprice", $this->productprice);
            $stmt->bindparam(":catid", $this->categoryid);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM product WHERE id= :productid");
        $stmt->bindParam(':productid', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @return int
     */
    public function getProductid()
    {
        return $this->productid;
    }

    /**
     * @param $productid
     */
    public function setProductid($productid)
    {
        $this->productid = $productid;
    }


    /**
     * @return int
     */
    public function getProductnumber()
    {
        return $this->productnumber;
    }

    /**
     * @param int $productnumber
     */
    public function setProductnumber($productnumber)
    {
        if (empty($productnumber)) {
            throw new InvalidArgumentException("Productnummer is niet ingevoerd!");
        }
        if (!is_numeric($productnumber)) {
            throw new InvalidArgumentException("productnummer is geen getal!");
        }

        $this->productnumber = $productnumber;
    }

    /**
     * @return string
     */
    public function getProductprice()
    {
        return $this->productprice;

    }

    /**
     * @param mixed $productprice
     */
    public function setProductprice($productprice, $cents)
    {
        if (empty($productprice) && empty($cents)) {
            throw new InvalidArgumentException("prijs mag niet leeg zijn");
        }
        if (empty($cents)) {
            $cents = 00;
        }
        if (empty($productprice)) {
            $productprice = 00;
        }
        if (!is_numeric($productprice) || !is_numeric($cents)) {
            throw new InvalidArgumentException("bedrag moet een getal zijn");
        }

        if ($productprice < 0 || $cents < 0) {
            throw new InvalidArgumentException("prijs kan niet lager dan 0 zijn");
        }
        if (strlen($productprice) > 11 || strlen($cents) > 2) {
            throw new InvalidArgumentException("bedrag te groot of centen kloppen niet");
        }

        $this->productprice = $productprice . "." . $cents;
    }

    /**
     * @return string
     */
    public function getProductdescription()
    {
        return $this->productdescription;
    }

    /**
     * @param string $productdescription
     */
    public function setProductdescription($productdescription)
    {
        $this->productdescription = $productdescription;
    }

    /**
     * @return string
     */
    public function getProductname()
    {
        return $this->productname;
    }

    /**
     * @param string $productname
     */
    public function setProductname($productname)
    {
        if (empty($productname)) {
            throw new InvalidArgumentException("productnaam mag niet leeg zijn!");
        }
        $this->productname = $productname;
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
        //moet nog error handling in zodat er gecheckt wordt of dit een int is, niet leeg is etc.
        $this->categoryid = $categoryid;
    }



}