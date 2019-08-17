<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Create Delivery Receipt</title>

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
</head>


<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php
                require_once("nav.php");    
            ?>
        </div>
            <!-- /sidebar menu -->

                <!-- page content -->
                <div class="right_col" role="main">
                    <!-- top tiles -->
                    
                    

                    <!-- /top tiles -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title" align="center">
                 
                    <font color = "black"><h1><b>Create Delivery Receipt: </b> [ DR - 
                        <?php 
                        require_once('DataFetchers/mysql_connect.php');

                            $query = "SELECT count(delivery_Receipt) as Count FROM mydb.scheduledelivery;";
                            $resultofQuery = mysqli_query($dbc, $query);
                            while($rowofResult=mysqli_fetch_array($resultofQuery,MYSQLI_ASSOC))
                            {
                                echo $rowofResult['Count'] + 1;
                            };


                        ?> <!-- PHP END TO GET DR number-->
                     ]
                   
                     </h1></font>
                    <div class="clearfix"></div>
                  </div>

                  <!-- IF TRUCK CANNOT HANDLE DELIVERY (remove this when backend is implemented) Disable submit button when truck is unavailable.
                  <br>
                  <font color = "red">The delivery truck cannot handle any more deliveries for this day. Please choose another delivery date.</font>
                  <br>
                  IF TRUCK IS ON CODING
                  <br>
                  <font color = "red">The date selected is the truck's number coding date. Please choose another delivery date.</font> -->

                  <form class="form-horizontal form-label-center" method="POST">                              
                    <div class="col-md-6 col-sm-6 col-xs-12 " >
                        <div class="x_panel" >
                        <center><font color = "#2a5eb2"><h3>Order Details </h1>
                                            </h3></font></center>
                                            <div class="ln_solid"></div>
                    <div class="form-group" >
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Order Number: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select id="orderNumberDropdown" class="form-control" required="" name = "selectItemtype">
                            <option value="">Choose..</option>
                                <?php
                                    require_once('DataFetchers/mysql_connect.php');

                                    $sql1 = "SELECT * FROM orders
                                    join clients ON orders.client_id = clients.client_id
                                    where order_status = 'Deliver'                                      
                                    ";
                                    $result1=mysqli_query($dbc,$sql1);
                                    while($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC))
                                    { 
                                      if($row1['fab_status'] == "No Fabrication" || $row1['fab_status'] == "Finished Fabrication")
                                      {
                                        echo'<option value="';
                                        echo $row1['ordernumber'];
                                        echo'">';
                                        echo $row1['ordernumber'], " | " ,$row1['expected_date'];
                                        echo'</option>';
                                      }
                                        
                                    } 
                                                                   
                                ?> <!-- PHP END [ Getting the OR Number from DB ]-->                                                   
                        </select>
                        </div>
                      </div> <!-- END Div of TAble -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Expected Date: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="expectedDate" name = "expectedDate" class="form-control" type="text" readonly="readonly" required>
                        </div>
                      </div>
                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Delivery Date:
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input class="form-control deliveryDate"  type="date"  id="deliveryDate" name="deliveryDate"  min="<?php echo date("Y-m-d", strtotime("+1days")); ?>"required/>
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

                      <div class="form-group" >
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Customer Name: </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="customerName" name = "customerName" class="form-control" type="text" readonly="readonly" >                               
                        </div>
                      </div>

                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Client Address: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="locationFromClient" name = "locationFromClient" class="date-picker form-control col-md-7 col-xs-12" type="text" readonly="readonly">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Truck: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="truckPlate" name = "truckPlate" class="date-picker form-control col-md-7 col-xs-12" type="text" readonly="readonly">
                        </div>
                      </div>

                      <!-- Added truck weight cap -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Truck Weight Capacity: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input style="text-align:right;" id="truckWeight" name = "truckWeight" class="date-picker form-control col-md-7 col-xs-12" type="text" readonly="readonly">
                        </div>
                      </div>

                       <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Driver: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="driverName" name = "driverName" class="date-picker form-control col-md-7 col-xs-12" type="text" readonly="readonly">
                        </div>
                      </div>
                      <div class = "ln_solid"></div>


                      <!-- Added total weight -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Weight: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input style="text-align:right;" id="totalorderWeight" class="date-picker form-control col-md-7 col-xs-12" type="text" readonly="readonly">
                        </div>
                      </div>  


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Price: 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="totalfromOrders" class="date-picker form-control col-md-7 col-xs-12" type="text" readonly="readonly" style="text-align:right;">
                        </div>
                      </div>   
                            
                      
                            </div><!-- mod start  -->
                          </div>


                  <div class="col-md-6 col-sm-6 col-xs-12" >
                    <div class="x_panel" >
                      <center><h3>Items in Order</h1></h3></center>
                        <div class="ln_solid"></div>
                         <div class="row" >
                            <div class="col-md-12 col-sm-12 col-xs-12"  >
                              <table  id="datatable" class="table table-striped table-bordered dataTable no-footer" role="grid" aria-describedby="datatable_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 263px;">Product</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 197px;">Pieces</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 197px;">Price per piece</th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"  style="width: 197px;">Subtotal</th>
                                        </tr>
                                </thead>
                                <tbody>
                                <tr role='row' class='odd'>
                                        <!-- <td id="itemNameRow" ></td>
                                        <td id="itemQuantityRow" ></td>
                                        <td id="itemPriceRow" ></td>                                                                                                       -->
                                </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>         
                        </div> <!--END XPanel-->
                    </div> <!--END Class Colmd-->
                    <div class="col-md-6 col-sm-6 col-xs-12" id="item_fab">
                    <div class="x_panel" >
                      <center><h3>Fabricated Product Request</h1></h3></center>
                        <div class="ln_solid"></div>
                         <div class="row" >
                           <div class = "col-md-12" align = "center">
                             <!-- "data:image/jpg;base64,'. base64_encode($BLOB[$i]).'" -->
                              <img id = "fab_img" src = " https://s7d4.scene7.com/is/image/roomandboard/?layer=0&size=498,300&scl=1&src=996120_wood_W&layer=comp&$prodzoom0$"  border-style = "border-width:3px;"style = "height:20vh; width:15vw">
                           </div>
                            <div class="col-md-12 col-sm-12 col-xs-12"  >
                              <br>
                              <h2><span id = "current_or">Order Number: </span></h2>
                              <h2><span id = "fab_status">Current Status:  </span></h2>
                              <!-- <font color = "blue">Fabricating</font> OR <font color = "red">Disapproved</font> OR <font color = "green">Finished</font> -->
                            </div>
                            <div class ="col-md-12 col-sm-12 col-xs-12">
                              <span id = "description"><font size = "3"> Description: A big brown table</font></span>
                            </div>
                          </div>         
                        </div> <!--END XPanel-->
                    </div> <!--END Class Colmd-->

                        <div class = "clearfix"></div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12" align="right">
                          <button type="button" name = "submitDeliveryReceipt" id = "submit_receipt" class="btn btn-success">Submit</button>                        
                        </div>
                      </div>

                    </form>

                    
                  </div>
                </div>
              
