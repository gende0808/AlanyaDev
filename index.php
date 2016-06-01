<?PHP
ob_start();
include_once "header.php";
include_once "classes/Account.php";
$accountisdeletedconfirm = "";

if(isset($_SESSION['logged']))
{
    if ($_SESSION['user_info']['userLevel'] === '3') {
        header('location: adminaccount');
    }
}


//code voor het verwijderen van een account
if (isset($_POST['deleteaccount'])){
    $deleteaccount = htmlspecialchars($_POST['deleteaccount']);
    if (isset($_SESSION['account_id']) && $_SESSION['logged'] == true) {
        if ($deleteaccount == true) {
            try {
                $account = new Account($DB_con);
                $account->delete($_SESSION['account_id']);
                session_destroy();
                $_SESSION = array();
                $accountisdeletedconfirm = "
            <div class=\"alert alert-success\" role=\"alert\">
                <strong>Succes!</strong> Uw account is verwijderd.
             </div>
            ";
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
if ($accountisdeletedconfirm != "") {
    echo $accountisdeletedconfirm;
}
//code voor confirmatie als een account is geactiveerd

if (isset($_SESSION['iactivatedmyaccount']) && $_SESSION['iactivatedmyaccount'] === true) {
    echo "
     <div class=\"alert alert-success\" role=\"alert\" style='text-align: center; font-size: 21px;'>
          <strong>Succes!</strong><br> <p style='font-size: 20px; text-align: center'>Uw account is geactiveerd. U kunt nu inloggen met uw gebruikersnaam en wachtwoord.</p>  
     </div>
    ";
    $_SESSION['iactivatedmyaccount'] = null;
}

?>

<div id="slider" style="height: 350px!important;">
    <div class="flexslider">
        <ul class="slides">
            <li>
                <img src="images/slide3.jpg" alt="" />
            </li>
            <li>
                <img src="images/slide1.jpg" alt="" />
            </li>
            <li>
                <img src="images/slide2.jpg" alt="" />
            </li>
        </ul>
    </div>
</div>


<div id="catagories">
    <div class="container text-center">
        <br>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6" id="mobile">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/alanyafortel.png" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="tel:0756409003" class="hvr-float-shadow"><span class="glyphicon glyphicon-earphone"></span> 075-6409003</a></h4>
                        </div>
                        <div class="content-hide">
                            <p>Alanya Krommenie is elke dag geopend vanaf 11:00 uur tot 21:00 uur en op vrijdag tot en met zateradag tot 03:00 uur. (pizza’s elke dag vanaf 16.00 uur)</p>
                        </div>
                    </div>
                </div>
            </div>
<!--            <h3><b> <img src="images/testlogo3.png" alt="" /></b></h3>-->
            <div class="col-md-4 col-sm-6">
                <a href="menu?bref=1">
                    <div class="blog-post">
                        <div class="blog-thumb">
                            <img src="images/frontcat1.jpg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="content-show">
                                <h4><a href="menu?bref=1">Italiaanse pizza's</a></h4>
                            </div>
                            <div class="content-hide">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="menu?bref=2">
                    <div class="blog-post">
                        <div class="blog-thumb">
                            <img src="images/frontcat4.jpg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="content-show">
                                <h4><a href="menu?bref=2">SPECIAL HOUTSKOOL GRILL</a></h4>
                            </div>
                            <div class="content-hide">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="menu?bref=3">
                    <div class="blog-post">
                        <div class="blog-thumb">
                            <img src="images/frontcat8.jpg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="content-show">
                                <h4><a href="menu.php?bref=3">Broodjes &AMP; Durum</a></h4>
                            </div>
                            <div class="content-hide">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="menu?bref=4">
                    <div class="blog-post">
                        <div class="blog-thumb">
                            <img src="images/frontcat3.jpg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="content-show">
                                <h4><a href="menu.php?bref=4">Snacks</a></h4>
                            </div>
                            <div class="content-hide">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="menu?bref=10">
                    <div class="blog-post">
                        <div class="blog-thumb">
                            <img src="images/frontcat7.jpg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="content-show">
                                <h4><a href="menu.php?bref=10">Turkse deegwaren</a></h4>
                            </div>
                            <div class="content-hide">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="menu?bref=8">
                    <div class="blog-post">
                        <div class="blog-thumb">
                            <img src="images/frontcat6.jpg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="content-show">
                                <h4><a href="menu.php?bref=8">Sate gerechten</a></h4>
                            </div>
                            <div class="content-hide">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="menu?bref=9">
                    <div class="blog-post">
                        <div class="blog-thumb">
                            <img src="images/frontcat5.jpg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="content-show">
                                <h4><a href="menu.php?bref=9">Salades</a></h4>
                            </div>
                            <div class="content-hide">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="menu?bref=11">
                    <div class="blog-post">
                        <div class="blog-thumb">
                            <img src="images/frontcat2.jpg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="content-show">
                                <h4><a href="menu.php?bref=11">Vers belegde broodjes</a></h4>
                            </div>
                            <div class="content-hide">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4 col-sm-6">
                <a href="menu?bref=5">
                    <div class="blog-post">
                        <div class="blog-thumb">
                            <img src="images/frontcat9.jpg" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="content-show">
                                <h4><a href="menu.php?bref=5">Dranken</a></h4>
                            </div>
                            <div class="content-hide">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<?PHP
include_once "footer.php";
?>
