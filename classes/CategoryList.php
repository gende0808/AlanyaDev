<?php

class CategoryList
{
    private $listofids = array();
    /**
     * @var PDO
     */
    private $db;

    function __construct($dbconnection)
    {
        $this->db = $dbconnection; // moet nog error handling bij

        try {
            $stmt = $this->db->prepare("SELECT categorieID FROM categorie");
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->listofids[] = $result['categorieID'];
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    function returnbuttons()
    {
        $return = "";
        $category = new Category($this->db);
        foreach ($this->listofids as $id) {
            $category->read($id);
            $return.='<form action="" method="post"><button name="categorieID" value="' . $category->getcatID() . '">' . $category->getcatname() . '</button></form>';
        }
        return $return;
    }


}