<?php

/**
 * Class Product
 */
class City implements CRUD
{

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $oldid;
    /**
     * @var PDO
     */
    private $db;
    /**
     * @var int
     */
    private $city;
    /**
     * @var string
     */
    private $deliverycost;


    /**
     * @param $dbconnection
     * @param string $productID
     */
    public function __construct($dbconnection)
    {
        $this->db = $dbconnection;
    }

    /**
     *
     */
    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO plaats(plaatsID,plaatsNaam,extraKosten)
                                    VALUES(:cityid, :cityname, :delivery)");
            $stmt->bindparam(":cityid", $this->id);
            $stmt->bindparam(":cityname", $this->city);
            $stmt->bindparam(":delivery", $this->deliverycost);

            $stmt->execute();

        } catch (PDOException $e) {
            echo "er is iets misgegaan met het toevoegen van een stad!" . " " . $e->getMessage();
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
            $stmt = $this->db->prepare("SELECT plaatsID,plaatsNaam,extraKosten FROM plaats WHERE plaatsID= :cityid");
            $stmt->bindparam(":cityid", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['plaatsID'];
            $this->city = $result['plaatsNaam'];
            $this->deliverycost= $result['extraKosten'];
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
            $stmt = $this->db->prepare("UPDATE plaats SET  plaatsID = :cityid,
                                                           plaatsNaam = :cityname,
                                                           extraKosten = :delivery
                                                           WHERE plaatsID= :oldid");
            $stmt->bindparam(":cityid", $this->id);
            $stmt->bindparam(":cityname", $this->city);
            $stmt->bindparam(":delivery", $this->deliverycost);
            $stmt->bindparam(":oldid", $this->oldid);

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
        $stmt = $this->db->prepare("DELETE FROM plaats WHERE plaatsID= :cityid");
        $stmt->bindParam(':cityid', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @return int
     */
    public function getCityid()
    {
        return $this->id;
    }

    /**
     * @param $cityid
     */
    public function setCityid($cityid)
    {
        $this->id = $cityid;
    }

    /**
     * @return int
     */
    public function getOldid()
    {
        return $this->oldid;
    }

    /**
     * @param $productid
     */
    public function setOldid($oldid)
    {
        $this->oldid = $oldid;
    }

    /**
     * @return string
     */
    public function getCityname()
    {
        return $this->city;
    }

    /**
     * @param int $city
     */
    public function setCityname($city)
    {
        if (empty($city)) {
            throw new InvalidArgumentException("Plaatsnummer is niet ingevoerd!");
        }
        if (is_numeric($city)) {
            throw new InvalidArgumentException("Plaatsnummer moet geen getal zijn!");
        }

        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getAdditionalcost()
    {
        return $this->deliverycost;
    }

    /**
     * @param $deliverycost
     */
    public function setAdditionalcost($deliverycost)
    {
        $this->deliverycost = $deliverycost;
    }
//
//
//    /**
//     * @param mixed $productprice
//     */
//    public function setProductprice($productprice, $cents)
//    {
//        if (empty($productprice) && empty($cents)) {
//            throw new InvalidArgumentException("prijs mag niet leeg zijn");
//        }
//        if (empty($cents)) {
//            $cents = 00;
//        }
//        if (empty($productprice)) {
//            $productprice = 00;
//        }
//        if (!is_numeric($productprice) || !is_numeric($cents)) {
//            throw new InvalidArgumentException("bedrag moet een getal zijn");
//        }
//
//        if ($productprice < 0 || $cents < 0) {
//            throw new InvalidArgumentException("prijs kan niet lager dan 0 zijn");
//        }
//        if (strlen($productprice) > 11 || strlen($cents) > 2) {
//            throw new InvalidArgumentException("bedrag te groot of centen kloppen niet");
//        }
//
//        $this->productprice = $productprice . "." . $cents;
//    }
//
//    /**
//     * @return string
//     */
//    public function getProductdescription()
//    {
//        return $this->productdescription;
//    }
//
//    /**
//     * @param string $productdescription
//     */
//    public function setProductdescription($productdescription)
//    {
//        $this->productdescription = $productdescription;
//    }
//
//    /**
//     * @return string
//     */
//    public function getProductname()
//    {
//        return $this->productname;
//    }
//
//    /**
//     * @param string $productname
//     */
//    public function setProductname($productname)
//    {
//        if (empty($productname)) {
//            throw new InvalidArgumentException("productnaam mag niet leeg zijn!");
//        }
//        $this->productname = $productname;
//    }
//
//    /**
//     * @return int
//     */
//    public function getCategoryid()
//    {
//        return $this->categoryid;
//    }
//
//    /**
//     * @param int $categoryid
//     */
//    public function setCategoryid($categoryid)
//    {
//        //moet nog error handling in zodat er gecheckt wordt of dit een int is, niet leeg is etc.
//        $this->categoryid = $categoryid;
//    }



}