<html lang="en">
<?php 
 
?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GM - Order Form </title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <!-- JQUERY Required Scripts -->
        <script type="text/javascript" src="js/script.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 

       
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                
                <?php
                require_once("nav.php");                   
                ?>

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">GLOBEMASTER TRADING CLIENT ORDER FORM</h1><br>
                        </div>
            <br><br><br><br>

                        <div class="clearfix"></div>


                        <div class="col-md-12 col-sm-6 col-xs-12">

                            <div class="x_content">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h3> 
                                            <?php
                                                $queryTogetMaxOR = " SELECT count(ordernumber)+1 as TOTALOR FROM orders";
                                                $resultOfQuery=mysqli_query($dbc,$queryTogetMaxOR);
                                                $row = mysqli_fetch_array($resultOfQuery,MYSQLI_ASSOC);

                                                $CurrentOR = "OR - ".$row['TOTALOR'];                                                           
                                                echo "<b>".$CurrentOR."</b>";
                                                $orderNumber = $CurrentOR;

                                               //
                                            ?>
                                        </h3>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                    

                                        <form class="form-horizontal form-label-left" method="POST">

                                            <div class="form-group">
                                                <font color = "black" size = "6"><label class="control-label col-md-11 col-sm-11 col-xs-12" style = "text-align: left;">Select Client:</label></font>
                                                <div class="col-md-2 col-sm-2 col-xs-12" style = "align: left;">
                                                    <select class="form-control col-md-12 col-xs-12" id="clientID" name="clientID">
                                                <?php

                                                    require_once('DataFetchers/mysql_connect.php');
                                                    $SQL_CLIENT_LIST="SELECT client_id, client_name FROM clients WHERE client_status = 'Allowed'";
                                                    $result=mysqli_query($dbc,$SQL_CLIENT_LIST);
                                                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                                    {
                                                        echo "<option value=".$row['client_id']."> ".$row['client_name']."</option>";  
                                                    }
                                                ?> 
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                                                        <thead>
                                                        <tr>
                                                            <th>Item Name</th>
                                                            <th>Item Type</th>
                                                            <th>Supplier</th>                                                           
                                                            <th>Price</th>
                                                            <th>Stock </th>
                                                            
                                                            <th class="col-md-1 col-sm-1 col-xs-1">Quantity</th>
                                                            <th>Add</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php

                                                            require_once('DataFetchers/mysql_connect.php');
                                                            $SQL_ITEM_LIST = "SELECT * FROM items_trading;";
                                                            $result1=mysqli_query($dbc,$SQL_ITEM_LIST);

                                                            $itemCountArray = array();
                                                            while($row=mysqli_fetch_array($result1,MYSQLI_ASSOC) )
                                                            {
                                                                $queryItemType = "SELECT itemtype FROM ref_itemtype WHERE itemtype_id =" . $row['itemtype_id'] . ";";
                                                                $resultItemType = mysqli_query($dbc,$queryItemType);
                                                                $rowItemType=mysqli_fetch_array($resultItemType,MYSQLI_ASSOC);
                                                                $itemType = $rowItemType['itemtype'];

                                                                $queryWarehouse = "SELECT warehouse FROM warehouses WHERE warehouse_id =" . $row['warehouse_id'] . ";";
                                                                $resultWarehouse = mysqli_query($dbc,$queryWarehouse);
                                                                $rowWarehouse=mysqli_fetch_array($resultWarehouse,MYSQLI_ASSOC);
                                                                $warehouse = $rowWarehouse['warehouse'];

                                                                $querySupplierName = "SELECT supplier_name FROM suppliers WHERE supplier_id =" . $row['supplier_id'] . ";";
                                                                $resultSupplierName = mysqli_query($dbc,$querySupplierName);
                                                                $rowSupplierName=mysqli_fetch_array($resultSupplierName,MYSQLI_ASSOC);
                                                                $supplierName = $rowSupplierName['supplier_name'];

                                                                    
                                                                echo '<tr class ="tableRow">';
                                                                    echo '<td  id = ',$row['item_id'],' >';
                                                                    echo $row['item_name'];
                                                                    echo '</td>';
                                                                    echo '<td>';
                                                                    echo $itemType;
                                                                    echo '</td>';
                                                                    echo '<td>';
                                                                    echo $supplierName;
                                                                    echo '</td>';

                                                                   
                                                                    echo '<td align = right>';
                                                                    echo  '₱'." ".number_format($row['price'], 2);
                                                                    echo '</td>';
                                                                    echo '<td align = right class = ',$row['item_id'],'>';
                                                                    echo $row['item_count'];
                                                                    echo '</td>';

                                                                                                                            
                                                                    echo '<td >';
                                                                    echo '<input  style="text-align:right;" type="number" oninput="validate(this)" id="quantity',$row['item_id'],'" name="quantity',$row['item_id'],'"  min="1" max ="',$row['item_count'],'" value="" placeholder ="0"></input>';
                                                                    echo '</td>';

                                                                    echo '<td align = center >';
                                                                    echo '<button type="button" class="btn btn-round btn-success" name ="add" value ="',$row['item_id'],'" > + </button>';
                                                                    echo '</td>';

                                                                echo '</tr>';                                                                                  
                                                            }
                                                        ?>  
                                                        </tbody>
                                                        <script type="text/javascript">
                                                            function validate(obj) {
                                                                obj.value = valBetween(obj.value, obj.min, obj.max); //Gets the value of input alongside with min and max
                                                                console.log(obj.value);
                                                            }

                                                            function valBetween(v, min, max) {
                                                                return (Math.min(max, Math.max(min, v))); //compares the value between the min and max , returns the max when input value > max
                                                            }
                                                        </script> <!-- To avoid the users input more than the current Max per item -->
                                                    </table>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label class="red" id="quantityAlert"></label>
                                                </div>
                                            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Order Cart</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="productTable">                                                   
                               
                                <table id="cart" class="table table-striped table-bordered bulk_action">
                                  <thead>
                                    <tr>
                                        <th>Item Name</th>
                                         <th>Item Type</th>
                                         <th>Price</th>
                                         <th>Quantity</th>
                                         <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                        
                                    </tr>
                                  </tbody>
                                </table>
                                <!-- Added as of 11-7-19 Add subtotal and vat computation??? -->
                                <h4 align = "right"> Subtotal: <input style="text-align:right;" readonly="readonly" name="subtotal" id ="subtotal" value="0"> </h4>
                                <h4 align = "right"> VAT: <input style="text-align:right;" readonly="readonly" name="total_vat" id ="total_vat" value="0"> </h4>
                                <h4 align = "right"> Total Payment: <input style="text-align:right;" readonly="readonly" name="totalPayment" id ="payment" value="0"> </h4>
                            </div>

                           
                            <?php
                        
                        // WORK IN PROGESS //
                                               

                    //     if(isset($_POST['viewOrderButton']))
                    //     {
                            // if($_SESSION['DeliveryStatus'] == "PickUp") //IF order is pickup
                            // {
                            //     $CLIENT_ID = $_POST['clientID'];
                            //     $PAYMENT_ID = $_POST['paymentID'];
                            //     $CART_TOTAL = $_POST['totalPayment'];                               
                            //     $ORDER_STATUS = $_SESSION['DeliveryStatus'];
                            //     $CURRENT_OR = $CurrentOR;
                            //     $INSTALL_STATUS = "No Installation";
                            //     $FAB_STATUS = $_SESSION['FabricationStatus'];
                            //     $PAYMENT_STATUS = $_SESSION['payment_status'];

                            //     $SANITIZED_CART_TOTAL = filter_var($CART_TOTAL,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

                            //     $sqlInsertToOrdersTable = "INSERT INTO orders(ordernumber, client_id, order_date, payment_id, totalamt, order_status, installation_status, fab_status, payment_status)
                            //     VALUES(
                            //         '$CURRENT_OR',
                            //         '$CLIENT_ID', 
                            //         Now(),  
                            //         '$PAYMENT_ID', 
                            //         '$SANITIZED_CART_TOTAL',
                            //         '$ORDER_STATUS',
                            //         '$INSTALL_STATUS',
                            //         '$FAB_STATUS',
                            //         '$PAYMENT_STATUS');";

                            //     $resultofInsertToOrders = mysqli_query($dbc,$sqlInsertToOrdersTable);  // Insert To Orders
                            //     if($PAYMENT_STATUS == "Unpaid") // Adds Unpaid amount to Client Tabol
                            //     {
                            //       $SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE = "UPDATE clients
                            //       SET clients.total_unpaid  = (total_unpaid + '$SANITIZED_CART_TOTAL')
                            //       WHERE client_id ='$CLIENT_ID';";
                            //        $RESULT_UNPAID_TOTAL=mysqli_query($dbc,$SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE);
                            //        if(!$RESULT_UNPAID_TOTAL) 
                            //        {
                            //            die('Error: ' . mysqli_error($dbc));
                            //        } 
                            //        else 
                            //        {
                            //            echo '<script language="javascript">';
                            //            echo 'alert("Added Unpaid Amount to Client");';
                            //            echo '</script>';
                            //           //  header("Location: ViewOrders.php");
                            //        }

                            //        $SQL_INSERT_TO_UNPAID_TABLE = "INSERT INTO unpaid_clients(clientID, ordernumber, init_unpaid, totalunpaid) 
                            //        VALUES('$CLIENT_ID', '$CURRENT_OR', '$SANITIZED_CART_TOTAL','$SANITIZED_CART_TOTAL');"; 
                            //        $RESULT_INSERT_TO_UNPAID_TABLE=mysqli_query($dbc,$SQL_INSERT_TO_UNPAID_TABLE); //Inserts to UNPAID Client Table for reference
                                                                                           
                            //     }//END IF
                                
                    //            $CART_ITEM_ID = $_SESSION['order_form_item_id'];
                    //            $CART_ITEM_QTY = $_SESSION['order_form_item_qty'];
                            //    $ITEM_NAME = array();
                            //    $ITEM_PRICE = array();
                            //    $DELIVERY_STATUS = $_SESSION['DeliveryStatus'];
                               
                               
                            //    for($i = 0; $i < sizeof($CART_ITEM_ID); $i++)
                            //    {
                            //         $sqlGetFromItemTrading = "SELECT * FROM items_trading WHERE item_id = $CART_ITEM_ID[$i];";
                            //         $resultofInsertToOrderDetails = mysqli_query($dbc,$sqlGetFromItemTrading);
                            //         while($rowOfSelect=mysqli_fetch_array($resultofInsertToOrderDetails,MYSQLI_ASSOC))
                            //         {
                            //             $ITEM_NAME[] = $rowOfSelect['item_name'];
                            //             $ITEM_PRICE[] = $rowOfSelect['price'];                                        
                            //         }

                            //         $sqlInsertToOrderDetails = "INSERT INTO order_details(ordernumber, client_id, item_id, item_name, item_price, item_qty, item_status)
                            //         VALUES(
                            //             '$CURRENT_OR',
                            //             '$CLIENT_ID',
                            //             '$CART_ITEM_ID[$i]',
                            //             '$ITEM_NAME[$i]',
                            //             '$ITEM_PRICE[$i]',
                            //             '$CART_ITEM_QTY[$i]',
                            //             '$DELIVERY_STATUS');";
                            //         $resultofInsertToOrderDetails = mysqli_query($dbc,$sqlInsertToOrderDetails); //Insert To Order DEtails
                                   
                                    
                            //         $sqlToSubtractFromItemsTrading = "UPDATE items_trading
                            //         SET items_trading.item_count  = (item_count - '$CART_ITEM_QTY[$i]'),
                            //         last_update = Now() 
                            //         WHERE item_id ='$CART_ITEM_ID[$i]';";
                            //          $resultOfSubtract=mysqli_query($dbc,$sqlToSubtractFromItemsTrading); //Subtracts From Inventory
                            //          if(!$resultOfSubtract) 
                            //          {
                            //              die('Error: ' . mysqli_error($dbc));
                            //          } 
                            //          else 
                            //          {
                            //              echo '<script language="javascript">';
                            //              echo 'alert("Subtract Successfull");';
                            //              echo '</script>';
                            //              header("Location: ViewOrders.php");
                            //          }                                                                      
                            //       }//End For
                                

                                  
                    //          }//End 2nd IF                                                                                                                    
                         

                        // else if($_SESSION['DeliveryStatus'] == "Deliver") //IF ORder is Deliver
                        // {
                        //     $CLIENT_ID = $_POST['clientID'];
                        //     $PAYMENT_ID = $_POST['paymentID'];
                        //     $CART_TOTAL = $_POST['totalPayment'];                               
                        //     $ORDER_STATUS = $_SESSION['DeliveryStatus'];
                        //     $CURRENT_OR = $CurrentOR;
                        //     $INSTALL_STATUS = "No Installation";
                        //     $FAB_STATUS = $_SESSION['FabricationStatus'];
                        //     $PAYMENT_STATUS = $_SESSION['payment_status'];
                        //     $EXPECTED_DATE = date('Y-m-d', strtotime($_POST['getExpectedDelivery']));
                        //     $LOAN_STATUS = $_POST['paymentID'];

                        //     $SANITIZED_CART_TOTAL = filter_var($CART_TOTAL,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

                        //     $sqlInsertToOrdersTable = "INSERT INTO orders(ordernumber, client_id, order_date, expected_date, payment_id, totalamt, order_status, installation_status, fab_status, payment_status)
                        //     VALUES(
                        //         '$CURRENT_OR',
                        //         '$CLIENT_ID', 
                        //         Now(),
                        //         '$EXPECTED_DATE',  
                        //         '$PAYMENT_ID', 
                        //         '$SANITIZED_CART_TOTAL',
                        //         '$ORDER_STATUS',
                        //         '$INSTALL_STATUS',
                        //         '$FAB_STATUS',
                        //         '$PAYMENT_STATUS');";
                        //     $resultofInsertToOrders = mysqli_query($dbc,$sqlInsertToOrdersTable);  // Insert To Orders

                        //     if($PAYMENT_STATUS == "Unpaid") // Adds Unpaid amount to Client Tabol
                        //     {
                        //       $SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE = "UPDATE clients
                        //       SET clients.total_unpaid  = (total_unpaid + '$SANITIZED_CART_TOTAL')
                        //       WHERE client_id ='$CLIENT_ID';";
                        //        $RESULT_UNPAID_TOTAL=mysqli_query($dbc,$SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE);
                        //        if(!$RESULT_UNPAID_TOTAL) 
                        //        {
                        //            die('Error: ' . mysqli_error($dbc));
                        //        } 
                        //        else 
                        //        {
                        //            echo '<script language="javascript">';
                        //            echo 'alert("Added Unpaid Amount to Client");';
                        //            echo '</script>';
                        //         //    header("Location: ViewOrders.php");
                        //        } 
                        //        $SQL_INSERT_TO_UNPAID_TABLE = "INSERT INTO unpaid_clients(clientID, ordernumber, init_unpaid, totalunpaid) 
                        //        VALUES('$CLIENT_ID', '$CURRENT_OR', '$SANITIZED_CART_TOTAL','$SANITIZED_CART_TOTAL');"; 
                        //        $RESULT_INSERT_TO_UNPAID_TABLE=mysqli_query($dbc,$SQL_INSERT_TO_UNPAID_TABLE); //Inserts to UNPAID Client Table for reference
                                                                           
                        //     }//END IF

                            
                    //         $CART_ITEM_ID = $_SESSION['order_form_item_id'];
                    //         $CART_ITEM_QTY = $_SESSION['order_form_item_qty'];
                    //         $ITEM_NAME = array();
                    //         $ITEM_PRICE = array();
                    //         $DELIVERY_STATUS = $_SESSION['DeliveryStatus'];
                                                        
                    //         for($i = 0; $i < sizeof($CART_ITEM_ID); $i++)
                    //         {
                    //             $sqlGetFromItemTrading = "SELECT * FROM items_trading WHERE item_id = $CART_ITEM_ID[$i];";
                    //             $resultofInsertToOrderDetails = mysqli_query($dbc,$sqlGetFromItemTrading);
                    //             while($rowOfSelect=mysqli_fetch_array($resultofInsertToOrderDetails,MYSQLI_ASSOC))
                    //             {
                    //                 $ITEM_NAME[] = $rowOfSelect['item_name'];
                    //                 $ITEM_PRICE[] = $rowOfSelect['price'];
                                    
                    //             }

                    //             $sqlInsertToOrderDetails = "INSERT INTO order_details(ordernumber, client_id, item_id, item_name, item_price, item_qty, item_status)
                    //             VALUES(
                    //                 '$CURRENT_OR',
                    //                 '$CLIENT_ID',
                    //                 '$CART_ITEM_ID[$i]',
                    //                 '$ITEM_NAME[$i]',
                    //                 '$ITEM_PRICE[$i]',
                    //                 '$CART_ITEM_QTY[$i]',
                    //                 '$DELIVERY_STATUS');";
                    //             $resultofInsertToOrderDetails = mysqli_query($dbc,$sqlInsertToOrderDetails); //Insert To Order DEtails
                                                                
                                
                    //             $sqlToSubtractFromItemsTrading = "UPDATE items_trading
                    //             SET items_trading.item_count  = (item_count - '$CART_ITEM_QTY[$i]'),
                    //             last_update = Now() 
                    //             WHERE item_id ='$CART_ITEM_ID[$i]';";
                    //             $resultOfSubtract=mysqli_query($dbc,$sqlToSubtractFromItemsTrading); //Subtracts From Inventory
                    //             if(!$resultOfSubtract) 
                    //             {
                    //                 die('Error: ' . mysqli_error($dbc));
                    //             } 
                    //             else 
                    //             {
                    //                 echo '<script language="javascript">';
                    //                 echo 'alert("Subtract Successfull");';
                    //                 echo '</script>';
                    //                 header("Location: ViewOrders.php");
                    //             }
                                
                    //         }//End For
                            
                                
                    //     }// END else IF
                    // }//END 1st IF
                       
                           
                            
                        ?>                   
                        </div>
                    </div>
                </div>
                                                            
                <!-- <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Type</label>
                    <div class='input-group col-md-14'>
                        <select class="form-control col-md-7 col-xs-12" name="paymentID" id = "paymentID">
                        <?php
                            require_once('DataFetchers/mysql_connect.php');
                            $SQL_PAYMENT_LIST="SELECT * FROM ref_payment";
                            $result=mysqli_query($dbc,$SQL_PAYMENT_LIST);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                            {
                                echo "<option value=".$row['payment_id']."> ".$row['paymenttype']."</option>";  
                            }

                            
                            ?> 
                        </select>
                    </div>
                </div> -->
                
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12" align = "right">
                        <button type="Reset" class="btn btn-danger btn-lg btn-round" onclick="destroyTable();">Reset</button>
                        <button type="button" class="btn btn-primary btn-lg btn-round" align="center" name="next" data-toggle="modal" data-target=".bs-example-modal-md" onclick ="checkCart()">Next Step <i class = "fa fa-arrow-right"></i></button>
                    </div>
            <!-- Add Order2 Modal -->
            
            <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id ="finalizeOrder" >
              <div class="modal-dialog modal-md" >
                <div class="modal-content" >

                  <div class="modal-header">
              
                    <h4 class="modal-title" id="myModalLabel">Finalize Order</h4>
                  </div>

                  <div class = "modal-body">
                  <form class="form-horizontal form-label-left" method="POST" action= "<?php echo $_SERVER["PHP_SELF"];?>">


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-2">Payment Type</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="btn btn-default dropdown-toggle" name="paymentID" id = "paymentID"  onchange = "setLoanDown();">
                            <?php
                                require_once('DataFetchers/mysql_connect.php');
                                $SQL_PAYMENT_LIST="SELECT * FROM ref_payment";
                                $result=mysqli_query($dbc,$SQL_PAYMENT_LIST);
                                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {
                                    echo "<option value=".$row['payment_id']."> ".$row['paymenttype']."</option>";  
                                }

                                
                                ?> 
                            </select>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-2">Loan Downpayment</label>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <input type="number" id="loanpayment" placeholder="0.00" style = "text-align:right" disabled required class="form-control col-md-7 col-xs-12" max ="0" oninput="validate(this)">
                            <!-- Loan downpayment can be 0. If set to the total value of order, the order payment status will automatically be set to PAID. -->
                        </div>
                    </div>
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-2" >For Delivery?<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <button type="button" name ="YesDeliv" class="btn btn-round btn-success" onclick = "toggleDeliveryDate(); " value = "Deliver" id = "Yesbutton" style = "display:block" >Yes</button>
                            <button type="button" name ="NoDeliv" class="btn btn-round btn-default" onclick = "toggleDeliveryDate1();" value = "PickUp" id = "Nobutton" style = "display:none">No</button>
                            
                            <?php 
                            // Session is defaulted to Deliver
                                $_SESSION['DeliveryStatus'] = "Deliver";
                                $_SESSION['FabricationStatus'] = "No Fabrication";
                                // echo $_SESSION['DeliveryStatus'] = 0;
                                                        
                                
                                
                                // echo "<script type='text/javascript'>alert('$message');</script>";
                            ?>
                          
                        </div>
                        <div class="result" style = "display:none"></div>  
                    </div>

                    <div id = "ifYes" style = "display:block">
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-2" >Expected Date<span class="required">*</span>
                            </label>
                            
                            <div class="col-md-2 col-sm-6 col-xs-12 input-group date">
                                <input id="expectedDate" name="getExpectedDelivery" class=" btn btn-default form-control col-md-7 col-xs-12 col-md-offset-1 deliveryDate" data-validate-length-range="6" data-validate-words="2" name="name1" type="date" min="<?php echo date("Y-m-d", strtotime("+1days")); ?>">
                                <!-- <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span> -->
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
                            </div>
                        </div>
                    </div>
                
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-2" >For Fabrication?<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <button type="button" class="btn btn-round btn-primary" onclick = "toggleFabrication()" value = "YesFab" id = "YesbuttonFab" style = "display:none" >Yes</button>
                            <button type="button" class="btn btn-round btn-default" onclick = "toggleFabrication1()" value = "NoFab" id = "NobuttonFab" style = "display:block">No</button>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-2" >Is This Order Paid?<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="btn btn-default dropdown-toggle" name = "payment_status" id = "payment_status" onchange = "changebuttoncolor()" required="required">
                                <option value="">Choose..</option>
                                <option value="Paid"  id = "paidoption">Paid</option>
                                <option value="Unpaid"  id = "unpaidoption">Unpaid</option>
                            </select>
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-12" align = "right">
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <!--   -->
                        <input id="send" name ="viewOrderButton" type="button" class="btn btn-success" value ="Submit" required="required"></input>
                        <input type="button" class="btn btn-primary" id="fabricationpage" disabled  onclick="nextpageWithFabrication()" value ="Next Step"></input>

                         
                                  
                      </div>
                    </div>

                    </form>
                    <!-- Order 2 -->                   
                  
                    </div>
                </div>
              </div>
            </div>
            <br>
            <br>
            <!-- End Order2 Modal -->
                                        </div>
                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
            <!-- /page content -->
        </div>


        <script>
        var count = 0;
        var itemName = "item"+1;
        var quantity = "quantity"+1;
        var currentName = ""; 
        var CurrentTotal = 0; //Gets the current total to pay
        var item_id_in_cart = []; // Get This

        var Calculated_Vat = 0
        var Grand_Total = 0                           

            $('#datatable-checkbox tbody button.btn.btn-success').on('click', function(e) {
                var row = $(this).closest('tr');
                var buttonValue = $(this).val();

                item_id_in_cart.push(buttonValue);
                
               
                var subtotal = document.getElementById("subtotal");
                var vat_total = document.getElementById("total_vat");
                var payment = document.getElementById("payment");

                var itemQuantity = document.getElementById("quantity"+buttonValue).value;
                document.getElementById("quantity"+buttonValue).value = "";
                
                // console.log('TR 1 cell: ' + row.find('td:first').text());
                // console.log('TR 2 cell: ' + row.find('td:nth-child(2)').text());
                // console.log('TR 3 cell: ' + row.find('td:nth-child(3)').text());
                // console.log('TR 4 cell: ' + row.find('td:nth-child(4)').text());
               
                var currentName =  row.find('td:first').text(); 
                console.log("Current Name = " + currentName);
                if(itemQuantity == 0)
                    {
                        alert("No Quantity Set!");
                    }
                    else
                    {
                      alert("Item: "+ currentName +" - Added to Cart!")  
                    var qty_old = 0
                    var item_does_not_exist = true;
                        $(".qtys").each(function(i){ // this gets all the classes in the order table.
                            if (buttonValue ==$(this).attr('val_id'))
                            { //checks i there is existing item

                                var current_stock = parseInt(row.find('td:nth-child(5)').text());

                                    qty = $(this).text().replace("₱ ", "");                                    
                                    var estinamted_total =  parseInt(itemQuantity) + parseInt(qty);

                                    qty_old = parseFloat(qty.replace(/\,/g,''), 10); //old qty in cart table
                                    
                                    console.log("Current Stock = " +current_stock);
                                    console.log("estinamted_total =  "+ estinamted_total);

                                    if(estinamted_total > current_stock && ((estinamted_total - current_stock) <= 0))  //checks if estimated total is greater than current stocks
                                    {
                                        alert("Cannot exceed Current Stock!");
                                        item_does_not_exist = false; //item does exist
                                    }
                                    else
                                    {
                                        item_does_not_exist = false; //item does exist
                                        new_qty = parseFloat(itemQuantity) + qty_old; //adds old qty with current qty in cart

                                        $(this).text(new_qty);
                                            var oldPrice =  $(this).attr('price');
                                            var newPrice = $(this).attr('price') * new_qty;

                                            var subtractOldamount = qty_old *oldPrice;
                                            CurrentTotal = (CurrentTotal - subtractOldamount);
                                            
                                        
                                            CurrentTotal = CurrentTotal+ newPrice;
                                            Calculated_Vat = (CurrentTotal / 1.12) * 0.12;
                                            Grand_Total = CurrentTotal + Calculated_Vat

                                        
                                        vat_total.value  = "₱ "+ Calculated_Vat.toFixed(2);
                                        subtotal.value = "₱ "+  CurrentTotal.toFixed(2) ;
                                        payment.value = "₱ "+  Grand_Total.toFixed(2) ;
                                        var current_max;
                                        $("."+buttonValue).each(function() {
                                            cellText = parseInt($(this).html());                                             
                                            $(this).text(cellText - itemQuantity);
                                            current_max =  $(this).text(cellText - itemQuantity);
                                        }); //Subtracts the added item count in the cart 

                                        $("#quantity"+buttonValue).attr({
                                            "max": current_max.text() 
                                        }); 
                                    }      
                                    console.log("Old Amount = "+subtractOldamount);                                   
                                    console.log("Old Price = "+oldPrice);
                                    console.log("Current Total = "+CurrentTotal);
                            }
                        });
                        if(item_does_not_exist){

                            var price =row.find('td:nth-child(4)').text().replace("₱ ", ""); //Removes the peso sign to make it as INT rather than string
                            var valid= row.find('td:nth-child(4)');
                            var ParsePrice = parseFloat(price.replace(/\,/g,''), 10);

                            // count =  count +1+ parseFloat(price.replace(/\,/g,''), 10);
                            // count =  count+ parseFloat(price.replace(/\,/g,''), 10);
                            var totalPayment = (ParsePrice * itemQuantity);

                            CurrentTotal = CurrentTotal + totalPayment;

                            Calculated_Vat = (CurrentTotal / 1.12) * 0.12;
                            Grand_Total = CurrentTotal + Calculated_Vat

                            var newRow = document.getElementById('cart').insertRow();                       
                            newRow.innerHTML = "<tr> <td id = "+buttonValue +">" + currentName + "</td> <td>" + row.find('td:nth-child(2)').text() +" </td> <td>" + row.find('td:nth-child(4)').text() + "</td> <td class='qtys' price ='"+ParsePrice+"' val_id='"+buttonValue+"'> " + itemQuantity + " </td> <td> <button type='button' class='btn btn-danger' name ='remove' onclick= 'DeleteRow(this)' value ='"+totalPayment.toFixed(2)+"' > - </button></td>"
                             
                            // payment.value = "₱ "+ totalPayment;
                           
                            
                            vat_total.value  = "₱ "+ Calculated_Vat.toFixed(2);
                            subtotal.value = "₱ "+  CurrentTotal.toFixed(2) ;
                            payment.value = "₱ "+  Grand_Total.toFixed(2) ;
                            itemName++;
                            quantity++;

                            var current_max;
                             $("."+buttonValue).each(function() {
                                var cellText = parseInt($(this).html()); 
                                
                                $(this).text(cellText - itemQuantity);
                                current_max =  $(this).text(cellText - itemQuantity);
                            }); //Subtracts the added item count in the cart 

                            $("#quantity"+buttonValue).attr({
                                "max": current_max.text() 
                            });

                            console.log("Current Total = ");
                        } // END IF                                                 
                    }   // END ELSE    

            }) //END FUNCTION
             function DeleteRow(obj) 
               {
                
                        var buttonValue =obj.value;     
                        var paymentBox = document.getElementById("payment");

                            var td = event.target.parentNode; // event.target will be the input element.
                            var tr = td.parentNode; // the row to be removed
                   
                            var cartPrice = tr.cells[2].innerHTML.replace("₱ ", ""); //Gets Value of Cell in TR and Removes Peso Sign 
                            var cartQuantity = tr.cells[3].innerHTML;
                            var AmountToBeSubtracted = cartQuantity *  parseFloat(cartPrice.replace(/\,/g,''), 10);
                            console.log("Cart Price = " + cartPrice);
                            console.log("Cart Quantity = " + cartQuantity);
                            console.log("Total Amount = " + AmountToBeSubtracted);
                     
                        // var paymentValue = paymentBox.value.replace("₱ ", "");
                        
                        console.log("button value = "+buttonValue);
                        console.log("Total Payment Value = "+CurrentTotal);
                        CurrentTotal = (CurrentTotal.toFixed(2) - AmountToBeSubtracted.toFixed(2)); //Limits the Decimal points to 2
                        paymentBox.value = "₱ " + CurrentTotal.toFixed(2);

                        var current_max;
                        $("."+tr.cells[0].id).each(function() {
                            cellText = parseInt($(this).html()); 
                           
                                $(this).text(cellText + parseInt(cartQuantity));
                            current_max =  $(this).text(cellText + parseInt(cartQuantity));
                        }); //Adds the item count back to the stock

                        $("#quantity"+tr.cells[0].id).attr({
                            "max": current_max.text() 
                        });       
                        
                         tr.parentNode.removeChild(tr); 

                                 
                }                    
            </script>         
            <script>
                function destroyTable()
                {
                    var table = document.getElementById("cart");      //Deletes All Rows of Table except Header before Inserting new Rows   
                    for(var i = table.rows.length - 1; i > 0; i--)
                    {     
                        table.deleteRow(i);
                    } //END FOR
                }           
            </script>
            <script>
            function getValue(obj) 
            {
                var status = obj.value;
                var strLink = "CreateJobOrderFab.php?order_id=<?php echo $CurrentOR?> & delivery_status =" + status;
                document.getElementById("nextpage").setAttribute("href",strLink);

              
            }
        </script>
        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
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
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>


        
        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>
        <!-- bootstrap-datetimepicker -->
        <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

        <script>
            $('#myDatepicker').datetimepicker();

            $('#myDatepicker2').datetimepicker({
                format: 'YYYY-MM-DD HH:MM:SS'
            });

            $('#myDatepicker3').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $('#myDatepicker4').datetimepicker({
                ignoreReadonly: true,
                allowInputToggle: true
            });

            $('#datetimepicker6').datetimepicker();

            $('#datetimepicker7').datetimepicker({
                useCurrent: false
            });

            $("#datetimepicker6").on("dp.change", function(e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });

            $("#datetimepicker7").on("dp.change", function(e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });
        </script>
        
        <script>
            var divdel = document.getElementById("ifYes");
            var yesbutton = document.getElementById("Yesbutton");
            var nobutton = document.getElementById("Nobutton");

            var yesbuttonfab = document.getElementById("YesbuttonFab");
            var nobuttonfab = document.getElementById("NobuttonFab");

            var submitbtn = document.getElementById("send");
            var nextbtn = document.getElementById("fabricationpage");

            var pickup = "PickUp";
            var delivery = "Deliver";

            var deltype = "Deliver";
            var fabtype = "No Fabrication";

            function toggleDeliveryDate()
            {

                deltype = "PickUp";

                console.log(deltype);
                divdel.style.display = "none";
                yesbutton.style.display = "none";
                nobutton.style.display = "block";

                request = $.ajax({
                    url: "ajax/setpickup.php",
                    type: "POST",
                    data: {deltype: deltype}, //{Variable name, variable value}
                    success: function(data, textStatus) 
                    { //To test data
                        
                    }
                   
                });

            }

            function toggleDeliveryDate1()
            {
                divdel.style.display = "block";
                yesbutton.style.display = "block";
                nobutton.style.display = "none";

                deltype = "Deliver";

                console.log(deltype);

                request = $.ajax({
                    url: "ajax/setpickup.php",
                    type: "POST",
                    data: {deltype: deltype},
                    success: function(data, textStatus) {
                    $(".result").html(data); 
                    console.log("success");   
                    }
                   
                });

            }

            function toggleFabrication()
            {
                submitbtn.disabled = false;
                nextbtn.disabled = true;
                yesbuttonfab.style.display = "none";
                nobuttonfab.style.display = "block";

                fabtype = "No Fabrication";

                console.log(fabtype);

                request = $.ajax({
                    url: "ajax/setfabrication.php",
                    type: "POST",
                    data: {fabtype: fabtype},
                    success: function(data, textStatus) {
                    $(".result").html(data); 

                    }
                   
                });
            }
            function toggleFabrication1()
            {
                
                submitbtn.disabled = true;
                nextbtn.disabled = false;
                yesbuttonfab.style.display = "block";
                nobuttonfab.style.display = "none";

                fabtype = "For Fabrication";

                console.log(fabtype);

                request = $.ajax({
                    url: "ajax/setfabrication.php",
                    type: "POST",
                    data: {fabtype: fabtype},
                    success: function(data, textStatus) {
                    $(".result").html(data);    
                    }
                  
                }); //end ajax 
            } //end success

            
        </script>

