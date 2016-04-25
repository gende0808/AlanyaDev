<?php

/**
 * Class Product
 */
class Discount implements CRUD
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
     * @var string
     */
    private $discountname;
    /**
     * @var string
     */
    private $discounttext;
    /**
     * @var boolean
     */
    private $discountsort;
    /**
     * @var boolean
     */
    private $monday;
    /**
     * @var boolean
     */
    private $tuesday;
    /**
     * @var boolean
     */
    private $wednesday;
    /**
     * @var boolean
     */
    private $thursday;
    /**
     * @var boolean
     */
    private $friday;
    /**
     * @var boolean
     */
    private $saturday;
    /**
     * @var boolean
     */
    private $sunday;
    /**
     * @var string
     */
    private $begindate;
    /**
     * @var string
     */
    private $enddate;
    /**
     * @var int
     */
    private $categorieID;
    /**
     * @var string
     */
    private $categorieName;
    /**
     * @var int
     */
    private $productID;
    /**
     * @var string
     */
    private $productName;
    /**
     * @var
     */
    private $categoryprice;
    /**
     * @var
     */
    private $discountprice;
    /**
     * @var
     */
    private $highestid;
    /**
     * @var string
     */
    private $completestring;



    /**
     * @param $dbconnection
     * @param string $productID
     */
    public function __construct($dbconnection, $id="")
    {
        $this->db = $dbconnection;
        if(!empty($id) && is_numeric($id)){
            $this->read($id);
        }

    }

    /**
     *
     */
    public function create()
    {
        if($this->discountsort === true) {
            try {
                $stmt2 = $this->db->prepare("SELECT MAX(actieID) AS maxactieID FROM actie");
                $stmt2->execute();
                while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                {
                    $this->highestid = $result2['maxactieID'];
                }

                $stmt = $this->db->prepare("
                                    INSERT INTO actie(ActieID,actieNaam,actieOmschrijving,actieSoort)
                                    VALUES(:discountid, :discountname, :discounttext, :actiesoort);
                                    INSERT INTO actiedatum(actieID,beginDatum,eindDatum,maandag,dinsdag,woensdag,donderdag,vrijdag,zaterdag,zondag)
                                    VALUES(:discountid2, :begindatum, :einddatum, :maandag, :dinsdag, :woensdag, :donderdag, :vrijdag, :zaterdag, :zondag);
                                    INSERT INTO actiecategorie(actieCatID,actieID,categorieID,prijs)
                                    VALUES(:discountid3, :discountid4, :categorieid, :categorieprijs);
                                    ");
                $stmt->bindValue(":discountid", $this->getHighestidplusone());
                $stmt->bindParam(":discountname", $this->discountname);
                $stmt->bindParam(":discounttext", $this->discounttext);
                $stmt->bindParam(":actiesoort", $this->discountsort);

                $stmt->bindValue(":discountid2", $this->getHighestidplusone());
                $stmt->bindParam(":begindatum", $this->begindate);
                $stmt->bindParam(":einddatum", $this->enddate);
                $stmt->bindParam(":maandag", $this->monday);
                $stmt->bindParam(":dinsdag", $this->tuesday);
                $stmt->bindParam(":woensdag", $this->wednesday);
                $stmt->bindParam(":donderdag", $this->thursday);
                $stmt->bindParam(":vrijdag", $this->friday);
                $stmt->bindParam(":zaterdag", $this->saturday);
                $stmt->bindParam(":zondag", $this->sunday);

                $stmt->bindValue(":discountid3", $this->getHighestidplusone());
                $stmt->bindValue(":discountid4", $this->getHighestidplusone());
                $stmt->bindParam(":categorieprijs", $this->categoryprice);
                $stmt->bindParam(":categorieid", $this->categorieID);

                $stmt->execute();

            } catch (PDOException $e) {
                echo "Er is iets misgegaan met het toevoegen van een actie!" . " " . $e->getMessage();
            }
        }
        else {
            try {
                $stmt2 = $this->db->prepare("SELECT MAX(actieID) AS maxactieID FROM actie");
                $stmt2->execute();
                while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC))
                {
                    $this->highestid = $result2['maxactieID'];
                }

                $stmt2 = $this->db->prepare("
                                    INSERT INTO actie(ActieID,actieNaam,actieOmschrijving,actieSoort)
                                    VALUES(:discountid, :discountname, :discounttext, :actiesoort);
                                    INSERT INTO actiedatum(actieID,beginDatum,eindDatum,maandag,dinsdag,woensdag,donderdag,vrijdag,zaterdag,zondag)
                                    VALUES(:discountid2, :begindatum, :einddatum, :maandag, :dinsdag, :woensdag, :donderdag, :vrijdag, :zaterdag, :zondag);
                                    INSERT INTO actieproduct(actieProID,actieID,productID,prijs)
                                    VALUES(:discountid3, :discountid4, :productid, :productprijs);
                                    ");
                $stmt2->bindValue(":discountid", $this->getHighestidplusone());//Bindvalue ipv bindparam
                $stmt2->bindParam(":discountname", $this->discountname);
                $stmt2->bindParam(":discounttext", $this->discounttext);
                $stmt2->bindParam(":actiesoort", $this->discountsort);

                $stmt2->bindValue(":discountid2", $this->getHighestidplusone());
                $stmt2->bindParam(":begindatum", $this->begindate);
                $stmt2->bindParam(":einddatum", $this->enddate);
                $stmt2->bindParam(":maandag", $this->monday);
                $stmt2->bindParam(":dinsdag", $this->tuesday);
                $stmt2->bindParam(":woensdag", $this->wednesday);
                $stmt2->bindParam(":donderdag", $this->thursday);
                $stmt2->bindParam(":vrijdag", $this->friday);
                $stmt2->bindParam(":zaterdag", $this->saturday);
                $stmt2->bindParam(":zondag", $this->sunday);

                $stmt2->bindValue(":discountid3", $this->getHighestidplusone());
                $stmt2->bindValue(":discountid4", $this->getHighestidplusone());
                $stmt2->bindParam(":productid", $this->productID);
                $stmt2->bindParam(":productprijs", $this->discountprice);

                $stmt2->execute();

            } catch (PDOException $e) {
                echo "Er is iets misgegaan met het toevoegen van een actie!" . " " . $e->getMessage();
            }
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
            $stmt = $this->db->prepare("
                                      SELECT actie . * , actiedatum . * , actieproduct . * , product . * , actiecategorie . * , categorie . *,
                                       CASE
                                WHEN actieproduct.prijs !=0
                                    THEN actieproduct.prijs
                                WHEN actiecategorie.prijs !=0
                                    THEN actiecategorie.prijs
                                ELSE product.productPrijs
                            END AS actiePrijs
FROM actie
INNER JOIN actiedatum ON actiedatum.actieID = actie.ActieID
LEFT JOIN actieproduct ON actieproduct.actieID = actie.ActieID
LEFT JOIN product ON product.id = actieproduct.productID
LEFT JOIN actiecategorie ON actiecategorie.actieID = actie.ActieID
LEFT JOIN categorie ON categorie.categorieID = actiecategorie.categorieID
                                         WHERE actie.ActieID= :actieid;

                                        ");
            $stmt->bindParam(":actieid", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['ActieID'];
            $this->discountname = $result['actieNaam'];
            $this->discounttext= $result['actieOmschrijving'];
            $this->discountsort= $result['actieSoort'];
            $this->begindate= $result['beginDatum'];
            $this->enddate= $result['eindDatum'];
            $this->monday= $result['maandag'];
            $this->tuesday= $result['dinsdag'];
            $this->wednesday= $result['woensdag'];
            $this->thursday= $result['donderdag'];
            $this->friday= $result['vrijdag'];
            $this->saturday= $result['zaterdag'];
            $this->sunday= $result['zondag'];
            $this->discountprice= $result['actiePrijs'];
            if(!empty ($result['productNaam']))
            {
                $this->productName = $result['productNaam'];
            }
            if(!empty ($result['categorieNaam']))
            {
                $this->productName= $result['categorieNaam'];
            }


        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }

    }

    /**
     * @param $id
     */
    public function update($id)
    {
        //TODO
    }

    /**
     * @param $id
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("
                                    DELETE FROM actie WHERE ActieID= :discountid;
                                    DELETE FROM actiedatum WHERE actieID= :discountid1;
                                    DELETE FROM actieproduct WHERE actieID= :discountid2;
                                    DELETE FROM actiecategorie WHERE actieID= :discountid3;
        ");
        $stmt->bindParam(':discountid', $id, PDO::PARAM_INT);
        $stmt->bindParam(':discountid1', $id, PDO::PARAM_INT);
        $stmt->bindParam(':discountid2', $id, PDO::PARAM_INT);
        $stmt->bindParam(':discountid3', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @return mixed $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDiscountname()
    {
        return $this->discountname;
    }

    /**
     * @param string $discountname
     */
    public function setDiscountname($discountname)
    {
        $this->discountname = $discountname;
    }

    /**
     * @return string
     */
    public function getDiscounttext()
    {
        return $this->discounttext;
    }

    /**
     * @return mixed
     */
    public function getHighestidplusone()
    {
        return $this->highestid+1;
    }

    /**
     * @param string $discounttext
     */
    public function setDiscounttext($discounttext)
    {
        $this->discounttext = $discounttext;
    }

    /**
     * @return boolean
     */
    public function getDiscounsort()
    {
        return $this->discountsort;
    }

    /**
     * @param boolean $discounsort
     */
    public function setDiscountsort($discountsort)
    {
        $this->discountsort = $discountsort;
    }

    /**
     * @return boolean
     */
    public function isMonday()
    {
        return $this->monday;
    }

    /**
     * @param boolean $monday
     */
    public function setMonday($monday)
    {
        $this->monday = $monday;
    }

    /**
     * @return boolean
     */
    public function isTuesday()
    {
        return $this->tuesday;
    }

    /**
     * @param boolean $tuesday
     */
    public function setTuesday($tuesday)
    {
        $this->tuesday = $tuesday;
    }

    /**
     * @return boolean
     */
    public function isWednesday()
    {
        return $this->wednesday;
    }

    /**
     * @param boolean $wednesday
     */
    public function setWednesday($wednesday)
    {
        $this->wednesday = $wednesday;
    }

    /**
     * @return boolean
     */
    public function isThursday()
    {
        return $this->thursday;
    }

    /**
     * @return string
     */
    public function getdays(){

        $completestring = '';

        if ($this->monday == true)
        {
            $completestring .= "ma, ";
        }
        if ($this->tuesday == true)
        {
            $completestring .= "di, ";
        }
        if ($this->wednesday == true)
        {
            $completestring .= "wo, ";
        }
        if ($this->thursday == true)
        {
            $completestring .= "do, ";
        }
        if ($this->friday == true)
        {
            $completestring .= "vr, ";
        }
        if ($this->saturday == true)
        {
            $completestring .= "za, ";
        }
        if ($this->sunday == true)
        {
            $completestring .=  "zo";
        }
        return $completestring;
    }

    /**
     * @param boolean $thursday
     */
    public function setThursday($thursday)
    {
        $this->thursday = $thursday;
    }

    /**
     * @return boolean
     */
    public function isFriday()
    {
        return $this->friday;
    }

    /**
     * @param boolean $friday
     */
    public function setFriday($friday)
    {
        $this->friday = $friday;
    }

    /**
     * @return boolean
     */
    public function isSaturday()
    {
        return $this->saturday;
    }

    /**
     * @param boolean $saturday
     */
    public function setSaturday($saturday)
    {
        $this->saturday = $saturday;
    }

    /**
     * @return boolean
     */
    public function isSunday()
    {
        return $this->sunday;
    }

    /**
     * @param boolean $sunday
     */
    public function setSunday($sunday)
    {
        $this->sunday = $sunday;
    }

    /**
     * @return string
     */
    public function getDiscountstartdate()
    {
        return $this->begindate;
    }

    /**
     * @param string $begindate
     */
    public function setDiscountstartdate($begindate)
    {
        $this->begindate = $begindate;
    }

    /**
     * @return string
     */
    public function getDiscountenddate()
    {
        return $this->enddate;
    }

    /**
     * @param string $enddate
     */
    public function setDiscountenddate($enddate)
    {
        $this->enddate = $enddate;
    }

    /**
     * @return string
     */
    public function getBegindate()
    {
        return $this->begindate;
    }

    /**
     * @param string $begindate
     */
    public function setBegindate($begindate)
    {
        $this->begindate = $begindate;
    }

    /**
     * @return string
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * @param string $enddate
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;
    }

    /**
     * @return int
     */
    public function getCategorieID()
    {
        return $this->categorieID;
    }

    /**
     * @param int $categorieID
     */
    public function setCategorieID($categorieID)
    {
        $this->categorieID = $categorieID;
    }

    /**
     * @return mixed
     */
    public function getCategoryprice()
    {
        return $this->categoryprice;
    }

    /**
     * @param mixed $categoryprice
     */
    public function setCategoryprice($discounteuro, $discountcents)
    {
        if (empty($discounteuro) && empty($discountcents)) {
            throw new InvalidArgumentException("prijs mag niet leeg zijn");
        }
        if (empty($discountcents)) {
            $discountcents = 00;
        }
        if (empty($discounteuro)) {
            $discounteuro = 00;
        }
        if (!is_numeric($discounteuro) || !is_numeric($discountcents)) {
            throw new InvalidArgumentException("bedrag moet een getal zijn");
        }

        if ($discounteuro < 0 || $discountcents < 0) {
            throw new InvalidArgumentException("prijs kan niet lager dan 0 zijn");
        }
        if (strlen($discounteuro) > 11 || strlen($discountcents) > 2) {
            throw new InvalidArgumentException("bedrag te groot of centen kloppen niet");
        }

        $this->categoryprice = htmlentities($discounteuro . "." . $discountcents);
    }

    /**
     * @return int
     */
    public function getProductID()
    {
        return $this->productID;
    }

    /**
     * @param int $productID
     */
    public function setProductID($productID)
    {
        $this->productID = $productID;
    }

    /**
     * @return mixed
     */
    public function getDiscountprice()
    {
        return $this->discountprice;
    }

    /**
     * @param mixed $discountprice
     */
    public function setDiscountprice($discounteuro, $discountcents)
    {
        if (empty($discounteuro) && empty($discountcents)) {
            throw new InvalidArgumentException("prijs mag niet leeg zijn");
        }
        if (empty($discountcents)) {
            $discountcents = 00;
        }
        if (empty($discounteuro)) {
            $discounteuro = 00;
        }
        if (!is_numeric($discounteuro) || !is_numeric($discountcents)) {
            throw new InvalidArgumentException("bedrag moet een getal zijn");
        }

        if ($discounteuro < 0 || $discountcents < 0) {
            throw new InvalidArgumentException("prijs kan niet lager dan 0 zijn");
        }
        if (strlen($discounteuro) > 11 || strlen($discountcents) > 2) {
            throw new InvalidArgumentException("bedrag te groot of centen kloppen niet");
        }

        $this->discountprice = htmlentities($discounteuro . "." . $discountcents);
    }

    /**
     * @return string
     */
    public function getCategorieName()
    {
        return $this->categorieName;
    }

    /**
     * @param string $categorieName
     */
    public function setCategorieName($categorieName)
    {
        $this->categorieName = $categorieName;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
    }










}