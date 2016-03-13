<?php
class Category implements CRUD
{
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $catname;
    /**
     * @var
     */
    private $catdescription;
    /**
     * @var
     */
    private $discountID;
    /**
     * @var string
     */
    private $catimg;
    /**
     * @var PDO
     */
    private $db;

    public function __construct($dbconnection, $id="")
    {
        $this->db = $dbconnection;
        if ($id != "" && is_numeric($id)){
            $this->read($id);
        }

    }


    function create()
    {
        // TODO: Implement create() method.
    }

    function read($id)
    {
        if (empty($id)) {
            throw new InvalidArgumentException('Id is leeg!');
        }
        if(!is_numeric($id))
        {
            throw new InvalidArgumentException("Id is geen getal!");
        }

        try {
            $stmt = $this->db->prepare("SELECT categorieID,categorieNaam,categorieOmschrijving,actieID,CatIMG FROM categorie WHERE categorieID= :catid");
            $stmt->bindParam(':catid', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['categorieID'];
            $this->catname = $result['categorieNaam'];
            $this->catdescription = $result['categorieOmschrijving'];
            $this->discountID = $result['actieID'];
            $this->catimg = $result['CatIMG'];
        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }
    }

    function update($id)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }
    function getcatID()
    {
        return $this->id;
    }
    function getcatname()
    {
        return $this->catname;
    }

    /**
     * @return string
     */
    public function getCatimg()
    {
        return $this->catimg;
    }



}







?>