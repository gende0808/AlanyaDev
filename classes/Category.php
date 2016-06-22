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
            $stmt = $this->db->prepare("SELECT categorieID,categorieNaam,categorieOmschrijving,actieID FROM categorie WHERE categorieID= :catid");
            $stmt->bindParam(':catid', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $result['categorieID'];
            $this->catname = $result['categorieNaam'];
            $this->catdescription = $result['categorieOmschrijving'];
            $this->discountID = $result['actieID'];
        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }
    }

    function update($id)
    {
       
    }

    function delete($id)
    {
       
    }
    function getcatID()
    {
        return $this->id;
    }
    function getcatname()
    {
        return $this->catname;
    }





}







?>