<?php

/**
 * Class Bestelling
 */

class Bestelling{
    /**
     * @var int
     */
    private $orderid;

    /**
     * @var string
     */
    private $customerfirstname;
    /**
     * @var string
     */
    private $customerlastname;
    /**
     * @var string
     */
    private $customerphonenumber;
    /**
     * @var string
     */
    private $customeremail;
    /**
     * @var string
     */
    private $customerstreetname;
    /**
     * @var string
     */
    private $customerhousenumber;
    /**
     * @var string
     */
    private $customeraddition;
    /**
     * @var int
     */
    private $customercityid;
    /**
     * @var string
     */
    private $customerparticularities;
    /**
     * @var string
     */
    private $ordertime ;
    /**
     * @var string
     */
    private $printed;

    /**
     * @param $dbconnection
     * @param string $id
     */

    /**
     * @var PDO
     */
    private $db;

    /**
     * @param int
     */
    private $lastinsertedid;

    public function __construct($dbconnection, $id = "")
    {

        $this->db = $dbconnection;
        if ($id != "" && is_numeric($id)) {
            $this->read($id);
        }

    }

    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO bestelling(
                                                           klantVoornaam,
                                                           klantAchternaam,
                                                           klantTelefoonnummer,
                                                           klantEmail,
                                                           klantStraatnaam,
                                                           klantHuisnummer,
                                                           klantToevoeging,
                                                           klantWoonplaats,
                                                           klantBijzonderheden,
                                                           besteltijd,
                                                           uitgeprint)
                                    VALUES(:firstname, :lastname, :phonenumber, :email, :streetname, :housenumber, :addition, :cityid, :particularities, :ordertime, :printed)");
            $stmt->bindParam(":firstname", $this->customerfirstname);
            $stmt->bindParam(":lastname", $this->customerlastname);
            $stmt->bindParam(":phonenumber", $this->customerphonenumber);
            $stmt->bindParam(":email", $this->customeremail);
            $stmt->bindParam(":streetname", $this->customerstreetname);
            $stmt->bindParam(":housenumber", $this->customerhousenumber);
            $stmt->bindParam(":addition", $this->customeraddition);
            $stmt->bindParam(":cityid", $this->customercityid);
            $stmt->bindParam(":particularities", $this->customerparticularities);
            $stmt->bindParam(":ordertime", $this->ordertime);
            $stmt->bindParam(":printed", $this->printed);
            $stmt->execute();
            $this->lastinsertedid = $this->db->lastInsertId();

        } catch (PDOException $e) {
            echo "er is iets misgegaan met de verbinding van de server!" . $e->getMessage();
        }
    }


    public function read($id)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id is leeg!');
        }
        if (!is_numeric($id)) {
            throw new InvalidArgumentException("Id is geen getal!");
        }

        try {
            $stmt = $this->db->prepare("SELECT bestellingNummer,
                                               klantVoornaam,
                                               klantAchternaam,
                                               klantTelefoonnummer,
                                               klantEmail,
                                               klantStraatnaam,
                                               klantHuisnummer,
                                               klantToevoeging,
                                               klantWoonplaats,
                                               klantBijzonderheden,
                                               besteltijd,
                                               uitgeprint,
                                                FROM bestelling WHERE bestellingNummer :orderid");
            $stmt->bindParam(':bestellingNummer', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->orderid = $result['bestellingNummer'];
            $this->customerfirstname = $result['klantVoornaam'];
            $this->customerlastname = $this->customerlastname['klantAchternaam'];
            $this->customerphonenumber = $this->customerphonenumber['klantTelefoonnummer'];
            $this->customeremail = $this->customeremail['klantEmail'];
            $this->customerstreetname = $this->customerstreetname['klantStraatnaam'];
            $this->customerhousenumber = $this->customerhousenumber['klantHuisnummer'];
            $this->customeraddition = $this->customeraddition['klantToevoeging'];
            $this->customercityid = $this->customercityid['klantWoonplaats'];
            $this->customerparticularities = $this->customerparticularities['klantBijzonderheden'];
            $this->ordertime = $this->ordertime['besteltijd'];
            $this->printed = $this->printed['uitgeprint'];
        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }
    }


   
    /**
     * @return string
     */
    public function getCustomerfirstname()
    {
        return $this->customerfirstname;
    }
    /**
     * @return string
     */
    public function getCustomerlastname()
    {
        return $this->customerlastname;
    }
    /**
     * @return string
     */
    public function getCustomerphonenumber()
    {
        return $this->customerphonenumber;
    }
    /**
     * @return string
     */
    public function getCustomeremail()
    {
        return $this->customeremail;
    }
    /**
     * @return string
     */
    public function getCustomerstreetname()
    {
        return $this->customerstreetname;
    }
    /**
     * @return string
     */
    public function getCustomerhousenumber()
    {
        return $this->customerhousenumber;
    }
    /**
     * @return string
     */
    public function getCustomeraddition()
    {
        return $this->customeraddition;
    }
    /**
     * @return int
     */
    public function getCustomercityid()
    {
        return $this->customercityid;
    }
    /**
     * @return string
     */
    public function getCustomerparticularities()
    {
        return $this->customerparticularities;
    }
    /**
     * @return string
     */
    public function getOrdertime()
    {
        return $this->ordertime;
    }
    /**
     * @return string
     */
    public function getPrinted()
    {
        return $this->printed;
    }

    /**
     * @return mixed
     */
    public function getLastinsertedid()
    {
        return $this->lastinsertedid;
    }
    
    /**
     * @param mixed $customercityid
     */
    public function setCustomercityid($customercityid)
    {
        $this->customercityid = htmlentities($customercityid);
    }

    /**
     * @param mixed $customerstreetname
     */
    public function setCustomerstreetname($customerstreetname)
    {
        $this->customerstreetname = htmlentities($customerstreetname);
    }

    /**
     * @param mixed $customerhousenumber
     */
    public function setCustomerhousenumber($customerhousenumber)
    {
        $this->customerhousenumber = htmlentities($customerhousenumber);
    }

    /**
     * @param mixed $customeremail
     */
    public function setCustomeremail($customeremail)
    {
        $this->customeremail = htmlentities($customeremail);
    }

    /**
     * @param mixed $customerfirstname
     */
    public function setCustomerfirstname($customerfirstname)
    {
        $this->customerfirstname = htmlentities($customerfirstname);
    }

    /**
     * @param mixed $customerlastname
     */
    public function setCustomerlastname($customerlastname)
    {
        $this->customerlastname = htmlentities($customerlastname);
    }

    /**
     * @param mixed $customerphonenumber
     */
    public function setCustomerphonenumber($customerphonenumber)
    {
        if (empty($customerphonenumber)) {
            throw new InvalidArgumentException("telefoonnummer is leeg");
        }
        $this->customerphonenumber = htmlentities($customerphonenumber);
    }
    
    /**
     * @param mixed $customeraddition
     */
    
    public function setCustomeraddition($customeraddition)
    {
        $this->customeraddition = $customeraddition;
    }

    /**
     * @param mixed $customerparticularities
     */

    public function setCustomerparticularities($customerparticularities)
    {
        $this->customerparticularities = $customerparticularities;
    }

    /**
     * @param string $printed
     */
    public function setPrinted($printed)
    {
        $this->printed = $printed;
    }

}
?>