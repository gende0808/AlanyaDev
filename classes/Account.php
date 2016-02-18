<?php

/**
 * Class Account
 */



class Account implements CRUD{
    /**
     * @var int
     */
    private $userid;
    /**
     * @var string
     */
    private $usercity;
    /**
     * @var int
     */
    private $usercityid;
    /**
     * @var string
     */
    private $userstreetname;
    /**
     * @var int
     */
    private $userhousenumber;
    /**
     * @var string
     */
    private $useremail;
    /**
     * @var string
     */
    private $userfirstname;
    /**
     * @var string
     */
    private $userlastname;
    /**
     * @var int
     */
    private $userlevel = 1;
    /**
     * @var string
     */
    private $userpassword;
    /**
     * @var string
     */
    private $userphonenumber;
    /**
     * @var string
     */
    private $usernote;
    /**
     * @var PDO
     */
    private $db;



    public function __construct($dbconnection){
        $this->db = $dbconnection;
    }

    public function create(){
        try {
            $stmt = $this->db->prepare("INSERT INTO account(userEmail,userPlaatsID,userStraatnaam,userHuisnummer,userTelefoonnummer,userPassword,userLevel)
                                    VALUES(:mail, :cityid, :street, :streetnr, :phone, :password, :userlevel)");
            $stmt->bindparam(":mail", $this->useremail);
            $stmt->bindparam(":cityid", $this->usercityid);
            $stmt->bindparam(":street", $this->userstreetname);
            $stmt->bindparam(":streetnr", $this->userhousenumber);
            $stmt->bindparam(":phone", $this->userphonenumber);
            $stmt->bindparam(":password", $this->userpassword);
            $stmt->bindparam(":userlevel", $this->userlevel);
            $stmt->execute();

            } catch(PDOException $e){
            echo "er is iets misgegaan!"." ".$e->getMessage();
        }
    }
    public function read($id){

    }
    public function update($id){

    }
    public function delete($id){

    }
    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        if(!is_numeric($userid)){
            throw new InvalidArgumentException('userID is not numeric!');
        }
        $this->userid = $userid;
    }

    /**
     * @param mixed $usercity
     */

    /**
     * @param mixed $usercityid
     */
    public function setUsercityid($usercityid)
    {
        if(empty($usercityid)){
           throw new InvalidArgumentException("Je hebt geen stad gekozen!");
            }
        $this->usercityid = $usercityid;
    }

    /**
     * @param mixed $userstreetname
     */
    public function setUserstreetname($userstreetname)
    {
        if(empty($userstreetname)){
            throw new InvalidArgumentException("Je hebt geen straat ingevoerd!");
        }
        $this->userstreetname = $userstreetname;
    }

    /**
     * @param mixed $userhousenumber
     */
    public function setUserhousenumber($userhousenumber)
    {
        if(empty($userhousenumber)){
            throw new InvalidArgumentException("Je hebt geen huisnummer ingevoerd!");
        }
        $this->userhousenumber = $userhousenumber;
    }

    /**
     * @param mixed $useremail
     */
    public function setUseremail($useremail)
    {
        if(empty($useremail)){
            throw new InvalidArgumentException("Je hebt geen email ingevoerd!");
        }
        $this->useremail = $useremail;

    }

    /**
     * @param mixed $userfirstname
     */
    public function setUserfirstname($userfirstname)
    {
        $this->userfirstname = $userfirstname;
    }

    /**
     * @param mixed $userlastname
     */
    public function setUserlastname($userlastname)
    {
        $this->userlastname = $userlastname;
    }

    /**
     * @param mixed $userlevel
     */
    public function setUserlevel($userlevel)
    {
        $this->userlevel = $userlevel;
    }

    /**
     * @param mixed $userpassword
     */
    public function setUserpassword($userpassword)
    {
        if(empty($userpassword)){
            throw new InvalidArgumentException("wachtwoord is leeg!");
        }
        if(strlen($userpassword) < 6 || strlen($userpassword) > 16){
            throw new InvalidArgumentException("wachtwoord moet tussen de 6 en 16 karakters zijn!");
        }
        $this->userpassword = $userpassword;
    }

    /**
     * @param mixed $userphonenumber
     */
    public function setUserphonenumber($userphonenumber)
    {
        if(empty($userphonenumber))
        {
            throw new InvalidArgumentException("telefoonnummer is leeg");
        }
        $this->userphonenumber = $userphonenumber;
    }

    /**
     * @param mixed $usernote
     */
    public function setUsernote($usernote)
    {
        $this->usernote = $usernote;
    }
}


?>