
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Dashboard</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- FullCalendar -->
    <link href="../vendors/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="../vendors/fullcalendar/dist/fullcalendar.print.css" rel="stylesheet" media="print">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       
            

            <!-- sidebar menu -->
            <?php
            require_once("nav.php");    
            ?>
                

            
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            
            <!-- /menu footer buttons -->
          </div>
        
        

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
<?php
  if($user == 'SALES' || $user == 'Superuser')
  {

?>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-ticket"></i> Total Depot Requests</span>
              <!-- Insert count of depot requests here -->
<?php
              $SQL_COUNT_ALL_DEPOT_REQUEST_INPROGRESS = "SELECT COUNT(*) as COUNTREQUESTS FROM depot_request
                                                          WHERE depot_request_status = 'Order in Progress';";
                      $RESULT_COUNT_ALL_DEPOT_REQUEST_INPROGRESS  = mysqli_query($dbc, $SQL_COUNT_ALL_DEPOT_REQUEST_INPROGRESS);
                      $ROWRESULT_ORDER_IN_PROGRESS=mysqli_fetch_array($RESULT_COUNT_ALL_DEPOT_REQUEST_INPROGRESS,MYSQLI_ASSOC);
?>
              <div class="count blue"><?php echo $ROWRESULT_ORDER_IN_PROGRESS['COUNTREQUESTS']; ?></div>
              <span class="count_bottom"><i class="green"></i><a href = "ViewDepotRequests.php" class = "blue">Click for more!</a></span>
            </div>
<?php
  }
?>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-thumbs-o-down"></i> Unfinished Fabrications</span>
              <!-- Insert count of unfinished fabrications here -->

<?php
              $SQL_COUNT_ALL_UNFINISHED_FABS = "SELECT COUNT(*) as COUNTFABS FROM orders
                                                          WHERE fab_status = 'Under Fabrication' OR fab_status = 'For Fabrication';";
                      $RESULT_COUNT_ALL_UNFINISHED_FABS  = mysqli_query($dbc, $SQL_COUNT_ALL_UNFINISHED_FABS);
                      $ROWRESULT_UNFINISHED_FABS=mysqli_fetch_array($RESULT_COUNT_ALL_UNFINISHED_FABS,MYSQLI_ASSOC);
?>
              <div class="count red"><?php echo $ROWRESULT_UNFINISHED_FABS['COUNTFABS']; ?></div>
              <span class="count_bottom"><i class="green"></i><a href = "FabricationApproval.php" class = "blue">View Fabrication Summary</a></span>
              <!-- <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>2 </i> Added From Last Week</span> -->
            </div><br>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count"> 
              <span class="count_top"><i class="fa fa-truck"></i> Orders to be Delivered Today</span>
              <!-- Insert count of deliveries for today -->

<?php
              $SQL_COUNT_ALL_DELIVERIES = "SELECT COUNT(*) as COUNTDELIVERIES FROM orders
                                                          WHERE delivery_date = CURDATE();";
                      $RESULT_COUNT_ALL_DELIVERIESS  = mysqli_query($dbc, $SQL_COUNT_ALL_DELIVERIES);
                      $ROWRESULT_DELIVERIES=mysqli_fetch_array($RESULT_COUNT_ALL_DELIVERIESS,MYSQLI_ASSOC);
?>             
              <div class="count green"><?php echo $ROWRESULT_DELIVERIES['COUNTDELIVERIES']; ?></div>
              <span class="count_bottom"><i class="green"></i><a href = "ViewTruckCap.php" class = "blue">View all Deliveries </a></span>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Total Unpaid Client Orders</span>
              <!-- Insert total count of unpaid client orders here -->

