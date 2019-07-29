<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | POSx Dashboard</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- FullCalendar -->
    <link href="../vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- bootstrap-datetimepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">



        <!-- sidebar menu -->
        <?php
        require_once("navDepot.php");
        ?>



        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->

        <!-- /menu footer buttons -->
    </div>



    <!-- page content -->
    <div class="right_col" role="main" style="background-color:#3e4042">
        <!-- top tiles -->

        <br><br><br>
        <div class="container">
            <div class="jumbotron" style="background-color:#ffffff">
                <center><font color = "black"><h1><font color = "#ff9900"></font><font color = "#000066"><b> Welcome!</b></font></h1>
                        <h2><font size = "8px">This is an extension of the Globe Master Home Depot POS.</font></h2>
                <div class="row">
                    
                </div>
            </div>
            <?php
                if($user == "CEO" || $user == "Sales" || $user == "Superuser")
                {
            ?>
                <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <h2><center><i class="fa fa-cubes"></i><b>  TILES NEARING OR BELOW THRESHOLD</b></h2>  
                            <div class="clearfix"></div>
                            <div class="x_content">

                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Item SKU</th>
                                    <th>Item Name</th>
                                    <th>Threshold Amount</th>
                                    <th>Stocks Remaining</th>
                                </tr>
                                </thead>
                                <tbody>

                <?php 
                    $SQL_GET_DEPOT_ITEM = "SELECT * 
                    FROM mydb.items_trading
                    JOIN depotdb.gm_products
                    ON gm_products.UnitName = items_trading.item_name
                    JOIN depotdb.gm_inventorystocks
                    ON gm_inventorystocks.ProductID = gm_products.ProductID
                    WHERE gm_inventorystocks.StockOnHand <= 200;";
                    $RESULT_GET_DEPOT_ITEM=mysqli_query($dbc,$SQL_GET_DEPOT_ITEM);
                    while($ROW_DEPOT_ITEM=mysqli_fetch_array($RESULT_GET_DEPOT_ITEM,MYSQLI_ASSOC))
                    {
                ?>
                            <tr>
                                <td><?php echo $ROW_DEPOT_ITEM['SKU']; ?></td>
                                <td><?php echo $ROW_DEPOT_ITEM['UnitName']; ?></td>
                                <td align = "right">150 Pieces</td>
                                <?php
                                    if($ROW_DEPOT_ITEM['StockOnHand'] <= 200 && $ROW_DEPOT_ITEM['StockOnHand'] >= 150)
                                    {
                                ?>
                                    <td align = "right"><font color = "orange"><?php echo $ROW_DEPOT_ITEM['StockOnHand']." Pieces"; ?></font></td>
                                <?php
                                    }
                                    elseif($ROW_DEPOT_ITEM['StockOnHand'] <= 150)
                                    {
                                ?>
                                    <td align = "right"><font color = "red"><?php echo $ROW_DEPOT_ITEM['StockOnHand']." Pieces"; ?></font></td>
                                <?php
                                    }
                                    else 
                                    {
                                ?>
                                    <td align = "right"><?php echo $ROW_DEPOT_ITEM['StockOnHand']." Pieces"; ?></td>
                                <?php
                                    }
                                ?>
                            </tr>
                <?php      
                    } 
                ?>
                            </tbody>
                        </table>
                        <center><a href = "depotrequestform.php"><button class = "btn btn-round btn-md btn-primary">Request</button></a></center>
                        </div>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </div>

</div>
<br />
<div class="row">
</div>
</div>
</div>
</div>
<!-- /page content -->

<!-- footer content -->

<!-- /footer content -->
</div>
</div>
<style>
    .deliveryDate {
        -moz-appearance:textfield;
    }

    .deliveryDate::-webkit-outer-spin-button,
    .deliveryDate::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style> <!-- To Remove the Up/Down Arrows from Date Selection -->

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="../vendors/Chart.js/dist/Chart.min.js"></script>
<!-- FullCalendar -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/fullcalendar/dist/fullcalendar.min.js"></script>
<!-- gauge.js -->
<script src="../vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="../vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="../vendors/Flot/jquery.flot.js"></script>
<script src="../vendors/Flot/jquery.flot.pie.js"></script>
<script src="../vendors/Flot/jquery.flot.time.js"></script>
<script src="../vendors/Flot/jquery.flot.stack.js"></script>
<script src="../vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="../vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="../vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- bootstrap-datetimepicker -->
<script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

<!-- custom scripts -->

<script>
    var TYPE = "";
    function changetonaive(obj)      //Naive
    {
        var SALES_FORECAST_LABEL = document.getElementById("salesforecastlabel");
        SALES_FORECAST_LABEL.value = obj.textContent;
        TYPE = "naive";
        console.log(TYPE);
    }
    function changetots(obj)//Long
    {
        var SALES_FORECAST_LABEL = document.getElementById("salesforecastlabel");
        SALES_FORECAST_LABEL.value = obj.textContent;
        TYPE = "long";
        console.log(TYPE);
    }
    function changetost(obj)//short
    {
        var SALES_FORECAST_LABEL = document.getElementById("salesforecastlabel");
        SALES_FORECAST_LABEL.value= obj.textContent;
        TYPE = "short";
        console.log(TYPE);
    }
</script>



<script>
    function SHOW_FORECAST()
    {
        var SET_ITEM_NAME = document.getElementById("item_name").value;
        var SET_START_DATE = document.getElementById("startdate").value;
        var SET_END_DATE = document.getElementById("enddate").value;
        var SALES_FORECAST_LABEL = document.getElementById("salesforecastlabel").value;


        if(!SET_ITEM_NAME || !SET_START_DATE || !SET_END_DATE) //Checker
        {
            alert("Please Fill Up All Input");
        }//END IF
        else
        {
            if(confirm("Show forecast on Selected Item and Dates?"))
            {
                window.location.href = "SalesForecasting.php?item_id="+SET_ITEM_NAME+"&sd="+SET_START_DATE+"&ed="+SET_END_DATE+"&type="+TYPE;
            }
            else
            {
                alert("Action : Cancelled");
            }
        }  //END ELSE
    }//END FUNCTION
</script>
</body>
</html>