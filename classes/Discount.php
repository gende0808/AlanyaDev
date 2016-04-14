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
     * @var int
     */
    private $productID;
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
                                    INSERT INTO actie(actieID,actieNaam,actieOmschrijving,actieSoort)
                                    VALUES(:discountid, :discountname, :discounttext, :actiesoort);
                                    INSERT INTO actiedatum(actieID,beginDatum,eindDatum,maandag,dinsdag,woensdag,donderdag,vrijdag,zaterdag,zondag)
                                    VALUES(:discountid2, :begindatum, :einddatum, :maandag, :dinsdag, :woensdag, :donderdag, :vrijdag, :zaterdag, :zondag);
                                    INSERT INTO actiecategorie(id,actieID,categorieID,prijs)
                                    VALUES(:discountid3, :discountid4, :categorieid, :categorieprijs);
                                    ");
                $stmt->bindparam(":discountid", $this->getHighestidplusone());
                $stmt->bindparam(":discountid2", $this->getHighestidplusone());
                $stmt->bindparam(":discountid3", $this->getHighestidplusone());
                $stmt->bindparam(":discountid4", $this->getHighestidplusone());
                $stmt->bindparam(":discountname", $this->discountname);
                $stmt->bindparam(":discounttext", $this->discounttext);
                $stmt->bindparam(":begindatum", $this->begindate);
                $stmt->bindparam(":einddatum", $this->enddate);
                $stmt->bindparam(":maandag", $this->monday);
                $stmt->bindparam(":dinsdag", $this->tuesday);
                $stmt->bindparam(":woensdag", $this->wednesday);
                $stmt->bindparam(":donderdag", $this->thursday);
                $stmt->bindparam(":vrijdag", $this->friday);
                $stmt->bindparam(":zaterdag", $this->saturday);
                $stmt->bindparam(":zondag", $this->sunday);
                $stmt->bindparam(":actiesoort", $this->discountsort);
                $stmt->bindparam(":categorieprijs", $this->categoryprice);
                $stmt->bindparam(":categorieid", $this->categorieID);

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
                                    INSERT INTO actie(actieID,actieNaam,actieOmschrijving,actieSoort)
                                    VALUES(:discountid, :discountname, :discounttext, :actiesoort);
                                    INSERT INTO actiedatum(actieID,beginDatum,eindDatum,maandag,dinsdag,woensdag,donderdag,vrijdag,zaterdag,zondag)
                                    VALUES(:discountid2, :begindatum, :einddatum, :maandag, :dinsdag, :woensdag, :donderdag, :vrijdag, :zaterdag, :zondag);
                                    INSERT INTO actieproduct(id,actieID,productID,prijs)
                                    VALUES(:actiesoort2, :discountid3, :productid, :productprijs);
                                    ");
                $stmt2->bindparam(":discountid", $this->getHighestidplusone());
                $stmt2->bindparam(":discountname", $this->discountname);
                $stmt2->bindparam(":discounttext", $this->discounttext);
                $stmt2->bindparam(":actiesoort", $this->discountsort);

                $stmt2->bindparam(":discountid2", $this->getHighestidplusone());
                $stmt2->bindparam(":begindatum", $this->begindate);
                $stmt2->bindparam(":einddatum", $this->enddate);
                $stmt2->bindparam(":maandag", $this->monday);
                $stmt2->bindparam(":dinsdag", $this->tuesday);
                $stmt2->bindparam(":woensdag", $this->wednesday);
                $stmt2->bindparam(":donderdag", $this->thursday);
                $stmt2->bindparam(":vrijdag", $this->friday);
                $stmt2->bindparam(":zaterdag", $this->saturday);
                $stmt2->bindparam(":zondag", $this->sunday);

                $stmt2->bindparam(":discountid3", $this->getHighestidplusone());
                $stmt2->bindparam(":actiesoort2", $this->discountsort);
                $stmt2->bindparam(":productid", $this->productID);
                $stmt2->bindparam(":productprijs", $this->discountprice);

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
                                           SELECT actie.*, actiedatum.*, actiecategorie.*
                                        FROM actie
                                        INNER JOIN actiedatum
                                        ON actiedatum.actieID = actie.actieID
                                         INNER JOIN actiecategorie
                                        ON actiecategorie.actieID = actie.actieID;
                                        SELECT actie.*, actiedatum.*, actieproduct.*
                                        FROM actie
                                        INNER JOIN actiedatum
                                        ON actiedatum.actieID = actie.actieID
                                         INNER JOIN actieproduct
                                        ON actieproduct.actieID = actie.actieID;
                                        ");
            $stmt->bindparam(":actieid", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['actieID'];
            $this->discountname = $result['actieNaam'];
//            $this->discount= $result['actieKorting'];
            $this->discounttext= $result['actieOmschrijving'];
            $this->discountsort= $result['actieSoort'];
            $this->begindate= $result['beginDatum'];
            $this->enddate= $result['eindDatum'];
            $this->discountprice= $result['prijs'];

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
            $stmt = $this->db->prepare("UPDATE actie SET  actieID = :discountid,
                                                          actieNaam = :discountname,
                                                           actieOmschrijving = :discounttext,
                                                           actieBegindatum = :discountstartdate,
                                                           actieEinddatum = :discountenddate,
                                                           actieKorting = :discount
                                                           WHERE actieID= :actieid");
            $stmt->bindparam(":discountid", $this->id);
            $stmt->bindparam(":discountname", $this->discountname);
            $stmt->bindparam(":discounttext", $this->discounttext);
            $stmt->bindparam(":discountstartdate", $this->discountstartdate);
            $stmt->bindparam(":discountenddate", $this->discountenddate);
            $stmt->bindparam(":discount", $this->discount);
            $stmt->bindparam(":actieid", $id);

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
        $stmt = $this->db->prepare("
                                    DELETE FROM actie WHERE actieID= :discountid;
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










}