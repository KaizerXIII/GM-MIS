<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Damaged Items Report</title>

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
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- CDN FOR SUM() -->
    <!-- <script src="https://cdn.datatables.net/plug-ins/1.10.19/api/sum().js" type="text/javascript"></script> -->
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <font color = "black">
                  <h2><font size = "6px"> Filter damage source: 
                      <select type = "button" class = "btn btn-round btn-default" id="dmg_source" name = "dmg_source">
                            <option value="">All </option>
                                <?php
                                    require_once("print.php"); 
                                    require_once('DataFetchers/mysql_connect.php');
                                    $query = "SELECT * FROM damage_item GROUP by dmg_source";                                                       
                                    $resultofQuery =  mysqli_query($dbc, $query);

                                    while($row=mysqli_fetch_array($resultofQuery,MYSQLI_ASSOC))
                                    {
                                      echo '<option value="'.$row['dmg_source'].'">'.$row['dmg_source'].'</option> ';
                                    }

                                               
                                ?> <!-- PHP END [ Getting the Warehouses from DB ]-->    
                                <!-- <option value="All">All </option>                                                -->
                        </select>
                      </font></h2>

                      <div class="clearfix"></div>
                      <h2><font size = "6px"> Damaged items report as of: 

                      <div id="report_range" class="btn btn-default btn-round" >
                            <span></span> <b class="caret"></b>
                      </div></font>  

                      <!-- <button type="submit" class="btn btn-primary btn-lg" style="float: right;"  data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-filter"></i> Filter this Report</button> -->
                      </h2></font>
                      <br>

                      <!-- Bar Chart start -->
                      <?php
                          $SQL_GET_DMG_SOURCE_COUNT_DELIVERY = "SELECT COUNT(dmg_source) AS 'COUNTDAMAGESOURCEDELIVERY' FROM damage_item 
                                                        WHERE dmg_source = 'Delivery';";                                                       
                          $RESULT_GET_DMG_SOURCE_COUNT_DELIVERY =  mysqli_query($dbc, $SQL_GET_DMG_SOURCE_COUNT_DELIVERY);
                          $ROW_GET_COUNTED_DAMAGE_SOURCE_DELIVERY = mysqli_fetch_array($RESULT_GET_DMG_SOURCE_COUNT_DELIVERY,MYSQLI_ASSOC);

                          $SQL_GET_DMG_SOURCE_COUNT_CUSTOMER = "SELECT COUNT(dmg_source) AS 'COUNTDAMAGESOURCECUSTOMER' FROM damage_item 
                                                        WHERE dmg_source = 'Customer';";                                                       
                          $RESULT_GET_DMG_SOURCE_COUNT_CUSTOMER =  mysqli_query($dbc, $SQL_GET_DMG_SOURCE_COUNT_CUSTOMER);
                          $ROW_GET_COUNTED_DAMAGE_SOURCE_CUSTOMER = mysqli_fetch_array($RESULT_GET_DMG_SOURCE_COUNT_CUSTOMER,MYSQLI_ASSOC);
                          
                          $SQL_GET_DMG_SOURCE_COUNT_EMPLOYEE = "SELECT COUNT(dmg_source) AS 'COUNTDAMAGESOURCEEMPLOYEE' FROM damage_item 
                                                        WHERE dmg_source = 'Employee';";                                                       
                          $RESULT_GET_DMG_SOURCE_COUNT_EMPLOYEE =  mysqli_query($dbc, $SQL_GET_DMG_SOURCE_COUNT_EMPLOYEE);
                          $ROW_GET_COUNTED_DAMAGE_SOURCE_EMPLOYEE = mysqli_fetch_array($RESULT_GET_DMG_SOURCE_COUNT_EMPLOYEE,MYSQLI_ASSOC);

                          $SQL_GET_DMG_SOURCE_COUNT_FABRICATION = "SELECT COUNT(dmg_source) AS 'COUNTDAMAGESOURCEFABRICATION' FROM damage_item 
                                                        WHERE dmg_source = 'Fabrication';";                                                       
                          $RESULT_GET_DMG_SOURCE_COUNT_FABRICATION =  mysqli_query($dbc, $SQL_GET_DMG_SOURCE_COUNT_FABRICATION);
                          $ROW_GET_COUNTED_DAMAGE_SOURCE_FABRICATION = mysqli_fetch_array($RESULT_GET_DMG_SOURCE_COUNT_FABRICATION,MYSQLI_ASSOC);

                          $SQL_GET_DMG_SOURCE_COUNT_SHIPMENT = "SELECT COUNT(dmg_source) AS 'COUNTDAMAGESOURCESHIPMENT' FROM damage_item 
                                                        WHERE dmg_source = 'Supplier Shipment';";                                                       
                          $RESULT_GET_DMG_SOURCE_COUNT_SHIPMENT =  mysqli_query($dbc, $SQL_GET_DMG_SOURCE_COUNT_SHIPMENT);
                          $ROW_GET_COUNTED_DAMAGE_SOURCE_SHIPMENT = mysqli_fetch_array($RESULT_GET_DMG_SOURCE_COUNT_SHIPMENT,MYSQLI_ASSOC);

                          $SQL_GET_DMG_SOURCE_COUNT_ENVIRONMENTAL = "SELECT COUNT(dmg_source) AS 'COUNTDAMAGESOURCEENVIRONMENTAL' FROM damage_item 
                                                        WHERE dmg_source = 'Environmental';";                                                       
                          $RESULT_GET_DMG_SOURCE_COUNT_ENVIRONMENTAL =  mysqli_query($dbc, $SQL_GET_DMG_SOURCE_COUNT_ENVIRONMENTAL);
                          $ROW_GET_COUNTED_DAMAGE_SOURCE_ENVIRONMENTAL = mysqli_fetch_array($RESULT_GET_DMG_SOURCE_COUNT_ENVIRONMENTAL,MYSQLI_ASSOC);

                          $DMGSRC = array($ROW_GET_COUNTED_DAMAGE_SOURCE_DELIVERY['COUNTDAMAGESOURCEDELIVERY'], $ROW_GET_COUNTED_DAMAGE_SOURCE_CUSTOMER['COUNTDAMAGESOURCECUSTOMER'],
                            $ROW_GET_COUNTED_DAMAGE_SOURCE_EMPLOYEE['COUNTDAMAGESOURCEEMPLOYEE'], $ROW_GET_COUNTED_DAMAGE_SOURCE_FABRICATION['COUNTDAMAGESOURCEFABRICATION'],
                            $ROW_GET_COUNTED_DAMAGE_SOURCE_SHIPMENT['COUNTDAMAGESOURCESHIPMENT'], $ROW_GET_COUNTED_DAMAGE_SOURCE_ENVIRONMENTAL['COUNTDAMAGESOURCEENVIRONMENTAL']);

                          // print_r($DMGSRC);

                          // json_encode($DMGSRC);
                      ?> 
                      <div class = "col-md-8 col-sm-8 col-xs-12 col-md-offset-2 col-sm-offset-2">
                        <canvas id="DamageSourceChart" width="250" height="90"></canvas>
                      </div>
                      <!-- Bar Chart End -->
                      <div class = "clearfix"></div>
                      


                      <?php 
                        
                          $sqlToViewTotalLoss = "SELECT SUM(total_loss) AS accumulated_loss FROM damage_item";
                          $resultOfSqlTotalLoss =  mysqli_query($dbc,$sqlToViewTotalLoss);
                          while($rowTotalLoss=mysqli_fetch_array($resultOfSqlTotalLoss,MYSQLI_ASSOC))
                          {
                      ?>

                          <label id ="total_loss" ><b><font color = "black" size = "5px">Current Report - Total Losses: [ <?php echo '₱ '."".number_format($rowTotalLoss['accumulated_loss'], 2);?> ]</font></b></label>
                          <br>
                      <?php
                          }
                      ?>
                      <?php
                        $SQL_SUM_DMG_CUS = "SELECT SUM(total_loss) as TOTAL_CUS_LOSS FROM damage_item WHERE dmg_source = 'Customer';";
                        $RESULT_SUM_DMG_CUS =  mysqli_query($dbc, $SQL_SUM_DMG_CUS);
                        $ROW_RESULT_SUM_DMG_CUS =  mysqli_fetch_array($RESULT_SUM_DMG_CUS,MYSQLI_ASSOC);

                        $SQL_SUM_DMG_DEV = "SELECT SUM(total_loss) as TOTAL_LOSS FROM damage_item WHERE dmg_source = 'Delivery';";
                        $RESULT_SUM_DMG_DEV =  mysqli_query($dbc, $SQL_SUM_DMG_DEV);
                        $ROW_RESULT_SUM_DMG_DEV =  mysqli_fetch_array($RESULT_SUM_DMG_DEV,MYSQLI_ASSOC);

                        $SQL_SUM_DMG_EMP = "SELECT SUM(total_loss) as TOTAL_LOSS FROM damage_item WHERE dmg_source = 'Employee';";
                        $RESULT_SUM_DMG_EMP =  mysqli_query($dbc, $SQL_SUM_DMG_EMP);
                        $ROW_RESULT_SUM_DMG_EMP =  mysqli_fetch_array($RESULT_SUM_DMG_EMP,MYSQLI_ASSOC);

                        $SQL_SUM_DMG_FAB = "SELECT SUM(total_loss) as TOTAL_LOSS FROM damage_item WHERE dmg_source = 'Fabrication';";
                        $RESULT_SUM_DMG_FAB =  mysqli_query($dbc, $SQL_SUM_DMG_FAB);
                        $ROW_RESULT_SUM_DMG_FAB =  mysqli_fetch_array($RESULT_SUM_DMG_FAB,MYSQLI_ASSOC);

                        $SQL_SUM_DMG_ENV = "SELECT SUM(total_loss) as TOTAL_LOSS FROM damage_item WHERE dmg_source = 'Environmental';";
                        $RESULT_SUM_DMG_ENV =  mysqli_query($dbc, $SQL_SUM_DMG_ENV);
                        $ROW_RESULT_SUM_DMG_ENV =  mysqli_fetch_array($RESULT_SUM_DMG_ENV,MYSQLI_ASSOC);

                        $SQL_SUM_DMG_SUP = "SELECT SUM(total_loss) as TOTAL_LOSS FROM damage_item WHERE dmg_source = 'Supplier Shipment';";
                        $RESULT_SUM_DMG_SUP =  mysqli_query($dbc, $SQL_SUM_DMG_SUP);
                        $ROW_RESULT_SUM_DMG_SUP =  mysqli_fetch_array($RESULT_SUM_DMG_SUP,MYSQLI_ASSOC);
                      ?>
                          <label id ="customer_loss" ><b><font color = "black" size = "4px">Customer Losses:</font> <font color = "red" size = "4px"><?php echo '₱ '."".number_format($ROW_RESULT_SUM_DMG_CUS['TOTAL_CUS_LOSS'], 2); ?> </font></b></label>
                          <br>
                          <label id ="delivery_loss" ><b><font color = "black" size = "4px">Delivery Losses:</font> <font color = "red" size = "4px"><?php echo '₱ '."".number_format($ROW_RESULT_SUM_DMG_DEV['TOTAL_LOSS'], 2); ?></font></b></label>
                          <br>
                          <label id ="employee_loss" ><b><font color = "black" size = "4px">Employee Losses:</font> <font color = "red" size = "4px"><?php echo '₱ '."".number_format($ROW_RESULT_SUM_DMG_EMP['TOTAL_LOSS'], 2); ?></font></b></label>
                          <br>
                          <label id ="environ_loss" ><b><font color = "black" size = "4px">Environmental Losses:</font> <font color = "red" size = "4px"><?php echo '₱ '."".number_format($ROW_RESULT_SUM_DMG_ENV['TOTAL_LOSS'], 2); ?></font></b></label>
                          <br>
                          <label id ="fab_loss" ><b><font color = "black" size = "4px">Fabrication Losses:</font> <font color = "red" size = "4px"><?php echo '₱ '."".number_format($ROW_RESULT_SUM_DMG_FAB['TOTAL_LOSS'], 2); ?></font></b></label>
                          <br>
                          <label id ="supplier_loss" ><b><font color = "black" size = "4px">Supplier Shipment Losses:</font> <font color = "red" size = "4px"><?php echo '₱ '."".number_format($ROW_RESULT_SUM_DMG_SUP['TOTAL_LOSS'], 2); ?></font></b></label>
                          

                    
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Item Name Reference</th>
                          <!-- <th>Damaged Percentage</th> -->
                          <th>Item Quantity</th>
                          <th>Source of Damage</th>
                          <th>Total Loss</th>
                          <th>Date Occured </th>
                         
                        </tr>
                      </thead>


                      <tbody>
                       <?php 
                       
                        $sqlToView = "SELECT * FROM damage_item ORDER BY total_loss DESC";
                        $resultOfSql =  mysqli_query($dbc,$sqlToView);
                        while($row=mysqli_fetch_array($resultOfSql,MYSQLI_ASSOC))
                        {
                          echo '<tr>';
                            echo '<td>';
                            echo $row['item_name'];
                            echo '</td>';
                            // echo '<td align = "right">';
                            // echo $row['damage_percentage'],"%";
                            // echo '</td>';
                            echo '<td align = "right">';
                            echo $row['item_quantity'];
                            echo '</td>';
                            echo '<td>'.$row['dmg_source'].'</td>';
                            echo '<td align = "right">';
                            echo '₱'." ".number_format($row['total_loss'], 2);
                            echo '</td>';
                            echo '<td>';
                            echo $row['last_update'];
                            echo '</td>';
                          echo '</tr>';
                        }

                       ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          <!-- top tiles -->
          <div class="row tile_count">
           


          
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

    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <!-- <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script> -->
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

    <div id = "gmlogo" class = "gmlogo">
      <img src = "images/GM%20LOGO" width = "80px" height = "80px">GM LOGO HERE
      <span id = "username"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'] ?></span>
    </div>

    <!-- Modal Input Buton Toggles -->
    <!-- <script>
            var reportfilterlabel = document.getElementById("reportfilterlabel");
            var reportfilterlabelVal = reportfilterlabel.value;
            
            var yearly = document.getElementById("yearly");
            var monthyear = document.getElementById("monthyear");
            

            var yearpicker = document.getElementById("yearpicker");
            var monthyearpicker = document.getElementById("monthyearpicker");
            var reportrangepicker = document.getElementById("reportrangepicker");
            
            function changepickers(obj)
            {
              // reportfilterlabel.value = "";
              // alert(reportfilterlabelVal);
              console.log(obj.value);
              if(obj.value == "yearly")
              {
                yearpicker.style.display = "block";
                monthyearpicker.style.display = "none";
                reportrangepicker.style.display = "none";
              }
              else if(obj.value == "monthyear")
              {
                monthyearpicker.style.display = "block";
                yearpicker.style.display = "none";
                reportrangepicker.style.display = "none";
              }
              else if(obj.value == "datepick")
              {
                reportrangepicker.style.display = "block";
                yearpicker.style.display = "none";
                monthyearpicker.style.display = "none";
              }
            }
            
    </script> -->

    <script>
                        
        $(document).ready(function() {
          

        $(function() {
          var current_time = moment().valueOf();
          var start = moment("2019-01-01 00:00:00");
          var end = moment(current_time);

          function cb(start, end) {
            $('#report_range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          }

          $('#report_range').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
          }, cb);

          cb(start, end);

        });

        $('#report_range').on('apply.daterangepicker', function(ev, picker) { //Applies the changes on the Datepicker
          var start = picker.startDate;
          var end = picker.endDate;
          
          var getTable = $('#datatable-buttons').DataTable();
          var total_amt_label = document.getElementById('total_loss');
          var customer_loss_label = document.getElementById('customer_loss');
          var delivery_loss_label = document.getElementById('delivery_loss');
          var employee_loss_label = document.getElementById('employee_loss');
          var environ_loss_label = document.getElementById('environ_loss');
          var fab_loss_label = document.getElementById('fab_loss');
          var supplier_loss_label = document.getElementById('supplier_loss');

          $.fn.dataTable.ext.search.push( //Checks all the dates between start and end then pushes it to array
            function(settings, data, dataIndex) 
            {
              var min = start;
              var max = end;
              var startDate = new Date(data[4]); //gets the date in the specific col of the table
              
              if (min == null && max == null) {
                return true;
              }
              if (min == null && startDate <= max) {
                return true;
              }
              if (max == null && startDate >= min) {
                return true;
              }
              if (startDate <= max && startDate >= min) {
                return true;
              }
              return false;
            }
          );
          getTable.draw(); //Draws table based on the dates between start and end compared to the column 
          console.log(formatNumber(getTable.column(3,{'search': 'applied'}).data()));
          console.log(getTable.column(2,{'search': 'applied'}).data());
          var current_data_from_table = formatNumber(getTable.column(3,{'search': 'applied'}).data());  //Applies the searched version of the table to get the column data to sum the total Loss of the current report
          var sum = 0;

          var dmg_source_from_table = getTable.column(2,{'search': 'applied'}).data(); 
          var customer_loss_sum = 0;
          var delivery_loss_sum = 0;
          var employee_loss_sum = 0;
          var environ_loss_sum = 0;
          var fab_loss_sum = 0;
          var supplier_loss_sum = 0;

          var cus_loss_cnt = 0;
          var del_loss_cnt = 0;
          var emp_loss_cnt = 0;
          var env_loss_cnt = 0;
          var fab_loss_cnt = 0;
          var sup_loss_cnt = 0;

          for(var i = 0; i < current_data_from_table.length; i++)
          {
            sum = sum +parseFloat(current_data_from_table[i]);    
          }

          for(var j = 0; j < dmg_source_from_table.length; j++)
          {
            if(dmg_source_from_table[j] == "Customer")
            {     
              customer_loss_sum = customer_loss_sum + parseFloat(current_data_from_table[j]);
              cus_loss_cnt = cus_loss_cnt + 1;
            }
            else if(dmg_source_from_table[j] == "Delivery")
            {
              delivery_loss_sum = delivery_loss_sum + parseFloat(current_data_from_table[j]);
              del_loss_cnt = del_loss_cnt + 1;
            }
            else if(dmg_source_from_table[j] == "Employee")
            {
              employee_loss_sum = employee_loss_sum + parseFloat(current_data_from_table[j]);
              emp_loss_cnt = emp_loss_cnt + 1;
            } 
            else if(dmg_source_from_table[j] == "Environmental")
            {
              environ_loss_sum = environ_loss_sum + parseFloat(current_data_from_table[j]);
              env_loss_cnt = env_loss_cnt + 1;
            } 
            else if(dmg_source_from_table[j] == "Fabrication")
            {
              fab_loss_sum = fab_loss_sum + parseFloat(current_data_from_table[j]);
              fab_loss_cnt = fab_loss_cnt + 1;
            } 
            else if(dmg_source_from_table[j] == "Supplier Shipment")
            {
              supplier_loss_sum = supplier_loss_sum + parseFloat(current_data_from_table[j]);
              sup_loss_cnt = sup_loss_cnt + 1;
            }    
             
          }
              
          total_amt_label.innerHTML = '<b><font color = "black" size = "5px">Current Report - Total Losses: [ ₱ '+Number(parseFloat(sum).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2})+' ]</font></b>';
          
          customer_loss_label.innerHTML = '<b><font color = "black" size = "4px">Customer Loss: </font><font color = "red" size = "4px"> ₱ '+Number(parseFloat(customer_loss_sum).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2})+'</font></b>';
          delivery_loss_label.innerHTML = '<b><font color = "black" size = "4px">Delivery Loss: </font><font color = "red" size = "4px"> ₱ '+Number(parseFloat(delivery_loss_sum).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2})+'</font>  </b>';
          employee_loss_label.innerHTML = '<b><font color = "black" size = "4px">Employee Loss: </font><font color = "red" size = "4px"> ₱ '+Number(parseFloat(employee_loss_sum).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2})+'</font>  </b>';
          environ_loss_label.innerHTML = '<b><font color = "black" size = "4px">Environmental Loss: </font><font color = "red" size = "4px"> ₱ '+Number(parseFloat(environ_loss_sum).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2})+'</font>  </b>';
          fab_loss_label.innerHTML = '<b><font color = "black" size = "4px">Fabrication Loss: </font><font color = "red" size = "4px"> ₱ '+Number(parseFloat(fab_loss_sum).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2})+'</font>  </b>';
          supplier_loss_label.innerHTML = '<b><font color = "black" size = "4px">Supplier Shipment Loss: </font><font color = "red" size = "4px"> ₱ '+Number(parseFloat(supplier_loss_sum).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2})+'</font>  </b>';
          
          $.fn.dataTable.ext.search.pop();//Pops the function

          var ctx = document.getElementById("DamageSourceChart");

          var damagesource = [cus_loss_cnt, del_loss_cnt,emp_loss_cnt,env_loss_cnt,fab_loss_cnt,sup_loss_cnt];    
          });//End function
        }); //END Document .ready
    </script>

    <script>
      function formatNumber(n) { //Removes the peso sign and comma to add the values properly
       for(var i = 0; i < n.length; i++)
       {
        n[i] = n[i].replace(/[₱,]+/g,"","");
       }
        return n ;
      }
    </script>

