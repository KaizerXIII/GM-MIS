<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GM MIS | View Truck Capacity</title>
    <link rel="icon" type="image/ico" href="images/GM%20LOGO.png" />
    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
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
              
              $dto = new DateTime();


              $year1 = $dto->format('o');
              $week1 = $dto->format('W');



              // if(isset($_GET['startdate']) && isset($_GET['enddate']))
              // {
              // }
              // else
              // {

              // }
              // return $ret;

              


// echo "<script>console.log($r);</script>";
            // echo $ret['week_start'];
            ?>
      </div>
        <!-- page content -->
        <div class="right_col" role="main">
            <div class="page-title">
              <div>
                  <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">TRUCK CAPACITY</h1>
              </div>
            </div>
            <br><br><br><br>
            <div class="clearfix"></div>
            
            <?php
            

              $dt = new DateTime;
              if (isset($_GET['year']) && isset($_GET['week'])) {
                  $dt->setISODate($_GET['year'], $_GET['week']);
              } else {
                  $dt->setISODate($dt->format('o'), $dt->format('W'));
    
              }
              $year = $dt->format('o');
              $week = $dt->format('W');
              
              // $ret['week_start'] = $dt->setISODate($year, $week)->format('Y-m-d');
              // $ret['week_end'] = $dt->modify('+6 days')->format('Y-m-d');
              // $r = print_r($ret);

              // do {
              //   echo "<th date_id = ". $dt->format('Y-m-d')." >" . $dt->format('l') . " | " . $dt->format('F d, Y') . "</td>\n";
              //   $dt->modify('+1 day');
              // } while ($week == $dt->format('W') && $dt->format('l') != "Sunday");

              // while($week == $dt->format('W') && $dt->format('l') != "Sunday")
              // {
              //   $ctr = 0;
              //   $datearray = array();
              //   $datarraydata = $dt->format('Y-m-d');
              //   array_push($datearray, $datarraydata);
              //   echo "<script>console.log( $datearray[$ctr]);</script>";
              //   print_r($datearray);  
              //   echo $dt->format('l');
              //   $dt->modify('+1 day');
              //   $ctr++;
              // }
            ?>
            <!-- Compute current week -->

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title col-md-12">
                      <div class="form-group">
                        <!-- CLICK ARROWS FOR NEXT WEEK/PREVIOUS WEEK -->
                        <font size = "4" color = "green"><center> 
                          <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year;?>">
                          <i class="fa fa-arrow-left fa-lg"></i> Previous Week</a> <!--Previous week-->
                          For the week of:   <span id="first_date" style="color:green"> 
                        
                        <?php
                            // do {
                            //   if($dt->format('l') != "Sunday")
                            //   {
                            //     echo $dt->format('F d, Y');
                            //     $dt->modify('+1 day');
                            //   }
                            // } while ($week == $dt->format('W'));
                        ?>
                        </span>
                         To 
                         <span id="second_date" style="color:green">
                      
                      
                          </span>
                          <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week+1).'&year='.$year; ?>">Next Week  <!--Next week-->
                        <i class="fa fa-arrow-right fa-lg"></i> </a></center></font>
                      </div>
                 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                  <form method = "POST" action = "Delivery Receipt.php">

                  <!-- START DATE PICKER FOR WEEK FILTER -->
                  <div class = "col-md-12 col-sm-12 col-xs-12">
                  <div class = "col-md-2 col-sm-3 col-xs-12">
                  <font size = "5" color = "black">Show week of:</font>
                  </div>
                  <div class="form-group col-md-4 col-sm-4 col-xs-12">
                        <div class='input-group date' id='myDatepicker2'>
                            <input type='text' class="form-control" id = "current_date">
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                  </div>
                  <script>
                        var get_date = document.getElementById("current_date"); //Gets the date from datepicker
                          var set_date;
                          function refresh_date() 
                          {
                            var set_date = get_date.value;
                            
                            

                            var next_7_days = new Date(set_date);
                            alert(set_date);
                            
                            next_7_days.setDate(next_7_days.getDate() + 3);

                            var get_first_month = next_7_days.getMonth()+1  
                            var get_first_day = next_7_days.getDate()     
                            var get_first_year = next_7_days.getFullYear() 

                            var previous_7_days = new Date(set_date);
                            previous_7_days.setDate(previous_7_days.getDate() - 3);

                            var get_second_month = previous_7_days.getMonth()+1  
                            var get_second_day = previous_7_days.getDate()     
                            var get_second_year = previous_7_days.getFullYear() 

                            var first_date_string =  ('0' + get_first_month).slice(-2) +"-" +('0' + get_first_day).slice(-2) +"-" + get_first_year;
                            var second_date_string = ('0' + get_second_month).slice(-2) +"-" +('0' + get_second_day).slice(-2) +"-" + get_second_year;;

                            document.getElementById("first_date").innerHTML = second_date_string;

                            document.getElementById("second_date").innerHTML = first_date_string;
                          }

                          // function addDays = function(input_date) {
                          //     var next_7_days = new Date(input_date);
                          //     next_7_days.setDate(next_7_days.getDate() + 7);
                          //     return next_7_days;
                          // }
                        
                        
                         </script>

                  
                  <div>
                  <button type="button" class="btn btn-primary" onclick="refresh_date()" >Refresh</button>
                  </div>
                  </div>
                  <!-- END DATE PICKER -->

                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Truck List</th>
                          <?php 
                            // for($i = 0; $i <= sizeof($datearray); $i++)
                            // {
                            //   print_r($datearray);
                            //   echo "<th>". $datearray[$i] . "</th>\n";
                            // }
                            
                            $i = 0;
                            do {
                              // echo "<th date_id = ". $dt->format('Y-m-d')." >" . $dt->format('l') . " | " . $dt->format('F d, Y') . "</td>\n";
                              // for($i=0; $i<=6; $i++)
                              // {
                                
                                $DATES[$i] = $dt->format('Y-m-d');

                               
                                $i++;
                              // }
                              $dt->modify('+1 day');
                            } while ($week == $dt->format('W') && $dt->format('l') != "Sunday" && $i<7);
                            
                            foreach($DATES as $date){
                             
                              echo "<th date_id = ".$date.">".date('l F d, Y',strtotime($date))."</th>";
                             }
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                           
                            
                           print_r($DATES);

                          //  $_GET['startdate'] = $DATES[0];
                          //  $_GET['enddate'] = $DATES[5];
                            $BULK_DATE_ARRAY = array();
                            $TRUCK_PLATE_ARRAY = array();
                            $TRUCK_CAP_ARRAY = array();
                            $TRUCK_STATIC_CAP = array();

                            $TRUCKS_FROM_TRUCKTABLE = array();

                            $querytogetDBTable = "SELECT * FROM trucktable";
                            $resultofQuery =  mysqli_query($dbc, $querytogetDBTable);
                            while($rowofResult=mysqli_fetch_array($resultofQuery,MYSQLI_ASSOC))
                            {
                             
                              $TRUCK_STATIC_CAP[] = $rowofResult['weightCap'];
                              $TRUCKS_FROM_TRUCKTABLE[] = $rowofResult['truckplate'];
                              // echo " <tr>";
                              //   echo '<td value="',$rowofResult['truckplate'],'"  "> ';            
                              //   echo $rowofResult['truckmodel']." | ".$rowofResult['truckplate'];
                              //   echo '</td>';  
                              //   echo '<td align = "right">';
                              //   // echo '350kg out of 2500kg | <font color = "#42d9f4">'.$rowofResult['weightCap'].' kg available</font>';
                              //   echo $rowofResult['weightCap'];
                              //   echo '</td>'; 
                              //   echo '<td align = "right">';
                              //   echo $rowofResult['weightCap'];
                              //   echo '</td>';  
                              //   echo '<td align = "right">';
                              //   echo $rowofResult['weightCap'];
                              //   echo '</td>';  
                              //   echo '<td align = "right">';
                              //   echo $rowofResult['weightCap'];
                              //   echo '</td>';  
                              //   echo '<td align = "right">';
                              //   echo $rowofResult['weightCap'];
                              //   echo '</td>';  
                              //   echo '<td align = "right">';
                              //   echo $rowofResult['weightCap'];
                              //   echo '</td>';                              
                                                                                      
                              
                            }; 
                            $TRUCK_ARRAY = array();
                            foreach($TRUCKS_FROM_TRUCKTABLE as $truck_plate)
                            {
                              $TEMP_ARRAY = array();
                              foreach($DATES as $date)
                              {
                                $SQL_GET_TRUCK_FROM_BULK = "SELECT * FROM mydb.bulk_order
                                WHERE (truck_assigned = '$truck_plate' AND bulk_order_date = '$date')";
                                $RESULT_GET_TRUCK_FROM_BULK = mysqli_query($dbc, $SQL_GET_TRUCK_FROM_BULK);
                                $ROW_RESULT_GET = mysqli_fetch_assoc($RESULT_GET_TRUCK_FROM_BULK);

                                $TEMP_ARRAY[] = $ROW_RESULT_GET['current_truck_cap'];                                                           
                              }      
                              $TRUCK_ARRAY[] =  $TEMP_ARRAY;                     
                            }
                           
                            for($i=0; $i<sizeof($TRUCK_ARRAY);$i++){
                              echo "<tr>";
                              echo '<td>'.$TRUCKS_FROM_TRUCKTABLE[$i].'</td>';
                              foreach($TRUCK_ARRAY[$i] as $truck_array_entry){
                                echo '<td>'.$truck_array_entry.'</td>';
                                
                              }
                              echo "</tr>";
                            }     
                           
                            
                              $GET_BULK_CAP = "SELECT * FROM bulk_order";
                            $RESULT_BULK_CAP = mysqli_query($dbc, $GET_BULK_CAP);;
                            while($ROW_RESULT_BULK_CAP = mysqli_fetch_array($RESULT_BULK_CAP,MYSQLI_ASSOC))
                            {
                              $BULK_DATE_ARRAY[] = $ROW_RESULT_BULK_CAP['bulk_order_date'];
                              $TRUCK_CAP_ARRAY[]=$ROW_RESULT_BULK_CAP['current_truck_cap'];
                              $TRUCK_PLATE_ARRAY[]=$ROW_RESULT_BULK_CAP['truck_assigned'];
                            }
                           
                            
                          ?>
                        </tr>
                        
                      </tbody>
                    </table>

                    <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Deliveries Summary</h2>
    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                   
                  <form method = "POST" action = "Delivery Receipt.php">
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>B.D.</th>
                          <th>Delivery Date</th>                         
                          <th>Truck #</th>                                                 
                          <th>Delivery Status</th>
                          <th>Time Out</th>
                          <th>Time In</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <!-- Gawa nalang bagong table sa mysql for bulk orders para matrack time in and time out. tapos palagyan rin bagong column sa trucks table para malaman kung in or out yung truck. -->
                        <?php
                        $SQL_GET_BULK_ORDER = "SELECT * FROM bulk_order
                        JOIN trucktable
                        ON bulk_order.truck_assigned = trucktable.truckplate";
                        $RESULT_GET_BULK_ORDER = mysqli_query($dbc,$SQL_GET_BULK_ORDER);
                        while($ROW_GET_BULK_ORDER = mysqli_fetch_array($RESULT_GET_BULK_ORDER,MYSQLI_ASSOC))
                        {
                          echo '<tr>';
                          echo '<td bd_id = '.$ROW_GET_BULK_ORDER['bulk_order_id'].'> B.D - '.$ROW_GET_BULK_ORDER['bulk_order_id'].'</td>'; 
                          echo '<td>'.$ROW_GET_BULK_ORDER['bulk_order_date'].'</td>';                         
                          echo '<td>'.$ROW_GET_BULK_ORDER['truck_assigned'].'</td>'; 
                          echo '<td>'.$ROW_GET_BULK_ORDER['bulk_order_status'].'</td>'; 
                          echo '<td></td>';
                          if($ROW_GET_BULK_ORDER['Availability']== "Available")
                          {
                            echo '<td> 07:00:00 </td>';
                          }
                          else
                          {
                            echo '<td></td>';
                          } 
                           
                          echo '<td align = "center"><a><span class = "bulk_details"><i class = "fa fa-wrench"></i></a></span></td>';
                          echo '</tr>';
                        }

                        ?>
                      </tbody>
                    </table>
                    </form>
					<script>
            $('.bulk_details').on('click', function(e){
              var row = $(this).closest('tr');
              var current_id = row.find('td:first').attr('bd_id');
              window.location.href= "BulkDeliveryDetails.php?bulk_id="+current_id;
            })

          </script>
					
                  </div>
                </div>
              </div>
            </div>
                    </form>
					
					
                  </div>
                </div>
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
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
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
    <!-- bootstrap-datetimepicker -->    
    <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script> 

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
  
    <!-- Custom Fonts -->
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
    $('#myDatepicker').datetimepicker();
    
    $('#myDatepicker2').datetimepicker({
        format: 'MM-DD-YYYY'
    });
    
    $('#myDatepicker3').datetimepicker({
        format: 'hh:mm A'
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

  </body>
</html>