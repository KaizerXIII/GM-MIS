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
                <h1>Create Job Order for Fabrication</h1><br>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h3>
                        <b>
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

                               
                               
                            }
                            else
                            {
  
                               echo $_SESSION['getORNumber']; 
                                
                            }
                           
                          ?>
                        </b>
                      </h3>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <!-- enctype="multipart/form-data" : required inside tag to upload correctly -->
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">

                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Enter Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea id="message" required="required" class="form-control" name="item_description" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                          <br/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Enter Fabrication Cost: ₱<span class="required">*</span>
                        </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id = "fab_cost" name="fab_cost"  required="required" class="form-control col-md-7 col-xs-12" step=".01" min="0" max ="99999.99" oninput="validate(this)">
                        </div>
                      </div>
                      <br><br>

                      <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Amount: ₱<span class="required">*</span>
                        </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="total_amount"  id = "total_amount" required="required" readonly="readonly" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <br><br> 
                      

                      <div class="form-group" style = "display:none" id ="installDiv">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">For Installation?<span class="required">*</span>
                        </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="checkbox" name="installation" required="required" id = "installbutton" value = "With Installation">
                         
                        </div>
                      </div>
                      <br><br>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Reference Drawing <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="file_reference" id="fileToUpload" required="required">
                        </div>
                      </div>

                      <div class="ln_solid"></div>

                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <button name="createBtn" class="btn btn-round btn-success" type="submit" class="btn btn-success" onclick ="removerequired()">Create</button>
						              <button class="btn btn-round btn-primary" type="reset">Reset</button>
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
                                  header("Location: ViewOrders.php");
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
                              $sqlToSubtractFromItemsTrading = "UPDATE items_trading
                              SET items_trading.item_count  = (item_count - '$EXPLODED_ITEM_QTY[$i]'),
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
                                  header("Location: ViewOrders.php");
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
                          } 
                                                                                                               
                        } // END IF DELIVER
                        else //Insert to DB if PickUp
                        {
                          $OR_NUM = $_SESSION['getORNumber'];
                          $CLIENT_ID = $_SESSION['client_id'];
                          $ORDER_DATE = $_SESSION['order_date'];                          
                          $PAYMENT_ID = $_SESSION['payment_id'];

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
                                  header("Location: ViewOrders.php");
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
                              $sqlToSubtractFromItemsTrading = "UPDATE items_trading
                              SET items_trading.item_count  = (item_count - '$EXPLODED_ITEM_QTY[$i]'),
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

      console.log(parseFloat(getTotal));

      fab_total.innerHTML = parseFloat(getTotal);
      fab_total.value =parseFloat(getTotal);
      
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