<?php
              $SQL_COUNT_ALL_UNPAID = "SELECT SUM(total_unpaid) as COUNTUNPAID FROM clients";
                      $RESULT_COUNT_ALL_UNPAID = mysqli_query($dbc, $SQL_COUNT_ALL_UNPAID);
                      $ROWRESULT_UNPAID=mysqli_fetch_array($RESULT_COUNT_ALL_UNPAID,MYSQLI_ASSOC);

              $SQL_COUNT_ALL_PAID_THIS_MONTH = "SELECT IFNULL(SUM(payment_amount), 0) as PAYAMOUNT FROM unpaidaudit
                                                          WHERE MONTH(payment_date) = MONTH(CURDATE());";
                      $RESULT_COUNT_ALL_UNPAID_THIS_MONTH = mysqli_query($dbc, $SQL_COUNT_ALL_PAID_THIS_MONTH);
                      $ROWRESULT_UNPAID_THIS_MONTH=mysqli_fetch_array($RESULT_COUNT_ALL_UNPAID_THIS_MONTH,MYSQLI_ASSOC);

              $DIFF_PREV_MONTH = $ROWRESULT_UNPAID['COUNTUNPAID'] - $ROWRESULT_UNPAID_THIS_MONTH['PAYAMOUNT'];
              $DIFF_THIS_PREV_MONTH = $ROWRESULT_UNPAID['COUNTUNPAID'] - $DIFF_PREV_MONTH;
              $PERCENT_INC_DEC = ($DIFF_THIS_PREV_MONTH/$ROWRESULT_UNPAID['COUNTUNPAID']) * 100; //to compute for the percentage of increase or decrease
?>          
            <div class="count"><font color = "orange">₱ <?php echo $ROWRESULT_UNPAID['COUNTUNPAID']; ?></font></div>
              <span class="count_bottom">
              <?php if ($PERCENT_INC_DEC > 0) 
                {
                ?>
                <i class="green"><i class="fa fa-sort-asc"></i>
                <?php
                }
                else if ($PERCENT_INC_DEC <= 0)
                {
                ?>
                <i class="red"><i class="fa fa-sort-desc"></i>
                <?php 
                }
                echo number_format($PERCENT_INC_DEC, 2, '.', ','); ?>%</i> 
              <?php if ($PERCENT_INC_DEC > 0) 
                {
                ?>
                Increase
                <?php
                }
                else if ($PERCENT_INC_DEC <= 0)
                {
                ?>
                Decrease
                <?php 
                }
              ?>
                from Last Month</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-close"></i> Total Current Late Deliveries</span>
              <!-- Insert total late deliveries as of today -->

<?php
              $SQL_COUNT_ALL_LATE_DELIVERIES = "SELECT COUNT(*) as COUNTLATEDELIVERIES FROM orders
                                                          WHERE delivery_date < CURDATE();";
                      $RESULT_COUNT_ALL_LATE_DELIVERIESS  = mysqli_query($dbc, $SQL_COUNT_ALL_LATE_DELIVERIES);
                      $ROWRESULT_LATE_DELIVERIES=mysqli_fetch_array($RESULT_COUNT_ALL_LATE_DELIVERIESS,MYSQLI_ASSOC);
?>           
              <div class="count red"><?php echo $ROWRESULT_LATE_DELIVERIES['COUNTLATEDELIVERIES']; ?></div>
              <span class="count_bottom"><i class="green"></i><a href = "Delivery Report.php" class = "blue">View Report </a></span>
              <!-- <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span> -->
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Losses for this Month</span>
              <!-- Insert total losses due to damages -->

<?php
              $SQL_COUNT_ALL_LOSSES = "SELECT IFNULL(SUM(total_loss), 0) AS SUMLOSS FROM damage_item
                                                          WHERE MONTH(last_update) = MONTH(CURDATE());";
                      $RESULT_COUNT_ALL_LOSSES  = mysqli_query($dbc, $SQL_COUNT_ALL_LOSSES);
                      $ROWRESULT_ALL_LOSSES=mysqli_fetch_array($RESULT_COUNT_ALL_LOSSES,MYSQLI_ASSOC);
?>     
              <div class="count"><font color = "darkred">₱ <?php echo $ROWRESULT_ALL_LOSSES['SUMLOSS']; ?></font></div>
              <!-- insert comparison with last month here -->

