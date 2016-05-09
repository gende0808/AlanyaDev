<?php

class ProductAdditionRemovable{
    /**
     * @var PDO
     */
    private $db;

    private $id;

    private $name;
    public function __construct($dbconnection, $removableid = 0, $additionname = "")
    {
        $this->db = $dbconnection;
        if($removableid != 0){
            $this->id = $removableid;
        }
        if($additionname !=""){
            $this->name = $additionname;
        }
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



}