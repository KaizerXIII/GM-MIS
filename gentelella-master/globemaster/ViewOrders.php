<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GM - View Orders</title>

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
                  <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">GLOBEMASTER ORDERS</h1><br>
              </div>
            </div>
            <br><br><br><br>

              <div class="clearfix"></div>
              
              <div class="col-md-12 col-sm-12 col-xs-12">

                  <p class="text-muted font-13 m-b-30">
                      <button type="button" class="btn btn-success btn-lg" onclick="window.location.href='newOrderForm.php'"><i class="fa fa-plus" onclick =""></i> Create Order </button>
                  </p><br>
                <div class="x_panel">
                  <div class="x_content">

                  <!-- TABS -->
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><font color = "darkblue">Orders for Pickup</font></a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false"><font color = "skyblue">Orders for Delivery</font></a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content33" role="tab" id="profile-tabb3" data-toggle="tab" aria-controls="profile" aria-expanded="false"><font color = "green">Finished Orders</font></a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content44" role="tab" id="profile-tabb4" data-toggle="tab" aria-controls="profile" aria-expanded="false"><font color = "red">Cancelled Orders</font></a>
                        </li>
                      </ul>
                      <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Order Number</th>
                                <th>Client Name</th>
                                <th>Order Date</th>
                                
                                
                                <th>Payment Type</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                  
                                  require_once('DataFetchers/mysql_connect.php');
                                  $query = "SELECT * FROM orders 
                                              WHERE order_status = 'PickUp' ORDER BY orderID ASC;";
                                  $result=mysqli_query($dbc,$query);
                                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                  {
                                          $queryPaymentType = "SELECT paymenttype FROM ref_payment WHERE payment_id =" . $row['payment_id'] . ";";
                                          $resultPaymentType = mysqli_query($dbc,$queryPaymentType);
                                          $rowPaymentType=mysqli_fetch_array($resultPaymentType,MYSQLI_ASSOC);
                                          $paymentType = $rowPaymentType['paymenttype'];

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
                                          echo $row['order_date'];
                                          echo '</td>';
                                          // echo '<td>';
                                          
                                          // if($row['delivery_date'] == null || $row['delivery_date'] == "")
                                          // {
                                          //     echo '<button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus"></i> Set Delivery Date</button>';
                                          // }
                                          // else
                                          // {
                                              // echo $row['delivery_date'];
                                          // }
                                          // echo '</td>';
                                          
                                          echo '<td>';
                                          echo $paymentType;
                                          echo '</td>';
                                          echo '<td style="text-align:right;">';
                                          echo  '₱ '." ".number_format($row['totalamt'], 2);
                                          echo '</td>';
                                          if ($row['order_status'] == "Delivered")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-success btn-xs" disabled>Order Finished</button></td>'; 
                                          }
                                          else if ($row['order_status'] == "Cancelled")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-danger btn-xs" disabled>Order Cancelled</button></td>'; 
                                          }
                                          else if ($row['order_status'] == "PickUp")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-primary btn-xs" disabled>For Pickup</button></td>'; 
                                          }
                                          else
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-info btn-xs" disabled>For Delivery</button></td>'; 
                                          }
                                          echo '<td align="center">';
                                          echo '<a href ="ViewOrderDetails.php?order_number='.$row['ordernumber'].'"> <i class="fa fa-wrench"></i> </a>';
                                          echo '</td>';
                                          echo '</tr>';
                                          
                                  }
                              ?>  
                            </tbody>
                          </table><br>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Order Number</th>
                                <th>Client Name</th>
                                <th>Order Date</th>
                                
                                
                                <th>Payment Type</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                  
                                  require_once('DataFetchers/mysql_connect.php');
                                  $query = "SELECT * FROM orders 
                                              WHERE order_status = 'Deliver' ORDER BY orderID ASC;";
                                  $result=mysqli_query($dbc,$query);
                                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                  {
                                          $queryPaymentType = "SELECT paymenttype FROM ref_payment WHERE payment_id =" . $row['payment_id'] . ";";
                                          $resultPaymentType = mysqli_query($dbc,$queryPaymentType);
                                          $rowPaymentType=mysqli_fetch_array($resultPaymentType,MYSQLI_ASSOC);
                                          $paymentType = $rowPaymentType['paymenttype'];

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
                                          echo $row['order_date'];
                                          echo '</td>';
                                          // echo '<td>';
                                          
                                          // if($row['delivery_date'] == null || $row['delivery_date'] == "")
                                          // {
                                          //     echo '<button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus"></i> Set Delivery Date</button>';
                                          // }
                                          // else
                                          // {
                                              // echo $row['delivery_date'];
                                          // }
                                          // echo '</td>';
                                          
                                          echo '<td>';
                                          echo $paymentType;
                                          echo '</td>';
                                          echo '<td style="text-align:right;">';
                                          echo  '₱ '." ".number_format($row['totalamt'], 2);
                                          echo '</td>';
                                          if ($row['order_status'] == "Delivered")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-success btn-xs" disabled>Order Delivered</button></td>'; 
                                          }
                                          else if ($row['order_status'] == "Cancelled")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-danger btn-xs" disabled>Order Cancelled</button></td>'; 
                                          }
                                          else if ($row['order_status'] == "PickUp")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-primary btn-xs" disabled>For Pickup</button></td>'; 
                                          }
                                          else
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-info btn-xs" disabled>For Delivery</button></td>'; 
                                          }
                                          echo '<td align="center">';
                                          echo '<a href ="ViewOrderDetails.php?order_number='.$row['ordernumber'].'"> <i class="fa fa-wrench"></i> </a>';
                                          echo '</td>';
                                          echo '</tr>';
                                          
                                  }
                              ?>  
                            </tbody>
                          </table><br>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content33" aria-labelledby="profile-tab">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Order Number</th>
                                <th>Client Name</th>
                                <th>Order Date</th>
                                
                                
                                <th>Payment Type</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                  
                                  require_once('DataFetchers/mysql_connect.php');
                                  $query = "SELECT * FROM orders 
                                              WHERE order_status = 'Delivered' ORDER BY orderID ASC;";
                                  $result=mysqli_query($dbc,$query);
                                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                  {
                                          $queryPaymentType = "SELECT paymenttype FROM ref_payment WHERE payment_id =" . $row['payment_id'] . ";";
                                          $resultPaymentType = mysqli_query($dbc,$queryPaymentType);
                                          $rowPaymentType=mysqli_fetch_array($resultPaymentType,MYSQLI_ASSOC);
                                          $paymentType = $rowPaymentType['paymenttype'];

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
                                          echo $row['order_date'];
                                          echo '</td>';
                                          // echo '<td>';
                                          
                                          // if($row['delivery_date'] == null || $row['delivery_date'] == "")
                                          // {
                                          //     echo '<button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus"></i> Set Delivery Date</button>';
                                          // }
                                          // else
                                          // {
                                              // echo $row['delivery_date'];
                                          // }
                                          // echo '</td>';
                                          
                                          echo '<td>';
                                          echo $paymentType;
                                          echo '</td>';
                                          echo '<td style="text-align:right;">';
                                          echo  '₱ '." ".number_format($row['totalamt'], 2);
                                          echo '</td>';
                                          if ($row['order_status'] == "Delivered")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-success btn-xs" disabled>Order Finished</button></td>'; 
                                          }
                                          else if ($row['order_status'] == "Cancelled")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-danger btn-xs" disabled>Order Cancelled</button></td>'; 
                                          }
                                          else if ($row['order_status'] == "PickUp")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-primary btn-xs" disabled>For Pickup</button></td>'; 
                                          }
                                          else
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-info btn-xs" disabled>For Delivery</button></td>'; 
                                          }
                                          echo '<td align="center">';
                                          echo '<a href ="ViewOrderDetails.php?order_number='.$row['ordernumber'].'"> <i class="fa fa-wrench"></i> </a>';
                                          echo '</td>';
                                          echo '</tr>';
                                          
                                  }
                              ?>  
                            </tbody>
                          </table><br>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content44" aria-labelledby="profile-tab">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>Order Number</th>
                                <th>Client Name</th>
                                <th>Order Date</th>
                                
                                
                                <th>Payment Type</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                  
                                  require_once('DataFetchers/mysql_connect.php');
                                  $query = "SELECT * FROM orders 
                                              WHERE order_status = 'Cancelled' ORDER BY orderID ASC;";
                                  $result=mysqli_query($dbc,$query);
                                  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                  {
                                          $queryPaymentType = "SELECT paymenttype FROM ref_payment WHERE payment_id =" . $row['payment_id'] . ";";
                                          $resultPaymentType = mysqli_query($dbc,$queryPaymentType);
                                          $rowPaymentType=mysqli_fetch_array($resultPaymentType,MYSQLI_ASSOC);
                                          $paymentType = $rowPaymentType['paymenttype'];

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
                                          echo $row['order_date'];
                                          echo '</td>';
                                          // echo '<td>';
                                          
                                          // if($row['delivery_date'] == null || $row['delivery_date'] == "")
                                          // {
                                          //     echo '<button type="submit" class="btn btn-round btn-success"><i class="fa fa-plus"></i> Set Delivery Date</button>';
                                          // }
                                          // else
                                          // {
                                              // echo $row['delivery_date'];
                                          // }
                                          // echo '</td>';
                                          
                                          echo '<td>';
                                          echo $paymentType;
                                          echo '</td>';
                                          echo '<td style="text-align:right;">';
                                          echo  '₱ '." ".number_format($row['totalamt'], 2);
                                          echo '</td>';
                                          if ($row['order_status'] == "Delivered")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-success btn-xs" disabled>Order Finished</button></td>'; 
                                          }
                                          else if ($row['order_status'] == "Cancelled")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-danger btn-xs" disabled>Order Cancelled</button></td>'; 
                                          }
                                          else if ($row['order_status'] == "PickUp")
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-primary btn-xs" disabled>For Pickup</button></td>'; 
                                          }
                                          else
                                          {
                                            echo '<td align = "center"><button type="button" class="btn btn-round btn-info btn-xs" disabled>For Delivery</button></td>'; 
                                          }
                                          echo '<td align="center">';
                                          echo '<a href ="ViewOrderDetails.php?order_number='.$row['ordernumber'].'"> <i class="fa fa-wrench"></i> </a>';
                                          echo '</td>';
                                          echo '</tr>';
                                          
                                  }
                              ?>  
                            </tbody>
                          </table><br>
                        </div>

                      <!-- TABS END -->
                      </div>
                    </div>
                    
					
                    
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
    <script src="../vendors/datatables.net/js/jquery.dataTables.js"></script>
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

    <script>
      $(document).ready(function() {
          $('.table table-striped table-bordered dt-responsive nowrap').dataTable( {
              "aaSorting": [[ 5, "desc" ]]
          } );
      } );
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

  </body>
</html>