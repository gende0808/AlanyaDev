<?php


class ProductAddition
{
    /**
     * @var PDO
     */
    private $db;

    private $price;
    private $name;
    private $id;


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
    public function getFormattedPrice()
    {
        if ($this->price < 0.01) {
            return '';
        } else {
            return '+ €' . str_replace('.', ',', $this->price);
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