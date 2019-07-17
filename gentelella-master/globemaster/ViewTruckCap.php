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
            ?>
            <!-- Compute current week -->

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title col-md-12">
                      <div class="form-group">
                        <!-- CLICK ARROWS FOR NEXT WEEK/PREVIOUS WEEK -->
                        <font size = "4" color = "green"><center> 
                          <a href="<?php echo $_SERVER['PHP_SELF'].'?week='.($week-1).'&year='.$year; ?>">
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
                          <th></th>
                          <?php 
                            do {
                              echo "<th date_id = ". $dt->format('Y-m-d')." >" . $dt->format('l') . " | " . $dt->format('F d, Y') . "</td>\n";
                              $dt->modify('+1 day');
                            } while ($week == $dt->format('W') && $dt->format('l') != "Sunday");
                          ?>
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                           
                           
                            $BULK_DATE_ARRAY = array();
                            $TRUCK_PLATE_ARRAY = array();
                            $TRUCK_CAP_ARRAY = array();
                            $TRUCK_STATIC_CAP = array();

                            $querytogetDBTable = "SELECT * FROM trucktable";
                            $resultofQuery =  mysqli_query($dbc, $querytogetDBTable);
                            while($rowofResult=mysqli_fetch_array($resultofQuery,MYSQLI_ASSOC))
                            {
                             
                              $TRUCK_STATIC_CAP[] = $rowofResult['weightCap'];
                              echo " <tr>";
                                echo '<td value="',$rowofResult['truckplate'],'"  "> ';            
                                echo $rowofResult['truckmodel']." | ".$rowofResult['truckplate'];
                                echo '</td>';  
                                echo '<td align = "right">';
                                // echo '350kg out of 2500kg | <font color = "#42d9f4">'.$rowofResult['weightCap'].' kg available</font>';
                                echo $rowofResult['weightCap'];
                                echo '</td>'; 
                                echo '<td align = "right">';
                                echo $rowofResult['weightCap'];
                                echo '</td>';  
                                echo '<td align = "right">';
                                echo $rowofResult['weightCap'];
                                echo '</td>';  
                                echo '<td align = "right">';
                                echo $rowofResult['weightCap'];
                                echo '</td>';  
                                echo '<td align = "right">';
                                echo $rowofResult['weightCap'];
                                echo '</td>';  
                                echo '<td align = "right">';
                                echo $rowofResult['weightCap'];
                                echo '</td>';                              
                              echo "</tr>";                                                        
                              
                            };                            
                            
                            // $start_date = date_range here
                            // $end_date = 
                            // $date_range =
                            // []                            
                            // $trucks = get all trucks
                            // $truck_names
                            // $truck_array =();
                            // foreach trucks(){
                            //   $tem-array = []
                            //   foreach date in daterange{
                            //     $temp-array.add(  select * from bulkdelivery truck = truck and date == date *from url)
                            //   }
                            //   truck_array.add($temp_array)
                            // }

                            // <tr>
                            // <th>truck_name</>
                            // foreach(date_rate as date){
                            //   <th>$date</th>
                            // }
                            // </tr> 
                            // for($i;$i<truck_array.size;$i++){
                            //   <td>$trucks_names[i]</td>
                            //   $foreach($truck_array[i] as truck_array_entry){
                            //     <td>$truck_array_entry</td>
                            //   }
                            // }     
                            // </tr>
                              $GET_BULK_CAP = "SELECT * FROM bulk_order";
                            $RESULT_BULK_CAP = mysqli_query($dbc, $GET_BULK_CAP);;
                            while($ROW_RESULT_BULK_CAP = mysqli_fetch_array($RESULT_BULK_CAP,MYSQLI_ASSOC))
                            {
                              $BULK_DATE_ARRAY[] = $ROW_RESULT_BULK_CAP['bulk_order_date'];
                              $TRUCK_CAP_ARRAY[]=$ROW_RESULT_BULK_CAP['current_truck_cap'];
                              $TRUCK_PLATE_ARRAY[]=$ROW_RESULT_BULK_CAP['truck_assigned'];
                            }
                            echo "<script>";
                            echo "var TRUCK_PLATE = [];";
                            echo "var CURRENT_WEEK = [];";

                            echo "var BULK_DATE = ".json_encode($BULK_DATE_ARRAY).";"; 
                            echo "var TRUCK_CAP = ".json_encode($TRUCK_CAP_ARRAY).";";
                            echo "var TRUCK_PLATE_DB = ".json_encode($TRUCK_PLATE_ARRAY).";";
                            echo "var TRUCK_STATIC_CAP = ".json_encode($TRUCK_STATIC_CAP).";";  

                            echo "$('#datatable-responsive tbody tr td[value]').each(function(){ ";
                              echo "TRUCK_PLATE.push($(this).attr('value'));";
                              // echo "console.log($(this).attr('value'));";                                            

                            echo '});';  // End Jquery Each TD 

                            // echo "$('#datatable-responsive th[date_id]').each(function(index){ ";
                            //   echo "CURRENT_WEEK.push($(this).attr('date_id'));";
                            //   echo "var LENGTH = BULK_DATE.length -1;";
                            //   echo "if(BULK_DATE[index] == $(this).attr('date_id')){";
                            //     echo "console.log(BULK_DATE[index]);";
                            //     echo "return true;";                               
                            //   echo"}";//END IF
                              
                            // echo '});';  // End Jquery Each TH 
                           
                           
                            // echo "for(var i = 0; i < CURRENT_WEEK.length; i++){";                                                      

                             
                              
                            //     // echo "console.log(TRUCK_CAP[i]);";
                            //     // echo "$('<td align = right>'+TRUCK_CAP[i]+'</td>').appendTo('#datatable-responsive tbody tr');";
                            //     echo "if(BULK_DATE[i].value == CURRENT_WEEK[i].value && TRUCK_PLATE[i].value == TRUCK_PLATE_DB[i].value){";
                            //       echo "$('#datatable-responsive tbody tr td:nth-child('+i+'):not(:first-child)').each(function(i){";
                                    
                            //         echo "$(this).text(TRUCK_CAP[i]);";
                                  
                            //       echo "});"; //End Each nth-child
                            //     echo '}';//End if 
                                
                            //     echo "else{";
                            //       echo "$('<td align =right>TRUCK_STATIC_CAP[i]</td>').appendTo('#datatable-responsive tbody tr');";
                            //     echo "}";//End Else
                                                                                                                                                  
                            // echo "}"; //End For
                            echo "</script>";  

                          
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
                        $SQL_GET_BULK_ORDER = "SELECT * FROM bulk_order";
                        $RESULT_GET_BULK_ORDER = mysqli_query($dbc,$SQL_GET_BULK_ORDER);
                        while($ROW_GET_BULK_ORDER = mysqli_fetch_array($RESULT_GET_BULK_ORDER,MYSQLI_ASSOC))
                        {
                          echo '<tr>';
                          echo '<td bd_id = '.$ROW_GET_BULK_ORDER['bulk_order_id'].'> B.D - '.$ROW_GET_BULK_ORDER['bulk_order_id'].'</td>'; 
                          echo '<td>'.$ROW_GET_BULK_ORDER['bulk_order_date'].'</td>';                         
                          echo '<td>'.$ROW_GET_BULK_ORDER['truck_assigned'].'</td>'; 
                          echo '<td>'.$ROW_GET_BULK_ORDER['bulk_order_status'].'</td>'; 
                          echo '<td></td>'; 
                          echo '<td></td>'; 
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

    <script>
// var current_length = $('#datatable-responsive th[date_id]').length;
// $('#datatable-responsive th[date_id]').each(function(index){ 
    
    
//     if($(this).attr('date_id')==BULK_DATE[index])
//     {
     
//       $('#datatable-responsive tbody tr td[value]').each(function(e){
//         if($(this).attr('value')==TRUCK_PLATE_DB[e])
//         {
          
//           var table = $("#datatable-responsive")[0];
//           var cell = table.rows[e+1].cells[index];
//           cell.innerHTML = TRUCK_CAP[e];

//         }
//       })
//       return true;                              
//     }//END IF
//      CURRENT_WEEK.push($(this).attr('date_id'));
//   }); // End Jquery Each TH 
var CURRENT_WEEK = [];
$('#datatable-responsive th[date_id]').each(function(index){ 
  CURRENT_WEEK.push($(this).attr('date_id'));
 
  if(BULK_DATE[index] == $(this).attr('date_id')){
    console.log(BULK_DATE[index]);
    return true;                               
  }//END IF
  
});  // End Jquery Each TH   

$.each( BULK_DATE, function( key, value ) {
    var index = $.inArray( value, CURRENT_WEEK );
    if( index != -1 ) {
        console.log( index );
    }
});
for(var i = 0; i < CURRENT_WEEK.length; i++)
{
  for(var j = 0; j < TRUCK_PLATE.length; j++)
  {
     if(BULK_DATE[j].value == CURRENT_WEEK[i].value && TRUCK_PLATE[j].value == TRUCK_PLATE_DB[j].value)
     {
       console.log("DB TP: "+ TRUCK_PLATE_DB[j]);
       console.log("HTML TP: "+ TRUCK_PLATE[j]);
      var table = $("#datatable-responsive tbody")[0];
      var cell = table.rows[i+1].cells[j+1];
      cell.innerHTML = TRUCK_CAP[j];
     }
   
  } //END 2nd FOR        
} //END 1st FOR

  </script>                

  

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