<script text/javascript> 
function doAction()
{
    nextpageNOFabrication();   
}
function checkCart()
{
    $(document).ready(function() 
    {
        if($('#cart tr').length == 2) 
        {
            alert("WARNING: No Item(s) in Cart!"); 
            console.log("Table Length = " +$('#cart').length );
            $('#finalizeOrder').modal('toggle'); //Toggles the Modal to prevent No item in Cart [FOR NOW]
            
        }
        else
        {
            // alert("OK!"); 
            console.log("TR Length = " +$('#cart tr').length );
        }
    });
}
var getCartQuantity = []; //Get this

function nextpageWithFabrication() //Gets all necessary values from current page to give to next Page
{
    var expected_date =  document.getElementById("expectedDate").value;
    var payment_id =  document.getElementById("paymentID").value;
    var client_id = document.getElementById("clientID").value;
    var total_amount = document.getElementById("payment").value;
    var CurrentOrderDate = new Date().toJSON().slice(0,10);

        if(confirm("Submit Order?")) //ALert IS Showing
        {
            $('#cart tr td:nth-child(4)').each(function (e) 
            {
                if($(this).length==null) //WIP : Alert not Showing WTF?
                {
                    alert("No Orders in Cart!");
                }
                else
                {                                                        
                    var getValue = parseInt($(this).text());
                    getCartQuantity.push(getValue);
                  
                    var FILTERED_ID = [];
                    for(var i = 0; i < item_id_in_cart.length; i++){
                        if(FILTERED_ID.indexOf(item_id_in_cart[i]) == -1){ //Filters dups
                            FILTERED_ID.push(item_id_in_cart[i]);
                        }
                    }           
                                 

                    window.location.href = "CreateJobOrderFab.php?order_id=<?php echo $CurrentOR?>&deliver_date="+ expected_date +"&pay_id="+ payment_id +"&client_id="+ client_id +"&cart_item_id="+ FILTERED_ID +"&cart_qty_per_item="+ getCartQuantity +"&total_amount="+ total_amount +"&order_date="+ CurrentOrderDate +"  ";  
                    var days = localStorage.setItem("settotal", total_amount); //Stores total value to get in next page                                    
                                            
                }                                       
            });
        }    
} //END Function
function nextpageNOFabrication()
{                                                                                               
    if(confirm("Submit Order?"))
    {
        getAjax();
        alert("Order Successful!")  
        // window.location.href = "ViewOrders.php";   
         
        
    }
    else
    {
        header('Location: newOrderForm.php');
    } 
   
}