</body>

<!-- /page content -->

<!-- footer content -->

<!-- /footer content -->

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
<script type="text/javascript">
    
    $("#item_fab").hide();                   
    <?php
    
    require_once('DataFetchers/mysql_connect.php');
    
    echo  'var textBox = document.getElementById("customerName");';
    echo  'var dropdown = document.getElementById("orderNumberDropdown");';
    echo  'var itemBox = document.getElementById("itemfromOrders");';
    echo  'var quantityBox = document.getElementById("quantityfromOrders");';
    echo  'var totalPriceBox = document.getElementById("totalfromOrders");';

    echo  'var ExpectedDateBox = document.getElementById("expectedDate");';
    echo  'var locationBox = document.getElementById("locationFromClient");';
    echo  'var truckPlateBox = document.getElementById("truckPlate");';
    echo  'var driverBox = document.getElementById("driverName");';

    // newly added
    echo  'var truckweightBox = document.getElementById("truckWeight");';
    echo  'var totalweightBox = document.getElementById("totalorderWeight");';

    $orderNumber = array();
    $customerName = array();
    $itemName = array();
    $quantity = array();
    $pricePerItem = array();
    $totalPrice = array();
    $itemweight = array();
    
    $fabricationStatus = array();
    $paymentStatus = array();

    $ExpectedDateFromHTML = array();
    $locationFromHTML = array();

    $driverFirstNameFromHTML = array();
    $driverLastNameFromHTML = array();

    $fab_desc = array();
    $client_address = array();
    
    // $SQL_ORDERS_STATUS = "SELECT * FROM orders WHERE orderstatus = 'Deliver'";
    // $RESULT_ORDER_STATUS = mysqli_query($dbc,$SQL_ORDERS_STATUS);
    // while($ROW_RESULT_ORDER_STATUS=mysqli_fetch_array($result,MYSQLI_ASSOC))
    // {
    //     $orderNumber[] = $ROW_RESULT_ORDER_STATUS['ordernumber'];
    // }      

    $sql = "SELECT * FROM orders
    join clients ON orders.client_id = clients.client_id
    join order_details ON order_details.ordernumber = orders.ordernumber
    join items_trading ON order_details.item_id = items_trading.item_id   
    ;";

    $result=mysqli_query($dbc,$sql);                                      
    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
    {   
        if($row['fab_status'] == "No Fabrication" || $row['fab_status'] == "Finished Fabrication")
        {
          $orderNumber[] = $row['ordernumber'];
          $customerName[] = $row['client_name'];  
          $itemName[] = $row['item_name'];
          $quantity[] = $row['item_qty'];
          $pricePerItem[] =  number_format(($row['item_price']),2);  //place decimals
          // $totalPrice[] = $row['item_qty'] * $row['item_price'];
          $totalPrice[] =  number_format(($row['totalamt']),2);
          $itemweight[] = $row['item_weight'];
  
          $fabricationStatus[] = $row['fab_status'];
          $paymentStatus[] = $row['payment_status'];
  
          $FORMATTED_DATE = date('F j, Y',strtotime($row['expected_date'])); //Formats date 
  
          $ExpectedDateFromHTML[] = $FORMATTED_DATE;
          $locationFromHTML[] = $row['client_city'];

          $client_address[] =$row['client_address'];
        }                                                                               
        
                                                        
    }
    
    $truckID = array();
    $destinationID = array();
    $truckcap = array();

    $TRUCK_PLATE_FROM_TABLE = array();
    $TRUCK_STATIC_CAP = array();

    $SQL_GET_TRUCK_PLATE = "SELECT * FROM trucktable";
    $RESULT_GET_TP=mysqli_query($dbc,$SQL_GET_TRUCK_PLATE);
    while($ROW_RESULT_GET_TP=mysqli_fetch_array($RESULT_GET_TP,MYSQLI_ASSOC))
    { 
      $TRUCK_PLATE_FROM_TABLE[] = $ROW_RESULT_GET_TP['truckplate'];
      $TRUCK_STATIC_CAP[] = $ROW_RESULT_GET_TP['weightCap'];
    }


    $sql1 = "SELECT * FROM destination
    JOIN trucktable ON trucktable.truckID = destination.truckID
    join driver ON driver.truckID = trucktable.truckID;";
    $result1=mysqli_query($dbc,$sql1);
    while($row1=mysqli_fetch_array($result1,MYSQLI_ASSOC))
    { // W I P
        $truckID[] = $row1['truckplate'];
        $destinationID[] = $row1['DestinationName'];
        $driverFirstNameFromHTML[]  = $row1['driverFirstName'];
        $driverLastNameFromHTML[]  = $row1['driverLastName'];
        $truckcap[] = $row1['weightCap'];
    }
    $BULK_DATE = array();
    $DATE_TRUCK_CAP = array();
    $BULK_TRUCK_PLATE = array();

    $GET_BULK_INFO = "SELECT * FROM bulk_order";
    $RESULT_BULK_INFO = mysqli_query($dbc,$GET_BULK_INFO);
    
    while($ROW_RESULT_BULK_INFO = mysqli_fetch_array($RESULT_BULK_INFO,MYSQLI_ASSOC))
    {
      $BULK_DATE[] = $ROW_RESULT_BULK_INFO['bulk_order_date'];
      $DATE_TRUCK_CAP[] = $ROW_RESULT_BULK_INFO['current_truck_cap']; 
      $BULK_TRUCK_PLATE[] = $ROW_RESULT_BULK_INFO['truck_assigned']; 
    }

    // echo "alert(".$FAB_IMG.");";
    echo "var itemNameFromPHP = ".json_encode($itemName).";"; 
    echo "var cusNameFromPHP = ".json_encode($customerName).";"; 
    echo "var orderNumFromPHP = ".json_encode($orderNumber).";";
    echo "var quantityNumFromPHP = ".json_encode($quantity).";";
    echo "var PriceNumFromPHP = ".json_encode($pricePerItem).";";
    echo "var totalNumFromPHP = ".json_encode($totalPrice).";";
    echo "var itemweightFromPHP = ".json_encode($itemweight).";";

    echo "var fabricationStatusFromPHP = ".json_encode($fabricationStatus).";";
    echo "var paymentStatusFromPHP = ".json_encode($paymentStatus).";";

    echo "var expectedDateFromPHP = ".json_encode($ExpectedDateFromHTML).";";
    echo "var locationFromPHP = ".json_encode($locationFromHTML).";";

    echo "var truckPlateFromPHP = ".json_encode($truckID).";";
    echo "var DestinationFromPHP = ".json_encode($destinationID).";";
    echo "var TruckCapFromPHP = ".json_encode($truckcap).";";

    echo "var driverFirstNameFromPHP = ".json_encode($driverFirstNameFromHTML).";";
    echo "var driverLastNameFromPHP = ".json_encode($driverLastNameFromHTML).";";

   
    
    echo "var client_address_PHP = ".json_encode($client_address).";";

    echo "var current_truck_cap_PHP = ".json_encode($DATE_TRUCK_CAP).";";
    echo "var bulk_date_PHP = ".json_encode($BULK_DATE).";";
    echo "var bulk_truck_plate_PHP = ".json_encode($BULK_TRUCK_PLATE).";";

    echo "var TP_FROM_TABLE = ".json_encode($TRUCK_PLATE_FROM_TABLE).";";
    echo "var STATIC_CAP = ".json_encode($TRUCK_STATIC_CAP).";";
    
  //  echo "$('#fab_img').attr('src', 'data:image/jpg;base64,".base64_encode($FAB_IMG)."');";                                                                    
