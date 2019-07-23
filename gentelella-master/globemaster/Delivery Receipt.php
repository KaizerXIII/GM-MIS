<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Delivery Receipt</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- JQUERY Required Scripts -->
    <script type="text/javascript" src="js/script.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <style type="text/css">

    .print-only{display:none;}

    @media print
    {
    .noprint {display:none;}
    footer, header,.nav, .noprint, #choose_btn, #go_back{ display:none; } /*Removes elements before print, use [#idname] to find ID and [.class] to find class */
    .print-only{display:block;}

    }
    @page :footer {
        display: none
    }

    @media screen
    {
    }

    </style>
</head>

<body class="nav-md">
    <element class = "noprint">
    <div class="container body">
        <div class="main_container">
                    <?php
                        require_once("nav.php");    
                    ?>
            </div>
                <!-- page content -->
                <div class="right_col" role="main">
                    <!-- top tiles -->
                    
                    

                    <!-- /top tiles -->

                    

                    <!--TABLE OF DETAILS FOR DELIVERY RECEIPT-->
                    <div class="col-md-12 col-sm-12 col-xs-12" id = "maindiv">
                        <div class="x_panel" id="printDR">
                            <div class="x_title">
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                    <font color = "black" size = "6">Delivery Receipt - [
                                    <?php
                                        if(isset($_GET['deliver_number']))
                                        {
                                            $_SESSION['get_dr_number_from_deliveries'] = $_GET['deliver_number'];
                                            $_SESSION['get_or_number_from_deliveries'] = $_GET['order_number'];
                                            echo $_SESSION['get_dr_number_from_deliveries'];
                                        }
                                        else
                                        {
                                            echo $_SESSION['get_dr_number_from_deliveries'];
                                        }
                                        
                                    ?>

                                    ]</font> 
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12" align="right">
                                         
                                        <button type="button" id = "print_btn" class="btn btn-primary btn-lg noprint"><i class="fa fa-print"></i> Print</button>                                    
                                </div>                              
                                <div class="clearfix"></div>

                                
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12" >
                            <?php
                                    $GET_ID_DELIVERY = $_SESSION['get_dr_number_from_deliveries'];
                                    $deliveryexpected = array();
                                    $deliverydate = array();
                                    $datetoday = date("Y-m-d");
                                    $queryDeliveryDate = "SELECT * FROM orders o
                                    JOIN scheduledelivery sd 
                                    ON o.ordernumber = sd.ordernumber 
                                    WHERE delivery_Receipt = '$GET_ID_DELIVERY';"; 
                                    $resultDeliveryDate = mysqli_query($dbc,$queryDeliveryDate);
                                  
                                    while($rowDeliveryDate = mysqli_fetch_array($resultDeliveryDate,MYSQLI_ASSOC))
                                    {
                                        $deliveryexpected[] = $rowDeliveryDate['expected_date'];
                                        $deliverydate[] = $rowDeliveryDate['delivery_Date'];
                                    }
                                   
                                  
                                    for($i = 0; $i < sizeof($deliveryexpected); $i++)
                                    {
                                        // to check countdown till delivery
                                        $queryDeliveryDateDiffNow = "SELECT order_status, DATEDIFF(CURDATE(),sd.delivery_Date) 
                                        AS datedifferenceNow
                                        FROM orders o
                                        JOIN scheduledelivery sd 
                                        ON o.ordernumber = sd.ordernumber 
                                        WHERE delivery_Receipt = '$GET_ID_DELIVERY';"; 
                                        $resultDeliveryDateDiffNow = mysqli_query($dbc,$queryDeliveryDateDiffNow);
                                        $rowDeliveryDateDiffNow = mysqli_fetch_array($resultDeliveryDateDiffNow,MYSQLI_ASSOC);

                                        if($rowDeliveryDateDiffNow['order_status'] == "Delivered")
                                        {
                                ?>
                                            <p><font color = "green">This order has successfully been delivered!</font></p>
                                <?php
                                        }
                                        else{
                                            if($rowDeliveryDateDiffNow['datedifferenceNow'] > -4 && $rowDeliveryDateDiffNow['datedifferenceNow'] < 1)
                                            {
                                                $datedifferenceNow =  abs($rowDeliveryDateDiffNow['datedifferenceNow']);
                                                $orders = "order's";
                                                echo '<p><font color = "blue">This '.$orders.' delivery date is due in '.$datedifferenceNow.' days.</font></p>';
                                            }
                                            else if($rowDeliveryDateDiffNow['datedifferenceNow'] > 0)
                                            {
                                                $datedifferenceNow =  abs($rowDeliveryDateDiffNow['datedifferenceNow']);
                                                $orders = "order's";
                                                echo '<p><font color = "red">This order is late by '.$datedifferenceNow.' Days.</font></p>';
                                            }

                                            // to check date difference from expected date
                                            $queryDeliveryDateDiff = "SELECT DATEDIFF(o.expected_date,sd.delivery_Date) 
                                            AS datedifference
                                            FROM orders o
                                            JOIN scheduledelivery sd 
                                            ON o.ordernumber = sd.ordernumber 
                                            WHERE delivery_Receipt = '$GET_ID_DELIVERY';"; 
                                            $resultDeliveryDateDiff = mysqli_query($dbc,$queryDeliveryDateDiff);
                                            $rowDeliveryDateDiff = mysqli_fetch_array($resultDeliveryDateDiff,MYSQLI_ASSOC);

                                            if($rowDeliveryDateDiff['datedifference'] > 0)
                                            {
                                                $datedifference =  $rowDeliveryDateDiff['datedifference'];
                                                echo '<p><font color = "#ffc430">This order will be '.$datedifference.' day(s) late from the Expected Delivery Date.</font></p>';
                                            }
                                        }
                                    }
                                    
                                ?>
                                </div>
                            <form class="form-horizontal form-label-center" method="GET" >                              
                                <div class="col-md-6 col-sm-6 col-xs-12 " style="display: table-row;">
                                    <div class="x_panel" >
                                    <center><font color = "#2a5eb2"><h3>Delivery Receipt Details </h1>
                                                </h3></font></center>
                                    <div class="ln_solid"></div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Delivery Receipt Number </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id = "drNumber" class="form-control" readonly="readonly" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Expected Date</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id = "drexpectedDate" class="form-control" readonly="readonly" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Delivery Date</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id = "drDate" class="form-control" readonly="readonly" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Client Address</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id = "drDestination" class="form-control" readonly="readonly" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Customer Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id = "drCusName" class="form-control" readonly="readonly" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Current Status</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id = "drStatus" class="form-control" readonly="readonly">
                                        </div>
                                    </div> <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Delivered By: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id = "delivery_person" class="form-control" readonly="readonly">
                                        </div>
                                    </div>

                                    
                                    <br><br>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Total Amount</label>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input   type="text" id = "drTotal" class="form-control" readonly="readonly" placeholder="Read-Only Input" style="text-align:right;">
                                        </div>
                                    </div>

                                </div>
                            </div>

                                <div class="col-md-6 col-sm-6 col-xs-12" >
                                    <div class="x_panel" >

                                    <center><h3>Items in This Order</h1>
                                    
                                    </h3></center>
                                    <div class="ln_solid"></div>
                                            <div class="row" >
                                                <div class="col-md-12 col-sm-12 col-xs-12"  >
                                                    <table  id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending"  style="width: 263px;">Product</th>
                                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"  style="width: 197px;">Pieces</th>
                                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"  style="width: 197px;">Price per piece</th>
                                                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"  style="width: 197px;">Subtotal Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tr role='row' class='odd'>                                                                  
                                                        </tr>
                                                        <tbody>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                    </div> <!--END XPanel-->
                                </div> <!--END Class Colmd-->
                                <div class="col-md-6 col-sm-6 col-xs-12" id = "fab_item">
                                <div class="x_panel" >
                                <center><h3>Fabricated Product Request</h1></h3></center>
                                    <div class="ln_solid"></div>
                                    <div class="row" >
                                    <div class = "col-md-12" align = "center">
                                        <!-- "data:image/jpg;base64,'. base64_encode($BLOB[$i]).'" -->
                                        <?php
                                        $SQL_GET_OR_FROM_DR = "SELECT * FROM scheduledelivery WHERE delivery_Receipt = '$GET_ID_DELIVERY' ";
                                        $RESULT_GET_OR_FROM_DR = mysqli_query($dbc, $SQL_GET_OR_FROM_DR);
                                        $ROW_RESULT_GET_OR = mysqli_fetch_array($RESULT_GET_OR_FROM_DR,MYSQLI_ASSOC);

                                        $CURRENT_OR_OF_DR = $ROW_RESULT_GET_OR['ordernumber'];

                                        $SQL_GET_FAB_DESC = "SELECT * FROM joborderfabrication WHERE order_number = '$CURRENT_OR_OF_DR'";
                                        $RESULT_GET_FAB_DESC = mysqli_query($dbc, $SQL_GET_FAB_DESC);                                           
                                        
                                        $ROW_RESULT_GET_FAB_DESC = mysqli_fetch_array($RESULT_GET_FAB_DESC,MYSQLI_ASSOC);
                                        $BLOB =  $ROW_RESULT_GET_FAB_DESC['reference_drawing'];
                                                     

                                         echo '<img src = "data:image/jpg;base64,'. base64_encode($BLOB).'"   border-style = "border-width:3px;"style = "height:20vh; width:15vw">'
                                        ?>
                                    </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12"  >
                                        <br>
                                            <h2>Order Number:
                                            <?php
                                                $SQL_GET_OR_FROM_DR = "SELECT * FROM scheduledelivery WHERE delivery_Receipt = '$GET_ID_DELIVERY' ";
                                                $RESULT_GET_OR_FROM_DR = mysqli_query($dbc, $SQL_GET_OR_FROM_DR);
                                                $ROW_RESULT_GET_OR = mysqli_fetch_array($RESULT_GET_OR_FROM_DR,MYSQLI_ASSOC);

                                                $CURRENT_OR_OF_DR = $ROW_RESULT_GET_OR['ordernumber'];

                                                echo $CURRENT_OR_OF_DR;

                                                $SQL_GET_FAB_STATUS = "SELECT * FROM orders WHERE ordernumber = '$CURRENT_OR_OF_DR'";
                                                $RESULT_GET_FAB_STATUS = mysqli_query($dbc, $SQL_GET_FAB_STATUS);
                                                $ROW_RESULT_GET_FAB_STATUS = mysqli_fetch_array($RESULT_GET_FAB_STATUS,MYSQLI_ASSOC);

                                                $FAB_STATUS = $ROW_RESULT_GET_FAB_STATUS['fab_status'];
                                                
                                                if($FAB_STATUS == "For Fabrication")
                                                {
                                                    echo '<h2>Current Status: <font color = "blue">Fabricating</font></h2>';
                                                }
                                                else if($FAB_STATUS == "Under Fabrication")
                                                {
                                                    echo '<h2>Current Status: <font color = "blue">Fabricating</font></h2>';
                                                }
                                                else if($FAB_STATUS == "Finished Fabrication")
                                                {
                                                    echo '<h2>Current Status: <font color = "green">Finished</font></h2>';
                                                }
                                                else if($FAB_STATUS == "Disapproved")
                                                {
                                                    echo '<h2>Current Status: <font color = "red">Disapproved</font></h2>';
                                                }
                                                else if($FAB_STATUS == "No Fabrication")
                                                {
                                                    echo '<script>$("#fab_item").hide();</script>';
                                                }
                                                

                                            ?>
                                            </h2>
                                        </div>
                                        <div class ="col-md-12 col-sm-12 col-xs-12">
                                        <?php
                                            $SQL_GET_FAB_DESC = "SELECT * FROM joborderfabrication WHERE order_number = '$CURRENT_OR_OF_DR'";
                                            $RESULT_GET_FAB_DESC = mysqli_query($dbc, $SQL_GET_FAB_DESC);                                           
                                            if(!$RESULT_GET_FAB_DESC) 
                                            {
                                                die('Error: ' . mysqli_error($dbc));
                                                
                                            } 
                                            else 
                                            {
                                                $ROW_RESULT_GET_FAB_DESC = mysqli_fetch_array($RESULT_GET_FAB_DESC,MYSQLI_ASSOC);
                                                $BLOB =  $ROW_RESULT_GET_FAB_DESC['reference_drawing'];
                                                echo '<font size = "3">Description: '.$ROW_RESULT_GET_FAB_DESC['fab_description'].'</font>';                                           
                                            }                                           
                                        ?>
                                        </div>
                                    </div>         
                                    </div> <!--END XPanel-->
                                </div> <!--END Class Colmd-->

                                <div class = "clearfix"></div>  
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12" align = "right ">
                                    <?php
                                        if($rowDeliveryDateDiffNow['order_status'] == "Delivered" || $rowDeliveryDateDiffNow['order_status'] == "Cancelled")
                                        {
                                    ?>
                                            <button type="button" id="go_back" class="btn btn-default"><a href = Deliveries.php>Go Back</a></button>
                                            <button data-toggle="dropdown" id ="choose_btn" type="button" class="btn btn-success dropdown-toggle" aria-expanded = "false" disabled>Finish Delivery <span class="caret"></span></button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li>
                                                    <a href="#"  onclick = "finishDeliver()">Without Damages</a>
                                                </li>
                                                <li>
                                                    <a href="damage_delivery.php">With Damages</a>
                                                </li>
                                            </ul>
                                    <?php
                                        }
                                        else{
                                    ?>
                                            <button type="button"  id="go_back" class="btn btn-default"><a href = Deliveries.php>Go Back</a></button>
                                            <div class="btn-group">
                                                <button data-toggle="dropdown" id ="choose_btn" type="button" class="btn btn-success dropdown-toggle" aria-expanded = "false" >Finish Delivery <span class="caret"></span></button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <li>
                                                            <a href="#"  onclick = "finishDeliver()">Without Damages</a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;"  onclick = "post_to_dmg_delivery_page()">With Damages</a>
                                                        </li>
                                                    </ul>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                        </div>
                                    </div>

                                   

                                    
                            </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
</body>

<!-- /page content -->

<!-- footer content -->

<!-- /footer content -->
</div>
</div>
</element>

<!-- Print div -->
<div class = "col-md-12 col-sm-12 col-xs-12 print-only">
    <center>
        <h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">GLOBE MASTER TRADING</h1>
        <b><h2>Delivery Receipt</h2></b>
    </center>
    <div class = "col-md-6 col-sm-6 col-xs-6">
        <b>Customer Name: </b><span id = "print_customer_name"></span>
        <br>
        <b>Delivery Date: </b><span id = "print_deliv_date"></span>
        <br>
        <b>Customer Address: </b><span id = "print_customer_address"></span>
        <br><br>
    </div>
    <div class = "col-md-6 col-sm-6 col-xs-6" style = "text-align:right">
        <b><?php echo "[" .$_SESSION['get_dr_number_from_deliveries']. "]"; ?></b>
        <br>
        <b>Delivered by: </b><span id = "print_deliver_name"></span>
    </div>
    <div>
        <table id ="print_table" class="table table-bordered print_table">
            <thead>
            <tr>
                <th>Item Name</th>
                <th>Ordered Quantity</th>
                <th>Price per Piece</th>
                <th>Total Price per Item</th>
            </tr>
            </thead>
            <tbody>
            <!-- <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <th style = "text-align:right">Total Amount this Order: </th>
                <td align = "right">12345.00</td>
            </tr> -->
            </tbody>
        </table>
    </div>
    <div class = "row" style = "text-align:right">
    <br><br><br>
    Received by: ____________________
    <br><br><br>
    Printed by: <?php echo $_SESSION['firstname']." ".$_SESSION['middlename']." ".$_SESSION['lastname'];?>
    </div>
</div>

<script>
$('#print_btn').on('click',function(e){
    $('#print_customer_name').append($('#drCusName').val());
    $('#print_deliv_date').append($('#drDate').val());
    $('#print_customer_address').append($('#drDestination').val());
    $('#print_deliver_name').append($('#delivery_person').val());
    $('#datatable tbody').each(function(e){
        console.log($(this).html());
        $('#print_table').append($(this).html());
       
    })
    $('#print_table').append("<tr><td></td><td></td><th style = text-align:right>Total Amount this Order: </th><td align = right>"+$('#drTotal').val()+"</td></tr>");
})
</script>
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

<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<script>
function addCommas(num) {
    var str = num.toString().split('.');
    if (str[0].length >= 4) {
        //add comma every 3 digits befor decimal
        str[0] = str[0].replace(/(\d)(?=(\d{3})+$)/g, '$1,');
    } 
    
    return str.join('.');
}
</script>

  <?php    

require_once('DataFetchers/mysql_connect.php');


$DR_NUM_FROM_VIEW = $_SESSION['get_dr_number_from_deliveries'];

$orderNumberArray = array();
$itemName = array();
$quantity = array();
$pricePerItem = array();
$totalPrice = array();
$expected_date = array();

$SchedDelivOrderNumber = array(); 
$SchedDelivDR = array();
$SchedDelivDate = array();
$SchedDelivDestination = array();
$SchedDelivCusName = array();
$SchedDelivStatus = array();
$SchedDelivDriver = array();

$sqlToGetTableValue = "SELECT * FROM scheduledelivery";
$resultofQuery2 = mysqli_query($dbc, $sqlToGetTableValue);
while($rowofResult2=mysqli_fetch_array($resultofQuery2,MYSQLI_ASSOC))
{
    $OR_FROM_SCHED_DELIV_TABLE =  $rowofResult2['ordernumber'];

    $QUERY_GET_OR_FROM_ORDERS = "SELECT * FROM orders
    WHERE ordernumber = '$OR_FROM_SCHED_DELIV_TABLE'";
    
    $RESULT_GET_OR = mysqli_query($dbc, $QUERY_GET_OR_FROM_ORDERS);
    while($ROW_RESULT_GET_OR=mysqli_fetch_array($RESULT_GET_OR,MYSQLI_ASSOC))
    {
        $totalPrice[] = number_format(($ROW_RESULT_GET_OR['totalamt']),2);
        $FORMATTED_EXPECTED_DATE = date('F j, Y',strtotime($ROW_RESULT_GET_OR['expected_date'])); //Formats date 
        $expected_date[]= $FORMATTED_EXPECTED_DATE;
    }

    $queryToGetItemList = "SELECT * FROM order_details
    WHERE ordernumber = '$OR_FROM_SCHED_DELIV_TABLE'";
    $resultofQuery1 = mysqli_query($dbc, $queryToGetItemList);
    while($rowofResult1=mysqli_fetch_array($resultofQuery1,MYSQLI_ASSOC))
    {
        $orderNumberArray[] = $rowofResult1['ordernumber']; //Compare this 
        $itemName[] = $rowofResult1['item_name'];
        $quantity[] = $rowofResult1['item_qty'];
        $pricePerItem[] = number_format(($rowofResult1['item_price']),2);

       
        
       
    }
    

    $FORMATTED_DELIV_DATE = date('F j, Y',strtotime($rowofResult2['delivery_Date'])); //Formats date 
   
    $SchedDelivOrderNumber[] = $rowofResult2['ordernumber']; //To this
    $SchedDelivDR[] = $rowofResult2['delivery_Receipt'];
    $SchedDelivDate[] = $FORMATTED_DELIV_DATE;
    $SchedDelivDestination[] = $rowofResult2['Destination'];
    $SchedDelivCusName[] = $rowofResult2['customer_Name'];
    $SchedDelivStatus[] =  $rowofResult2['delivery_status'];
    $SchedDelivDriver[] = $rowofResult2['driver'];
}
    echo '<script text/javascript>';
    echo "var deliverNumberfromHTML = document.getElementById('drNumber');";
    echo "var expectedDatefromHTML = document.getElementById('drexpectedDate');";
    echo "var deliverDatefromHTML = document.getElementById('drDate');";
    echo "var deliverDestinationfromHTML = document.getElementById('drDestination');";
    echo "var deliverCusNamefromHTML = document.getElementById('drCusName');";
    echo "var deliverStatusfromHTML = document.getElementById('drStatus');";
    echo "var deliverTotalfromHTML = document.getElementById('drTotal');";  //Gets HTML elements (Textbox)

    echo "var DR_NUM_FROM_PHP = ".json_encode($DR_NUM_FROM_VIEW).";";
    
    echo "var drDateFromPHP = ".json_encode($SchedDelivDate).";";
    echo "var drDesFromPHP = ".json_encode($SchedDelivDestination).";";
    echo "var drCusFromPHP = ".json_encode($SchedDelivCusName).";";
    echo "var drStatFromPHP = ".json_encode($SchedDelivStatus).";";
    echo "var DRFromPHP = ".json_encode($SchedDelivDR).";"; 
    echo "var drExpectedDateFromPHP = ".json_encode($expected_date).";";
    echo "var OrderNumberFromSchedDeliver = ".json_encode($SchedDelivOrderNumber).";";
    echo "var DriverFromPHP = ".json_encode($SchedDelivDriver).";";//Values from Sched Delivery Table


    echo "var ItemNameFromPHP = ".json_encode($itemName).";"; 
    echo "var ItemQuantityFromPHP = ".json_encode($quantity).";"; 
    echo "var ItemPriceFromPHP = ".json_encode($pricePerItem).";"; 
    echo "var ItemTotalFromPHP = ".json_encode($totalPrice).";"; 
    echo "var OrderNumberFromOrderDetails = ".json_encode($orderNumberArray).";"; //Values from order_details table
   

    echo 'var GetDR = localStorage.getItem("DRfromDeliveriesPage");'; //Gets the text to compare fron Deliveries.php
    echo 'var Current_Total = 0;';
        echo 'for(var i = 0; i < DRFromPHP.length ; i++){';   
            
           
            echo 'if(DR_NUM_FROM_PHP.trim() == DRFromPHP[i].trim()) {';
                // echo 'if(){';
                echo 'Current_Total = Current_Total +(ItemQuantityFromPHP[i]);';
                echo 'console.log("Value From Receipts.php = " + DRFromPHP[i]);';
                echo 'console.log("Value from Delvieries.php = " + GetDR);';
            
                echo 'deliverNumberfromHTML.value = DRFromPHP[i];';
                echo 'deliverDatefromHTML.value = drDateFromPHP[i];';
                echo 'deliverDestinationfromHTML.value = drDesFromPHP[i];';
                echo 'deliverCusNamefromHTML.value = drCusFromPHP[i];';
                echo 'deliverStatusfromHTML.value = drStatFromPHP[i];';
                echo 'deliverTotalfromHTML.value = "₱ "+ ItemTotalFromPHP[i];';
                echo 'expectedDatefromHTML.value = drExpectedDateFromPHP[i];';
                echo "$('#delivery_person').val(DriverFromPHP[i]);";
                echo 'var count = OrderNumberFromOrderDetails.length ;';

                echo 'while(count >= 0){';
                    
                    echo 'console.log("OR From Sched = " + OrderNumberFromSchedDeliver[i]);';
                    

                    echo 'if(OrderNumberFromSchedDeliver[i] == OrderNumberFromOrderDetails[count]) {';

                        echo  "var newRow = document.getElementById('datatable').insertRow();";
                        
                        echo  'newRow.innerHTML = "<tr><td class= item_name>" +ItemNameFromPHP[count]+ "</td> <td class=item_qty align = right>" +ItemQuantityFromPHP[count]+ "</td><td align = right> ₱ " +ItemPriceFromPHP[count]+ "</td><td align=right> ₱ "+( parseInt(ItemQuantityFromPHP[count].replace(",", "")).toFixed(2) * parseInt(ItemPriceFromPHP[count].replace(",", "")).toFixed(2))+"</td></tr>";';
                        // echo 'localStorage.removeItem("DRfromDeliveriesPage");';
                        echo 'count--;';
                        echo 'continue;';                    

                    echo '  }'; // End 2nd IF     
                    echo 'count--;';        
                echo '}'; //End While
            echo '  }'; // End 1st IF  
        echo ' }';// END FOR
echo '</script>';
?> <!-- PHP END -->

         
<script>
    var current_name_array = [];
    var current_qty_array = [];
    $("#datatable .item_name").each(function() 
    {
        current_name_array.push( $(this).text());
        console.log(current_name_array);
    });

    $("#datatable .item_qty").each(function() 
    {
        current_qty_array.push($(this).text());
        console.log(current_qty_array);
    });

    function post_to_dmg_delivery_page()
    {        
            request = $.ajax({
            url: "ajax/post_to_dmg_delivery.php",
            type: "POST",
                data:{
                    post_item_name: current_name_array, //Never forget to get the Value from the <INPUTS>
                    post_item_qty: current_qty_array                   
                },
                success: function(data)
                {                 
                    window.location.href = "damage_delivery.php";                    
                }//End Scucess                       
            }); // End ajax     
        }
</script> <!-- scripts to get the values in the table of delivery-->
<script>
// To Clear localstorage =temporary
    function clearLocalStorage()  
    {
        localStorage.clear();
    }
</script>

<script>
    $('#print_btn').on('click', function(e){      
        window.print();
    })    
</script>
<script>
    function finishDeliver()
    {
        if(confirm("Do you want to finish this delivery?"))
        {
            if(confirm("Are you sure?"))
            {                              
                request = $.ajax({
                url: "ajax/finish_delivery.php",
                type: "POST",
                data: {
                    post_dr_number: "<?php echo $_SESSION['get_dr_number_from_deliveries'];?>",
                    post_or_number:  "<?php echo $_SESSION['get_or_number_from_deliveries'];?>"
                },
                    success: function(data)
                    {
                        alert("Delivery Complete!");
                        window.location.href = "Delivery Receipt.php";                         
                    }//End Scucess               
                }); // End ajax    
            }   
            else
            {
                alert("Action: Cancelled");
            }
        }
        else
        {
            alert("Action: Cancelled");
        }       
    }
</script>

 <script>
      $("#drTotal").change(function()
      {
      
        var $this = $(this);
        $this.val(parseFloat($this.val()).toFixed(2));
          
      }); //Sets the Decimal
</script>

<!-- heaader style -->
<style>
        
        @font-face {
        font-family: "Couture Bold";
        src: url("css/fonts/couture-bld.otf");
        }
        
        h1 {
            font-family: 'COUTURE Bold', Arial, sans-serif;
            font-weight:normal;
            font-style:normal;
            font-size: 50px;
            color: #1D2B51;
            }

</style>   

</body>

</html>
