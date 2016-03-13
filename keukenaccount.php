<?PHP
include_once "header2.php";
//include_once "printorder.php";
include_once "classes/Bestelling.php";
include_once "classes/BestellingList.php";



?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

<head>
    <?php header("Content-Type: text/html; charset=utf-8"); ?>
    <meta charset="utf-8">
    <title>Alanya Krommenie</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/scrolltop.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/sideshop.css">
    <link rel="stylesheet" href="css/border.css">
    <link rel="stylesheet" href="css/checkbox.css">
    <link href="css/demo-page.css" rel="stylesheet" media="all">
    <link href="css/hover.css" rel="stylesheet" media="all">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/bs/jq-2.2.0,dt-1.10.11/datatables.min.css"/>
</head>

<?PHP
//TODO _________________________________________________________________________________________________________

try {

    $orderlist = new OrderList($DB_con); //er wordt een nieuwe categorie lijst aangemaakt
    ?>

    <?PHP
    echo '<div class="col-md-12 col-md-offset-0 text-center">';
    foreach ($orderlist->getlistoforders() as $order) { //hij haalt alle bestellingen op in een array.
        echo "<br><br><br><br><br>";
        echo $order->getBestellingid();
        //hierboven worden simpele buttons geprint waarvan in de post de ID word meegegeven maar de waarde in de knop is de categorieNaam.
    }
    echo '</div>';

} catch (Exception $e) {
    echo $e->getMessage();
}
//TODO _________________________________________________________________________________________________________
?>