?> //PHP END                        
</script> <!-- Script to add Order Details from DB with PHP inside -->

<script>
var dropdown = document.getElementById("orderNumberDropdown");
var table = document.getElementById("datatable");

    table.oldHTML=table.innerHTML;
    $('#deliveryDate').on('change',function(e){
          var myDate = new Date($(this).val())         
          var day = myDate.getDate();
          var month = myDate.getMonth() + 1;
          var year = myDate.getFullYear();
          if (day < 10) {
              day = "0" + day;
          }
          if (month < 10) {
              month = "0" + month;
          }
          FORMATTED_DELIV_DATE = year + '-' + month + '-' + day;

          var d = FORMATTED_DELIV_DATE; //Converts to Num;
          var truck_coding = parseInt($('#truckPlate').val().slice(-1)); //Gets the last digit of truck plate
          var onchange = "On Change";
          console.log("Day Number: "+ d);
          console.log("Truck Number: "+ truck_coding);
          var code = coding(myDate.getDay(),truck_coding,onchange);
          if(code == null)
          {
           
            $('#deliveryDate').attr("value", FORMATTED_DELIV_DATE);
            for(var q = 0; q < bulk_date_PHP.length; q++)
            {
              // console.log("Deliv Date: "+ FORMATTED_DELIV_DATE);
              // console.log("Bulk Date: "+ bulk_date_PHP[q]);          
              if(FORMATTED_DELIV_DATE == bulk_date_PHP[q] && bulk_truck_plate_PHP[q] == $('#truckPlate').val())
              {
                
                truckweightBox.value = current_truck_cap_PHP[q] + ' KG';
                break;
              }
              else
              {
               
                $.each(TP_FROM_TABLE , function(index, val){ 
                  

                  if(val.trim() == $('#truckPlate').val().trim())
                  {
                  //   console.log('Foreach Value = '+val);
                  // // console.log('Foreach Index = '+index);
                  // console.log('Loop Value = '+bulk_truck_plate_PHP[q]);
                  // console.log('Static Cap: '+ STATIC_CAP[index]+' at Index: '+index);
                    truckweightBox.value = STATIC_CAP[index] + ' KG';
                  }
                });
                
              }
            } //End for
            
          }
          else
          {
            
            $('#deliveryDate').attr("value", code);
            $('#deliveryDate').val($('#deliveryDate').attr('value'));
            truckweightBox.value ="";
            console.log($('#deliveryDate').attr('value'));
           
          }
         

            
      })
    dropdown.onchange = function(){
        table.innerHTML=table.oldHTML; //returns to the first state of the Table
        var current_weight = 0;
    
        
    for (var i = 0; i < <?php echo sizeof($orderNumber);?>; i++) 
    {                                                                               
         if(dropdown.value == orderNumFromPHP[i])
          { 
              $("#item_fab").hide();             
              textBox.value = cusNameFromPHP[i];               
              totalPriceBox.value = '₱ '+ totalNumFromPHP[i];
              ExpectedDateBox.value = expectedDateFromPHP[i];
              locationBox.value = client_address_PHP[i] + ' - ' + locationFromPHP[i];

              

            // Added total weight
            // echo  " totalweightBox.value = '400' + 'kg'";
            
            current_weight = current_weight + (itemweightFromPHP[i] * quantityNumFromPHP[i]);
              for (var j = 0; j < <?php echo sizeof($truckID);?>; j++) 
              {  
                if(locationFromPHP[i] == DestinationFromPHP[j]) //checks if location is same as TruckDestination
                {
                    truckPlateBox.value = truckPlateFromPHP[j];
                    driverBox.value = driverFirstNameFromPHP[j] + ' ' +driverLastNameFromPHP[j];              
                    totalweightBox.value = current_weight + ' KG';
                }
              } // end 2nd forloop     

              if(fabricationStatusFromPHP[i] == "No Fabrication")
              { 
                $("#item_fab").hide(); 
                if("<?php echo date("l", strtotime("+3days")); ?>"=="Sunday")
                {
                  $("#deliveryDate").attr("value", "<?php echo date("Y-m-d", strtotime("+4days"));?>");

                  var status = "OnLoad";
                  var OnloadDate = $("#deliveryDate").attr('value');
                  var d = new Date($("#deliveryDate").attr('value')); //Converts to Num;
                  var truck_coding = parseInt($('#truckPlate').val().slice(-1)); //Gets the last digit of truck plate
                  
                  var code = coding(d.getDay(),truck_coding,status);
                  if(code == null)
                  {
                   
                    $('#deliveryDate').attr("value", OnloadDate);
                    set_weight();
                  }
                  else
                  {
                    
                    alert("Truck Coding on Selected Date, Moving to Next Day");
                    $('#deliveryDate').attr("value", code);
                    $('#deliveryDate').val($('#deliveryDate').attr('value'));
                    set_weight();
                   
                  }                                                    
                }
                else
                {
                  
                  $("#deliveryDate").attr("value", "<?php echo date("Y-m-d", strtotime("+3days"));?>"); 
                  var status = "OnLoad";
                  var OnloadDate = $("#deliveryDate").attr('value');
                  var d = new Date($("#deliveryDate").attr('value')); //Converts to Num;
                  var truck_coding = parseInt($('#truckPlate').val().slice(-1)); //Gets the last digit of truck plate
                  
                  var code = coding(d.getDay(),truck_coding,status);
                  if(code == null)
                  {
                    
                    $('#deliveryDate').attr("value", OnloadDate);
                    set_weight();
                  }
                  else
                  {
                   
                    alert("Truck Coding on Selected Date, Moving to Next Day");
                    $('#deliveryDate').attr("value", code);
                    $('#deliveryDate').val($('#deliveryDate').attr('value'));
                    set_weight();
                  }                 
                }                             
              } //END IF
             else
             {  
                $("#item_fab").show();

                request = $.ajax({
                  url: "ajax/get_deliv_img.php",
                  type: "POST",
                  data: {
                    post_or_number: dropdown.value                     
                  },                 
                  dataType: 'json',
                  success: function(data)
                  {
                    $("#current_or").text("Order Number: " + data[0]);
                    $("#fab_status").text("Current Status: Finished Fabrication" );
                    $("#description").text("Description: " + data[1] );
                    $('#fab_img').attr('src', "data:image/jpg;base64, "+data[2]+"");
                    
                  }//End Scucess                   
                }); // End ajax     

               
                
                if("<?php echo date("l", strtotime("+6days")); ?>"=="Sunday")
                {
                  $("#deliveryDate").attr("value", "<?php echo date("Y-m-d", strtotime("+7days"));?>");

                  var status = "OnLoad";
                  var OnloadDate = $("#deliveryDate").attr('value');
                  var d = new Date($("#deliveryDate").attr('value')); //Converts to Num;
                  var truck_coding = parseInt($('#truckPlate').val().slice(-1)); //Gets the last digit of truck plate
                  
                  var code = coding(d.getDay(),truck_coding,status);
                  if(code == null)
                  {
                    
                    $('#deliveryDate').attr("value", OnloadDate);
                    set_weight(); //Function below
                  }

                  else
                  {
                   
                    alert("Truck Coding on Selected Date, Moving to Next Day");
                    $('#deliveryDate').attr("value", code);
                    $('#deliveryDate').val($('#deliveryDate').attr('value'));
                    set_weight();
                  }

                 
                }//End iF
                
                else
                {
                  $("#deliveryDate").attr("value", "<?php echo date("Y-m-d", strtotime("+6days"));?>");

                  var status = "OnLoad";
                  var OnloadDate = $("#deliveryDate").attr('value');
                  var d = new Date($("#deliveryDate").attr('value')); //Converts to Num;
                  var truck_coding = parseInt($('#truckPlate').val().slice(-1)); //Gets the last digit of truck plate
                  
                  var code = coding(d.getDay(),truck_coding,status);
                  if(code == null)
                  {
                   
                    $('#deliveryDate').attr("value", OnloadDate);
                    set_weight();
                  }
                  else
                  {
                   
                    alert("Truck Coding on Selected Date, Moving to Next Day");
                    $('#deliveryDate').attr("value", code);
                    $('#deliveryDate').val($('#deliveryDate').attr('value'));
                    set_weight();
                   
                  }               
                } 
              
              
              } //END ELSE

            var newRow = document.getElementById('datatable').insertRow();
            var nf = new Intl.NumberFormat('en-US', {          
              minimumFractionDigits: 2,
              maximumFractionDigits: 2
            });
            var subtotal = parseFloat(quantityNumFromPHP[i].replace(",", "")).toFixed(2) * parseFloat(PriceNumFromPHP[i].replace(",", "")).toFixed(2);
                        
                        
            console.log("Subtotal: " + nf.format(subtotal));

            newRow.innerHTML = "<tr><td>" +itemNameFromPHP[i]+ "</td> <td align = right>" +quantityNumFromPHP[i]+ "</td> <td align = right> ₱ "+PriceNumFromPHP[i]+"</td> <td align=right> ₱ "+nf.format(subtotal)+"</td></tr>";
                                            
             } //End IF
                   
        }; //END 1st Forloop
      };  //End function 
