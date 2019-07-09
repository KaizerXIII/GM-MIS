<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Request Details</title>

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
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
                    <?php
                        require_once("navDepot.php");    
                    ?>
        </div><!--END Main Container?-->
                <!-- page content -->
            <div class="right_col" role="main">
                    <!-- top tiles -->
                                    
                    <!-- /top tiles -->
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <div class="x_panel" >
                            <div class="x_title col-md-12">
                                <div class = "col-md-6">
                                    <font size = "5"><b>Request Number: </b>
                                    <!-- insert request number here -->
                                    </font>
                                </div>
                                <div class = "col-md-6" align = "right">
                                <button type = "button" class = "btn btn-primary btn-lg"><i class = "fa fa-print"></i> Print</button>
                                </div>
                                <div class="clearfix"></div>
                            </div> <!--END Xtitle-->
                            <div class="x_content">
                            <div>
                                <font color = "black">Request Date:</font>
                                    echo expected date here
                                <br>
                                <font color = "black">Expected Date:</font>
                                    echo expected date here
                            </div>
                            <div class = "clearfix"></div>
                                <div class = "col-md-12" align = "center" style="z-index: 1">
                                <ul class="progressbar">
                                    <li class="active" >Requested</li>
                                    <li>Approved</li>
                                    <li>Delivered</li>
                                </ul>
                                </div> 
                            <div class = "clearfix"></div>


                            <?php
                                // $GET_OR_FROM_SESSION_1 = $_SESSION['order_number_from_view'];
                                // $SQL_SELECT_FROM_ORDER_ORDERSTATUS_1 = "SELECT * FROM orders WHERE ordernumber = '$GET_OR_FROM_SESSION_1'";
                                // $RESULT_SELECT_ORDERSTATUS_1 = mysqli_query($dbc,$SQL_SELECT_FROM_ORDER_ORDERSTATUS_1);
                                // while($ROW_RESULT_SELECT_STATUS_1=mysqli_fetch_array($RESULT_SELECT_ORDERSTATUS_1,MYSQLI_ASSOC))
                                // {
                                //     $statows = $ROW_RESULT_SELECT_STATUS_1['order_status'];
                                //     $fabstatows = $ROW_RESULT_SELECT_STATUS_1['fab_status'];
                                //     if($statows == "PickUp") //order status
                                //     {
                            ?>
                                    <!-- <p><font color = "black">This order is to be picked up by the customer.</font></p> -->
                            <?php
                                        // if($fabstatows == "Under Fabrication" || $fabstatows == "For Fabrication") //fabrication status
                                        // {
                            ?>
                                    <!-- <p><font color = "#ADD8E6">This order is still staged for fabrication, and is not yet ready for pickup.</font></p> -->
                            <?php
                                        // }
                                        // else if($fabstatows == "Disapproved")
                                        // {
                            ?>
                                    <!-- <p><font color = "red">This order's fabrication request has been disapproved. Please inform the customer about the disapproval.</font></p> -->
                            <?php
                                        // }
                                        // else if($fabstatows == "Finished Fabrication")
                                        // {
                            ?>
                                    <!-- <p><font color = "green">This order's fabrication request is finished! The items are ready to be picked up by the customer. Please inform the customer about this.</font></p> -->
                            <?php
                                        // }
                                        // else if($fabstatows == "No Fabrication")
                                        // {
                            ?>
                                    <!-- <p><font color = "blue">The items are ready to be picked up by the customer. Please inform the customer about this.</font></p> -->
                            <?php
                                    //     }
                                    // }
                                    // else if($statows == "Order In Progress" || $statows == "Deliver")
                                    // {
                            ?>
                                    <!-- <p><font color = "black">This order is currently in progress.</font></p> -->
                            <?php
                                    // }
                                    // else if($statows == "Cancelled")
                                    // {
                            ?>
                                    <!-- <p><font color = "red">This order is cancelled.</font></p> -->
                            <?php 
                                    // }
                                    // else if($statows == "Delivered")
                                    // {
                            ?>
                                    <!-- <p><font color = "green">This order is completed.</font></p>  -->
                            <?php
                                //     }
                                // }
                            ?>
                           
                          
                                <form class="form-horizontal form-label-center" method="POST">

                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
                                    <br><br>
                                        <div class="x_panel">
                                            
                                             <center><h3><font color = "black">Items Requested</font></h3></center>
                                             <div class="ln_solid"></div>   

                                             <!-- recently damaged table -->
                                             <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                
                                                    <div class="x_content">

                                                        <table id ="damageTable" class="table">
                                                            <thead>
                                                                <tr>    
                                                                <th>Item Name</th>
                                                                <th>Quantity</th>
                                                                
                                                                </tr>
                                                            </thead>
                                                            <tbody>                                                      
                                                            </tbody>
                                                        </table>
                                                        
                                                    </div> <!--END Xcontent-->
                                                </div><!--END Col MD-->
                                            </div><!--END Class-row -->
                                        
                                        </div><!--END XPanel-->
                                    
                                </div><!--ENDCol MD-->

                <div class="col-md-12 col-sm-12 col-xs-12" align = "right">

                </div><!--END Col MD-->
                    
            </div> <!--END X Panel-->
                        </div><!--END Col MD-->
                        </div>
                            </form>
                    </div><!--END Role=Main -->
                </div><!--END Container Body-->        
