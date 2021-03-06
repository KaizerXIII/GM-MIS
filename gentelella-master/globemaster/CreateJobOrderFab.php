<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>GM - Job Order Fabrication  </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md" onload="LoadCurrentTotal()";>
    <div class="container body">
      <div class="main_container">
            <!-- sidebar menu -->
            <?php
                require_once("nav.php");    
            ?>
            <!-- /sidebar menu -->
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <?php
                    if(isset($_GET['order_id']))
                    {
                   
                     $_SESSION['getORNumber'] = $_GET['order_id']; //Stores the Value of Get from Order Form
                    }
                  ?>
                <h1>Create a Job Order for Fabrication - [<?php echo $_SESSION['getORNumber'];?>]</h1><br>
                        <b>
                        <div style = "display:none">
                          <?php
                           
                           $currentStatus = $_SESSION['DeliveryStatus'];
                           $fabricationStatus = $_SESSION['FabricationStatus'];
                           $payment_status_from_orders = $_SESSION['payment_status']; 
                          
                           echo $currentStatus,"<br>";
                           echo $fabricationStatus,"<br>";
                          
                           
                            if(isset($_GET['order_id']))
                            {
                             
                               $_SESSION['getORNumber'] = $_GET['order_id']; //Stores the Value of Get from Order Form
                               echo $_SESSION['getORNumber'],"<br>"; 

                               $_SESSION['getDeliveryDate'] = $_GET['deliver_date']; //Get the Deliv Date
                                  $DELDATE = $_SESSION['getDeliveryDate'];
                                    $TIME1 = strtotime($DELDATE);
                                    $NEW_TIME_FORMAT1 = date('D, M d, Y',$TIME1);
                                    echo $NEW_TIME_FORMAT1;

                               echo"Deliver Date = ", $_SESSION['getDeliveryDate'],"<br>"; 

                               $_SESSION['client_id'] = $_GET['client_id']; //Get Client ID
                               echo "Client ID = ",$_SESSION['client_id'],"<br>"; 

                               $_SESSION['item_id'] = $_GET['cart_item_id']; //Get Item ID
                               echo"Item ID = ", $_SESSION['item_id'],"<br>"; 
                               
                               $ITEM = $_SESSION['item_id'];
                               $EXPLODED_ITEM = explode(",", $ITEM);
                               echo"Exploded Item ID = ",$EXPLODED_ITEM[0],"<br>"; //Explodes String from $_GET to be converted to usable array


                               $_SESSION['total'] = $_GET['total_amount']; //Get Total Amount
                               echo"Total From Order = ", $_SESSION['total'],"<br>"; 

                               $_SESSION['item_qty'] = $_GET['cart_qty_per_item']; //Get qty per item
                               echo"Item Quantity = ", $_SESSION['item_qty'],"<br>"; 

                               $_SESSION['order_date'] = $_GET['order_date']; //Get qty per item
                               echo"Order Date = ", $_SESSION['order_date'],"<br>"; 

                               $_SESSION['payment_id'] = $_GET['pay_id'];
                               echo"Payment ID = ", $_SESSION['payment_id'],"<br>"; // Get Pay Id, remove all Echo once Finalized

                               $_SESSION['loan_amt'] = $_GET['loan'];
                               echo"Loan AMT = ", $_SESSION['loan_amt'],"<br>"; // Get loan

                               $_SESSION['vat_total'] = $_GET['vat_amt'];
                               echo"Loan AMT = ", $_SESSION['vat_total'],"<br>"; // Get VAT
                               
                          ?>


                          <?php  
                            }
                            else
                            {
  
                               echo $_SESSION['getORNumber']; 
                                
                            }
                           
                          ?>
                          </div>
                        </b>
                      </h3>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <!-- enctype="multipart/form-data" : required inside tag to upload correctly -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
<!-- NEW FABRICATION DETAILS DESIGN -->
<div class="col-md-6 col-sm-6 col-xs-12" >
    <div class="x_panel" >

        <center><font color = "#2a5eb2"><h3>Order Details </h1>
        
        </h3></font></center>
        <div class="ln_solid"></div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Client Name</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
<?php
  $queryGetCustomerName = "SELECT * FROM clients
  WHERE client_id  = ".$_SESSION['client_id']."";
  $resultGetCustomerName = mysqli_query($dbc,$queryGetCustomerName);
  $rowGetCustomerName = mysqli_fetch_array($resultGetCustomerName,MYSQLI_ASSOC);
