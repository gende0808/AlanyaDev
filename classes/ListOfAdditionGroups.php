<?php
class ListOfAdditions
{
    /**
     * @var PDO
     */
    private $db;
    /**
     * @var array
     */
    private $listofadditiongroups = array();

    public function __construct($dbconnection)
    {
        $this->db = $dbconnection;
        try {
            $stmt = $this->db->prepare("SELECT * FROM toevoeginggroep");
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->listofadditiongroups[] = new AdditionGroup($result['toevoeginggroepid'], $result['toevoeginggroepnaam']);
            }
        } catch (PDOException $e) {
            echo "er is iets misgegaan met de verbinding van de server!" . $e->getMessage();

        }
    }
        /**
         * @return AdditionGroup[]
         */
        public function getListofadditiongroups()
        {
            return $this->listofadditiongroups;
        }
}





class AdditionGroup{
    /**
     * @var int
     */
    private $additiongroupid;
    /**
     * @var string
     */
    private $additiongroupname;

    /**
     * AdditionGroup constructor.
     * @param $groupid
     * @param $groupname
     */
    public function __construct($groupid, $groupname){
        $this->additiongroupid = $groupid;
        $this->additiongroupname = $groupname;
    }

    /**
     * @return int
     */
    public function getAdditiongroupid()
    {
        return $this->additiongroupid;
    }

    /**
     * @return string
     */
    public function getAdditiongroupname()
    {
        return $this->additiongroupname;
    }

}