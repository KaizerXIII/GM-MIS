<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Bulk Delivery Details</title>

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
     <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 

    <style type="text/css">

    @media print
    {
    .noprint {display:none;}
    footer, header,.nav, #deploy, #undeploy, #finish_delivery{ display:none; }
    }

    @media screen
    {
    
    }

    </style>
</head>

<body class="nav-md">
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
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <div class="x_panel" id="printDR">
                            <div class="x_title">
                                <div class="col-md-10 col-sm-10 col-xs-12">
                                   
                                    <?php
                                        if(isset($_GET['bulk_id']))
                                        {
                                            $_SESSION['current_bulk_id']=$_GET['bulk_id'];
                                        }
                                        else
                                        {
                                            $_SESSION['current_bulk_id'];
                                        }
                                        $CURRENT_BO =  $_SESSION['current_bulk_id'];

                                        $GET_BO_NUM = "SELECT * FROM bulk_order WHERE bulk_order_id ='$CURRENT_BO'"; 
                                        $RESULT_GET_BO = mysqli_query($dbc,$GET_BO_NUM);
                                        $ROW_GET_BO = mysqli_fetch_assoc($RESULT_GET_BO);

                                        $GET_DATE = strtotime($ROW_GET_BO['bulk_order_date']);
                                        $FORMAT_DATE = date("F d, Y", $GET_DATE);

                                        echo '<font color = "black"><h1>['.$ROW_GET_BO['truck_assigned'].'] - '.$FORMAT_DATE.' Delivery';

                                        $BULK_DETAIL_ARRAY = array();
                                        $GET_BULK_DETAIL = "SELECT * FROM bulk_order_details WHERE reference_bulk_or = '$CURRENT_BO'";
                                        $RESULT_GET_BULK_DETAIL = mysqli_query($dbc,$GET_BULK_DETAIL);
                                        while($ROW_GET_BULK_DETAIL = mysqli_fetch_array($RESULT_GET_BULK_DETAIL,MYSQLI_ASSOC))
                                        {
                                            $BULK_DETAIL_ARRAY[]=$ROW_GET_BULK_DETAIL['bulk_order_details_dr'];
                                        }

                                      
                                    ?>

                                    </h1></font> 
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-12" align="right">
                                    <?php
                                        include("print.php");
                                    ?>                                       
                                        <button type="" class="btn btn-primary btn-lg noprint" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print</button>                                    
                                </div>                              
                                <div class="clearfix"></div>

                                
                            </div>
                            <?php

                            ?>
                            <font color = "red">Truck number ZCV-513 is out for delivery.</font> 
                            <?php

                            ?>
                            <font color = "green">Truck number ZCV-513 is idle.</font>
                            <div class="col-md-12 col-sm-12 col-xs-12" >
                            
                                </div>
                            <form class="form-horizontal form-label-center" method="POST">                              
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 uniquedivA" id="dr_panel">
                                    <div class="x_panel" id = "dr_form">
                                    <div>
                                        <div class = "col-md-6">
                                            <span id = "dr_number"></span>
                                        </div>
                                        <div align = "right">
                                            <button type="button" id="finish_delivery" size = "6" class="btn btn-round btn-info btn-md">Finish this Delivery</button> 
                                        </div>
                                        
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Customer Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id = "drCusName" class="form-control" readonly="readonly" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Destination</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id = "drDestination" class="form-control" readonly="readonly" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Current Status</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id = "drStatus" class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Expected Date</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id = "drexpectedDate" class="form-control" readonly="readonly" >
                                        </div>
                                    </div>
                                    

                                    
                                    <br><br>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Total Weight</label>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input   type="text" id = "drTotalWeight" class="form-control" readonly="readonly" style="text-align:right;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Total Amount</label>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <input   type="text" id = "drTotal" class="form-control" readonly="readonly" style="text-align:right;">
                                        </div>
                                    </div>

                                    </div>
                                </div>
                                <div class = "clearfix"></div>  
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-12 col-sm-12 col-xs-12" align = "right">
                                        <button type="button" class="btn btn-primary btn-lg"  id = "deploy" ><i class="fa fa-truck"></i> Deploy Truck</button> 
                                        <button type="button" class="btn btn-success btn-lg" id = "undeploy" ><i class="fa fa-truck"></i> Truck has Returned</button> 
                                        <!-- lagyan ng onclick enable disable -->
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
<?php
 echo "<script>";
for($i = 0 ; $i < sizeof($BULK_DETAIL_ARRAY); $i++)
{
    $GET_DR_DETAILS = "SELECT * FROM scheduledelivery WHERE delivery_Receipt = '$BULK_DETAIL_ARRAY[$i]'";
    $RESULT_DR_DETAILS  = mysqli_query($dbc,$GET_DR_DETAILS);
    $ROW_RESULT_DR_DETAILS = mysqli_fetch_assoc($RESULT_DR_DETAILS);

    $GET_TOTAL_AMT = "SELECT * FROM orders
    JOIN scheduledelivery
    ON orders.ordernumber = scheduledelivery.ordernumber
    WHERE scheduledelivery.delivery_Receipt = '$BULK_DETAIL_ARRAY[$i]' ";
    $RESULT_TOTAL_AMT  = mysqli_query($dbc,$GET_TOTAL_AMT);
    $ROW_RESULT_TOTAL_AMT = mysqli_fetch_assoc($RESULT_TOTAL_AMT);
    
    $FORMATTED_TOTAL = number_format($ROW_RESULT_TOTAL_AMT['totalamt'],2,".",",");
   echo 'console.log("'.$ROW_RESULT_DR_DETAILS['delivery_Receipt'].'");';
   echo "$('#dr_number').html('<font color =black style=text-align:left size=6>".$ROW_RESULT_DR_DETAILS['delivery_Receipt']."</font>');";//Sets the values of input 
   echo "$('#drCusName').val('".$ROW_RESULT_DR_DETAILS['customer_Name']." ');";
   echo "$('#drDestination').val('".$ROW_RESULT_DR_DETAILS['Destination']." ');";
   echo "$('#drStatus').val('".$ROW_RESULT_DR_DETAILS['delivery_status']." ');";
   echo "$('#drexpectedDate').val('".$ROW_RESULT_DR_DETAILS['delivery_Date']." ');";
   echo "$('#drTotalWeight').val(".$ROW_RESULT_DR_DETAILS['delivery_weight']."+' KG');";
   echo "$('#drTotal').val('₱ '+ '".trim($FORMATTED_TOTAL)."');";

   echo "$('#finish_delivery').attr('dr_number','".$ROW_RESULT_DR_DETAILS['delivery_Receipt']."');";
   echo "$('#finish_delivery').attr('or_number','".$ROW_RESULT_DR_DETAILS['ordernumber']."');";

   echo "$('#dr_form').clone().appendTo('#dr_panel');";  //Clones the form to accomodate all DR's
        
   

}
echo "$('#dr_form').remove();";  //Removes the Original Form to prevent dups
echo "</script>";
?>
<script>

$('.btn.btn-round.btn-info.btn-md').on('click',function(e){
    var current_dr = $(this).attr('dr_number');
    var current_or = $(this).attr('or_number');
    window.location.href= "Delivery Receipt.php?deliver_number="+ current_dr +"&order_number="+ current_or +".php";
})
</script>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js">  </script>
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
$(document).ready(function() {
    for(var i = 0; i < 5; i++)
    {
        // var cloned = $('#dr_form').clone().appendTo('#dr_panel'); //Clones the Div and appends to the targetted container
        
    }
    // $('#drTotal').val('₱ '+parseInt(400.00));
});

</script>
</body>

</html>