<?php
              $SQL_COUNT_ALL_LOSSES_COMPARISON = "SELECT IFNULL(SUM(total_loss), 0) AS SUMLOSS FROM damage_item
                                            WHERE MONTH(last_update) = MONTH(CURDATE() - INTERVAL 1 MONTH);";
                      $RESULT_COUNT_ALL_LOSSES_COMPARISON  = mysqli_query($dbc, $SQL_COUNT_ALL_LOSSES_COMPARISON);
                      $ROWRESULT_ALL_LOSSES_COMPARISON = mysqli_fetch_array($RESULT_COUNT_ALL_LOSSES_COMPARISON,MYSQLI_ASSOC); 
               
              $PERCENTAGEOFLOSS = 0;
              if($ROWRESULT_ALL_LOSSES_COMPARISON['SUMLOSS'] != 0)
              {
                $PERCENTAGEOFLOSS = ($ROWRESULT_ALL_LOSSES['SUMLOSS']/$ROWRESULT_ALL_LOSSES_COMPARISON['SUMLOSS'])*100;
              }       
              else 
              {
                $PERCENTAGEOFLOSS = 0;
              }               

?>             
              <span class="count_bottom">
                <?php if ($PERCENTAGEOFLOSS >= 0) 
                {
                ?>
                <i class="green"><i class="fa fa-sort-asc"></i>
                <?php
                }
                else if ($PERCENTAGEOFLOSS < 0)
                {
                ?>
                <i class="red"><i class="fa fa-sort-desc"></i>
                <?php 
                }
                echo $PERCENTAGEOFLOSS; ?>%</i> From last month | <a href = "Damage Report.php" class = "blue">View Report</a></span>
            </div> 
          </div> 
          <!-- /top tiles -->
            
             <div class="row">
                 <?php
            
                    if($user == 'SALES' || $user == 'CEO' || $user == 'MKT' || $user == 'Superuser')
                    {
                        //INVENTORY BELOW THRESHOLD
                        
                        echo '<div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                    <h2><center><i class="fa fa-level-down"></i><b>  ITEMS BELOW THRESHOLD</b></h2>  
                                    <div class="clearfix"></div>
                                  <div class="x_content">

                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>SKU</th>
                                          <th>Item Name</th>
                                          <th>Amount In Stock</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>';
                        
                            require_once('DataFetchers/mysql_connect.php');
                            $query = "SELECT item_id, sku_id, item_name, item_count, (threshold_amt-item_count) AS 'diff' from items_trading WHERE item_count < threshold_amt";
                            $result=mysqli_query($dbc,$query);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                            {
                                
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $row['sku_id'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row['item_name'];
                                    echo '</td>';
                                    echo '<td align = "right">';
                                    echo $row['item_count']." pieces";
                                    echo '</td>';
                                    if($row['diff'] >= 50)
                                    {
                                        echo '<td><center><a href ="EditInventory.php?sku_id='.$row['sku_id'].' & item_id='.$row['item_id'].'" onclick = "teit()"class=""><i class = "fa fa-wrench"></i></a></center></td>';
                                    }
                                    else
                                    {
                                        echo '<td><center><a href ="EditInventory.php?sku_id='.$row['sku_id'].' & item_id='.$row['item_id'].'" onclick = "teit()"class=""><i class = "fa fa-wrench"></i></a></center></td>';
                                    }
                                    echo '</td>';
                                    echo '</tr>';
                                    
                            } 
                     echo '</tbody>';
                    echo '</table>';
                        
                             echo '</div>
                        </div>
                      </div>';
                    }

                    if($user == 'SALES' || $user == 'CEO' || $user == 'MKT' || $user == 'Superuser')
                    {
                      //DEPOT REQUEST SUMMARY
                    ?>
                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                    <h2><center><i class="fa fa-cubes"></i><b>  DEPOT REQUESTS SUMMARY</b></h2>  
                                    <div class="clearfix"></div>
                                  <div class="x_content">

                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Request Number</th>
                                          <th>Request Date</th>
                                          <th>Expected Date</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>';

                      <?php 
                            $SQL_GET_DEPOT_REQUEST = "SELECT * FROM depot_request";
                            $RESULT_GET_DEPOT_REQUEST=mysqli_query($dbc,$SQL_GET_DEPOT_REQUEST);
                            while($ROW_DEPOT_REQUEST=mysqli_fetch_array($RESULT_GET_DEPOT_REQUEST,MYSQLI_ASSOC))
                            {
                      ?>
                                    <tr>
                                      <td><?php echo $ROW_DEPOT_REQUEST['depot_request_id']; ?></td>
                                      <td><?php echo date('F d, Y', strtotime($ROW_DEPOT_REQUEST['depot_request_date'])); ?></td>
                                      <td><?php echo date('F d, Y', strtotime($ROW_DEPOT_REQUEST['depot_expected_date'])); ?></td>
                                      <td align = "center"><i class = "fa fa-wrench"></i></td>
                                    </tr>
                      <?php      
                            } 
                      ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                                    <!-- if($row['diff'] >= 50)
                                    {
                                        echo '<td><center><a href ="EditInventory.php?sku_id='.$row['sku_id'].' & item_id='.$row['item_id'].'" onclick = "teit()"class=""><button class="btn btn-danger">Restock now</button></a></center></td>';
                                    }
                                    else
                                    {
                                        echo '<td><center><a href ="EditInventory.php?sku_id='.$row['sku_id'].' & item_id='.$row['item_id'].'" onclick = "teit()"class=""><button class="btn btn-warning">Restock now</button></a></center></td>';
                                    }
                                    echo '</td>';
                                    echo '</tr>'; -->

                  <?php
                    }
                 
                    // if($user == 'CEO' || $user == 'CFO' || $user == 'MKT' || $user == 'Superuser')
                    // {
                         

                    //      //LOSSES FOR A MONTH
                 
                    //     echo '<div class="col-md-6 col-sm-6 col-xs-12">
                    //             <div class="x_panel">
                    //                   <h2><center><i class="fa fa-sort-amount-desc"></i><b> Losses</b></h2>
                    //                 <div class="clearfix"></div>
                    //               <div class="x_content">

                    //                 <table class="table table-bordered">
                    //                   <thead>
                    //                     <tr>
                    //                       <th>Item</th>
                    //                       <th>Damage Percent</th>
                    //                       <th>Quantity</th>
                    //                       <th>Total Loss</th>
                    //                     </tr>
                    //                   </thead>
                    //                   <tbody>';
                        
                    //         require_once('DataFetchers/mysql_connect.php');
                    //         $query = "SELECT item_name, damage_percentage * 10, item_quantity, total_loss, last_update FROM damage_item WHERE DATEDIFF(NOW(), last_update) / 31 < 1;";
                    //         $result11=mysqli_query($dbc,$query);
                    //         while($row=mysqli_fetch_array($result11,MYSQLI_ASSOC))
                    //         {

                                    
                                
                    //                 echo '<tr>';
                    //                 echo '<td>';
                    //                 echo $row['item_name'];
                    //                 echo '</td>';
                    //                 echo '<td><b>';
                    //                 echo $row['damage_percentage * 10'];
                    //                 echo '%';
                    //                 echo '</b></td>';
                    //                 echo '<td>';
                    //                 echo $row['item_quantity'];
                    //                 echo '</td>';
                    //                 echo '<td><b>';
                    //                 echo  'Php'." ".number_format($row['total_loss'], 2);
                    //                 echo '</b></td>';
                    //                 echo '</tr>';
                                    
                    //         } 
                    //  echo '</tbody>';
                    // echo '</table>';
                        
                    //          echo '</div>
                    //     </div>
                    //   </div>';
                     
                    // echo '<div class="clearfix"></div>';  
                    // }
                 
                    if($user == 'SALES' || $user == 'CEO' || $user == 'MKT' || $user == 'Superuser')
                    {
                      //DEPOT REQUEST SUMMARY
                    ?>
                        
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                    <h2><center><i class="fa fa-cubes"></i><b>  DEPOT REQUESTS SUMMARY</b></h2>  
                                    <div class="clearfix"></div>
                                  <div class="x_content">

                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Request Number</th>
                                          <th>Request Date</th>
                                          <th>Expected Date</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>';

                      <?php 
                            $SQL_GET_DEPOT_REQUEST = "SELECT * FROM depot_request";
                            $RESULT_GET_DEPOT_REQUEST=mysqli_query($dbc,$SQL_GET_DEPOT_REQUEST);
                            while($ROW_DEPOT_REQUEST=mysqli_fetch_array($RESULT_GET_DEPOT_REQUEST,MYSQLI_ASSOC))
                            {
                      ?>
                                    <tr>
                                      <td><?php echo $ROW_DEPOT_REQUEST['depot_request_id']; ?></td>
                                      <td><?php echo date('F d, Y', strtotime($ROW_DEPOT_REQUEST['depot_request_date'])); ?></td>
                                      <td><?php echo date('F d, Y', strtotime($ROW_DEPOT_REQUEST['depot_expected_date'])); ?></td>
                                      <td align = "center"><i class = "fa fa-wrench"></i></td>
                                    </tr>
                      <?php      
                            } 
                      ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                                    <!-- if($row['diff'] >= 50)
                                    {
                                        echo '<td><center><a href ="EditInventory.php?sku_id='.$row['sku_id'].' & item_id='.$row['item_id'].'" onclick = "teit()"class=""><button class="btn btn-danger">Restock now</button></a></center></td>';
                                    }
                                    else
                                    {
                                        echo '<td><center><a href ="EditInventory.php?sku_id='.$row['sku_id'].' & item_id='.$row['item_id'].'" onclick = "teit()"class=""><button class="btn btn-warning">Restock now</button></a></center></td>';
                                    }
                                    echo '</td>';
                                    echo '</tr>'; -->

                  <?php
                    }
                 
                    if($user == 'CFO' || $user == 'SALES' || $user == 'MKT' || $user == 'Superuser')
                    {
                        //UNPAID ORDERS
                 
                        echo '<div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                      <h2><center><i class="fa fa-money"></i><b>  UNPAID ORDERS</b></h2>
                                    <div class="clearfix"></div>
                                  <div class="x_content">

                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Order Number</th>
                                          <th>Client Name</th>
                                          <th>Total Balance</th>
                                        </tr>
                                      </thead>
                                      <tbody>';
                        
                            require_once('DataFetchers/mysql_connect.php');
                            $query = "SELECT ordernumber, client_id, totalamt FROM orders WHERE payment_status = 'UNPAID'";
                            $result=mysqli_query($dbc,$query);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                            {

                                    $queryClientName = "SELECT client_name FROM clients WHERE client_id =" . $row['client_id'] . ";";
                                    $resultClientName = mysqli_query($dbc,$queryClientName);
                                    $rowClientName=mysqli_fetch_array($resultClientName,MYSQLI_ASSOC);
                                    $clientName = $rowClientName['client_name'];
                                    
                                
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $row['ordernumber'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $clientName;
                                    echo '</td>';
                                    echo '<td align = "right">';
                                    echo  '₱'.number_format($row['totalamt'], 2);
                                    echo '</td>';
                                    echo '</tr>';
                                    
                            } 
                     echo '</tbody>';
                    echo '</table>';
                        
                             echo '</div>
                        </div>
                      </div>';
                       
                    }
                 
                    if($user == 'SALES' || $user == 'MKT' || $user == 'Superuser')
                    {
                        if($user != 'MKT')
                        {
                             echo '<div class="clearfix"></div>';    
                        }
                        
                         //ORDERS NEARING DELIVERY
                 
                        echo '<div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                      <h2><center><i class="fa fa-truck"></i><b>  ORDERS NEARING DELIVERY</b></h2>
                                    <div class="clearfix"></div>
                                  <div class="x_content">

                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Order Number</th>
                                          <th>Client Name</th>
                                          <th>Delivery Date</th>
                                          <th>Remaining Date</th>
                                        </tr>
                                      </thead>
                                      <tbody>';
                        
                            require_once('DataFetchers/mysql_connect.php');
                            $query = "SELECT ordernumber, client_id, delivery_date, DATEDIFF(delivery_date, NOW()) AS 'remain_date' FROM orders WHERE DATEDIFF(NOW(), delivery_date) < 7";
                            $result=mysqli_query($dbc,$query);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                            {

                                    $queryClientName = "SELECT client_name FROM clients WHERE client_id =" . $row['client_id'] . ";";
                                    $resultClientName = mysqli_query($dbc,$queryClientName);
                                    $rowClientName=mysqli_fetch_array($resultClientName,MYSQLI_ASSOC);
                                    $clientName = $rowClientName['client_name'];
                                    
                                
                                    echo '<tr>';
                                    echo '<td>';
                                    echo $row['ordernumber'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $clientName;
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row['delivery_date'];
                                    echo '</td>';
                                    echo '<td><b>';
                                    echo $row['remain_date'];
                                    echo ' days left!';
                                    echo '</b></td>';
                                    echo '</tr>';
                                    
                            } 
                     echo '</tbody>';
                    echo '</table>';
                        
                             echo '</div>
                        </div>
                      </div>';
                    }
                 
                 if($user == 'INV' || $user == 'SALES' || $user == 'Superuser')
                 {
                    
                        //FABRICATION APPROVALS
                 
                        echo '<div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                      <h2><center><i class="fa fa-check-circle"></i><b>  FABRICATIONS FOR APPROVAL</b></h2>
                                    <div class="clearfix"></div>
                                  <div class="x_content">

                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>Order Number</th>
                                          <th>Order Date</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>';
                        
                            require_once('DataFetchers/mysql_connect.php');
                            $query = "SELECT j.order_number, o.order_date FROM joborderfabrication j JOIN orders o ON j.order_number = o.ordernumber WHERE o.fab_status = 'For Approval'";
                            $result=mysqli_query($dbc,$query);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                            {

                                    echo '<tr>';
                                    echo '<td>';
                                    echo $row['order_number'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row['order_date'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo '</td>';
                                    echo '</tr>';
                                    
                            } 
                     echo '</tbody>';
                    echo '</table>';
                        
                             echo '</div>
                        </div>
                      </div>';
                    
                        
                     
                    }
                 
                 if($user == 'INV' || $user == 'CEO' || $user == 'Superuser')
                 {
                    
                        //RECOMMEND INVENTORY DISCOUNT
                 
                        echo '<div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="x_panel">
                                      <h2><center><i class="fa fa-percent"></i><b>  RECOMMENDED ITEMS FOR DISCOUNT</b></h2>
                                    <div class="clearfix"></div>
                                  <div class="x_content">

                                    <table class="table table-bordered">
                                      <thead>
                                        <tr>
                                          <th>SKU</th>
                                          <th>Item Name</th>
                                          <th>Last Update</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>';
                        
                            require_once('DataFetchers/mysql_connect.php');
                            $query = "SELECT * from items_trading WHERE DATEDIFF(NOW(), last_update) / 31 > 6";
                            $result=mysqli_query($dbc,$query);
                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                            {

                                    echo '<tr>';
                                    echo '<td>';
                                    echo $row['sku_id'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row['item_name'];
                                    echo '</td>';
                                    echo '<td>';
                                    echo $row['last_update'];
                                    echo '</td>';
                                    echo '<td><center><a href ="EditInventory.php?sku_id='.$row['sku_id'].' & item_id='.$row['item_id'].'" onclick = "teit()"class=""><button class="btn btn-info">Place Discount</button></a></center></td>';
                                    echo '</tr>';
                                    
                            } 
                     echo '</tbody>';
                    echo '</table>';
                        
                             echo '</div>
                        </div>
                      </div>';
                    
                        
                     
                    }
            ?>

              

              <div class="clearfix"></div>


            </div>
        
           </div>
          </div>
    
          <br>
          <div class="row">
            
   

           
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        
        <!-- /footer content -->
      </div>
    </div>

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
    <!-- FullCalendar -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/fullcalendar/dist/fullcalendar.min.js"></script>
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

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- Custom Fonts -->
    <style>
        
        @font-face {
        font-family: "Couture Bold";
        src: url("css/fonts/couture-bld.otf");
        }
        
        h2 {
            font-family: 'COUTURE Bold', Arial, sans-serif;
            font-weight:normal;
            font-style:normal;
            font-size: 25px;
            color: #1D2B51;
            }
        button {
            font-family: 'COUTURE Bold', Arial, sans-serif;
            font-weight:normal;
            font-style:normal;
            font-size: 10px;
            }

    </style>    
	
  </body>
</html>