</script>
           
<script>
 $('#submit_receipt').on('click', function(e){
   if($('#orderNumberDropdown :selected').val() == "")
   {
      alert("No Order Receipt Selected!");
   }
   else
   {
    if(confirm("Do you want to create a delivery receipt for this order?"))
    {
      request = $.ajax({
      url: "ajax/create_delivery_receipt.php",
      type: "POST",
      data: {
        post_delivery_date: $('#deliveryDate').val(),
        post_expected_date: $('#expectedDate').val(),
        post_driver_name: $('#driverName').val(),
        post_truck_plate: $('#truckPlate').val(),
        post_customer_name: $('#customerName').val(),
        post_destination: $('#locationFromClient').val(),
        post_selected_or: $('#orderNumberDropdown :selected').val(),
        post_order_weight: $('#totalorderWeight').val(),
        post_truck_cap: $('#truckWeight').val()
                                
      },
      success: function(data, textStatus)
      {
          alert("Successful");
          window.location.href= "Deliveries.php";
          

      }//End Success
      
      }); // End ajax 
    }
    else
    {
      alert("Action: Cancelled");
    }
   }
    
  })  
</script>
 <script>
  var warning = $('<p>').text('Error: No Sunday Delivery!')
  $('#deliveryDate').change(function(e) {

        var d = new Date(e.target.value)
        if(d.getDay() === 0) {
          alert('No Sunday Delivery!');
          $("#deliveryDate").val("");
          $('#deliveryDate').after(warning);
        } else {
          warning.remove() 
        
      }
  })