<div class="container">
<div class="row">
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>

                        <tr>
                            <td><strong><p>Bestelling ID</p></strong></td>
                            <td><strong><p>1</p></strong></td>
                            <td
                        </tr>

                        </thead>
                        <tbody>
                        <tr>
                            <td><strong>Product Naam</strong></td>
                            <td class="text-center"><strong>Toevoegingen</strong></td>
                            <td class="text-center"><strong>Prijs</strong></td>
                            <td class="text-center"><strong>Aantal</strong></td>
                            <td class="text-right"><strong>Totaal</strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Pizza Boromea</td>
                            <td class="highrow"></td>
                            <td class="text-center">€8,-</td>
                            <td class="text-center">2</td>
                            <td class="text-right">€16,-</td>
                        </tr>
                        <tr>
                            <td>Kapsalon</td>
                            <td class="highrow"></td>
                            <td class="text-center">€6,-</td>
                            <td class="text-center">1</td>
                            <td class="text-right">€6,-</td>
                        </tr>
                        <tr>
                            <td>Turkse Pizza</td>
                            <td class="highrow"></td>
                            <td class="text-center">€2,50</td>
                            <td class="text-center">4</td>
                            <td class="text-right">€10,-</td>
                        </tr>
                        <tr>
                            <td class="highrow"></td>
                            <td class="highrow"></td>
                            <td class="highrow"></td>
                            <td class="highrow"><strong>Sub totaal</strong></td>
                            <td class="highrow text-right">€32,-</td>
                        </tr>
                        <tr>
                            <td class="highrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"><strong>Bezorgingskosten</strong></td>
                            <td class="emptyrow text-right">€0,-</td>
                        </tr>
                        <tr>
                            <td class="highrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"><strong>Totaal</strong></td>
                            <td class="emptyrow text-right">$32,-</td>
                        </tr>
                        <tr>
                            <td class="emptyrow">
                                <strong>
                                    <p>Naam</p>
                                    <p>Adres</p>
                                    <p>Tel</p>
                                </strong></td>
                            <td class="emptyrow">
                                <strong>
                                    <p>Boudewijn Bos</p>
                                    <p>Padlaan 9, Krommenie</p>
                                    <p>075-6874522</p>
                                </strong></td>

                            <td class="emptyrow">
                                <br>
                                            <div class="alert alert-danger" role="alert">Deze bon is nog NIET afgedrukt!</div>
                            </td>


                            <td class="emptyrow">
                                <strong>
                                    <div class="searchable-container items col-lg-12">
                                        <div class="info-block block-info clearfix">
                                            <div class="square-box pull-left">
                                            </div>
                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default">
                                                    <div class="bizcontent">
                                                        <input type="checkbox" name="var_id[]" autocomplete="off" value="">
                                                        <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                        <h5>Selecteren</h5>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <td><strong><p>Bestelling ID</p></strong></td>
                            <td><strong><p>2</p></strong></td>
                            <td
                        </tr>

                        </thead>
                        <tbody>
                        <tr>
                            <td><strong>Product Naam</strong></td>
                            <td class="text-center"><strong>Toevoegingen</strong></td>
                            <td class="text-center"><strong>Prijs</strong></td>
                            <td class="text-center"><strong>Aantal</strong></td>
                            <td class="text-right"><strong>Totaal</strong></td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Pizza Boromea</td>
                            <td class="highrow"></td>
                            <td class="text-center">€8,-</td>
                            <td class="text-center">2</td>
                            <td class="text-right">€16,-</td>
                        </tr>
                        <tr>
                            <td>Kapsalon</td>
                            <td class="highrow"></td>
                            <td class="text-center">€6,-</td>
                            <td class="text-center">1</td>
                            <td class="text-right">€6,-</td>
                        </tr>
                        <tr>
                            <td>Turkse Pizza</td>
                            <td class="highrow"></td>
                            <td class="text-center">€2,50</td>
                            <td class="text-center">4</td>
                            <td class="text-right">€10,-</td>
                        </tr>
                        <tr>
                            <td class="highrow"></td>
                            <td class="highrow"></td>
                            <td class="highrow"></td>
                            <td class="highrow"><strong>Sub totaal</strong></td>
                            <td class="highrow text-right">€32,-</td>
                        </tr>
                        <tr>
                            <td class="highrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"><strong>Bezorgingskosten</strong></td>
                            <td class="emptyrow text-right">€0,-</td>
                        </tr>
                        <tr>
                            <td class="highrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"></td>
                            <td class="emptyrow"><strong>Totaal</strong></td>
                            <td class="emptyrow text-right">$32,-</td>
                        </tr>
                        <tr>
                            <td class="emptyrow">
                                <strong>
                                    <p>Naam</p>
                                    <p>Adres</p>
                                    <p>Tel</p>
                                </strong></td>
                            <td class="emptyrow">
                                <strong>
                                    <p>Boudewijn Bos</p>
                                    <p>Padlaan 9, Krommenie</p>
                                    <p>075-6874522</p>
                                </strong></td>

                            <td class="emptyrow">
                                <br>
                                            <div class="alert alert-success" role="alert">Deze bon is al WEL afgedrukt!</div>
                            </td>


                            <td class="emptyrow">
                                <strong>
                                    <div class="searchable-container items col-lg-12">
                                        <div class="info-block block-info clearfix">
                                            <div class="square-box pull-left">
                                            </div>
                                            <div data-toggle="buttons" class="btn-group bizmoduleselect">
                                                <label class="btn btn-default">
                                                    <div class="bizcontent">
                                                        <input type="checkbox" name="var_id[]" autocomplete="off" value="">
                                                        <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                                        <h5>Selecteren</h5>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </strong>
                            </td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
</div>
</div>

<!-- The scroll to top feature -->
<div class="scroll-top-wrapper ">
  <span class="scroll-top-inner">
<i class="fa fa-2x fa-arrow-circle-up"></i>
  </span>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/t/bs/jq-2.2.0,dt-1.10.11/datatables.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" media="all">
<script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/vendor/jquery-1.11.0.min.js"></script>
<script src="js/vendor/jquery.gmap3.min.js"></script>
<script src="js/plugins.js"></script>
<script src="js/main.js"></script>
<script src="js/bootstrap.js"></script>>
<script src="js/scrolltop.js"></script>
<script src="js/checkbox.js"></script>
<script src="js/modernizr.custom.js"></script>

</body>
</html>