?>
                <input type="text" id = "item_count" class="form-control" readonly="readonly" value = "<?php echo $rowGetCustomerName['client_name'];?>">
            </div>
        </div>
<!-- INSERT IF HERE -->
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Current Order Status</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name = "pangalan" type="text" id = "item_name" class="form-control" readonly="readonly" value = "<?php echo $currentStatus;?>">
            </div>
        </div>
        <!-- Show only when order status is for delivery -->
        <div class="form-group" style = "display:block">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Delivery Date</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name = "pangalan" type="text" id = "item_name" class="form-control" readonly="readonly" 
                value = "<?php 
                echo $NEW_TIME_FORMAT1;
                ?>">
            </div>
        </div>
        <!-- meh -->
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Current Fabrication Status</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id = "item_tyoe" class="form-control" readonly="readonly" value = "<?php echo $fabricationStatus;?>">
            </div>
        </div>
<?php
  $queryGetPaymentType = "SELECT * FROM ref_payment
  WHERE payment_id  = ".$_SESSION['payment_id']."";
  $resultGetPaymentType = mysqli_query($dbc,$queryGetPaymentType);
  $rowGetPaymentType = mysqli_fetch_array($resultGetPaymentType,MYSQLI_ASSOC);
?>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Type</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id = "supplier_name" class="form-control" readonly="readonly" value = "<?php echo $rowGetPaymentType['paymenttype'];?>">
            </div>
        </div>
        <div class="form-group">         
            <label class="control-label col-md-3 col-sm-3 col-xs-12">VAT Amount</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id = "vat_amt" class="form-control" readonly="readonly" style="text-align:right" value = "<?php echo $_SESSION['vat_total'];?>">
            </div>
        </div>
        <div class="form-group">         
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Loan Downpayment</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id = "vat_amt" class="form-control" readonly="readonly" style="text-align:right" value = "₱ 300.00">
            </div>
        </div>
        <div class="form-group">         
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Tendered Amount</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id = "item_price" class="form-control" readonly="readonly" style="text-align:right" value = "<?php echo $_SESSION['total'];?>">
            </div>
        </div>
        
    </div> <!--END XPanel-->
</div> <!--END Class Colmd-->
<div class="col-md-6 col-sm-6 col-xs-12" >

<div class="x_panel">

  <center><h3><font color = "black">Items Ordered for This Transaction</font>
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
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                    
                    </tr>
                </thead>
<?php
    for($i = 0; $i < sizeof($EXPLODED_ITEM); $i++)
    {
      $queryGetItemsOrdered = "SELECT * FROM items_trading
      WHERE item_id = ".$EXPLODED_ITEM[$i]."";
      $resultGetItemsOrdered = mysqli_query($dbc,$queryGetItemsOrdered);
      $rowGetItemsOrdered = mysqli_fetch_array($resultGetItemsOrdered,MYSQLI_ASSOC);
      $ITEMSORDERED =  $rowGetItemsOrdered['item_name'];
      $ITEMSQUANTITY = $_SESSION['item_qty'];
      $ITEMSQUANTITY1 = explode(",", $ITEMSQUANTITY);
?>
                    <tbody>
                      <tr>
                      <td><?php echo $ITEMSORDERED;?></td>
                      <td><?php echo $ITEMSQUANTITY1[$i];?></td>
                      <td>₱ <?php echo $rowGetItemsOrdered['price'];?></td>
                      <td>₱ <?php echo number_format((float)($rowGetItemsOrdered['price'] * $ITEMSQUANTITY1[$i]),2,'.','');?></td>
                      </tr>                                                         
                    </tbody>
<?php
    }
?>
            </table>
        </div> <!--END Xcontent-->
      </div><!--END Col MD-->
    </div><!--END Class-row -->
  </div><!--END XPanel-->
</div><!--ENDCol MD-->

<div class = "clearfix"></div>
        <div class="ln_solid"></div>
        <center><h3>Fabrication Order Details
        </h3></center>