</script>
<script>
function coding(day_number, truck_code, status)
{
  if(day_number == 1 && (truck_code == 1 || truck_code == 2))
  {
    
    if(status == "On Change")
    {
      var get_date = new Date($("#deliveryDate").attr('value'));
      get_date.setDate(get_date.getDate() + 2);
    }
    else
    {
      var get_date = new Date($("#deliveryDate").attr('value'));
      get_date.setDate(get_date.getDate() + 1);
    }

    var dd = get_date.getDate();
    var mm = get_date.getMonth() + 1;
    var y = get_date.getFullYear();
    if (dd < 10) {
      dd = "0" + dd;
    }
    if (mm < 10) {
      mm = "0" + mm;
    }

    var Formatted_Date = y + '-'+ mm + '-'+ dd;
    
    return Formatted_Date;
  }
  if(day_number == 2 && (truck_code == 3 || truck_code == 4))
  {
    
    if(status == "On Change")
    {
      var get_date = new Date($("#deliveryDate").attr('value'));
      get_date.setDate(get_date.getDate() + 2);
    }
    else
    {
      var get_date = new Date($("#deliveryDate").attr('value'));
      get_date.setDate(get_date.getDate() + 1);
    }

    var dd = get_date.getDate();
    var mm = get_date.getMonth() + 1;
    var y = get_date.getFullYear();
    if (dd < 10) {
      dd = "0" + dd;
    }
    if (mm < 10) {
      mm = "0" + mm;
    }

    var Formatted_Date = y + '-'+ mm + '-'+ dd;
    
    return Formatted_Date;
  }
  if(day_number == 3 && (truck_code == 5 || truck_code == 6))
  {
    if(status == "On Change")
    {
      var get_date = new Date($("#deliveryDate").attr('value'));
      get_date.setDate(get_date.getDate() + 2);
    }
    else
    {
      var get_date = new Date($("#deliveryDate").attr('value'));
      get_date.setDate(get_date.getDate() + 1);
    }

    var dd = get_date.getDate();
    var mm = get_date.getMonth() + 1;
    var y = get_date.getFullYear();
    if (dd < 10) {
      dd = "0" + dd;
    }
    if (mm < 10) {
      mm = "0" + mm;
    }

    var Formatted_Date = y + '-'+ mm + '-'+ dd;
    
    return Formatted_Date;
  }
  if(day_number == 4 && (truck_code == 7 || truck_code == 8))
  {
    if(status == "On Change")
    {
      var get_date = new Date($("#deliveryDate").attr('value'));
      get_date.setDate(get_date.getDate() + 2);
    }
    else
    {
      var get_date = new Date($("#deliveryDate").attr('value'));
      get_date.setDate(get_date.getDate() + 1);
    }
    

    var dd = get_date.getDate();
    var mm = get_date.getMonth() + 1;
    var y = get_date.getFullYear();
    if (dd < 10) {
      dd = "0" + dd;
    }
    if (mm < 10) {
      mm = "0" + mm;
    }

    var Formatted_Date = y + '-'+ mm + '-'+ dd;
    
    return Formatted_Date;
  }
  if(day_number == 5 && (truck_code == 9 || truck_code == 0))
  {
    
    if(status == "On Change")
    {
      var get_date = new Date($("#deliveryDate").attr('value'));
      get_date.setDate(get_date.getDate() + 2);
    }
    else
    {
      var get_date = new Date($("#deliveryDate").attr('value'));
      get_date.setDate(get_date.getDate() + 1);
    }

    var dd = get_date.getDate();
    var mm = get_date.getMonth() + 1;
    var y = get_date.getFullYear();
    if (dd < 10) {
      dd = "0" + dd;
    }
    if (mm < 10) {
      mm = "0" + mm;
    }

    var Formatted_Date = y + '-'+ mm + '-'+ dd;
    
    return Formatted_Date;
  }
}
</script>

<script>
function set_weight()
{
  for(var q = 0; q < bulk_date_PHP.length; q++)
    {                 
      if(bulk_date_PHP[q] == $("#deliveryDate").attr('value') && bulk_truck_plate_PHP[q] == $('#truckPlate').val())
      {                    
        truckweightBox.value = current_truck_cap_PHP[q] + ' KG';
        break;
      }
      else
      {
        $.each(TP_FROM_TABLE , function(index, val){                
          if(val.trim() == $('#truckPlate').val().trim())
          {                     
            truckweightBox.value = STATIC_CAP[index] + ' KG';
          }
        });
      }
    }
}
</script>


</body>

</html>
