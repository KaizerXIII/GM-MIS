<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GM - View Restock Orders</title>

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
                  <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">ORDERS FOR RESTOCKING</h1><br>
              </div>
            </div>
            <br><br><br><br>

              <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <?php
                  if($user == "CEO")
                  {
                ?>
              <a href = "SupplierOrderForm.php"><button type="button" class="btn btn-success btn-lg"><i class="fa fa-plus"></i> New Supplier Order</button></a>
              <?php
                  }
              ?>
                <div class="x_panel">
                  <div class="x_content">
                   
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                      <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><font color = "black">Purchased</font></a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false"><font color = "skyblue">Shipping</font></a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content33" role="tab" id="profile-tabb3" data-toggle="tab" aria-controls="profile" aria-expanded="false"><font color = "darkblue">Delivered</font></a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content44" role="tab" id="profile-tabb4" data-toggle="tab" aria-controls="profile" aria-expanded="false"><font color = "green">Finished</font></a>
                      </li>
                    </ul>
                    <div id="myTabContent2" class="tab-content">
                      <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Supply Order Number</th>
                          <th>Order Date</th>
                          <th>Expected Date</th>
                          <!-- <th>Total Quantity</th> -->
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $SQL_GET_ALL_SO = "SELECT supply_order_id,
                       CAST(supply_order_date AS DATE) as SD,
                        CAST(supply_order_expdate AS DATE) as SXD,
                         CAST(DATE_ADD(supply_order_expdate, INTERVAL 14 DAY) AS DATE) AS EXP_RANGE,
                          supply_order_total_quantity,
                           supply_order_status 
                           FROM supply_order 
                           WHERE supply_order_status = 'Purchased' OR supply_order_status = 'China'
                           ORDER BY supply_order_id + '0'";

                      $RESULT_GET_SO = mysqli_query($dbc, $SQL_GET_ALL_SO);
                        while($row=mysqli_fetch_array($RESULT_GET_SO,MYSQLI_ASSOC))
                        {
                          $SO_ID = $row['supply_order_id'];
                          echo '<tr>';                          
                          echo ' <td> SR - ' .$row['supply_order_id'].'</td>'; 
                          echo ' <td>' .$row['SD'].'</td>'; 
                          echo ' <td>' .$row['SXD']. '  to  ' .$row['EXP_RANGE'].'</td>'; 
                          // echo ' <td>'.$row['supply_order_total_quantity'].'</td>'; 

                          //start status if/else PHP
                            if($row['supply_order_status'] == "Purchased" || $row['supply_order_status'] == "China")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-default btn-xs" disabled>Purchased</button></td>
                          <?php
                            }
                            else if($row['supply_order_status'] == "Shipped" || $row['supply_order_status'] == "Philippines" || $row['supply_order_status'] == "OTW")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-primary btn-xs" disabled>Shipping</button></td>
                          <?php
                            }
                            else if($row['supply_order_status'] == "Arrived" || $row['supply_order_status'] == "Receiving")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-success btn-xs" disabled>Delivered</button></td>
                      <?php
                            } //end progressbar if/else PHP
                          echo ' <td align = "center"><a href="SupplierOrderDetails.php?so_id='.$SO_ID.'"><i class = "fa fa-wrench"></i></a></td>'; 
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
                          <th>Supply Order Number</th>
                          <th>Order Date</th>
                          <th>Expected Date</th>
                          <!-- <th>Total Quantity</th> -->
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $SQL_GET_ALL_SO = "SELECT supply_order_id,
                       CAST(supply_order_date AS DATE) as SD,
                        CAST(supply_order_expdate AS DATE) as SXD,
                         CAST(DATE_ADD(supply_order_expdate, INTERVAL 14 DAY) AS DATE) AS EXP_RANGE,
                          supply_order_total_quantity,
                           supply_order_status 
                           FROM supply_order 
                           WHERE supply_order_status = 'Shipped' OR supply_order_status = 'Philippines' OR supply_order_status = 'OTW'
                           ORDER BY supply_order_id + '0'";

                      $RESULT_GET_SO = mysqli_query($dbc, $SQL_GET_ALL_SO);
                        while($row=mysqli_fetch_array($RESULT_GET_SO,MYSQLI_ASSOC))
                        {
                          $SO_ID = $row['supply_order_id'];
                          echo '<tr>';                          
                          echo ' <td> SR - ' .$row['supply_order_id'].'</td>'; 
                          echo ' <td>' .$row['SD'].'</td>'; 
                          echo ' <td>' .$row['SXD']. '  to  ' .$row['EXP_RANGE'].'</td>'; 
                          // echo ' <td>'.$row['supply_order_total_quantity'].'</td>'; 

                          //start status if/else PHP
                            if($row['supply_order_status'] == "Purchased" || $row['supply_order_status'] == "China")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-default btn-xs" disabled>Purchased</button></td>
                          <?php
                            }
                            else if($row['supply_order_status'] == "Shipped" || $row['supply_order_status'] == "Philippines" || $row['supply_order_status'] == "OTW")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-info btn-xs" disabled>Shipping</button></td>
                          <?php
                            }
                            else if($row['supply_order_status'] == "Arrived" || $row['supply_order_status'] == "Receiving")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-success btn-xs" disabled>Delivered</button></td>
                      <?php
                            } //end progressbar if/else PHP
                          echo ' <td align = "center"><a href="SupplierOrderDetails.php?so_id='.$SO_ID.'"><i class = "fa fa-wrench"></i></a></td>'; 
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
                          <th>Supply Order Number</th>
                          <th>Order Date</th>
                          <th>Expected Date</th>
                          <!-- <th>Total Quantity</th> -->
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $SQL_GET_ALL_SO = "SELECT supply_order_id,
                       CAST(supply_order_date AS DATE) as SD,
                        CAST(supply_order_expdate AS DATE) as SXD,
                         CAST(DATE_ADD(supply_order_expdate, INTERVAL 14 DAY) AS DATE) AS EXP_RANGE,
                          supply_order_total_quantity,
                           supply_order_status 
                           FROM supply_order 
                           WHERE supply_order_status = 'Receiving'
                           ORDER BY supply_order_id + '0'";

                      $RESULT_GET_SO = mysqli_query($dbc, $SQL_GET_ALL_SO);
                        while($row=mysqli_fetch_array($RESULT_GET_SO,MYSQLI_ASSOC))
                        {
                          $SO_ID = $row['supply_order_id'];
                          echo '<tr>';                          
                          echo ' <td> SR - ' .$row['supply_order_id'].'</td>'; 
                          echo ' <td>' .$row['SD'].'</td>'; 
                          echo ' <td>' .$row['SXD']. '  to  ' .$row['EXP_RANGE'].'</td>'; 
                          // echo ' <td>'.$row['supply_order_total_quantity'].'</td>'; 

                          //start status if/else PHP
                            if($row['supply_order_status'] == "Purchased" || $row['supply_order_status'] == "China")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-default btn-xs" disabled>Purchased</button></td>
                          <?php
                            }
                            else if($row['supply_order_status'] == "Shipped" || $row['supply_order_status'] == "Philippines" || $row['supply_order_status'] == "OTW")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-primary btn-xs" disabled>Shipping</button></td>
                          <?php
                            }
                            else if($row['supply_order_status'] == "Receiving")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-primary btn-xs" disabled>Delivered</button></td>
                      <?php
                            } //end progressbar if/else PHP
                          echo ' <td align = "center"><a href="SupplierOrderDetails.php?so_id='.$SO_ID.'"><i class = "fa fa-wrench"></i></a></td>'; 
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
                          <th>Supply Order Number</th>
                          <th>Order Date</th>
                          <th>Expected Date</th>
                          <!-- <th>Total Quantity</th> -->
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $SQL_GET_ALL_SO = "SELECT supply_order_id,
                       CAST(supply_order_date AS DATE) as SD,
                        CAST(supply_order_expdate AS DATE) as SXD,
                         CAST(DATE_ADD(supply_order_expdate, INTERVAL 14 DAY) AS DATE) AS EXP_RANGE,
                          supply_order_total_quantity,
                           supply_order_status 
                           FROM supply_order 
                           WHERE supply_order_status = 'Arrived'
                           ORDER BY supply_order_id + '0'";

                      $RESULT_GET_SO = mysqli_query($dbc, $SQL_GET_ALL_SO);
                        while($row=mysqli_fetch_array($RESULT_GET_SO,MYSQLI_ASSOC))
                        {
                          $SO_ID = $row['supply_order_id'];
                          echo '<tr>';                          
                          echo ' <td> SR - ' .$row['supply_order_id'].'</td>'; 
                          echo ' <td>' .$row['SD'].'</td>'; 
                          echo ' <td>' .$row['SXD']. '  to  ' .$row['EXP_RANGE'].'</td>'; 
                          // echo ' <td>'.$row['supply_order_total_quantity'].'</td>'; 

                          //start status if/else PHP
                            if($row['supply_order_status'] == "Purchased" || $row['supply_order_status'] == "China")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-default btn-xs" disabled>Purchased</button></td>
                          <?php
                            }
                            else if($row['supply_order_status'] == "Shipped" || $row['supply_order_status'] == "Philippines" || $row['supply_order_status'] == "OTW")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-primary btn-xs" disabled>Shipping</button></td>
                          <?php
                            }
                            else if($row['supply_order_status'] == "Arrived")
                            {
                          ?>
                            <td align = "center"><button type="button" class="btn btn-round btn-success btn-xs" disabled>Finished</button></td>
                      <?php
                            } //end progressbar if/else PHP
                          echo ' <td align = "center"><a href="SupplierOrderDetails.php?so_id='.$SO_ID.'"><i class = "fa fa-wrench"></i></a></td>'; 
                          echo '</tr>'; 
                        }
                      ?>                          
                      </tbody>
                    </table><br>
                    </div>
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