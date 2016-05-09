<?php

/**
 * Created by PhpStorm.
 * User: Gregory
 * Date: 14-3-2016
 * Time: 09:19
 */
class ProductDiscount implements CRUD
{

    /**
     * @var int
     */
    private $discountid;
    /**
     * @var string
     */
    private $discountname;
    /**
     * @var string
     */
    private $discountdescription;
    /**
     * @var Datetime
     */
    private $startdate;
    /**
     * @var DateTime
     */
    private $enddate;
    /**
     * @var float
     */
    private $discountamount;
    /**
     * @var PDO
     */
    private $db;

    public function __construct($dbconnection, $id = "")
    {
        $this->db = $dbconnection;
        if (!empty($id) && is_numeric($id)) {
            $this->read($id);
        }
    }

    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO actieproduct(
                                                    actieNaam,
                                                    actieOmschrijving,
                                                    actieBegindatum,
                                                    actieEindDatum,
                                                    actieKorting)
                                    VALUES(:actionname, :actiondescription, :start, :eind, :discount)");
            $stmt->bindParam(":actionname", $this->discountname, PDO::PARAM_STR);
            $stmt->bindParam(":actiondescription", $this->discountdescription, PDO::PARAM_STR);
            $stmt->bindParam(":start", $this->startdate);
            $stmt->bindParam(":eind", $this->enddate);
            $stmt->bindParam(":discount", $this->discountamount);

            $stmt->execute();

        } catch (PDOException $e) {
            echo "er is iets misgegaan met het toevoegen van een actie: ". $e->getMessage();
        }
    }

    public function read($id)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id is geen getal');
        }

        try {
            $stmt = $this->db->prepare("SELECT
                                              actieID,
                                              actieNaam,
                                              actieOmschrijving,
                                              actieBegindatum,
                                              actieEindDatum,
                                              actieKorting
                                              FROM actieproduct
                                              WHERE actieID= :actieid");
            $stmt->bindParam(":actieid", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->discountid = $result['actieID'];
            $this->discountname = $result['actieNaam'];
            $this->discountdescription = $result['actieOmschrijving'];
            $this->startdate = $result['actieBeginDatum'];
            $this->enddate = $result['actieEindDatum'];
            $this->discountamount = $result['actieKorting'];
        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }


    }

    public function update($id){

        //todo waarschijnlijk niet nodig
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM actieproduct WHERE actieID= :actieid");
        $stmt->bindParam(':actieid', $id, PDO::PARAM_INT);
        $stmt->execute();
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
    public function getDiscountdescription()
    {
        return $this->discountdescription;
    }

    /**
     * @param string $discountdescription
     */
    public function setDiscountdescription($discountdescription)
    {
        $this->discountdescription = $discountdescription;
    }

    /**
     * @return Datetime
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * @param Datetime $startdate
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;
    }

    /**
     * @return DateTime
     */
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * @param DateTime $enddate
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;
    }

    /**
     * @return float
     */
    public function getDiscountamount()
    {
        return $this->discountamount;
    }

    /**
     * @param float $discountamount
     */
    public function setDiscountamount($euros, $cents)
    {
        if (empty($euros) && empty($cents)) {
            throw new InvalidArgumentException("prijs mag niet leeg zijn");
        }
        if (empty($cents)) {
            $cents = 00;
        }
        if (empty($euros)) {
            $euros = 00;
        }
        if (!is_numeric($euros) || !is_numeric($cents)) {
            throw new InvalidArgumentException("bedrag moet een getal zijn");
        }

        if ($euros < 0 || $cents < 0) {
            throw new InvalidArgumentException("prijs kan niet lager dan 0 zijn");
        }
        if (strlen($euros) > 11 || strlen($cents) > 2) {
            throw new InvalidArgumentException("bedrag te groot of centen kloppen niet");
        }

        $this->discountamount = $euros . "." . $cents;
    }
}