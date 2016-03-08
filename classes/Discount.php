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
     * @var string
     */
    private $discountstartdate;
    /**
     * @var string
     */
    private $discountenddate;
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
            $stmt = $this->db->prepare("INSERT INTO actie(actieID,actieNaam,actieOmschrijving,actieBegindatum,actieEinddatum,actieKorting)
                                    VALUES(:discountid, :discountname, :discounttext, :discountstartdate, :discountenddate, :discount)");
            $stmt->bindparam(":discountid", $this->id);
            $stmt->bindparam(":discountname", $this->discountname);
            $stmt->bindparam(":discounttext", $this->discounttext);
            $stmt->bindparam(":discountstartdate", $this->discountstartdate);
            $stmt->bindparam(":discountenddate", $this->discountenddate);
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
            $stmt = $this->db->prepare("SELECT * FROM actie WHERE actieID= :actieid");
            $stmt->bindparam(":actieid", $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['actieID'];
            $this->discountname = $result['actieNaam'];
            $this->discount= $result['actieKorting'];
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
     * @return string
     */
    public function getDiscountstartdate()
    {
        return $this->discountstartdate;
    }

    /**
     * @param string $discountstartdate
     */
    public function setDiscountstartdate($discountstartdate)
    {
        $this->discountstartdate = $discountstartdate;
    }

    /**
     * @return string
     */
    public function getDiscountenddate()
    {
        return $this->discountenddate;
    }

    /**
     * @param string $discountenddate
     */
    public function setDiscountenddate($discountenddate)
    {
        $this->discountenddate = $discountenddate;
    }

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
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }



}