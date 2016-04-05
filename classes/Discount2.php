<?php

/**
 * Class Product
 */
class Discount2 implements CRUD
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
    private $maandag;
    /**
     * @var bool
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
     * @var int
     */
    private $discount;




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
        try {
            $stmt = $this->db->prepare("INSERT INTO actie2(actieID,actieNaam,actieOmschrijving,maandag,dinsdag,woensdag,donderdag,vrijdag,zaterdag,zondag,actieKorting)
                                    VALUES(:discountid, :discountname, :discounttext, :maandag, :dinsdag, :woensdag, :donderdag, :vrijdag, :zaterdag, :zondag, :discount)");
            $stmt->bindparam(":discountid", $this->id);
            $stmt->bindparam(":discountname", $this->discountname);
            $stmt->bindparam(":discounttext", $this->discounttext);
            $stmt->bindparam(":maandag", $this->maandag);
            $stmt->bindparam(":dinsdag", $this->dinsdag);
            $stmt->bindparam(":woensdag", $this->woensdag);
            $stmt->bindparam(":donderdag", $this->donderdag);
            $stmt->bindparam(":vrijdag", $this->vrijdag);
            $stmt->bindparam(":zaterdag", $this->zaterdag);
            $stmt->bindparam(":zondag", $this->zondag);
            $stmt->bindparam(":discount", $this->discount);

            $stmt->execute();

        } catch (PDOException $e) {
            echo "Er is iets misgegaan met het toevoegen van een actie!" . " " . $e->getMessage();
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
            $stmt = $this->db->prepare("SELECT * FROM actie2 WHERE actieID= :actieid");
            $stmt->bindparam(":actieid", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['actieID'];
            $this->discountname = $result['actieNaam'];
            $this->discount= $result['actieKorting'];
            $this->maandag= $result['maandag'];
            $this->dinsdag= $result['dinsdag'];
            $this->woensdag= $result['woensdag'];
            $this->donderdag= $result['donderdag'];
            $this->vrijdag= $result['vrijdag'];
            $this->zaterdag= $result['zaterdag'];


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
        $stmt = $this->db->prepare("DELETE FROM actie WHERE actieID= :discountid");
        $stmt->bindParam(':discountid', $id, PDO::PARAM_INT);
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
     * @param string $discounttext
     */
    public function setDiscounttext($discounttext)
    {
        $this->discounttext = $discounttext;
    }

    /**
     * @return boolean
     */
    public function getMaandag()
    {
        return $this->maandag;
    }

    /**
     * @param boolean $maandag
     */
    public function setMaandag($maandag)
    {
        $this->maandag = $maandag;
    }

    /**
     * @return boolean
     */
    public function getDinsdag()
    {
        return $this->dinsdag;
    }

    /**
     * @param boolean $dinsdag
     */
    public function setDinsdag($dinsdag)
    {
        $this->dinsdag = $dinsdag;
    }

    /**
     * @return boolean
     */
    public function getWoensdag()
    {
        return $this->woensdag;
    }

    /**
     * @param boolean $woensdag
     */
    public function setWoensdag($woensdag)
    {
        $this->woensdag = $woensdag;
    }

    /**
     * @return boolean
     */
    public function getDonderdag()
    {
        return $this->donderdag;
    }

    /**
     * @param boolean $donderdag
     */
    public function setDonderdag($donderdag)
    {
        $this->donderdag = $donderdag;
    }

    /**
     * @return boolean
     */
    public function getVrijdag()
    {
        return $this->vrijdag;
    }

    /**
     * @param boolean $vrijdag
     */
    public function setVrijdag($vrijdag)
    {
        $this->vrijdag = $vrijdag;
    }

    /**
     * @return boolean
     */
    public function getZaterdag()
    {
        return $this->zaterdag;
    }

    /**
     * @param boolean $zaterdag
     */
    public function setZaterdag($zaterdag)
    {
        $this->zaterdag = $zaterdag;
    }

    /**
     * @return boolean
     */
    public function getZondag()
    {
        return $this->zondag;
    }

    /**
     * @param boolean $zondag
     */
    public function setZondag($zondag)
    {
        $this->zondag = $zondag;
    }

//    /**
//     * @return string
//     */
//    public function getDiscountstartdate()
//    {
//        return $this->discountstartdate;
//    }
//
//    /**
//     * @param string $discountstartdate
//     */
//    public function setDiscountstartdate($discountstartdate)
//    {
//        $this->discountstartdate = $discountstartdate;
//    }
//
//    /**
//     * @return string
//     */
//    public function getDiscountenddate()
//    {
//        return $this->discountenddate;
//    }
//
//    /**
//     * @param string $discountenddate
//     */
//    public function setDiscountenddate($discountenddate)
//    {
//        $this->discountenddate = $discountenddate;
//    }




    /**
     * @return int
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param int $discount
     */
    public function setDiscount($euro, $cents)
    {
        if (empty($euro) && empty($cents)) {
            throw new InvalidArgumentException("prijs mag niet leeg zijn");
        }
        if (empty($cents)) {
            $cents = 00;
        }
        if (empty($euro)) {
            $euro = 00;
        }
        if (!is_numeric($euro) || !is_numeric($cents)) {
            throw new InvalidArgumentException("bedrag moet een getal zijn");
        }

        if ($euro < 0 || $cents < 0) {
            throw new InvalidArgumentException("prijs kan niet lager dan 0 zijn");
        }
        if (strlen($euro) > 11 || strlen($cents) > 2) {
            throw new InvalidArgumentException("bedrag te groot of centen kloppen niet");
        }

        $this->discount = $euro . "." . $cents;
    }



}