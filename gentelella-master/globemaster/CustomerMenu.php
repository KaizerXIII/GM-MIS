<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GM MIS | View Customers</title>

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
            <!-- sidebar menu -->
            <?php
              require_once("nav.php");    
            ?>

            </div>
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Customers <small>List of Customers for Globe Master Trading</small></h3>
              </div>

              

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>


            <!-- Add Customer Modal -->
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target=".bs-example-modal-lg"><i class = "fa fa-plus"></i> Add Customer</button>
            
            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Add a Customer Profile</h4>
                  </div>

                  <div class = "modal-body">
                  <form class="form-horizontal form-label-left" method="post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                    <span class="section">Customer Info</span>

                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="customer" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Please enter the customer's name" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Contact Number <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="contact" placeholder="Please enter the customer contact number" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="email" placeholder="Please enter the customer's e-mail address" required="required" type="email">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">City <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                  
                      <select class="form-control col-md-7 col-xs-12" name="city" required="required">
                      <option value="">Choose..</option>
                          <?php
                          require_once('DataFetchers/mysql_connect.php');
                          $sqlPullDestination = "SELECT * FROM destination";
                          $resultofDestination =  mysqli_query($dbc,$sqlPullDestination);
                          while($rowDestination=mysqli_fetch_array($resultofDestination,MYSQLI_ASSOC))
                          {
                        
                                echo'<option value="';
                                echo $rowDestination['DestinationName'];
                                echo'">';
                                echo $rowDestination['DestinationName'];
                                echo'</option>';
                        
                          }
                         ?>
                      </select>
                        <!-- <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="city" placeholder="Please enter the customer's city of delivery" required="required" type="text"> -->
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <textarea id="textarea" name="address" class="form-control col-md-7 col-xs-12" placeholder="Please enter the customer's delivery address"></textarea>
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" data-dismiss="modal">Reset</button>
                        <button id="send" type="submit" class="btn btn-success" onclick="confirmalert()">Submit</button>
                      </div>
                    </div>
                    <!-- Add Inventory -->
                    <!-- Finished general insert, but create a status column for customer -->
                    <?php
                            require_once('DataFetchers/mysql_connect.php');

                            $name = $idinsert = $contact = $email = $address = $status = $city = "";

                              if($_SERVER["REQUEST_METHOD"] == "POST")
                              {
                                $query = "SELECT max(client_id) FROM clients";
                                $result1=mysqli_query($dbc,$query);
                                
                                $id = mysqli_fetch_array($result1,MYSQLI_ASSOC);
                                
                                $idinsert = $id["max(client_id)"] + 1;
                                // echo $idinsert; for testing

                                $name = test_input($_POST['name']);
                                $contact = test_input($_POST['contact']);
                                $email = test_input($_POST['email']);
                                $address = test_input($_POST['address']);
                                $city = test_input($_POST['city']);
                                // $status = test_input($_POST['status']);

                                  echo '<script language="javascript">';
                                  echo 'confirm(Are you sure you want to enter the following data?)';  //not showing an alert box.
                                  echo '</script>';
                              

                                $sql = "INSERT INTO clients (client_id, client_name, client_address, client_city, client_contactno, client_email, total_unpaid, client_status)
                                  Values(
                                  '$idinsert',
                                  '$name', 
                                  '$address',
                                  '$city',
                                  '$contact',
                                  '$email',
                                   0,
                                   'Allowed')";

                                $resultinsert = mysqli_query($dbc,$sql);

                              }

                              function test_input($data) 
                              {
                                $data = trim($data);
                                $data = stripslashes($data);
                                $data = htmlspecialchars($data);
                                return $data;
                             }
                      ?>
                  </form>
                </div>
                </div>
              </div>
            </div>
            <br>
            <br>
            <!-- End Delivery Modal -->
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Customers<small>List of Customers for GlobeMaster</small></h2>
    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Customer Name</th>
                          <th>Contact Number</th>
                          <th>Delivery Address</th>
                          <th>E-mail Address</th>
                          <th>Total Unpaid</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <?php
                            require_once('DataFetchers/mysql_connect.php');
                          
                            $query = "SELECT * FROM clients";
                            $result=mysqli_query($dbc,$query);

                            echo "<tbody>";

                            while ($clients = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                                //output a row here
                                echo "<td>".($clients['client_name'])."</td>";
                                echo "<td>".($clients['client_contactno'])."</td>";
                                echo "<td>".($clients['client_city'])." | ".($clients['client_address'])."</td>";
                                echo "<td>".($clients['client_email'])."</td>";
                                echo "<td align = 'right'>₱ ".($clients['total_unpaid'])."</td>";
                                if($clients['client_status'] == "Allowed")
                                {
                      ?>
                                  <td align = 'center'><font color = "green">Allowed</font></td>
                      <?php
                                }
                                else if($clients['client_status'] == "Disallowed")
                                {
                      ?>
                                  <td align = 'center'><font color = "red ">Disallowed</font></td>
                      <?php
                                }
                                echo "<td align = 'center'>";
                                echo '<a href ="UnpaidCustomer.php"><i onclick = "teit()"class="fa fa-wrench" > </a>'; 
                                echo "</td></tr>";
                            }
                            echo "</tbody>";
                      ?>
                    </table>
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

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <!-- Prevent POST Resubmission -->
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>

    <!-- Alert Box -->
    <script>
    function confirmalert()
    {
      confirm("Are you sure you want to enter the following data?");
    }
    </script>

  </body>
</html>