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
                    <h1><font size = "6px"> Damaged Items Report as of: 

                    <div id="report_range" class="btn btn-primary btn-lg" >
                          <span></span> <b class="caret"></b>      
                    </div>

                    <!-- <button type="submit" class="btn btn-primary btn-lg" style="float: right;"  data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-filter"></i> Filter this Report</button> -->
                  </font></h1>



                    <?php 
                       
                        $sqlToViewTotalLoss = "SELECT SUM(total_loss) AS accumulated_loss FROM damage_item";
                        $resultOfSqlTotalLoss =  mysqli_query($dbc,$sqlToViewTotalLoss);
                        while($rowTotalLoss=mysqli_fetch_array($resultOfSqlTotalLoss,MYSQLI_ASSOC))
                        {
                    ?>
                    
                        <label id ="total_loss"><b><font color = "black" size = "5px">Current Report - Total Losses: [ <?php echo '₱ '."".number_format($rowTotalLoss['accumulated_loss'], 2);?> ]</font></b></label>
                    <?php
                        }
                    ?>
                    
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Item Name Reference</th>
                          <th>Damaged Percentage</th>
                          <th>Item Quantity</th>
                          <th>Loss per Item</th>
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
                            echo '<td>';
                            echo $row['damage_percentage'],"%";
                            echo '</td>';
                            echo '<td>';
                            echo $row['item_quantity'];
                            echo '</td>';
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
          
          var start = moment("2019-01-01 00:00:00");
          var end = moment("2019-01-31 00:00:00");

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
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
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

          var current_data_from_table = formatNumber(getTable.column(3,{'search': 'applied'}).data());  //Applies the searched version of the table to get the column data to sum the total Loss of the current report
          var sum = 0;

          for(var i = 0; i < current_data_from_table.length; i++)
          {
            sum = sum +parseFloat(current_data_from_table[i]);
          }      
         
          total_amt_label.innerHTML = '<b><font color = "black" size = "5px">Current Report - Total Losses: [ ₱ '+Number(parseFloat(sum).toFixed(2)).toLocaleString('en', {minimumFractionDigits: 2})+' ]</font></b>';
          $.fn.dataTable.ext.search.pop();//Pops the function
          
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
  </body>
</html>