<div class="ln_solid"></div>
                <div>
                      <div class="form-group">
                        <label class="control-label col-md-5 col-sm-5 col-xs-12">Enter Description <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                         <textarea id="message" required="required" class="form-control" name="item_description" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Please enter at least a description of 20 characters"
                            data-parsley-validation-threshold="10"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-5 col-sm-5 col-xs-12">Enter Fabrication Cost: ₱<span class="required">*</span>
                        </label>
                         <div class="col-md-3 col-sm-3 col-xs-12">
                          <input style="text-align:right" readonly="readonly" type="number" id = "fab_cost" name="fab_cost"  required="required" class="form-control col-md-7 col-xs-12" step="any" min="0" max ="99999.99" oninput="validate(this)">
                        </div>
                      </div>
                      <br>
                      <div class="form-group" style = "display:none" id ="installDiv">
                        <label class="control-label col-md-5 col-sm-5 col-xs-12">For Installation?<span class="required">*</span>
                        </label>
                         <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="checkbox" name="installation" required="required" id = "installbutton" value = "With Installation">
                         
                        </div>
                      </div>
                      <br>
                      <div class="form-group">
                        <label class="control-label col-md-5 col-sm-5 col-xs-12">Upload Reference Drawing <span class="required">*</span>
                        </label>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <input type="file" accept="image/x-png,image/jpeg" name="file_reference" id="fileToUpload" required="required">
                            <br>
                            <p>Please choose a file no more than 25MB in size.
                            <p><font color = "red">File types are limited to (.jpg, .png).</font></p>
                        </div>
                      </div>  
                      <br><br>

                      <div class="form-group" >
                        <label class="control-label col-md-5 col-sm-5 col-xs-12">Total Amount: ₱<span class="required">*</span>
                        </label>
                         <div class="col-md-3 col-sm-3 col-xs-12">
                          <input style="text-align:right" type="number" name="total_amount"  id = "total_amount" required="required" readonly="readonly" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                </div>
                  <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12" align = "right">
                          <button name="createBtn" class="btn btn-success" type="submit" class="btn btn-success" onclick ="removerequired()">Create</button>
                          <!-- <button class="btn btn-round btn-primary" type="button" onclick ="testScript()">Test Function</button> -->
                        </div>
                      </div>

                      <?php      
                      if(isset($_POST['createBtn']))
                      {
                         //<--------------------------------------------------------[ UPLOADED FILE Checker ]----------------------------------------------------->
                         if(isset($_FILES['file_reference']))
                          {                          
                            echo "Upload: " . $_FILES['file_reference']['name'] . "<br>";
                            echo "Type: " . $_FILES['file_reference']['type'] . "<br>";
                            echo "Size: " . ($_FILES['file_reference']['size'] / 1024) . " kB<br>";
                            echo "Stored in: " . $_FILES['file_reference']['tmp_name'];

                            $filename = $_FILES['file_reference']['name'];
                            $filetype = $_FILES['file_reference']['type'];
                            $filesize = $_FILES['file_reference']['size'];

                            $allowed = array("JPG" => "image/JPG", "jpg" => "image/jpg", "jpeg" => "image/jpeg", "JPEG" => "image/JPEG", "png" => "image/png", "PNG" => "image/PNG",); //Checks the File type extension 
                            
                            $ext = pathinfo($filename, PATHINFO_EXTENSION);

                            if(!array_key_exists($ext, $allowed))
                            {
                              die("Error: Please select a valid file format.");
                            }

                            $maxsize = 10 * 1024 * 1024;
                            if($filesize > $maxsize)
                            {
                              die("Error: File size is larger than the allowed limit."); //10 MB max 
                            } 

                          }//END IF ISSET FILE REFERENCE
                          else
                          {
                            echo "CANT DETECT FILE";
                          }                                                   
                        //<--------------------------------------------------------[ UPLOADED FILE Checker ]----------------------------------------------------->
                        if($currentStatus == "Deliver") //Insert to DB IF Deliver
                        {
                          $OR_NUM = $_SESSION['getORNumber'];
                          $CLIENT_ID = $_SESSION['client_id'];
                          $ORDER_DATE = $_SESSION['order_date'];
                          $EXPECTED_DATE = $_SESSION['getDeliveryDate'];
                          $PAYMENT_ID = $_SESSION['payment_id'];

                          $LOAN_AMOUNT = $_SESSION['loan_amt'];
                          // $TOTAL_AMOUNT = $_SESSION['total'];
                          $TOTAL_AMOUNT = $_POST['total_amount'];
                          $SANITIZED_TOTAL = filter_var($TOTAL_AMOUNT,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION); //Removes Peso Sign

                          $ORDER_STATUS = $currentStatus;
                          $FAB_STATUS = $fabricationStatus;
                          $PAYMENT_STATUS =  $payment_status_from_orders;
                          if(!empty($_POST['installation']))
                          {
                            $INSTALLATION_STATUS = $_POST['installation'];
                          }
                          else
                          {
                            $INSTALLATION_STATUS = "No Installation";
                          }
                          $sqlToInsertToORDERS = "INSERT INTO orders(ordernumber, client_id, order_date, expected_date, payment_id, totalamt, order_status,installation_status, fab_status, payment_status)
                          VALUES(
                            '$OR_NUM',
                            '$CLIENT_ID',
                            '$ORDER_DATE',
                            '$EXPECTED_DATE',
                            '$PAYMENT_ID',
                            '$SANITIZED_TOTAL',
                            '$ORDER_STATUS',
                            '$INSTALLATION_STATUS',
                            '$FAB_STATUS',
                            '$PAYMENT_STATUS');";
                           $resultToInsertORDERS = mysqli_query($dbc,$sqlToInsertToORDERS);//Isnerts to Orders

                          if(!$resultToInsertORDERS) //Chceker
                            {
                                die('Error: ' . mysqli_error($dbc));
                            } 
                            else 
                            {                            
                                echo '<script language="javascript">';
                                echo 'alert("1st Insert Successful!");';
                                echo '</script>';                            
                            }
                          if($PAYMENT_STATUS == "Unpaid") // Adds Unpaid amount to Client Tabol
                          {
                            $SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE = "UPDATE clients
                            SET clients.total_unpaid  = (total_unpaid + '$SANITIZED_TOTAL')
                            WHERE client_id ='$CLIENT_ID';";
                              $RESULT_UNPAID_TOTAL=mysqli_query($dbc,$SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE);
                              if(!$RESULT_UNPAID_TOTAL) 
                              {
                                  die('Error: ' . mysqli_error($dbc));
                              } 
                              else 
                              {
                                  echo '<script language="javascript">';
                                  echo 'alert("Added Unpaid Amount to Client");';
                                  echo '</script>';
                                 
                              }
                              $SQL_INSERT_TO_UNPAID_TABLE = "INSERT INTO unpaid_clients(clientID, ordernumber, init_unpaid, totalunpaid) 
                              VALUES('$CLIENT_ID', '$OR_NUM', '$SANITIZED_TOTAL','$SANITIZED_TOTAL');"; 
                              $RESULT_INSERT_TO_UNPAID_TABLE=mysqli_query($dbc,$SQL_INSERT_TO_UNPAID_TABLE); //Inserts to UNPAID Client Table for reference
                              
                              if(!$RESULT_INSERT_TO_UNPAID_TABLE) 
                              {
                                  die('Error: ' . mysqli_error($dbc));
                                  echo "Error in Insert Unpaid";
                              } 
                              else 
                              {
                                  $GET_UNPAID_TABLE = "SELECT * FROM unpaid_clients WHERE ordernumber ='$OR_NUM'";
                                  $RESULT_GET_UNPAID_TABLE=mysqli_query($dbc,$GET_UNPAID_TABLE);
                                  $ROW_RESULT_GET_UNPAID_TABLE = mysqli_fetch_assoc($RESULT_GET_UNPAID_TABLE); 
                                  
                                  $UNPAID_ID = $ROW_RESULT_GET_UNPAID_TABLE['unpaidID'];
                                  
                                  $INSERT_TO_AUDIT="INSERT INTO unpaidaudit(unpaidID, payment_amount, payment_date)
                                  VALUES('$UNPAID_ID','$LOAN_AMOUNT', now())";
                                  $RESULT_INSERT_TO_AUDIT=mysqli_query($dbc,$INSERT_TO_AUDIT); 
                              }          
                          }//END IF             

                         $ITEM_ID = $_SESSION['item_id'];
                         $EXPLODED_ITEM_ID = explode(",", $ITEM_ID);

                         $ITEM_QTY = $_SESSION['item_qty'];
                         $EXPLODED_ITEM_QTY = explode(",", $ITEM_QTY);

                         $ITEM_NAME = array();
                         $ITEM_PRICE = array(); 

                            for($i = 0; $i < sizeof($EXPLODED_ITEM_ID) ; $i++)
                            {
                              $sqlSelect ="SELECT * FROM items_trading WHERE item_id = $EXPLODED_ITEM_ID[$i];";
                              $resultOfSelect = mysqli_query($dbc,$sqlSelect);
                              while($rowOfSelect=mysqli_fetch_array($resultOfSelect,MYSQLI_ASSOC))
                              {
                                $ITEM_NAME[] = $rowOfSelect['item_name'];
                                $ITEM_PRICE[] = $rowOfSelect['price']; 
                              }
                            //Insert to Order Details
                              $sqlToInsertToOrderDetail = "INSERT INTO order_details(ordernumber, client_id, item_id, item_name, item_price, item_qty, item_status) 
                              VALUES(
                                '$OR_NUM',
                                '$CLIENT_ID',
                                '$EXPLODED_ITEM_ID[$i]',
                                '$ITEM_NAME[$i]',
                                '$ITEM_PRICE[$i]',
                                '$EXPLODED_ITEM_QTY[$i]',
                                '$ORDER_STATUS'
                                );";
                              $resultToInsertOrderDetail = mysqli_query($dbc,$sqlToInsertToOrderDetail);
                              if(!$resultToInsertOrderDetail) 
                              {
                                  die('Error: ' . mysqli_error($dbc));
                              } 
                              else 
                              {                            
                                  echo '<script language="javascript">';
                                  echo 'alert("2nd Insert Successful!");';
                                  echo '</script>';                            
                              } 
                              //Subtracts QTY in the inventory
                              $CHECK_ITEMS_INSIDE_WAREHOUSE = "SELECT * FROM items_trading"; //checks if there is any item inside warehouse
                              $RESULT_CHECK_ITEMS_INSIDE_WAREHOUSE = mysqli_query($dbc,$CHECK_ITEMS_INSIDE_WAREHOUSE);
                              $ROW_RESULT_CHECK_ITEMS_INSIDE_WAREHOUSE = mysqli_fetch_assoc($RESULT_CHECK_ITEMS_INSIDE_WAREHOUSE);

                              $NUMBER_OF_ITEMS_INSIDE = $ROW_RESULT_CHECK_ITEMS_INSIDE_WAREHOUSE['item_inside_warehouse'];

                              if($NUMBER_OF_ITEMS_INSIDE > 0)  //if there is 
                              {
                                $sqlToSubtractFromItemsTrading = "UPDATE items_trading
                                SET items_trading.item_count  = (item_count - '$EXPLODED_ITEM_QTY[$i]'),
                                item_inside_warehouse = (item_inside_warehouse - '$EXPLODED_ITEM_QTY[$i]' ),
                                last_update = Now() 
                                WHERE item_id ='$EXPLODED_ITEM_ID[$i]';";
                                $resultOfSubtract=mysqli_query($dbc,$sqlToSubtractFromItemsTrading); 
                                if(!$resultOfSubtract) 
                                {
                                    die('Error: ' . mysqli_error($dbc));
                                } 
                                else 
                                {
                                    echo '<script language="javascript">';
                                    echo 'alert("Subtract Successfull");';
                                    echo '</script>';
                                }
                              } 

                              else
                              {
                                $sqlToSubtractFromItemsTrading = "UPDATE items_trading
                                SET items_trading.item_count  = (item_count - '$EXPLODED_ITEM_QTY[$i]'),
                                item_outside_warehouse = (item_outside_warehouse - '$EXPLODED_ITEM_QTY[$i]' ),
                                last_update = Now() 
                                WHERE item_id ='$EXPLODED_ITEM_ID[$i]';";
                                $resultOfSubtract=mysqli_query($dbc,$sqlToSubtractFromItemsTrading); 
                                if(!$resultOfSubtract) 
                                {
                                    die('Error: ' . mysqli_error($dbc));
                                } 
                                else 
                                {
                                    echo '<script language="javascript">';
                                    echo 'alert("Subtract Successfull");';
                                    echo '</script>';
                                }
                              }
                            } //END FOR

                          $fab_text = htmlspecialchars($_POST['item_description']);  //Insert Job Order
                          $fab_price = $_POST['fab_cost'];
                          $fab_totalprice = $_POST['total_amount'];
                          $blob = addslashes(file_get_contents($_FILES['file_reference']['tmp_name']));
                          
                          $currentStatus = $_SESSION['DeliveryStatus'];

                          $sqlToInsertJOBFAB = "INSERT INTO joborderfabrication(fab_description,order_number, fab_price, fab_totalprice, reference_drawing)
                          VALUES('$fab_text','$OR_NUM','$fab_price', '$fab_totalprice', '$blob' );";
                          $resultToInsertJOBFAB = mysqli_query($dbc,$sqlToInsertJOBFAB);
                          if(!$resultToInsertJOBFAB) 
                          {
                              die('Error: ' . mysqli_error($dbc));
                          } 
                          else 
                          {                            
                              echo '<script language="javascript">';
                              echo 'alert("3rd Insert Successful!");';
                              echo '</script>';
                              header("Location: ViewOrders.php");                            
                          } 
                                                                                                               
                        } // END IF DELIVER
                        else //Insert to DB if PickUp
                        {
                          $OR_NUM = $_SESSION['getORNumber'];
                          $CLIENT_ID = $_SESSION['client_id'];
                          $ORDER_DATE = $_SESSION['order_date'];                          
                          $PAYMENT_ID = $_SESSION['payment_id'];

                          $LOAN_AMOUNT = $_SESSION['loan_amt'];

                          // $TOTAL_AMOUNT = $_SESSION['total'];
                          $TOTAL_AMOUNT = $_POST['total_amount'];
                          $SANITIZED_TOTAL = filter_var($TOTAL_AMOUNT,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION); //Removes Peso Sign

                          $ORDER_STATUS = $currentStatus;
                          $FAB_STATUS = $fabricationStatus;
                          $PAYMENT_STATUS =  $payment_status_from_orders;
                          $INSTALLATION_STATUS = "No Installation";
                          
                          $sqlToInsertToORDERS = "INSERT INTO orders(ordernumber, client_id, order_date, payment_id, totalamt, order_status,installation_status, fab_status, payment_status)
                          VALUES(
                            '$OR_NUM',
                            '$CLIENT_ID',
                            '$ORDER_DATE',                          
                            '$PAYMENT_ID',
                            '$SANITIZED_TOTAL',
                            '$ORDER_STATUS',
                            '$INSTALLATION_STATUS',
                            '$FAB_STATUS',
                            '$PAYMENT_STATUS');";
                           $resultToInsertORDERS = mysqli_query($dbc,$sqlToInsertToORDERS); //Insert To Orders

                          if(!$resultToInsertORDERS) //Chceker
                            {
                                die('Error: ' . mysqli_error($dbc));
                            } 
                            else 
                            {                            
                                echo '<script language="javascript">';
                                echo 'alert("1st Insert Successful!");';
                                echo '</script>';                            
                            }
                          if($PAYMENT_STATUS == "Unpaid") // Adds Unpaid amount to Client Tabol
                          {
                            $SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE = "UPDATE clients
                            SET clients.total_unpaid  = (total_unpaid + '$SANITIZED_TOTAL')
                            WHERE client_id ='$CLIENT_ID';";
                              $RESULT_UNPAID_TOTAL=mysqli_query($dbc,$SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE);
                              if(!$RESULT_UNPAID_TOTAL) 
                              {
                                  die('Error: ' . mysqli_error($dbc));
                              } 
                              else 
                              {
                                  echo '<script language="javascript">';
                                  echo 'alert("Added Unpaid Amount to Client");';
                                  echo '</script>';
                                 // header("Location: ViewOrders.php");
                              }                       
                              $SQL_INSERT_TO_UNPAID_TABLE = "INSERT INTO unpaid_clients(clientID, ordernumber, init_unpaid, totalunpaid) 
                              VALUES('$CLIENT_ID', '$OR_NUM', '$SANITIZED_TOTAL','$SANITIZED_TOTAL');"; 
                              $RESULT_INSERT_TO_UNPAID_TABLE=mysqli_query($dbc,$SQL_INSERT_TO_UNPAID_TABLE); //Inserts to UNPAID Client Table for reference
                              if(!$RESULT_INSERT_TO_UNPAID_TABLE) 
                                {
                                    die('Error: ' . mysqli_error($dbc));
                                    echo "Error in Insert Unpaid";
                                } 
                                else 
                                {
                                    $GET_UNPAID_TABLE = "SELECT * FROM unpaid_clients WHERE ordernumber ='$OR_NUM'";
                                    $RESULT_GET_UNPAID_TABLE=mysqli_query($dbc,$GET_UNPAID_TABLE);
                                    $ROW_RESULT_GET_UNPAID_TABLE = mysqli_fetch_assoc($RESULT_GET_UNPAID_TABLE); 
                                    
                                    $UNPAID_ID = $ROW_RESULT_GET_UNPAID_TABLE['unpaidID'];
                                    
                                    $INSERT_TO_AUDIT="INSERT INTO unpaidaudit(unpaidID, payment_amount, payment_date)
                                    VALUES('$UNPAID_ID','$LOAN_AMOUNT', now())";
                                    $RESULT_INSERT_TO_AUDIT=mysqli_query($dbc,$INSERT_TO_AUDIT); 
                                }                                   
                          }//END IF 

                         $ITEM_ID = $_SESSION['item_id'];
                         $EXPLODED_ITEM_ID = explode(",", $ITEM_ID);

                         $ITEM_QTY = $_SESSION['item_qty'];
                         $EXPLODED_ITEM_QTY = explode(",", $ITEM_QTY);

                         $ITEM_NAME = array();
                         $ITEM_PRICE = array(); 

                            for($i = 0; $i < sizeof($EXPLODED_ITEM_ID) ; $i++)
                            {
                              $sqlSelect ="SELECT * FROM items_trading WHERE item_id = $EXPLODED_ITEM_ID[$i];";
                              $resultOfSelect = mysqli_query($dbc,$sqlSelect);
                              while($rowOfSelect=mysqli_fetch_array($resultOfSelect,MYSQLI_ASSOC))
                              {
                                $ITEM_NAME[] = $rowOfSelect['item_name'];
                                $ITEM_PRICE[] = $rowOfSelect['price']; 
                              }
                            //Insert to Order Details
                              $sqlToInsertToOrderDetail = "INSERT INTO order_details(ordernumber, client_id, item_id, item_name, item_price, item_qty, item_status) 
                              VALUES(
                                '$OR_NUM',
                                '$CLIENT_ID',
                                '$EXPLODED_ITEM_ID[$i]',
                                '$ITEM_NAME[$i]',
                                '$ITEM_PRICE[$i]',
                                '$EXPLODED_ITEM_QTY[$i]',
                                '$ORDER_STATUS'
                                );";
                              $resultToInsertOrderDetail = mysqli_query($dbc,$sqlToInsertToOrderDetail);
                              if(!$resultToInsertOrderDetail) 
                              {
                                  die('Error: ' . mysqli_error($dbc));
                              } 
                              else 
                              {                            
                                  echo '<script language="javascript">';
                                  echo 'alert("2nd Insert Successful!");';
                                  echo '</script>';                            
                              } 
                              //Subtracts QTY in the inventory
                              $CHECK_ITEMS_INSIDE_WAREHOUSE = "SELECT * FROM items_trading"; //checks if there is any item inside warehouse
                              $RESULT_CHECK_ITEMS_INSIDE_WAREHOUSE = mysqli_query($dbc,$CHECK_ITEMS_INSIDE_WAREHOUSE);
                              $ROW_RESULT_CHECK_ITEMS_INSIDE_WAREHOUSE = mysqli_fetch_assoc($RESULT_CHECK_ITEMS_INSIDE_WAREHOUSE);

                              $NUMBER_OF_ITEMS_INSIDE = $ROW_RESULT_CHECK_ITEMS_INSIDE_WAREHOUSE['item_inside_warehouse'];

                              if($NUMBER_OF_ITEMS_INSIDE > 0)  //if there is 
                              {
                                $sqlToSubtractFromItemsTrading = "UPDATE items_trading
                                SET items_trading.item_count  = (item_count - '$EXPLODED_ITEM_QTY[$i]'),
                                item_inside_warehouse = (item_inside_warehouse - '$EXPLODED_ITEM_QTY[$i]' ),
                                last_update = Now() 
                                WHERE item_id ='$EXPLODED_ITEM_ID[$i]';";
                                $resultOfSubtract=mysqli_query($dbc,$sqlToSubtractFromItemsTrading); 
                                if(!$resultOfSubtract) 
                                {
                                    die('Error: ' . mysqli_error($dbc));
                                } 
                                else 
                                {
                                    echo '<script language="javascript">';
                                    echo 'alert("Subtract Successfull");';
                                    echo '</script>';
                                }
                              } 

                              else
                              {
                                $sqlToSubtractFromItemsTrading = "UPDATE items_trading
                                SET items_trading.item_count  = (item_count - '$EXPLODED_ITEM_QTY[$i]'),
                                item_outside_warehouse = (item_outside_warehouse - '$EXPLODED_ITEM_QTY[$i]' ),
                                last_update = Now() 
                                WHERE item_id ='$EXPLODED_ITEM_ID[$i]';";
                                $resultOfSubtract=mysqli_query($dbc,$sqlToSubtractFromItemsTrading); 
                                if(!$resultOfSubtract) 
                                {
                                    die('Error: ' . mysqli_error($dbc));
                                } 
                                else 
                                {
                                    echo '<script language="javascript">';
                                    echo 'alert("Subtract Successfull");';
                                    echo '</script>';
                                }
                              }
                              
                            } //END FOR

                          $fab_text = htmlspecialchars($_POST['item_description']);
                          $fab_price = $_POST['fab_cost'];
                          $fab_totalprice = $_POST['total_amount'];
                          $blob = addslashes(file_get_contents($_FILES['file_reference']['tmp_name']));

                          $currentStatus = $_SESSION['DeliveryStatus'];
                                              
                          $sqlToInsertJOBFAB = "INSERT INTO joborderfabrication(fab_description,order_number, fab_price, fab_totalprice, reference_drawing)
                          VALUES('$fab_text','$OR_NUM','$fab_price', '$fab_totalprice', '$blob' );";
                          $resultToInsertJOBFAB = mysqli_query($dbc,$sqlToInsertJOBFAB);
                          if(!$resultToInsertJOBFAB) 
                          {
                              die('Error: ' . mysqli_error($dbc));
                          } 
                          else 
                          {                            
                              echo '<script language="javascript">';
                              echo 'alert("Order Successful!");';                             
                              echo '</script>';               
                              header("Location: ViewOrders.php");             
                          }
                        }//END ELSE
                        
                      } //END IF ISSET POST BTN  
                      
                   
                      ?>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <script type="text/javascript">
      function validate(obj) {
          obj.value = valBetween(obj.value, obj.min, obj.max); //Gets the value of input alongside with min and max
          console.log(obj.value);
      }

      function valBetween(v, min, max) {
          return (Math.min(max, Math.max(min, v))); //compares the value between the min and max , returns the max when input value > max
      }
  </script> <!-- To avoid the users input more than the current Max per item -->

  <script>
  var installbtn = document.getElementById("installbutton");
    installbtn.required = true;
    function removerequired()
    {
      installbtn.required = false;
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
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <?php
      echo '<script>';
      echo 'var radioButton = document.getElementById("installDiv");';
      if($currentStatus == "Deliver")
      {
        echo 'radioButton.style.display = "block"';
      } 
      echo ' </script>'; //Unhides Installation Button when Order is Deliver
    ?>
    <script>
    function LoadCurrentTotal()
    {
      var fab_total = document.getElementById("total_amount");
      var getTotal = localStorage.getItem("settotal").replace("₱ ", "");

      var f_cost = parseFloat($('#item_price').val().replace("₱ ", "")) * 0.1;
      $('#fab_cost').val(f_cost.toFixed(2));

      console.log(parseFloat(getTotal));
      var total = parseFloat(getTotal) + f_cost;
      // fab_total.innerHTML = parseFloat(getTotal);
      fab_total.value = total.toFixed(2);
      
    }     
    </script>

    <script>
   
    $("#fab_cost").change(function()
    {
    
      var $this = $(this);
      $this.val(parseFloat($this.val()).toFixed(2));
        
    }); //Sets the Decimal

    var fab_cost = document.getElementById("fab_cost");
    var fab_total = document.getElementById("total_amount");

   
    
    fab_cost.onkeyup = function()
    {
        var getTotal = localStorage.getItem("settotal").replace("₱ ", "");
        parseFloat(getTotal);
        var inputValue = fab_cost.value;

        console.log(getTotal);
        console.log(inputValue);        
        var currentTotal = parseFloat(getTotal) + parseFloat(inputValue) ;        
        console.log(currentTotal);

        fab_total.innerHTML = currentTotal.toFixed(2);
        fab_total.value = currentTotal.toFixed(2);
    }

   </script>

   <script>
    function testScript()
    {
      var CurrentOrderDate = new Date().toJSON().slice(0,10);
      console.log(CurrentOrderDate);
    }
   </script>
  </body>
</html>
