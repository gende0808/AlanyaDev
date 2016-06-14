<?php

/**
 * Class Account
 */
class Account implements CRUD
{
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
    /**
     * @var array
     */
    private $user_info;
    /**
     * @var string
     */
    private $verificationcode;

    /**
     * @var string
     */
    private $userstatus;

    /**
     * @var string
     */
    private $useraddition;


    /**
     * @param $dbconnection
     * @param string $id
     */


    public function __construct($dbconnection, $id = "")
    {

        $this->db = $dbconnection;
        if ($id != "" && is_numeric($id)) {
            $this->read($id);
        }

    }

    public function create()
    {
        try {
            $stmt = $this->db->prepare("INSERT INTO account(userEmail,
                                                            userPlaatsID,
                                                            userStraatnaam,
                                                            userHuisnummer,
                                                            userTelefoonnummer,
                                                            userPassword,
                                                            userLevel,
                                                            tokenCode,
                                                            userStatus, 
                                                            userVoornaam, 
                                                            userAchternaam, 
                                                            userToevoeging)
                                    VALUES(:mail, :cityid, :street, :streetnr, :phone, :password, :userlevel, :token, :status, :firstname, :lastname, :useraddition)");
            $stmt->bindParam(":mail", $this->useremail);
            $stmt->bindParam(":cityid", $this->usercityid);
            $stmt->bindParam(":street", $this->userstreetname);
            $stmt->bindParam(":streetnr", $this->userhousenumber);
            $stmt->bindParam(":phone", $this->userphonenumber);
            $stmt->bindParam(":password", $this->userpassword);
            $stmt->bindParam(":userlevel", $this->userlevel);
            $stmt->bindParam(":token", $this->verificationcode);
            $stmt->bindParam(":status", $this->userstatus);
            $stmt->bindParam(":firstname", $this->userfirstname);
            $stmt->bindParam(":lastname", $this->userlastname);
            $stmt->bindParam(":useraddition", $this->useraddition);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "er is iets misgegaan met de verbinding van de server!" . $e->getMessage();
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
            $stmt = $this->db->prepare("SELECT userID,
                                               userPlaatsID,
                                               userStraatnaam,
                                               userToevoeging,
                                               userTelefoonnummer,
                                               userPassword,
                                               userLevel,
                                               userVoornaam,
                                               userAchternaam,
                                               userEmail,
                                               userHuisnummer,
                                               tokenCode,
                                               userStatus
                                                FROM account WHERE userID= :userid");
            $stmt->bindParam(':userid', $id, PDO::PARAM_INT);
            $stmt->execute();
            $this->user_info = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->userid = $this->user_info['userID'];
            $this->usercity = $this->user_info['userStraatnaam'];
            $this->usercityid = $this->user_info['userPlaatsID'];
            $this->userstreetname = $this->user_info['userStraatnaam'];
            $this->userhousenumber = $this->user_info['userHuisnummer'];
            $this->useraddition = $this->user_info['userToevoeging'];
            $this->useremail = $this->user_info['userEmail'];
            $this->userfirstname = $this->user_info['userVoornaam'];
            $this->userlastname = $this->user_info['userAchternaam'];
            $this->userlevel = $this->user_info['userLevel'];
            $this->userpassword = $this->user_info['userPassword'];
            $this->userphonenumber = $this->user_info['userTelefoonnummer'];
            $this->usernote = $this->user_info['userToevoeging'];
            $this->verificationcode = $this->user_info['tokenCode'];
            $this->userstatus = $this->user_info['userStatus'];
        } catch (PDOException $e) {
            echo "Database-error: " . $e->getMessage();
        }
    }

    public function update($id)
    {
        if (!is_numeric($id)) {
            throw new InvalidArgumentException('id is geen getal!');
        }
        try {
            $stmt = $this->db->prepare("UPDATE account SET userplaatsID = :uplaceid,
                                                           userStraatnaam = :ustreetname,
                                                           userToevoeging = :uaddition,
                                                           userTelefoonnummer = :uphone,
                                                           userPassword = :upassword,
                                                           userLevel = :ulevel,
                                                           userVoornaam = :ufirstname,
                                                           userAchternaam = :ulastname,
                                                           userEmail = :uemail,
                                                           userHuisnummer = :uhousenr,
                                                           tokenCode = :verify,
                                                           userStatus = :userstatus
                                                           WHERE userID= :userid");
            $stmt->bindParam(":uplaceid", $this->usercityid);
            $stmt->bindParam(":ustreetname", $this->userstreetname);
            $stmt->bindParam(":uaddition", $this->useraddition);
            $stmt->bindParam(":uphone", $this->userphonenumber);
            $stmt->bindParam(":upassword", $this->userpassword);
            $stmt->bindParam(":ulevel", $this->userlevel);
            $stmt->bindParam(":ufirstname", $this->userfirstname);
            $stmt->bindParam(":ulastname", $this->userlastname);
            $stmt->bindParam(":uemail", $this->useremail);
            $stmt->bindParam(":uhousenr", $this->userhousenumber);
            $stmt->bindParam(":verify", $this->verificationcode);
            $stmt->bindParam(":userstatus", $this->userstatus);
            $stmt->bindParam(":userid", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM account WHERE userID= :productid");
        $stmt->bindParam(':productid', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid)
    {
        if (!is_numeric($userid)) {
            throw new InvalidArgumentException('userID is niet numeriek!');
        }
        $this->userid = htmlentities($userid);
    }

    /**
     * @param mixed $usercity
     */

    /**
     * @param mixed $usercityid
     */
    public function setUsercityid($usercityid)
    {
        if (empty($usercityid)) {
            throw new InvalidArgumentException("Je hebt geen stad gekozen!");
        }
        $this->usercityid = htmlentities($usercityid);
    }

    /**
     * @param mixed $userstreetname
     */
    public function setUserstreetname($userstreetname)
    {
        if (empty($userstreetname)) {
            throw new InvalidArgumentException("Je hebt geen straat ingevoerd!");
        }
        $this->userstreetname = htmlentities($userstreetname);
    }

    /**
     * @param mixed $userhousenumber
     */
    public function setUserhousenumber($userhousenumber)
    {
        if (empty($userhousenumber)) {
            throw new InvalidArgumentException("Je hebt geen huisnummer ingevoerd!");
        }
        $this->userhousenumber = htmlentities($userhousenumber);
    }

    /**
     * @param mixed $useremail
     */
    public function setUseremail($useremail)
    {
        if (empty($useremail)) {
            throw new InvalidArgumentException("Je hebt geen email ingevoerd!");
        }
        $this->useremail = htmlentities($useremail);

    }

    /**
     * @param mixed $userfirstname
     */
    public function setUserfirstname($userfirstname)
    {
        $this->userfirstname = htmlentities($userfirstname);
    }

    /**
     * @param mixed $userlastname
     */
    public function setUserlastname($userlastname)
    {
        $this->userlastname = htmlentities($userlastname);
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
        if (empty($userpassword)) {
            throw new InvalidArgumentException("wachtwoord is leeg!");
        }
        if (strlen($userpassword) < 6 || strlen($userpassword) > 128) {
            throw new InvalidArgumentException("wachtwoord moet tussen de 6 en 128 karakters zijn!");
        }
        $this->userpassword = password_hash($userpassword, PASSWORD_DEFAULT);
    }

    /**
     * @param mixed $userphonenumber
     */
    public function setUserphonenumber($userphonenumber)
    {
        if (empty($userphonenumber)) {
            throw new InvalidArgumentException("telefoonnummer is leeg");
        }
        $this->userphonenumber = htmlentities($userphonenumber);
    }

    /**
     * @param mixed $usernote
     */
    public function setUsernote($usernote)
    {
        $this->usernote = htmlentities($usernote);
    }

    /**
     * @return string
     */
    public function getUsernote()
    {
        return $this->usernote;
    }

    /**
     * @return string
     */
    public function getUserphonenumber()
    {
        return $this->userphonenumber;
    }

    /**
     * @return string
     */
    public function getUserpassword()
    {
        return $this->userpassword;
    }

    /**
     * @return int
     */
    public function getUserlevel()
    {
        return $this->userlevel;
    }

    /**
     * @return string
     */
    public function getUserlastname()
    {
        return $this->userlastname;
    }

    /**
     * @return string
     */
    public function getUserfirstname()
    {
        return $this->userfirstname;
    }

    public function getUserfullname()
    {
        return $this->userfirstname . ' ' . $this->userlastname;
    }

    /**
     * @return string
     */
    public function getUseremail()
    {
        return $this->useremail;
    }

    /**
     * @return int
     */
    public function getUserhousenumber()
    {
        return $this->userhousenumber;
    }

    /**
     * @return string
     */
    public function getUserstreetname()
    {
        return $this->userstreetname;
    }

    /**
     * @return int
     */
    public function getUsercityid()
    {
        return $this->usercityid;
    }

    /**
     * @return string
     */
    public function getUsercity()
    {
        return $this->usercity;
    }

    /**
     * @return string
     */
    public function getUseraddition()
    {
        return $this->useraddition;
    }

    /**
     * @return string
     */

    public function setUseraddition($useraddition)
    {
        $this->useraddition = $useraddition;
    }


    /**
     * @return int
     */
    public function getUserid()
    {
        return $this->userid;
    }

    public function setToken()
    {
        $secret = md5(uniqid(rand()));
        $this->verificationcode = $secret;

    }

    public function getToken()
    {
        return $this->verificationcode;
    }

    public function getstatus()
    {
        return $this->userstatus;
    }

    public function setstatus($status)
    {
        $this->userstatus = $status;
    }

    public function getUserInfo()
    {
        return $this->user_info;
    }
}


?>