</script>
<script>
 function getAjax()
     {
        var GET_CART_QTY=[];
        $('#cart tr td:nth-child(4)').each(function (e) 
        {
            var getValue =parseInt($(this).text());
            console.log(getValue);
            GET_CART_QTY.push(getValue);
        }) //ENd jquery
        
        request = $.ajax({
        url: "ajax/JSV_Getter.php",
        type: "POST",
        data: {post_item_id: item_id_in_cart,
            post_item_qty: GET_CART_QTY
        },
        success: function(data, textStatus)
        {
          
        }//End Scucess
        
            }); // End ajax    
     } //End function
       
</script>

<script>

    var paidoption = document.getElementById("paidoption");
    var unpaidoption = document.getElementById("unpaidoption");
    var paymentinput = document.getElementById("payment_status");


    function changebuttoncolor()
    {
        if((paymentinput.classList.contains('btn','btn-default','dropdown-toggle') || (paymentinput.classList.contains('btn','btn-warning','dropdown-toggle'))) && paymentinput.value == "Paid")
        {
            paymentinput.classList.remove('btn','btn-default','dropdown-toggle');
            paymentinput.classList.remove('btn','btn-warning','dropdown-toggle');
            paymentinput.classList.add('btn','btn-success','dropdown-toggle');

            payment_type = "Paid";

            console.log(payment_type);

            request = $.ajax({
                url: "ajax/setpaymentstatus.php",
                type: "POST",
                data: {post_payment_type: payment_type},
                success: function(data, textStatus) 
                {
                    console.log(data);
                }

            });
            
            loanpayment.disabled = true;
            loanpayment.value = "";
            $('#loanpayment').attr('placeholder','0.00');
            // paymentinput.classList.remove("btn.btn-default.dropdown-toggle");
            // paymentinput.classList.remove("btn.btn-warning.dropdown-toggle");
            // paymentinput.classList.add("btn.btn-success.dropdown-toggle");
        }
        else if((paymentinput.classList.contains('btn','btn-default','dropdown-toggle') || (paymentinput.classList.contains('btn','btn-success','dropdown-toggle'))) && paymentinput.value == "Unpaid")
        {
            paymentinput.classList.remove('btn','btn-default','dropdown-toggle');
            paymentinput.classList.remove('btn','btn-success','dropdown-toggle');
            paymentinput.classList.add('btn','btn-warning','dropdown-toggle');

            payment_type = "Unpaid";

            console.log(payment_type);

            request = $.ajax({
                url: "ajax/setpaymentstatus.php",
                type: "POST",
                data: {post_payment_type: payment_type},
                success: function(data, textStatus) 
                {
                    console.log(data);
                }
            
            });
            loanpayment.disabled = false;
            var format_val = $('#payment').val().replace("₱ ", "");
            var loanmax = format_val * 0.3;
            $('#loanpayment').attr('max',loanmax.toFixed(2));
            $('#loanpayment').attr('placeholder',loanmax.toFixed(2)); //Max loan amount = 30% of Current Total
            // paymentinput.classList.remove('btn btn-default dropdown-toggle');
            // paymentinput.classList.remove('btn btn-success dropdown-toggle');
            // paymentinput.classList.add('btn btn-warning dropdown-toggle');
        }
        else 
        {
            paymentinput.classList.remove('btn','btn-warning','dropdown-toggle');
            paymentinput.classList.remove('btn','btn-success','dropdown-toggle');
            paymentinput.classList.add('btn','btn-default','dropdown-toggle');

            loanpayment.disabled = true;
            loanpayment.value = "";
            $('#loanpayment').attr('placeholder','0.00');
        }
    }