</body>

<!-- Small modal -->

<div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Depot Tiles Request Approval</h4>
      </div>
      <div class="modal-body">
    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
        <div class="form-group">
            <label class="control-label col-md-4 col-sm-3 col-xs-12" for="first-name">Delivery Personnel <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="deliverypersonnel" required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success">Finish Approval</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- /page content -->
<script type="text/javascript">
    function validate(obj) {
    obj.value = valBetween(obj.value, obj.min, obj.max); //Gets the value of input alongside with min and max
    console.log(obj.value);
    }

    function valBetween(v, min, max) {
    return (Math.min(max, Math.max(min, v))); //compares the value between the min and max , returns the max when input value > max
    }
</script> <!-- To avoid the users input more than the current Max per item -->

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

    function cancelWarning()
    {
        if(confirm("Cancel Current Order?"))
        {
            if(confirm("Are you sure?"))
            {
                request = $.ajax({
                url: "ajax/cancel_order.php",
                type: "POST",
                data: {
                    post_or_number:  "<?php echo $_SESSION['order_number_from_view'];?>",                    
                },
                    success: function(data)
                    {
                        alert("Current Order: Cancelled!");
                        window.location.href = "ViewOrderDetails.php";                         
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

function FinishOrder()
{
    if(confirm("Finish Current Order?"))
    {
        if(confirm("Are you sure?"))
        {
            request = $.ajax({
            url: "ajax/finished_order.php",
            type: "POST",
            data: {
                post_or_number:  "<?php echo $_SESSION['order_number_from_view'];?>",                    
            },
                success: function(data)
                {
                    alert("Current Order: Finished!");
                    window.location.href = "ViewOrderDetails.php";                         
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
    <style>
        .container1 {
        width: 600px;
        margin: 100px auto; 
        }
        .progressbar {
        margin: 0;
        padding: 0;
        counter-reset: step;
        }
        .progressbar li {
            list-style-type: none;
            width: 33.3%;
            float: left;
            font-size: 12px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            color: #7d7d7d;
        }
        .progressbar li:before {
            width: 30px;
            height: 30px;
            content: counter(step);
            counter-increment: step;
            line-height: 30px;
            border: 2px solid #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: white;
        }
        .progressbar li:after {
            width: 100%;
            height: 2px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 15px;
            left: -50%;
            z-index: -1;     
        }
        .progressbar li:first-child:after {
        content: none;
        }
        .progressbar li.active {
        color: green;
        }
        .progressbar li.active:before {
        border-color: #55b776;
        }
        .progressbar li.active + li:after {
        background-color: #55b776;
        }
    </style>

</body>

</html>
