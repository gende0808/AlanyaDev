<?php

class AccountList
{
    /**
     * @var array
     */
    private $listofaccounts = array();
    /**
     * @var PDO
     */
    private $db;

    function __construct($dbconnection)
    {
        $this->db = $dbconnection; // moet nog error handling bij

        try
        {
            $stmt = $this->db->prepare("SELECT userID FROM account");
            $stmt->execute();
            while ($result = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                $this->listofaccounts[] = new Account($this->db, $result['userID']);
            }

        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }

    }

    /**
     * @return Account[]
     */
    function getlistofaccounts()
    {
        return $this->listofaccounts;
    }

}