<script>  //Filter Table based on Damage type               
      var get_select_value = document.getElementById("dmg_source");
      var total_amt_label = document.getElementById('total_loss');
      get_select_value.onchange = function()
      {
        console.log(get_select_value.value); 
        var getTable = $('#datatable-buttons').DataTable();
        
        getTable.columns(2).search(get_select_value.value).draw();
        //Get the col of table and searches IF it contains the [VALUE] inside () then draws the table accordingly 

        var current_data_from_table = formatNumber(getTable.column(3,{'search': 'applied'}).data());  //Applies the searched version of the table to get the column data to sum the total Loss of the current report
          var sum = 0;

          for(var i = 0; i < current_data_from_table.length; i++)
          {
            sum = sum +parseFloat(current_data_from_table[i]);
          }      
         
          total_amt_label.innerHTML = '<b><font color = "black" size = "5px">Current Report - Total Losses: [ ₱ '+Number(parseFloat(sum).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2})+' ]</font></b>';
          
      }                                                                          
</script> 

<script>
/*!
 * Print button for Buttons and DataTables.
 * 2016 SpryMedia Ltd - datatables.net/license
 */

(function( factory ){
	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( ['jquery', 'datatables.net', 'datatables.net-buttons'], function ( $ ) {
			return factory( $, window, document );
		} );
	}
	else if ( typeof exports === 'object' ) {
		// CommonJS
		module.exports = function (root, $) {
			if ( ! root ) {
				root = window;
			}

			if ( ! $ || ! $.fn.dataTable ) {
				$ = require('datatables.net')(root, $).$;
			}

			if ( ! $.fn.dataTable.Buttons ) {
				require('datatables.net-buttons')(root, $);
			}

			return factory( $, root, root.document );
		};
	}
	else {
		// Browser
		factory( jQuery, window, document );
	}
}(function( $, window, document, undefined ) {
'use strict';
var DataTable = $.fn.dataTable;


var _link = document.createElement( 'a' );

/**
 * Convert a `link` tag's URL from a relative to an absolute address so it will
 * work correctly in the popup window which has no base URL.
 *
 * @param  {node}     el Element to convert
 */
var _relToAbs = function( el ) {
	var url;
	var clone = $(el).clone()[0];
	var linkHost;

	if ( clone.nodeName.toLowerCase() === 'link' ) {
		_link.href = clone.href;
		linkHost = _link.host;

		// IE doesn't have a trailing slash on the host
		// Chrome has it on the pathname
		if ( linkHost.indexOf('/') === -1 && _link.pathname.indexOf('/') !== 0) {
			linkHost += '/';
		}

		clone.href = _link.protocol+"//"+linkHost+_link.pathname+_link.search;
	}

	return clone.outerHTML;
};


DataTable.ext.buttons.print = {
	className: 'buttons-print',

	text: function ( dt ) {
		return dt.i18n( 'buttons.print', 'Print' );
	},

	action: function ( e, dt, button, config ) {
		var data = dt.buttons.exportData( config.exportOptions );
		var addRow = function ( d, tag ) {
			var str = '<tr>';

			for ( var i=0, ien=d.length ; i<ien ; i++ ) {
				str += '<'+tag+'>'+d[i]+'</'+tag+'>';
			}

			return str + '</tr>';
		};

		// Construct a table for printing
		var html = '<table class="'+dt.table().node().className+'">';

		if ( config.header ) {
			html += '<thead>'+ addRow( data.header, 'th' ) +'</thead>';
		}

		html += '<tbody>';
		for ( var i=0, ien=data.body.length ; i<ien ; i++ ) {
			html += addRow( data.body[i], 'td' );
		}
		html += '</tbody>';

		if ( config.footer && data.footer ) {
			html += '<tfoot>'+ addRow( data.footer, 'th' ) +'</tfoot>';
		}

		// Open a new window for the printable table
		var win = window.open( '', '' );
		var title = config.title;

		if ( typeof title === 'function' ) {
			title = title();
		}

		if ( title.indexOf( '*' ) !== -1 ) {
			title= title.replace( '*', $('title').text() );
		}

		win.document.close();

		// Inject the title and also a copy of the style and link tags from this
		// document so the table can retain its base styling. Note that we have
		// to use string manipulation as IE won't allow elements to be created
		// in the host document and then appended to the new window.
		var head = '<title>'+title+'</title>';
		$('style, link').each( function () {
			head += _relToAbs( this );
		} );

		//$(win.document.head).html( head );
    win.document.head.innerHTML = head; // Work around for Edge
    
    // $('#gmlogodiv').appendChild($('.gmlogo').children('img').clone());

    var printedby = document.getElementById("username").innerHTML;
    var daterange = document.getElementById("report_range").innerHTML;
    var newdate = new Date();

		// Inject the table and other surrounding information
		win.document.body.innerHTML =
        '<center><h1>GLOBE MASTER TRADING</h1></center>'+
        '<br>'+
        '<center>Damaged Items Report as of: '+daterange+'</center>'+
        '<center>Damaged Items Report</center>'+
        '<div>'+config.message+'</div>'+
        '<div align  "right"><b>Printed by: '+printedby+'</b></div>'+
        '<div align  "right"><b>Print Date: '+newdate+'</b></div>'+
			html;
		// $(win.document.body).html(
		// 	'<h1>'+title+'</h1>'+
		// 	'<div>'+config.message+'</div>'+
		// 	html
		// );

		if ( config.customize ) {
			config.customize( win );
		}

		setTimeout( function () {
			if ( config.autoPrint ) {
				win.print(); // blocking - so close will not
				win.close(); // execute until this is done
			}
		}, 250 );
	},

	title: '*',

	message: '',

	exportOptions: {},

	header: true,

	footer: false,

	autoPrint: true,

	customize: null
};


return DataTable.Buttons;
}));

</script>


<!-- Bar Chart Script -->

<script>
// Bar chart

var damagesource = <?php echo json_encode($DMGSRC); ?>;

console.log(damagesource);
  
        if ($('#DamageSourceChart').length ){ 
          
          var ctx = document.getElementById("DamageSourceChart");
          var DamageSourceChart = new Chart(ctx, {
        	type: 'bar',
        	data: {
        	  labels: ["Delivery", "Customer", "Employee", "Fabrication", "Supplier Shipment", "Environmental"],
        	  datasets: [{
        		label: 'Source of Damage',
        		backgroundColor: "#0066CC",
        		data: damagesource
        	  }]
        	},
  
        	options: 
            {
              scales: 
              {
                xAxes: 
                [
                  {
                    barPercentage: 0.4
                  }
                ],
                yAxes: 
                [{
                  ticks: 
                  {
                    beginAtZero: true
                  }
                }]
              }
            }
          });      
        } 
</script>
  </body>
</html>
