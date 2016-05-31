<?php

/**
 * Class Product
 */
class Product implements CRUD
{
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
     * @var string
     */
    private $beginActieDatum;
    /**
     * @var string
     */
    private $eindActieDatum;
    /**
     * @var boolean
     */
    private $maandag;
    /**
     * @var boolean
     */
    private $dinsdag;
    /**
     * @var boolean
     */
    private $woensdag;
    /**
     * @var boolean
     */
    private $donderdag;
    /**
     * @var boolean
     */
    private $vrijdag;
    /**
     * @var boolean
     */
    private $zaterdag;
    /**
     * @var boolean
     */
    private $zondag;
    /**
     * @var
     */
    private $productprice;
    /**
     * @var
     */
    private $productdiscountprice;

    /**
     * @var int
     */
    private $categoryid;
    /**
     * @var int
     */
    private $additionid;
    /**
     * @var
     */
    private $productid;
    /**
     * @var array
     */
    private $product_info = array();


    /**
     * @param $dbconnection
     * @param string $productID
     */
    public function __construct($dbconnection, $productID = null)
    {
        $this->db = $dbconnection;

        if (is_numeric($productID) && $productID != null) {
            $this->read($productID);
        }
    }

    /**
     *
     */
    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO product(productNummer,productNaam,productOmschrijving,productPrijs, categorieID, toevoeginggroepid)
                                    VALUES(:prodnr, :prodname, :proddescription, :prodprice, :catid, :additionid)");
            $stmt->bindParam(":prodnr", $this->productnumber);
            $stmt->bindParam(":prodname", $this->productname);
            $stmt->bindParam(":proddescription", $this->productdescription);
            $stmt->bindParam(":prodprice", $this->productprice);
            $stmt->bindParam(":catid", $this->categoryid);
            $stmt->bindParam(":additionid", $this->additionid);
            $stmt->execute();

        } catch (PDOException $e) {
            echo "er is iets misgegaan met het maken van het product!" . " " . $e->getMessage();
        }
    }

    /**
     *
     */
    public function simpleproductdata($id)
{
    $stmt = $this->db->prepare("SELECT * FROM product WHERE id = :prodid");
    $stmt->bindParam(":prodid",$id );
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->product_info = $result;
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
            $stmt = $this->db->prepare("
                           SELECT product.*, actieproduct.* , actiecategorie.* ,actiedatum.*,
                            CASE
                                WHEN actieproduct.prijs >= 0 
                                    THEN actieproduct.prijs
                                WHEN actiecategorie.prijs >= 0
                                    THEN actiecategorie.prijs
                                ELSE product.productPrijs
                            END AS actiePrijs
                            FROM product
                            LEFT JOIN actieproduct ON actieproduct.productID = product.id
                            LEFT JOIN actiecategorie ON actiecategorie.categorieID = product.categorieID
                            LEFT JOIN actiedatum ON actiedatum.actieID = actieproduct.actieID OR
                                                    actiedatum.actieID = actiecategorie.actieID
                            WHERE product.id= :id
                            ");
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->product_info = $result;
            $this->productnumber = $result['productNummer'];
            $this->productname = $result['productNaam'];
            $this->productdescription = $result['productOmschrijving'];
            $this->productprice = $result['productPrijs'];
            $this->productdiscountprice = $result['actiePrijs'];
            $this->categoryid = $result['categorieID'];
            $this->productid = $result['id'];
            $this->beginActieDatum = $result['beginDatum'];
            $this->eindActieDatum = $result['eindDatum'];
            $this->maandag = $result['maandag'];
            $this->dinsdag = $result['dinsdag'];
            $this->woensdag = $result['woensdag'];
            $this->donderdag = $result['donderdag'];
            $this->vrijdag = $result['vrijdag'];
            $this->zaterdag = $result['zaterdag'];
            $this->zondag = $result['zondag'];
            $this->productid = $result['id'];
            $this->additionid = $result['toevoeginggroepid'];


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
                                                           productPrijs = :prodprice,
                                                           categorieID = :catid,
                                                           toevoeginggroepid = :toevid
                                                           WHERE id= :product_id");
            $stmt->bindParam(":prodnr", $this->productnumber);
            $stmt->bindParam(":prodname", $this->productname);
            $stmt->bindParam(":proddescription", $this->productdescription);
            $stmt->bindParam(":prodprice", $this->productprice);
            $stmt->bindParam(":catid", $this->categoryid);
            $stmt->bindParam(":toevid", $this->additionid);
            $stmt->bindParam(":product_id", $id);
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
        $this->productid = htmlentities($productid);
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

        $this->productnumber = htmlentities($productnumber);
    }

    /**
     * @return string
     */
    public function getProductprice()
    {
       return $this->productprice;

    }

    /**
     * @return string
     */
    public function getActiebegindatum()
    {

        return $this->beginActieDatum;
    }
    /**
     * @return string
     */
    public function getActieEinddatum()
    {

        return $this->eindActieDatum;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->productid;
    }

    /**
     * @return boolean
     */
    public function getMonday()
    {
        if($this->maandag) {
            return "Monday";
        }
    }

    /**
     * @return boolean
     */
    public function getTuesday()
    {
        if($this->dinsdag) {
            return "Tuesday";
        }
    }

    /**
     * @return boolean
     */
    public function getWednesday()
    {
        if($this->woensdag) {
            return "Wednesday";
        }
    }

    /**
     * @return boolean
     */
    public function getThursday()
    {
        if($this->donderdag) {
            return "Thursday";
        }
    }

    /**
     * @return boolean
     */
    public function getFriday()
    {
        if($this->vrijdag) {
            return "Friday";
        }
    }

    /**
     * @return boolean
     */
    public function getSaturday()
    {
        if($this->zaterdag) {
            return "Saturday";
        }
    }

    /**
     * @return boolean
     */
    public function getSunday()
    {
        if($this->zondag) {
            return "Sunday";
        }
    }

    /**
     * @return string
     */
    public function getProductpriceformatted()
    {

        return '€ '.str_replace('.',',',$this->productprice);
    }
    /**
     * @return string
     */
    public function getProductdiscountprice()
    {
        $huidigeDatum = date('Y-m-d');
        $huidigeDatum = date('Y-m-d', strtotime($huidigeDatum));

        $huidigeDag = date("l"); //is gelijk aan de dag van vandaag
        $actieshowen = false;

        $productprijs = "";

        if ($this->maandag === $huidigeDag
            or $this->dinsdag  === $huidigeDag
            or $this->woensdag  === $huidigeDag
            or $this->donderdag  === $huidigeDag
            or $this->vrijdag  === $huidigeDag
            or $this->zaterdag  === $huidigeDag
            or $this->zondag  === $huidigeDag
        ) {
            $actieshowen = true;
        }
        $productprijs = "";
        $data_product_price = $this->productprice;
        if (($this->beginActieDatum <= $huidigeDatum
                && $this->eindActieDatum >= $huidigeDatum)
            or $actieshowen == true)
        {
            if ($this->productdiscountprice < $this->productprice)
            {
                $productprijs = $this->productdiscountprice;
                $data_product_price = $this->productdiscountprice;
            }
        }
        $data_product_price = str_replace(".", ",", $data_product_price);

        if($productprijs != 0)
        {
            return $productprijs;
        }
        else
        {
            return $this->productprice;
        }
    }

    /**
     * @return string
     */
    public function getDiscountpriceformatted()
    {
        return '€ '.str_replace('.',',',$this->productdiscountprice);
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

        $this->productprice = htmlentities($productprice . "." . $cents);
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
        $this->productdescription = htmlentities($productdescription);
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
        $this->productname = htmlentities($productname);
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
        $this->categoryid = htmlentities($categoryid);
    }

    /**
     * @return array
     */
    public function getProductInfo(){
        return $this->product_info;
    }

    /**
     * @param $additionid
     */
    public function setAdditionId($additionid){
        $this->additionid = $additionid;
    }

    /**
     * @return int
     */
    public function getAdditionId(){
        return $this->additionid;
    }
}