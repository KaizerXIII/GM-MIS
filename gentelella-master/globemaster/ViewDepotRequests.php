<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GM - View Depot Requests</title>

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

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
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
              <div>
                  <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">GLOBEMASTER DEPOT TILE REQUESTS</h1><br>
              </div>
            </div>
            <br><br><br><br>

              <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <!-- <p class="text-muted font-13 m-b-30">
                      
                        <button type="button" class="btn btn-success" onclick="window.location.href='newOrderForm.php'"><i class="fa fa-plus" onclick =""></i> Create Order </button>
                      
                    </p><br> -->
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Order Number</th>
                          <!-- <th>Client Name</th> -->
                          <th>Request Date</th>
                          <th>Expected Date</th>
                          <th>Total Amount</th>
                          <!-- <th>Payment Type</th> -->
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php                            
                            require_once('DataFetchers/mysql_connect.php');
                            $GET_DEPOT = "SELECT * 
                            FROM mydb.depot_request";                           
                            $RESULT_GET_DEPOT=mysqli_query($dbc,$GET_DEPOT);
                            while($ROW_RESULT_GET_DEPOT=mysqli_fetch_array($RESULT_GET_DEPOT,MYSQLI_ASSOC))
                            {                                                                   
                              echo '<tr>';
                                echo '<td> Depot OR - ';
                                echo $ROW_RESULT_GET_DEPOT['depot_request_id'];
                                echo '</td>';
                                echo '<td>';
                                echo $ROW_RESULT_GET_DEPOT['depot_request_date'];
                                echo '</td>';                                  
                                echo '<td align = right>';
                                echo $ROW_RESULT_GET_DEPOT['depot_expected_date'];
                                echo '</td>';
                                
                                echo '<td align = right>';
                                echo  '₱'." ".number_format($ROW_RESULT_GET_DEPOT['total_payment'], 2);
                                echo '</td>';
                                if($ROW_RESULT_GET_DEPOT['depot_request_status'] == "Order in Progress")
                                {                                
                                  echo '<td>';
                                  echo "<font color = orange>".$ROW_RESULT_GET_DEPOT['depot_request_status']."</font>";
                                  echo '</td>';
                                }
                                else if($ROW_RESULT_GET_DEPOT['depot_request_status'] == "Requisition Approved")
                                {
                                  echo '<td>';
                                  echo "<font color = green>".$ROW_RESULT_GET_DEPOT['depot_request_status']."</font>";
                                  echo '</td>';
                                }
                                else
                                {
                                  echo '<td>';
                                  echo "<font color = red>".$ROW_RESULT_GET_DEPOT['depot_request_status']."</font>";
                                  echo '</td>';
                                }
     
                                echo '<td align = "center">';
                                echo '<a href = "ViewDepotRequestDetails.php?depot_or='.$ROW_RESULT_GET_DEPOT['depot_request_id'].'"><i class="fa fa-wrench" ></a>'; 
                                echo '</td>';
                              
                              echo '</tr>';
                                    
                            }
                        ?>  
                      </tbody>
                    </table><br>
                    <div>
                        
                    </div>
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

  </body>
</html>