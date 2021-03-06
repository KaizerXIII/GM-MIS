<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Order Details</title>

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

<element class = "noprint">
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
                    <?php
                        require_once("nav.php");    
                    ?>
        </div><!--END Main Container?-->
                <!-- page content -->
            <div class="right_col" role="main">
                    <!-- top tiles -->
                                    
                    <!-- /top tiles -->
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <div class="x_panel" >
                            <div class="x_title">
                                <div class = "col-md-10">
                                <h1><b>Order Number: </b>
                                    <?php
                                     if(isset($_GET['order_number']))
                                     {
                                       

                                        $_SESSION['order_number_from_view'] = $_GET['order_number']; //Stores the Value of Get from View Inventory
                                        echo $_SESSION['order_number_from_view']; 
                                        
                                     }
                                     else
                                     {
                                        // echo $_GET['getValue'];
                                        echo $_SESSION['order_number_from_view']; 
                                     }
                                    ?>
                                </h1>
                                </div>
                                <div class = "col-md-2" align = "right">
                                    <button type="button" id = "print_btn" class="btn btn-primary btn-lg noprint"><i class="fa fa-print"></i> Print</button>          
                                </div>                                  
                                <div class="clearfix"></div>
                            </div> <!--END Xtitle-->
                            <div class="x_content">

                            <?php
                                $GET_OR_FROM_SESSION_1 = $_SESSION['order_number_from_view'];
                                $SQL_SELECT_FROM_ORDER_ORDERSTATUS_1 = "SELECT * FROM orders WHERE ordernumber = '$GET_OR_FROM_SESSION_1'";
                                $RESULT_SELECT_ORDERSTATUS_1 = mysqli_query($dbc,$SQL_SELECT_FROM_ORDER_ORDERSTATUS_1);
                                while($ROW_RESULT_SELECT_STATUS_1=mysqli_fetch_array($RESULT_SELECT_ORDERSTATUS_1,MYSQLI_ASSOC))
                                {
                                    $statows = $ROW_RESULT_SELECT_STATUS_1['order_status'];
                                    $fabstatows = $ROW_RESULT_SELECT_STATUS_1['fab_status'];
                                    if($statows == "PickUp") //order status
                                    {
                            ?>
                                    <p><font color = "black">This order is to be picked up by the customer.</font></p>
                            <?php
                                        if($fabstatows == "Under Fabrication" || $fabstatows == "For Fabrication") //fabrication status
                                        {
                            ?>
                                    <p><font color = "#ADD8E6">This order is still staged for fabrication, and is not yet ready for pickup.</font></p>
                            <?php
                                        }
                                        else if($fabstatows == "Disapproved")
                                        {
                            ?>
                                    <p><font color = "red">This order's fabrication request has been disapproved. Please inform the customer about the disapproval.</font></p>
                            <?php
                                        }
                                        else if($fabstatows == "Finished Fabrication")
                                        {
                            ?>
                                    <p><font color = "green">This order's fabrication request is finished! The items are ready to be picked up by the customer. Please inform the customer about this.</font></p>
                            <?php
                                        }
                                        else if($fabstatows == "No Fabrication")
                                        {
                            ?>
                                    <p><font color = "blue">The items are ready to be picked up by the customer. Please inform the customer about this.</font></p>
                            <?php
                                        }
                                    }
                                    else if($statows == "Order In Progress" || $statows == "Deliver")
                                    {
                            ?>
                                    <p><font color = "black">This order is currently in progress.</font></p>
                            <?php
                                    }
                                    else if($statows == "Cancelled")
                                    {
                            ?>
                                    <p><font color = "red">This order is cancelled.</font></p>
                            <?php 
                                    }
                                    else if($statows == "Delivered")
                                    {
                            ?>
                                    <p><font color = "green">This order is completed.</font></p> 
                            <?php
                                    }
                                }
                            ?>
                           
                          
                                <form class="form-horizontal form-label-center" method="POST">

                                
                                    <div class="col-md-6 col-sm-6 col-xs-12" >
                                        <div class="x_panel" >

                                            <center><font color = "#2a5eb2"><h3>Order Details </h3>
                                            
                                            </h3></font></center>
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Client Name: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "client_name" class="form-control" readonly="readonly" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Order Date</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input name = "order_date" type="date" id = "order_date" class="form-control" readonly="readonly">
                                                </div>
                                            </div>

                                            <div class="form-group" id = "exp_date_div">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Expected Date: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="date" id = "expected_date" class="form-control" readonly="readonly" >
                                                </div>
                                            </div>
                                   
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Type: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "payment_type" class="form-control" readonly="readonly" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Status: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "payment_status" class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Order Status: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "order_status" class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group" id ="install_stat_div">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Installation Status: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "install_status" class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fabrication Status: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "fabrication_status" class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fabrication Cost: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "total_fab_cost" class="form-control" readonly="readonly "style="text-align:right;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">VAT Amount: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "total_vat" class="form-control" readonly="readonly "style="text-align:right;">
                                                </div>
                                            </div>        
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Loan Paid Amount: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "loanpaid" class="form-control" readonly="readonly"  style="text-align:right;" value = "₱ 300.00">
                                                </div>
                                            </div>                               
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Amount: </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "total_amount" class="form-control" readonly="readonly"  style="text-align:right;">
                                                </div>
                                            </div>
                                            
                                        </div> <!--END XPanel-->
                                    </div> <!--END Class Colmd-->
                                <script>
                                     <?php
                                      require_once('DataFetchers/mysql_connect.php');
                                    
                                      echo  'var CLIENT_NAME_BOX = document.getElementById("client_name");';
                                      echo  'var ORDER_DATE_BOX = document.getElementById("order_date");';
                                      echo  'var EXPECTED_DATE_BOX = document.getElementById("expected_date");';
                                      echo  'var PAYMENT_TYPE_BOX = document.getElementById("payment_type");';
                                      echo  'var PAYMENT_STATUS_BOX = document.getElementById("payment_status");';

                                      echo  'var ORDER_STATUS_BOX = document.getElementById("order_status");';
                                      echo  'var INSTALL_STATUS_BOX = document.getElementById("install_status");';
                                      echo  'var FAB_STATUS_BOX = document.getElementById("fabrication_status");';
                                      echo  'var TOTAL_AMOUNT_BOX = document.getElementById("total_amount");';
                                      echo  'var VAT_AMOUNT_BOX = document.getElementById("total_vat");';
                                      echo  'var FAB_AMOUNT_BOX = document.getElementById("total_fab_cost");';

                                    $CLIENT_NAME = array();
                                    $ORDER_DATE = array();
                                    $EXPECTED_DATE = array();
                                    $PAYMENT_TYPE = array();
                                    $PAYMENT_STATUS = array();
                                    $ORDER_STATUS = array();                                    
                                    $INSTALL_STATUS = array();
                                    $FAB_STATUS = array();
                                    $TOTAL_AMOUNT = array();
                                    $TOTAL_VAT = array();
                                    $TOTAL_FAB = array();

                                    $GET_OR =  $_SESSION['order_number_from_view']; 
                                    $SQL_SELECT_FROM_ORDERS = "SELECT * FROM orders WHERE ordernumber = '$GET_OR'";
                                    $RESULT_SELECT_ORDERS = mysqli_query($dbc,$SQL_SELECT_FROM_ORDERS);
                                    while($ROW_RESULT_SELECT_ORDERS=mysqli_fetch_array($RESULT_SELECT_ORDERS,MYSQLI_ASSOC))
                                    {
                                        $queryPaymentType = "SELECT paymenttype FROM ref_payment WHERE payment_id =" . $ROW_RESULT_SELECT_ORDERS['payment_id'] . ";";
                                        $resultPaymentType = mysqli_query($dbc,$queryPaymentType);
                                        $rowPaymentType=mysqli_fetch_array($resultPaymentType,MYSQLI_ASSOC);
              
                                        $PAYMENT_TYPE[] = $rowPaymentType['paymenttype'];
              
                                        $queryClientName = "SELECT client_name FROM clients WHERE client_id =" . $ROW_RESULT_SELECT_ORDERS['client_id'] . ";";
                                        $resultClientName = mysqli_query($dbc,$queryClientName);
                                        $rowClientName=mysqli_fetch_array($resultClientName,MYSQLI_ASSOC);
              
                                        $CLIENT_NAME[] = $rowClientName['client_name'];
                                        
                                        $TIME = strtotime($ROW_RESULT_SELECT_ORDERS['order_date']);
                                        $NEW_TIME_FORMAT = date('Y-m-d',$TIME);

                                        // $CLIENT_NAME[] = $ROW_RESULT_SELECT_ORDERS['client_id'];
                                        $ORDER_DATE[] = $NEW_TIME_FORMAT;  
                                        $EXPECTED_DATE[] = $ROW_RESULT_SELECT_ORDERS['expected_date'];
                                        // $PAYMENT_TYPE[] = $ROW_RESULT_SELECT_ORDERS['payment_id'];
                                        $PAYMENT_STATUS[] = $ROW_RESULT_SELECT_ORDERS['payment_status'];

                                        $ORDER_STATUS[] = $ROW_RESULT_SELECT_ORDERS['order_status'];
                                        $INSTALL_STATUS[] = $ROW_RESULT_SELECT_ORDERS['installation_status'];
                                        $FAB_STATUS[] = $ROW_RESULT_SELECT_ORDERS['fab_status'];
                                        $TOTAL_AMOUNT[] =  number_format(($ROW_RESULT_SELECT_ORDERS['totalamt']),2);                                          
                                                                          
                                    }
                                    $SQL_GET_ITEM_ID = "SELECT * FROM order_details WHERE ordernumber = '$GET_OR'";
                                    $RESULT_GET_ITEM_ID = mysqli_query($dbc,$SQL_GET_ITEM_ID);
                                    while($ROW_RESULT_GET_ITEM_ID=mysqli_fetch_array($RESULT_GET_ITEM_ID,MYSQLI_ASSOC))
                                    {
                                        $ITEM_PRICE_SUBTOTAL = $ROW_RESULT_GET_ITEM_ID['item_price'] * $ROW_RESULT_GET_ITEM_ID['item_qty'];
                                        $TOTAL_VAT[] = number_format(($ITEM_PRICE_SUBTOTAL / 1.12) * 0.12,2);
                                        
                                        $TOTAL_FAB[] = number_format((($ROW_RESULT_GET_ITEM_ID['item_price'] * $ROW_RESULT_GET_ITEM_ID['item_qty']) + (($ITEM_PRICE_SUBTOTAL / 1.12) * 0.12)) *.10,2);
                                    }
                                    
                                    echo "var CLIENT_NAME_FROM_PHP = ".json_encode($CLIENT_NAME).";"; 
                                    echo "var ORDER_DATE_FROM_PHP = ".json_encode($ORDER_DATE).";"; 
                                    echo "var EXPECTED_DATE_FROM_PHP = ".json_encode($EXPECTED_DATE).";";
                                    echo "var PAYMENT_TYPE_FROM_PHP = ".json_encode($PAYMENT_TYPE).";";
                                    echo "var PAYMENT_STATUS_FROM_PHP = ".json_encode($PAYMENT_STATUS).";";
                                    echo "var ORDER_STATUS_FROM_PHP = ".json_encode($ORDER_STATUS).";";
                                    echo "var INSTALL_STATUS_FROM_PHP = ".json_encode($INSTALL_STATUS).";";
                                    echo "var FAB_STATUS_FROM_PHP = ".json_encode($FAB_STATUS).";";
                                    echo "var TOTAL_AMOUNT_FROM_PHP = ".json_encode($TOTAL_AMOUNT).";";
                                    echo "var VAT_AMOUNT_FROM_PHP = ".json_encode($TOTAL_VAT).";";
                                    echo "var FAB_AMOUNT_FROM_PHP = ".json_encode($TOTAL_FAB).";";

                                    echo  " for (var i = 0; i < 1; i++) {  ";   
                                        echo 'CLIENT_NAME_BOX.value = CLIENT_NAME_FROM_PHP[i];';
                                        echo 'ORDER_DATE_BOX.value = ORDER_DATE_FROM_PHP[i];';
                                        echo 'EXPECTED_DATE_BOX.value = EXPECTED_DATE_FROM_PHP[i];';
                                        echo 'PAYMENT_TYPE_BOX.value = PAYMENT_TYPE_FROM_PHP[i];';
                                        echo 'PAYMENT_STATUS_BOX.value = PAYMENT_STATUS_FROM_PHP[i];';
                                        echo 'ORDER_STATUS_BOX.value = ORDER_STATUS_FROM_PHP[i];';
                                        echo 'INSTALL_STATUS_BOX.value = INSTALL_STATUS_FROM_PHP[i];';
                                        echo 'FAB_STATUS_BOX.value = FAB_STATUS_FROM_PHP[i];';
                                        echo 'TOTAL_AMOUNT_BOX.value = "₱ "+ TOTAL_AMOUNT_FROM_PHP[i];';
                                        echo 'VAT_AMOUNT_BOX.value = "₱ "+ VAT_AMOUNT_FROM_PHP[i];';
                                        echo 'FAB_AMOUNT_BOX.value = "₱ "+ FAB_AMOUNT_FROM_PHP[i];';
                                    echo '}'; //End FOR

                                     ?>
                                </script> 

                                    <div class="col-md-6 col-sm-6 col-xs-12" >
                                        
                                        <div class="x_panel">

                                             <center><h3>Items Bought for This Order
                                           
                                            </h3></center>

                                             <div class="ln_solid"></div>   

                                             <!-- recently damaged table -->
                                             <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                
                                                    <div class="x_content">

                                                        <table id ="damageTable" class="table">
                                                            <thead>
                                                                <tr>    
                                                                <th>Item Name</th>
                                                                <th>Price </th>
                                                                <th>Quantity Ordered</th>
                                                                <th>Subtotal</th>
                                                                
                                                                </tr>
                                                            </thead>

                                                                <?php 
                                                                require_once('DataFetchers/mysql_connect.php');
                                                                $GET_OR_FROM_SESSION = $_SESSION['order_number_from_view'];
                                                                $SQL_SELECT_FROM_ORDER_DETAILS = "SELECT * FROM order_details WHERE ordernumber = '$GET_OR_FROM_SESSION'";
                                                                $RESULT_SELECT = mysqli_query($dbc,$SQL_SELECT_FROM_ORDER_DETAILS);
                                                                while($ROW_RESULT_SELECT=mysqli_fetch_array($RESULT_SELECT,MYSQLI_ASSOC))
                                                                {
                                                                    echo '<tbody>';
                                                                    echo '<tr>';
                                                                        echo '<td>';
                                                                        echo $ROW_RESULT_SELECT['item_name'];
                                                                        echo '</td>';
                                                                        echo '<td align = "right">';
                                                                        echo "₱ ", number_format(($ROW_RESULT_SELECT['item_price']),2);  
                                                                        echo '</td>';
                                                                        echo '<td align = "right">';
                                                                        echo $ROW_RESULT_SELECT['item_qty'];
                                                                        echo '</td>';
                                                                        echo '<td align = "right">';
                                                                        echo "₱ ", number_format(($ROW_RESULT_SELECT['item_price']) * $ROW_RESULT_SELECT['item_qty'], 2);
                                                                        echo '</td>';
                                                                    echo '</tr>';                                                      
                                                                    echo '</tbody>';
                                                                }                                                                                 
                                                                ?>  
                                                        </table>
                                                        
                                                    </div> <!--END Xcontent-->
                                                </div><!--END Col MD-->
                                            </div><!--END Class-row -->
                            <div class="col-md-12 col-sm-6 col-xs-12" id = "fab_item">
                                <div class="x_panel" >
                                <center><h3>Fabricated Product Request</h1></h3></center>
                                    <div class="ln_solid"></div>
                                    <div class="row" >
                                    <div class = "col-md-12" align = "center">
                                        <!-- "data:image/jpg;base64,'. base64_encode($BLOB[$i]).'" -->
                                        <?php
                                        // $SQL_GET_OR_FROM_DR = "SELECT * FROM scheduledelivery WHERE delivery_Receipt = '$GET_ID_DELIVERY' ";
                                        // $RESULT_GET_OR_FROM_DR = mysqli_query($dbc, $SQL_GET_OR_FROM_DR);
                                        // $ROW_RESULT_GET_OR = mysqli_fetch_array($RESULT_GET_OR_FROM_DR,MYSQLI_ASSOC);

                                        // $CURRENT_OR_OF_DR = $ROW_RESULT_GET_OR['ordernumber'];

                                        $SQL_GET_FAB_DESC = "SELECT * FROM joborderfabrication WHERE order_number = '$GET_OR_FROM_SESSION_1'";
                                        $RESULT_GET_FAB_DESC = mysqli_query($dbc, $SQL_GET_FAB_DESC);                                           
                                        
                                        $ROW_RESULT_GET_FAB_DESC = mysqli_fetch_array($RESULT_GET_FAB_DESC,MYSQLI_ASSOC);
                                        $BLOB =  $ROW_RESULT_GET_FAB_DESC['reference_drawing'];
                                                     

                                         echo '<img src = "data:image/jpg;base64,'. base64_encode($BLOB).'"   border-style = "border-width:3px;"style = "height:20vh; width:15vw">'
                                        ?>
                                    </div>
                                        <div class="col-md-12 col-sm-12 col-xs-12"  >
                                        <br>
                                            <?php

                                                $SQL_GET_FAB_STATUS = "SELECT * FROM orders WHERE ordernumber = '$GET_OR_FROM_SESSION_1'";
                                                $RESULT_GET_FAB_STATUS = mysqli_query($dbc, $SQL_GET_FAB_STATUS);
                                                $ROW_RESULT_GET_FAB_STATUS = mysqli_fetch_array($RESULT_GET_FAB_STATUS,MYSQLI_ASSOC);

                                                $FAB_STATUS = $ROW_RESULT_GET_FAB_STATUS['fab_status'];
                                                
                                                if($FAB_STATUS == "For Fabrication")
                                                {
                                                    echo '<h2>Current Status: <font color = "blue">Pending Approval</font></h2>';
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
                                        </div>
                                        <div class ="col-md-12 col-sm-12 col-xs-12">
                                        <?php
                                            $SQL_GET_FAB_DESC = "SELECT * FROM joborderfabrication WHERE order_number = '$GET_OR_FROM_SESSION_1'";
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
                                        
                                        </div><!--END XPanel-->
                                        
                                    
                                </div><!--ENDCol MD-->

                               <div class="col-md-12 col-sm-12 col-xs-12" align = "right">
                                        
                                        <div class="ln_solid"></div>
                                        <?php
                                            $SQL_SELECT_FROM_ORDER_ORDERSTATUS = "SELECT * FROM orders WHERE ordernumber = '$GET_OR_FROM_SESSION'";
                                            $RESULT_SELECT_ORDERSTATUS = mysqli_query($dbc,$SQL_SELECT_FROM_ORDER_ORDERSTATUS);
                                            while($ROW_RESULT_SELECT_STATUS=mysqli_fetch_array($RESULT_SELECT_ORDERSTATUS,MYSQLI_ASSOC))
                                            {
                                                $statohs = $ROW_RESULT_SELECT_STATUS['order_status'];
                                                if($statohs == "PickUp" )
                                                {
                                        ?>
                                                <button name = "confirmButton" type="button" class="btn btn-success" onclick ="FinishOrder()">Finish</button>
                                                <button type="button" class="btn btn-warning" onclick="cancelWarning()">Cancel Order</button>
                                                <script>
                                                    $('#exp_date_div').hide();
                                                    $('#install_stat_div').hide();
                                                    
                                                </script>
                                        <?php
                                                }
                                                else if($statohs == "Deliver")
                                                {
                                                    echo '<button name = "confirmButton" type="button" class="btn btn-success" style = "display:none" onclick ="FinishOrder()">Finish</button>';
                                                    echo '<button type="button" class="btn btn-warning"  style = "display:block" onclick="cancelWarning()">Cancel Order</button>';
                                                }
                                                else if($statohs == "Order In Progress" || $statohs == "Late Delivery" || $statohs == "Order Cancelled" || $statohs == "Delivered" || $statohs == "Deliver")
                                                {
                                        ?>
                                                <button name = "confirmButton" type="button" class="btn btn-success" style = "display:none" onclick ="FinishOrder()">Finish</button>
                                                <button type="button" class="btn btn-warning"  style = "display:block" disabled onclick="cancelWarning()">Cancel Order</button>
                                        <?php
                                                }
                                                else if($statohs == "Cancelled" || $statohs == "Finished Order")
                                                {
                                        ?>
                                                <button name = "confirmButton" type="button" class="btn btn-success" onclick ="FinishOrder()" disabled>Finish</button>
                                                <button type="button" class="btn btn-warning"  onclick="cancelWarning()" disabled>Cancel Order</button>
                                        <?php
                                                }
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
        <h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">GLOBE MASTER TRADING</h1>
        <b><h2>Official Receipt</h2></b>
    </center>
    <div class = "col-md-6 col-sm-6 col-xs-6">
        <b>Customer Name: </b><span id = "print_customer_name"></span>
        <br>
        <b>Expected Date: </b><span id = "print_expected_date"></span>
        <br>
        <b>Payment Type: </b><span id = "print_payment_type"></span>
        <br>
        <b>Loan Paid Amount: </b><span>₱ 300.00</span>
        <br>
        <b>Payment Status: </b><span id = "print_payment_status"></span>
        <br><br>
    </div>
    <div class = "col-md-6 col-sm-6 col-xs-6" style = "text-align:right">
        <b><?php echo date("F j, Y g:i:s"); ?></b>  
        <br>                            
        <b><?php echo "[" .$_SESSION['order_number_from_view']. "]"; ?></b>
        <br>
    </div>
    <div>
        <table id ="print_table" class="table table-bordered print_table">
            <thead>
            <tr>
                <th>Item Name</th>
                <th>Price per Piece</th>
                <th>Quantity Ordered</th>
                <th>Total Price per Item</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- insert if else checker here -->
    <div class = "clearfix"></div>
    <div id = "fabDivRcpt">
        <b>Fabrication Job Request Details</b>       
        <br>     
        
        <?php
            // $SQL_GET_OR_FROM_DR_RCPT = "SELECT * FROM scheduledelivery WHERE delivery_Receipt = '$GET_ID_DELIVERY' ";
            // $RESULT_GET_OR_FROM_DR_RCPT = mysqli_query($dbc, $SQL_GET_OR_FROM_DR_RCPT);
            // $ROW_RESULT_GET_OR_RCPT = mysqli_fetch_array($RESULT_GET_OR_FROM_DR_RCPT,MYSQLI_ASSOC);

            $CURRENT_OR_OF_DR_RCPT = $_SESSION['order_number_from_view'];

            $SQL_GET_FAB_DESC_RCPT = "SELECT * FROM joborderfabrication WHERE order_number = '$CURRENT_OR_OF_DR_RCPT'";
            $RESULT_GET_FAB_DESC_RCPT = mysqli_query($dbc, $SQL_GET_FAB_DESC_RCPT);                                           

            $ROW_RESULT_GET_FAB_DESC_RCPT = mysqli_fetch_array($RESULT_GET_FAB_DESC_RCPT,MYSQLI_ASSOC);
            $BLOB_RCPT =  $ROW_RESULT_GET_FAB_DESC_RCPT['reference_drawing'];
                    

            echo '<img src = "data:image/jpg;base64,'. base64_encode($BLOB_RCPT).' "border-style = "border-width:3px;"style = "height:20vh; width:15vw">'
        ?>
            <!-- <img src = "data:image/jpg;base64,'. base64_encode().'" width = "200px" height = "180px"> -->
        <br>
        <b>Fabrication Description: </b><?php echo $ROW_RESULT_GET_FAB_DESC_RCPT['fab_description']; ?>

    </div>
    <?php
            $SQL_GET_FAB_STATUS_RCPT = "SELECT * FROM orders WHERE ordernumber = '$CURRENT_OR_OF_DR_RCPT'";
                $RESULT_GET_FAB_STATUS_RCPT = mysqli_query($dbc, $SQL_GET_FAB_STATUS_RCPT);
                $ROW_RESULT_GET_FAB_STATUS_RCPT = mysqli_fetch_array($RESULT_GET_FAB_STATUS_RCPT,MYSQLI_ASSOC);

                $FAB_STATUS_RCPT = $ROW_RESULT_GET_FAB_STATUS_RCPT['fab_status'];

                if($FAB_STATUS_RCPT == "No Fabrication")
                {
                    echo '<script>$("#fabDivRcpt").hide();</script>';
                }
    ?>
    <div style = "text-align:right">
        <br><br><br>
        Received by: ____________________
        <br><br><br>
        Printed by: <?php echo $_SESSION['firstname']."  ".$_SESSION['lastname'];?>
    </div>
</div>

<script>
$('#print_btn').on('click',function(e){
    console.log("logging");

    $('#print_customer_name').append($('#client_name').val()); //Appends all necessary info based on the DR
    $('#print_expected_date').append($('#expected_date').val());
    $('#print_payment_status').append($('#payment_status').val());
    $('#print_payment_type').append($('#payment_type').val());

    $('#damageTable tbody').each(function(e){
        console.log($(this).html());
        $('#print_table').append($(this).html()); //Appends the value of the items table to the print table
       
    })
    $('#print_table').append("<tr><td></td><td></td><th style = text-align:right>Total Amount this Order: </th><td align = right>"+$('#total_amount').val()+"</td></tr>"); //Appends the Total after all the items are loaded to avoid duplicate  <TR>
})
</script>

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
    $('#print_btn').on('click', function(e){      
        window.print();
    })    
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

</body>

</html>
