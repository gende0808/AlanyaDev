<?php

class Product implements CRUD
{

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

    public function __construct($dbconnection)
    {
        $this->db = $dbconnection;
    }

    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO product(productNummer,productNaam,productOmschrijving,productPrijs)
                                    VALUES(:prodnr, :prodname, :proddescription, :prodprice)");
            $stmt->bindparam(":prodnr", $this->productnumber);
            $stmt->bindparam(":prodname", $this->productname);
            $stmt->bindparam(":proddescription", $this->productdescription);
            $stmt->bindparam(":prodprice", $this->productprice);
            $stmt->execute();

        } catch (PDOException $e) {
            echo "er is iets misgegaan met het maken van het product!" . " " . $e->getMessage();
        }
    }

    public function read($id)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id is geen getal');
        }

        try {
            $stmt = $this->db->prepare("SELECT id,productNummer,productNaam,productOmschrijving,productPrijs FROM product WHERE id=" . $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->productnumber = $result['productNummer'];
            $this->productname = $result['productNaam'];
            $this->productdescription = $result['productOmschrijving'];
            $this->productprice = $result['productPrijs'];
            $this->id = $result['id'];
        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }

    }

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
                                                           WHERE id=" . $id);
            $stmt->bindparam(":prodnr", $this->productnumber);
            $stmt->bindparam(":prodname", $this->productname);
            $stmt->bindparam(":proddescription", $this->productdescription);
            $stmt->bindparam(":prodprice", $this->productprice);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {

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
     * @return mixed
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


}