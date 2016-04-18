<?PHP
ob_start();
include_once "header.php";
include_once "classes/Account.php";
$accountisdeletedconfirm = "";

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
                <img src="images/testslide2.png" alt="" />
            </li>
            <li>
                <img src="images/testslide1.png" alt="" />
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
            <h3><b>DIRECT NAAR ONZE CATEGORIËN!</b></h3>
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/grillcat1.png" alt=""/>
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="menu.php?bref=2">Special Houtskool Grill</a></h4>
                        </div>
                        <div class="content-hide">
                            <p>heeeul lekker</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/pizzcat2.png" alt=""/>
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="menu.php?bref=1">Italiaanse Pizza's</a></h4>
                        </div>
                        <div class="content-hide">
                            <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/brocattest.png" alt=""/>
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="menu.php?bref=3">Broodjes &AMP; Dürüm</a></h4>
                        </div>
                        <div class="content-hide">
                            <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/brocat4.png" alt=""/>
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="menu.php?bref=8">Sat&eacute; gerechten</a></h4>
                        </div>
                        <div class="content-hide">
                            <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/brocat5.png" alt=""/>
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="menu.php?bref=4">Snacks</a></h4>
                        </div>
                        <div class="content-hide">
                            <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="blog-post">
                    <div class="blog-thumb">
                        <img src="images/brocat6.png" alt=""/>
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="menu.php?bref=12">Salades</a></h4>
                        </div>
                        <div class="content-hide">
                            <p>Sed egestas tincidunt mollis. Suspendisse rhoncus vitae enim et faucibus. Ut dignissim nec arcu nec hendrerit. Sed arcu odio, sagittis vel diam in, malesuada malesuada risus. Aenean a sem leo. Nam ultricies dolor et mi tempor, non pulvinar felis sollicitudin.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?PHP
include_once "footer.php";
?>

