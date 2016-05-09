<?php


class ProductAdditionList
{
    /**
     * @var array
     */
    private $listofremovableadditions = array();
    /**
     * @var array
     */
    private $listofaddableadditions = array();
    /**
     * @var array
     */
    private $listofradioadditions = array();
    /**
     * @var PDO
     */
    private $db;


    public function __construct($dbconnection, $toevoeginggroepsid)
    {
        $this->db = $dbconnection;
        try {
            $stmt1 = $this->db->prepare("SELECT A.toevoeginggroepid,
                                               A.toevoeginggroepnaam,
                                               B.toevoegingverwijderenid,
                                               B.toevoegingnaam
                                        FROM toevoeginggroep A 
                                        INNER JOIN 
                                        toevoegingverwijderen B
                                        ON A.toevoeginggroepid = B.toevoeginggroepid
                                        WHERE A.toevoeginggroepid = :toevid
                                        ");
            $stmt1->bindParam(":toevid", $toevoeginggroepsid);
            $stmt1->execute();
            while ($result1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                $this->listofremovableadditions[] =
                    new ProductAdditionRemovable($this->db, $result1['toevoegingverwijderenid'], $result1['toevoegingnaam']);
            }

            $stmt2 = $this->db->prepare("SELECT A.toevoeginggroepid,
                                               A.toevoeginggroepnaam,
                                               C.toevoegingid,
                                               C.toevoegingtoevoegennaam,
                                               C.toevoegingprijs
                                        FROM toevoeginggroep A 
                                        INNER JOIN
                                        toevoegingtoevoegen C
                                        ON A.toevoeginggroepid = C.toevoeginggroepid
                                        WHERE A.toevoeginggroepid = :toevid
                                        ");
            $stmt2->bindParam(":toevid", $toevoeginggroepsid);
            $stmt2->execute();
            while ($result2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $this->listofaddableadditions[] =
                    new ProductAddition($this->db, $result2['toevoegingid'], $result2['toevoegingtoevoegennaam'], $result2['toevoegingprijs']);
            }

            $stmt3 = $this->db->prepare(" SELECT A.toevoeginggroepid,
                                                 A.toevoeginggroepnaam,
                                                 D.radiotoevoegingid,
                                                 D.radiogroepnaam
                                        FROM toevoeginggroep A
                                        INNER JOIN
                                        toevoegingradiogroep D
                                        ON A.toevoeginggroepid = D.toevoeginggroepid
                                        WHERE A.toevoeginggroepid = :toevid
                                        ");
            $stmt3->bindParam("toevid", $toevoeginggroepsid);
            $stmt3->execute();
            while ($result3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                $this->listofradioadditions[] =
                    new ProductAdditionRadioList($this->db, $result3['radiotoevoegingid'], $result3['radiogroepnaam']);
            }

        } catch (PDOException $e) {
            echo $e->getMessage();

        }

    }

    /**
     * @return ProductAdditionRemovable[]
     */
    public function getremovableadditions()
    {
        return $this->listofremovableadditions;
    }

    /**
     * @return ProductAddition[]
     */
    public function getaddableadditions()
    {
        return $this->listofaddableadditions;
    }

    /**
     * @return ProductAdditionRadioList[]
     */

    public function getradioadditions()
    {
        return $this->listofradioadditions;
    }
}


?>