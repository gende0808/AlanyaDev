<?php


class ProductAddition
{
    /**
     * @var PDO
     */
    private $db;
    /**
     * @var int
     */
    private $price;

    private $name;

    private $id;

    private $groupid;

    private $add_info;


    public function __construct($dbconnection, $additionid = 0, $additionname = "", $additionprice = 0)
    {
        $this->db = $dbconnection;
        if ($additionid != 0) {
            $this->id = $additionid;
        }
        if ($additionname != "") {
            $this->name = $additionname;
        }
        if ($additionprice != 0) {
            $this->price = $additionprice;
        }
        if ($additionid != "" && is_numeric($additionid)) {
            $this->read($additionid);
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
        $stmt = $this->db->prepare("SELECT toevoegingid,
                                           toevoeginggroepid,
                                           toevoegingtoevoegennaam,
                                           toevoegingprijs
                                                FROM toevoegingtoevoegen WHERE toevoegingid = :addid");
        $stmt->bindParam(':addid', $id, PDO::PARAM_INT);
        $stmt->execute();
        $this->add_info = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $this->add_info['toevoegingid'];
        $this->groupid = $this->add_info['toevoeginggroepid'];
        $this->name = $this->add_info['toevoegingtoevoegennaam'];
        $this->price = $this->add_info['toevoegingprijs'];
    } catch (PDOException $e) {
        echo "Database-error: " . $e->getMessage();
    }
}

    /**
     * @return string
     */
    public function getPriceformatted()
    {

        return '€ '.str_replace('.',',',$this->price);
    }
    
    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
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
    public function getFormattedPrice()
    {
        if ($this->price < 0.01) {
            return '';
        } else {
            return '(+ €' . str_replace('.', ',', $this->price.")");
        }
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }


}