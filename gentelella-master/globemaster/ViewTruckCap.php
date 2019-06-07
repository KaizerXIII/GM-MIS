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

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title col-md-12">
                      <div class="form-group">
                        <!-- CLICK ARROWS FOR NEXT WEEK/PREVIOUS WEEK -->
                        <font size = "4" color = "green"><center><i class="fa fa-arrow-left fa-lg"></i> For the week of 06/12/19 - 06/19/19 <i class="fa fa-arrow-right fa-lg"></i></center></font>
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
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                               <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                  </div>
                  <div>
                  <button type="button" class="btn btn-primary">Refresh</button>
                  </div>
                  </div>
                  <!-- END DATE PICKER -->
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th></th>
                          <th>Monday | 01/01/19</th>
                          <th>Tuesday </th>
                          <th>Wednesday |</th>
                          <th>Thursday |</th>
                          <th>Friday |</th>                                                   
                          <th>Saturday |</th>
                          <!-- <th></th> -->
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                            require_once('DataFetchers/mysql_connect.php');

                            $querytogetDBTable = "SELECT * FROM trucktable";
                            $resultofQuery =  mysqli_query($dbc, $querytogetDBTable);
                            $count = 0;
                            $postmalone;
                            while($rowofResult=mysqli_fetch_array($resultofQuery,MYSQLI_ASSOC))
                            {

                              echo " <tr>";
                                echo '<td value="',$rowofResult['truckplate'],'"  "> ';            
                                echo $rowofResult['truckmodel']." | ".$rowofResult['truckplate'];
                                echo '</td>';  
                                echo '<td align = "right">';
                                echo '350kg out of 2500kg | <font color = "#42d9f4">2150kg available</font>';
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
                                // echo '<td align = "center">';
                                // echo '<a href ="Delivery Receipt.php?deliver_number='.$rowofResult['delivery_Receipt'].'&order_number='.$rowofResult['ordernumber'].' "> <i class="fa fa-wrench"></i> </a>';
                                // echo '</td>';
                              echo "</tr>";
                              $count++;
                              
                                // if(isset($_POST["delivrow".$count ]))
                                // {
                                //   echo $_POST["delivrow".$count ];  
                                // }
                                // $_SESSION['GET_DEV'] = "delivrow".$count;
                              // echo $_POST["delivRow',$count,'"];
                            };
                          ?>
                        </tr>
                        
                      </tbody>
                    </table>
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
        format: 'DD.MM.YYYY'
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