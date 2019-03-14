<?php

if(isset($_POST['add']))
{
    $description = $_POST['desc'];
    $amount = $_POST['amount'];
    $image = addslashes(file_get_contents($_POST['image'])); //SQL Injection defence!
    
    require_once('DataFetchers/mysql_connect.php');
    $queryItemType = "SELECT ordernumber FROM orders WHERE orderID = '{$_POST['order']}'";
    $resultItemType = mysqli_query($dbc,$queryItemType);
    $rowItemType=mysqli_fetch_array($resultItemType,MYSQLI_ASSOC);
    $ordernumber = $rowItemType['ordernumber'];
    
    
    require_once('DataFetchers/mysql_connect.php');
    $query="INSERT INTO joborderfabrication(ordernumber, description, totalamt, refdrawing)
    VALUES('$ordernumber', '$description', '$amount', '$image')";
    $result=mysqli_query($dbc,$query);
    echo "<script> alert('Item added'); </script>";
}

?>


<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>GM - Job Order Fabrication  </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <!-- Switchery -->
    <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <!-- starrr -->
    <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
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
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h1>Create Job Order for Fabrication</h1><br>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                      <h3>
                        <b>
                          <?php
                           
                           $currentStatus = $_SESSION['DeliveryStatus'];
                           $fabricationStatus = $_SESSION['FabricationStatus'];
                          
                           echo $currentStatus,"<br>";
                           echo $fabricationStatus,"<br>";
                           
                            if(isset($_GET['order_id']))
                            {
                             
                               $_SESSION['getORNumber'] = $_GET['order_id']; //Stores the Value of Get from Order Form
                               echo $_SESSION['getORNumber'],"<br>"; 

                               $_SESSION['getDeliveryDate'] = $_GET['deliver_date']; //Get the Deliv Date
                               echo"Deliver Date = ", $_SESSION['getDeliveryDate'],"<br>"; 

                               $_SESSION['client_id'] = $_GET['client_id']; //Get Client ID
                               echo "Client ID = ",$_SESSION['client_id'],"<br>"; 

                               $_SESSION['item_id'] = $_GET['cart_item_id']; //Get Client ID
                               echo"Item ID = ", $_SESSION['item_id'],"<br>"; 

                               $_SESSION['item_qty'] = $_GET['cart_qty_per_item']; //Get Client ID
                               echo"Item Quantity = ", $_SESSION['item_qty'],"<br>"; 


                               $_SESSION['payment_id'] = $_GET['pay_id'];
                               echo"Payment ID = ", $_SESSION['payment_id'],"<br>"; // Get Pay Id, remove all Echo once Finalized
                               
                            }
                            else
                            {
  
                               echo $_SESSION['getORNumber']; 
                                
                            }
                           
                          ?>
                        </b>
                      </h3>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">

                    
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Enter Description <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <textarea id="message" required="required" class="form-control" name="desc" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.."
                            data-parsley-validation-threshold="10"></textarea>
                          <br/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Enter Fabrication Cost<span class="required">*</span>
                        </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="fab_cost" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <br><br>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Amount<span class="required">*</span>
                        </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" name="total_amount" id="last-name" name="last-name" required="required" readonly="readonly" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <br><br> 
                      

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">For Installation?<span class="required">*</span>
                        </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="radio" name="installation" id="last-name" name="last-name" required="required">
                        </div>
                      </div>
                      <br><br>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Reference Drawing <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="drawing" id="fileToUpload">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <button name="add" class="btn btn-round btn-success" type="submit" class="btn btn-success">Create</button>
						  <button class="btn btn-round btn-primary" type="reset">Reset</button>
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
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
    <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
    <script src="../vendors/google-code-prettify/src/prettify.js"></script>
    <!-- jQuery Tags Input -->
    <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
    <!-- Switchery -->
    <script src="../vendors/switchery/dist/switchery.min.js"></script>
    <!-- Select2 -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <!-- Parsley -->
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>