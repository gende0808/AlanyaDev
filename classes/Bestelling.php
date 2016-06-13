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
     * @var array
     */
    private $order_info;

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
     * @var string
     */
    private $afhalen;
    /**
     * @var string
     */
    private $order_prod;
    /**
     * @var int
     */
    private $prodid;
    /**
     * @var int
     */
    private $number;

    /**
     * @var array
     */
    private $orderlist = array();

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
                                                           uitgeprint,
                                                           afhalen)
                                    VALUES(:firstname, :lastname, :phonenumber, :email, :streetname, :housenumber, :addition, :cityid, :particularities, :ordertime, :printed, :afhaal)");
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
            $stmt->bindParam(":afhaal", $this->afhalen);
            $stmt->execute();
            $this->lastinsertedid = $this->db->lastInsertId();

        } catch (PDOException $e) {
            echo "er is iets misgegaan met de verbinding van de server!" . $e->getMessage();
        }
    }

    public function update($id)
    {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException('id is geen getal!');
        }
        try {
            $stmt = $this->db->prepare("UPDATE bestelling SET bestellingNummer = :uorderid,
                                                           afhalen = :uafhalen,
                                                           klantVoornaam = :ufname,
                                                           klantAchternaam = :ulname,
                                                           klantTelefoonnummer = :uphone,
                                                           klantEmail = :uemail,
                                                           klantStraatnaam = :ustreetn,
                                                           klantHuisnummer = :uhousen,
                                                           klantToevoeging = :uaddition,
                                                           klantWoonplaats = :ucity,
                                                           klantBijzonderheden = :upartic,
                                                           bestelTijd = :uordertime,
                                                           uitgeprint = :uprinted
                                                           WHERE bestellingNummer= :uorderid");
            $stmt->bindParam(":uorderid", $this->orderid);
            $stmt->bindParam(":uafhalen", $this->afhalen);
            $stmt->bindParam(":ufname", $this->customerfirstname);
            $stmt->bindParam(":ulname", $this->customerlastname);
            $stmt->bindParam(":uphone", $this->customerphonenumber);
            $stmt->bindParam(":uemail", $this->customeremail);
            $stmt->bindParam(":ustreetn", $this->customerstreetname);
            $stmt->bindParam(":uhousen", $this->customerhousenumber);
            $stmt->bindParam(":uaddition", $this->customeraddition);
            $stmt->bindParam(":ucity", $this->customercityid);
            $stmt->bindParam(":upartic", $this->customerparticularities);
            $stmt->bindParam(":uordertime", $this->ordertime);
            $stmt->bindParam(":uprinted", $this->printed);
            $stmt->bindParam(":uorderid", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    /**
     * 
     */
    
    public function Orderproduct()
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM bestellingproduct WHERE bestellingNummer = :orderid");
            $stmt->bindParam(":orderid",$this->orderid);
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->orderlist[] = new BestellingProduct($this->db, $prodid="", $result);
            }

        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
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
                                               afhalen
                                                FROM bestelling WHERE bestellingNummer = :orderid");
            $stmt->bindParam(':orderid', $id, PDO::PARAM_INT);
            $stmt->execute();
            $this->order_info = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->orderid = $this->order_info['bestellingNummer'];
            $this->customerfirstname = $this->order_info['klantVoornaam'];
            $this->customerlastname = $this->order_info['klantAchternaam'];
            $this->customerphonenumber = $this->order_info['klantTelefoonnummer'];
            $this->customeremail = $this->order_info['klantEmail'];
            $this->customerstreetname = $this->order_info['klantStraatnaam'];
            $this->customerhousenumber = $this->order_info['klantHuisnummer'];
            $this->customeraddition = $this->order_info['klantToevoeging'];
            $this->customercityid = $this->order_info['klantWoonplaats'];
            $this->customerparticularities = $this->order_info['klantBijzonderheden'];
            $this->ordertime = $this->order_info['besteltijd'];
            $this->printed = $this->order_info['uitgeprint'];
            $this->afhalen = $this->order_info['afhalen'];
        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }
    }


    /**
     * @return string
     */
    public function getOrderid()
    {
        return $this->orderid;
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
    public function getAfhalen()
    {
        return $this->afhalen;
    }
    /**
     * @return string
     */
    public function getCustomerproductid()
    {
        return $this->prodid;
    }
    /**
     * @return string
     */
    public function getCustomerproductaantal()
    {
        return $this->number;
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
     * @return mixed
     */
    public function getOrderInfo()
    {
        return $this->order_info;
    }

    /**
     * @return BestellingProduct[]
     */
    function getOrderlist()
    {
        return $this->orderlist;
    }

    /**
     * @param mixed $customercityid
     */
    public function setCustomercityid($customercityid)
    {
        $this->customercityid = htmlentities($customercityid);
    }
    /**
     * @param mixed $afhalen
     */
    public function setAfhalen($afhalen)
    {
        $this->afhalen = htmlentities($afhalen);
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