</script>
<script>
    var loanpayment = document.getElementById("loanpayment");
    var paymentID = document.getElementById("paymentID");

    // $('#paymentID').on('change',function(e)
    // {    
    //     if(paymentID.value == "1")
    //     {
    //         loanpayment.disabled = "true";
    //     }
    //     else if(paymentID.value == "2")
    //     {
    //         loanpayment.disabled = "true";
    //     }
    //     else if(paymentID.value == "3")
    //     {
    //         loanpayment.disabled = "false";
    //     }
    // })

    function setLoanDown()
    {
        var paymentinput = document.getElementById("payment_status");
        if(paymentID.value == "1")
        {
            loanpayment.disabled = true;
            loanpayment.value = "";
            $('#loanpayment').attr('placeholder','0.00');
            paymentinput.classList.remove('btn','btn-warning','dropdown-toggle');           
            paymentinput.classList.add('btn','btn-default','dropdown-toggle');
            $('#payment_status').val("");
        }
        else if(paymentID.value == "2")
        {
            loanpayment.disabled = false;
            console.log($('#payment').val());
            var format_val = $('#payment').val().replace("₱ ", "");
            var loanmax = format_val * 0.3;
            $('#loanpayment').attr('max',loanmax.toFixed(2));
            $('#loanpayment').attr('placeholder',loanmax.toFixed(2)); //Max loan amount = 30% of Current Total

            paymentinput.classList.add('btn','btn-danger','dropdown-toggle');
            // $('#payment_status').val("Unpaid");

        }
        else if(paymentID.value == "3")
        {
            loanpayment.disabled = true;
            loanpayment.value = "";
            $('#loanpayment').attr('placeholder','0.00');
            paymentinput.classList.remove('btn','btn-warning','dropdown-toggle');         
            paymentinput.classList.add('btn','btn-default','dropdown-toggle');
            $('#payment_status').val("");
            
        }
        // Not sure what to to with this, paki check nalang mamats.
    }
