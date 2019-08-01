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
                                    <button type="button" id = "print_btn" class="btn btn-primary btn-lg noprint"><i class="fa fa-print"></i> Print</button> 
                                </div>
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
                                echo '<br>';
                                echo '<font color = "black">DELIVERY PERSONNEL: <span id=delivery_person>'.$ROW_RESULT_GET_DEPOT_DETAILS['delivery_person'].' </span></font>';
                            ?>              
                            </div>
                            <div class = "clearfix" ></div>
                                <!-- <div class = "col-md-12" align = "center" style="z-index: 1" id = "progress_bar">
                                <ul class="progressbar">
                                    <li class="active" >Requested</li>
                                    <li>Approved</li>
                                    <li>Delivered</li>
                                </ul>
                                </div>  -->
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

                                                        <table id ="itemtable" class="table">
                                                            <thead>
                                                                <tr>    
                                                                    <th>Trading Item Name</th>
                                                                    <th>Depot Reference Name</th>
                                                                    <th>Quantity</th>                                                               
                                                                </tr>
                                                            </thead>
                                                            <tbody>  
                                                                <?php
                                                                        require_once("Datafetchers/mysql_connect.php");
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
                                                                                echo '<td align = "right">'.$ROW_RESULT_GET_DEPOT_ITEM_DETAILS['requested_item_qty'].'</td>';
                                                                            echo '</tr>';

                                                                        }

                                                                    ?>                                                  
                                                            </tbody>
                                                        </table>
                                                        
                                                        
                                                    </div> <!--END Xcontent-->
                                                </div><!--END Col MD-->
                                            </div><!--END Class-row -->
                                        
                                        </div><!--END XPanel-->
                                    
                                </div><!--ENDCol MD-->

                <div class="col-md-12 col-sm-12 col-xs-12" align = "right">
                                <!--//Order in Progress 
                                //Requisition Approved
                            //Requision Cancelled
                        //Requision Finished -->
                <?php
                $SQL_GET_ORDER_STATUS = "SELECT depot_request_status 
                                            FROM mydb.depot_request
                                            WHERE depot_request_id = '$CURRENT_REQUEST_OR';";
                $RESULT_GET_ORDER_STATUS =  mysqli_query($dbc,$SQL_GET_ORDER_STATUS);
                $ROW_RESULT_GET_ORDER_STATUS=mysqli_fetch_array($RESULT_GET_ORDER_STATUS,MYSQLI_ASSOC);
                if($ROW_RESULT_GET_ORDER_STATUS['depot_request_status'] == "Order in Progress")
                    {
                ?>
                    <button  type="button" id = "cancel_order" class="btn btn-danger" >Cancel Order</button>
                <?php
                    }
                    elseif($ROW_RESULT_GET_ORDER_STATUS['depot_request_status'] == "Requisition Approved")
                    {
                ?>
                    <button  type="button" id = "order_arrived" class="btn btn-success" >Order Arrived</button>
                <?php
                    }
                ?>
                </div><!--END Col MD-->
                    
                         </div> <!--END X Panel-->
                    </div><!--END Col MD-->
                    </div>
                </form>
                </div><!--END Role=Main -->
            </div><!--END Container Body-->        
</body>
</element>
<!-- Print div -->
<div class = "col-md-12 col-sm-12 col-xs-12 print-only">
    <center>
        <h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">GLOBE MASTER HOME DEPOT</h1>
        <b><h2>Tile Request Receipt</h2></b>
    </center>
    <div class = "col-md-6 col-sm-6 col-xs-6">
        <b>Expected Delivery Date: </b><?php echo $FORMATTED_REQUESTED_DATE; ?>
        <br>
        <b>Date of Request: </b><?php echo $FORMATTED_EXPECTED_DATE; ?>
        <br><br>
    </div>
    <div class = "col-md-6 col-sm-6 col-xs-6" style = "text-align:right">
        <b><?php echo "[RN-" .$_SESSION['get_depot_or']. "]"; ?></b>
        <br>
        <b>Delivered by: </b><span id = "print_deliver_name"></span>
    </div>
    <div>
        <table id ="print_table" class="table table-bordered print_table">
            <thead>
            <tr>
                <th>Trading Item Name</th>
                <th>Depot Reference Name</th>
                <th>Quantity Ordered</th>   
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
    Printed by: <?php echo $_SESSION['firstname']."  ".$_SESSION['lastname'];?>
    </div>
</div>

<script>
$('#print_btn').on('click',function(e)
{
    //Appends all necessary info based on the DR
    $('#print_deliver_name').append($('#delivery_person').text());

    $('#itemtable tbody').each(function(e)
    {
        // console.log($(this).html());
        $('#print_table').append($(this).html()); //Appends the value of the items table to the print table
       
    })
    // $('#print_table').append("<tr><td></td><td></td><th style = text-align:right>Total Amount this Order: </th><td align = right>"+$('#drTotal').val()+"</td></tr>"); //Appends the Total after all the items are loaded to avoid duplicate  <TR>
})
</script>

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
 $('#cancel_order').on('click', function(e){
        var CURRENT_QTY = [];
        var CURRENT_SKU = [];
        var DEPOT_REFERENCE = [];
        var approved = "cancelled";
        $('#itemtable tr td:nth-child(1)').each(function (e){
            var getValue =$(this).text();
            console.log("Cart VAlue: "+getValue);           
            CURRENT_SKU.push(getValue);
        }); //ENd jquery
        $('#itemtable tr td:nth-child(2)').each(function (e){
            var getValue =$(this).text();
            console.log("Cart VAlue: "+getValue);
            DEPOT_REFERENCE.push(getValue);
        }); //ENd jquery
        $('#itemtable tr td:nth-child(3)').each(function (e){
            var getValue =parseInt($(this).text());
            console.log("Cart VAlue: "+getValue);
            CURRENT_QTY.push(getValue);
        }); //ENd jquery
       

        if(confirm("Cancel Request?"))
            {
                
                request = $.ajax({
                url: "ajax/update_depot_and_trading.php",
                type: "POST",
                data: {post_item_sku: CURRENT_SKU,
                    post_item_qty: CURRENT_QTY,
                    post_depot_reference: DEPOT_REFERENCE,
                    post_depot_or: parseInt($('#requisition_order_number').text()),
                    post_status: approved
                                            
                },
                success: function(data, textStatus)
                {
                    alert("Current Requistion Cancelled!");
                    // window.location.href= "ViewDepotRequests.php";
                    

                }//End Success
                
                }); // End ajax 
            }
            else
            {
                alert("Action: Cancelled");
            }                  
    })
   
</script>

<script>
    $('#print_btn').on('click', function(e){      
        window.print();
    })    
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
