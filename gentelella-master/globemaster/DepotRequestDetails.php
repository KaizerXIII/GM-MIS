<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM Depot | Request Details</title>

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

    @media print
    {
    #print_btn {display:none;}
    footer, header,.nav,  #progress_bar{ display:none; } /*Removes elements before print, use [#idname] to find ID and [.class] to find class */

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
                                    <font size = "5" color = "black"><b>Request Number: 
                                    <span id ="requisition_order_number">
                                    <?php 
                                       if(isset($_GET['depot_or']))
                                       {
                                        $_SESSION['get_depot_or'] = $_GET['depot_or'];
                                        echo '<font color = "black">'.$_SESSION['get_depot_or'].'</font>';
                                       }
                                       else
                                       {
                                        echo '<font color = "black">'.$_SESSION['get_depot_or'].'</font>';
                                       }
                                    ?>                                   
                                    </span></b>
                                    <!-- insert request number here -->
                                    </font>
                                </div>
                                <div class = "col-md-6" align = "right">
                                    <button id = "print_btn" type = "button" class = "btn btn-primary btn-lg"><i class = "fa fa-print"></i> Print</button>
                                </div>
                                <script>
                                    $('#print_btn').on('click', function(e){
                                        window.print();
                                    })
                                </script>
                                <div class="clearfix"></div>
                            </div> <!--END Xtitle-->
                            <div class="x_content">
                            <div>
                            <?php
                                $CURRENT_REQUEST_OR = $_SESSION['get_depot_or'];
                                $SQL_GET_DEPOT_DETAILS = "SELECT * 
                                FROM mydb.depot_request
                                JOIN mydb.depot_request_details
                                ON depot_request.depot_request_id = depot_request_details.depot_request_number
                                WHERE depot_request_id = '$CURRENT_REQUEST_OR';";
                                $RESULT_GET_DEPOT_DETAILS =  mysqli_query($dbc,$SQL_GET_DEPOT_DETAILS);
                                $ROW_RESULT_GET_DEPOT_DETAILS=mysqli_fetch_array($RESULT_GET_DEPOT_DETAILS,MYSQLI_ASSOC);

                                $REQUESTED_DATE = strtotime($ROW_RESULT_GET_DEPOT_DETAILS['depot_request_date']);
                                $EXPECTED_DATE = strtotime($ROW_RESULT_GET_DEPOT_DETAILS['depot_expected_date']);

                                $FORMATTED_REQUESTED_DATE = date("M/d/y g:i A", $REQUESTED_DATE);
                                $FORMATTED_EXPECTED_DATE = date("M/d/y g:i A", $EXPECTED_DATE);
                                echo '<font color = "black">REQUEST DATE: '.$FORMATTED_REQUESTED_DATE.' </font>';                                                                           
                                echo '<br>';
                                echo '<font color = "black">EXPECTED DATE: '.$FORMATTED_EXPECTED_DATE.' </font>';
                            ?>              
                            </div>
                            <div class = "clearfix" ></div>
                                <div class = "col-md-12" align = "center" style="z-index: 1" id = "progress_bar">
                                <ul class="progressbar">
                                    <li class="active" >Requested</li>
                                    <li>Approved</li>
                                    <li>Delivered</li>
                                </ul>
                                </div> 
                            <div class = "clearfix"></div>
                             <form class="form-horizontal form-label-center" method="POST">

                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
                                    <br><br>
                                        <div class="x_panel">
                                            
                                             <center><h3><font color = "black">Items Requested</font></h3></center>
                                             <div class="ln_solid"></div>   
                                             <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                
                                                    <div class="x_content">

                                                        <table id ="damageTable" class="table">
                                                            <thead>
                                                                <tr>    
                                                                    <th>Trading Item Name</th>
                                                                    <th>Depot Reference Name</th>
                                                                    <th>Quantity</th>                                                               
                                                                </tr>
                                                                <?php
                                                                        $GET_STATUS;
                                                                        $SQL_GET_DEPOT_ITEM_DETAILS = "SELECT * 
                                                                        FROM mydb.depot_request
                                                                        JOIN mydb.depot_request_details
                                                                        ON depot_request.depot_request_id = depot_request_details.depot_request_number
                                                                        JOIN items_trading
                                                                        ON items_trading.item_id = depot_request_details.requested_item_name
                                                                        WHERE depot_request_id = '$CURRENT_REQUEST_OR';";
                                                                        $RESULT_GET_DEPOT_ITEM_DETAILS =  mysqli_query($dbc,$SQL_GET_DEPOT_ITEM_DETAILS);
                                                                        while($ROW_RESULT_GET_DEPOT_ITEM_DETAILS=mysqli_fetch_array($RESULT_GET_DEPOT_ITEM_DETAILS,MYSQLI_ASSOC))
                                                                        {
                                                                            $GET_STATUS = $ROW_RESULT_GET_DEPOT_ITEM_DETAILS['depot_request_status'];
                                                                            echo '<tr>';
                                                                                echo '<td>'.$ROW_RESULT_GET_DEPOT_ITEM_DETAILS['sku_id'].'</td>';
                                                                                echo '<td>'.$ROW_RESULT_GET_DEPOT_ITEM_DETAILS['depot_reference_name'].'</td>';
                                                                                echo '<td>'.$ROW_RESULT_GET_DEPOT_ITEM_DETAILS['requested_item_qty'].'</td>';
                                                                            echo '</tr>';

                                                                        }

                                                                    ?>
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