</script>

<!-- Style for page title -->
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

<script>

    $('#send').on('click',function(e){
        if (!$('#loanpayment').val() && ($('#paymentID').val()=="2" || $('#payment_status').val() == "Unpaid")) 
        {
            return alert('Please fill in all required fields.');
        }
        var GET_CART_QTY=[];
        $('#cart tr td:nth-child(4)').each(function (e) 
        {
            var getValue =parseInt($(this).text());
            console.log(getValue);
            GET_CART_QTY.push(getValue);
        }) //ENd jquery

        var FILTERED_ID = [];
        for(var i = 0; i < item_id_in_cart.length; i++){
            if(FILTERED_ID.indexOf(item_id_in_cart[i]) == -1){ //Filters dups
                FILTERED_ID.push(item_id_in_cart[i]);
            }
        }  
        if(confirm("Submit Current Orders?"))
        {
            request = $.ajax({
                url: "ajax/orders_process.php",
                type: "POST",
                data: {post_current_or: "<?php echo $CurrentOR; ?>",
                    post_client_id: $('#clientID').val(),
                    post_payment_id: $('#paymentID').val(),
                    post_cart_total: $('#payment').val(),
                    post_expected_date: $('#expectedDate').val(),
                    post_payment_status: $('#payment_status').val(),
                    post_downpayment:  $('#loanpayment').val(),
                    post_cart_item_id: FILTERED_ID,
                    post_cart_item_qty: GET_CART_QTY
                },
                success: function(data, textStatus)
                {
                    alert("Order Successful!")  
                    window.location.href = "ViewOrders.php";   
                }//End Scucess
            
            }); // End ajax    
        }
        else
        {
            alert("Action: Cancelled");
        }
        

    })
                            
</script> 

    </body>
</html>
