<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>GM-MIS | Unpaid Customer  </title>

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
    <!-- JQUERY -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 

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
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  
                <h1>Customer Details - 
                <?php 
                if(isset($_GET['give_client_id']))
                {
                  $_SESSION['get_client_id_from_customer_menu'] = $_GET['give_client_id'];
                  $GET_CLIENT_ID_FROM_MENU = $_SESSION['get_client_id_from_customer_menu'];
                  

                  $SQL_GET_CLIENT_NAME = "SELECT client_name FROM clients WHERE client_id ='$GET_CLIENT_ID_FROM_MENU'";
                  $RESULT_GET_CLIENT_NAME = mysqli_query($dbc,$SQL_GET_CLIENT_NAME);
                  $ROW_RESULT_GET_CLIENT_NAME =  mysqli_fetch_assoc($RESULT_GET_CLIENT_NAME);
                  echo $ROW_RESULT_GET_CLIENT_NAME['client_name'];

                }
                else
                {
                  $_SESSION['get_client_id_from_customer_menu'];
                }
                      

                ?>
                </h1><br>
                        <b>
                        <div style = "display:none">
                          </div>
                        </b>
                      </h3>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <!-- enctype="multipart/form-data" : required inside tag to upload correctly -->
                    <form action="<?php echo $_SERVER["PHP_SELF"] . '?'.http_build_query($_GET); ?>" method="POST" class="form-horizontal form-label-left" onsubmit="return confirm('Confirm Client Payment?')">

                    <div class="col-md-6 col-sm-6 col-xs-12" >
                        <div class="x_panel" >

                            <center><font color = "#2a5eb2"><h3>Customer Details </h1>
                            
                            </h3></font></center>
                            <div class="ln_solid"></div>
                            <?php 
                                $SQL_GET_CLIENT_DETAILS = "SELECT * FROM clients WHERE client_id ='$GET_CLIENT_ID_FROM_MENU'";
                                $RESULT_GET_CLIENT_DETAILS = mysqli_query($dbc,$SQL_GET_CLIENT_DETAILS);
                                while($ROW_GET_CLIENT_DETAILS = mysqli_fetch_array($RESULT_GET_CLIENT_DETAILS,MYSQLI_ASSOC))
                                {

                                
                            ?>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name = "contact_number" type="text" id = "contact_number" class="form-control" readonly="readonly" value ="<?php echo $ROW_GET_CLIENT_DETAILS['client_contactno'] ?>
                                    ">
                                </div>
                            </div>
                          
                            <div class="form-group" style = "display:block">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">E-mail Address</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name = "pangalan" type="text" id = "email_address" class="form-control" readonly="readonly"  value ="<?php echo $ROW_GET_CLIENT_DETAILS['client_email'] ?>
                                    ">
                                </div>
                            </div>

                             <div class="form-group" style = "display:block">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Location</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name = "pangalan" type="text" id = "location" class="form-control" readonly="readonly"  value ="<?php echo $ROW_GET_CLIENT_DETAILS['client_address']." | ".$ROW_GET_CLIENT_DETAILS['client_city']?>
                                    ">
                                </div>
                            </div>
                          
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id = "client_status" class="form-control" readonly="readonly"  value ="<?php echo $ROW_GET_CLIENT_DETAILS['client_status'] ?>
                                    ">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <br><br>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Unpaid Amount</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id = "total_unpaid" class="form-control" readonly="readonly" style="text-align:right" value ="₱ <?php echo number_format($ROW_GET_CLIENT_DETAILS['total_unpaid'],2) ?>
                                    ">
                                </div>
                            </div>
                          <?php
                            } //END While 
                          ?>
        
                    </div> <!--END XPanel-->
                </div> <!--END Class Colmd-->
<div class="col-md-6 col-sm-6 col-xs-12" >

<div class="x_panel">

  <center><h3><font color = "black">Unpaid Orders</font>
</h3></center>
  <div class="ln_solid"></div>
  <!-- recently damaged table -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    
        <div class="x_content">
            <table id ="damageTable" class="table">
                <thead>
                    <tr>    
                    <th>Order Number</th>
                    <th>Total Amount</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                    
                    </tr>
                </thead>
                <tbody>
                  <?php 
                  
                  $GET_CLIENT_ID_FROM_MENU = $_SESSION['get_client_id_from_customer_menu'];
                  $SQL_GET_ORDER_NUMBER_BASED_ON_CLIENT_ID = "SELECT * FROM orders WHERE client_id ='$GET_CLIENT_ID_FROM_MENU' AND payment_status ='Unpaid'";
                  $RESULT_GET_ORDER_NUMBER = mysqli_query($dbc,$SQL_GET_ORDER_NUMBER_BASED_ON_CLIENT_ID);
                  while($ROW_GET_ORDER_NUMBER = mysqli_fetch_array($RESULT_GET_ORDER_NUMBER,MYSQLI_ASSOC))
                  {
                      echo '<tr>';
                        echo '<td>';
                          echo $ROW_GET_ORDER_NUMBER['ordernumber'];
                        echo '</td>';
                        echo '<td align = right>';
                          echo "₱ ", number_format($ROW_GET_ORDER_NUMBER['totalamt'],2);
                        echo '</td>';
                        echo '<td align = center>';
                          echo $ROW_GET_ORDER_NUMBER['payment_status'];
                        echo '</td>';
                        echo '<td align = center>';
                          echo '<button type="button" class="btn btn-success" value ="'.$ROW_GET_ORDER_NUMBER['ordernumber'].'" data-toggle="modal" data-target=".bs-example-modal-lg"><i  class="fa fa-money" ></i> </button>';
                        echo '</td>';
                      echo '</tr>';
                  }
              ?>                  
                </tbody>
            </table>
        </div> <!--END Xcontent-->
      </div><!--END Col MD-->
    </div><!--END Class-row -->
  </div><!--END XPanel-->
</div><!--ENDCol MD-->

<!-- Large modal -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Customer Payments</h4>
      </div>
      <div class="modal-body">
      <?php 
        $GET_OR_FROM_AJAX_SESSION =  $_SESSION['ordernumber_array_from_unpaid_customer_php'];

        $SQL_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE = "SELECT * FROM unpaid_clients WHERE clientID ='$GET_CLIENT_ID_FROM_MENU' AND ordernumber ='$GET_OR_FROM_AJAX_SESSION'";
        $RESULT_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE = mysqli_query($dbc,$SQL_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE);
        while($ROW_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE = mysqli_fetch_array($RESULT_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE,MYSQLI_ASSOC))
        {       
      ?>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Initial Unpaid Amount</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id = "item_price" class="form-control" readonly="readonly" style="text-align:right" value ="₱ <?php echo number_format($ROW_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE['init_unpaid'], 2); ?>
                ">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remaining Unpaid Amount</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id = "item_price" class="form-control" readonly="readonly" style="text-align:right"  value ="₱ <?php echo number_format($ROW_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE['totalunpaid'], 2); ?>
                ">
            </div>
        </div>
      <?php
      $_SESSION['SET_MAX_BY_TOTAL_UNPAID'] = $ROW_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE['totalunpaid'];
      }
        
      ?>

        <div class = "clearfix"></div>
<div class="col-md-12 col-sm-12 col-xs-12" >

<div class="x_panel">

  <center><h3><font color = "lightblue">Payment Trail</font>
</h3></center>
  <div class="ln_solid"></div>
  <!-- recently damaged table -->
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    
        <div class="x_content">
            <table id ="damageTable" class="table">
                <thead>
                    <tr>    
                      <th>Amount Paid</th>
                      <th>Payment Date</th>
                    </tr>
                </thead>
                <tbody>
                    <td></td>
                    <td></td>
                </tbody>
            </table>
        </div> <!--END Xcontent-->
      </div><!--END Col MD-->
    </div><!--END Class-row -->
  </div><!--END XPanel-->
</div><!--ENDCol MD-->
<div class = "clearfix"></div>

<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment</label>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <input type="number" step = "any" name="client_payment" id = "payment" class="form-control" style="text-align:right" oninput ="validate(this)" min ="1" max = <?php echo $_SESSION['SET_MAX_BY_TOTAL_UNPAID'];?>
        >
  </div>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="confirm_payment" class="btn btn-success">Confirm Payment</button>

        <?php
        if(isset($_POST['confirm_payment'] ))
        {
          if(!empty($_POST['client_payment']))
          {
            $GET_UNPAID_ID = "SELECT * FROM unpaid_clients WHERE clientID = '$GET_CLIENT_ID_FROM_MENU' AND ordernumber = '$GET_OR_FROM_AJAX_SESSION'";
            $RESULT_UNPAID_ID = mysqli_query($dbc,$GET_UNPAID_ID);
            $ROW_UNPAID_ID = mysqli_fetch_assoc($RESULT_UNPAID_ID);
    
              $GET_UNPAID_ID_FROM_SQL = $ROW_UNPAID_ID['unpaidID'];
              $GET_PAYMENT_OF_CLIENT = $_POST['client_payment'];
    
            $INSERT_TO_AUDIT = "INSERT INTO unpaidaudit(unpaidID, payment_amount, payment_date) 
            VALUES('$GET_UNPAID_ID_FROM_SQL','$GET_PAYMENT_OF_CLIENT', Now());";

            $RESULT_INSERT_TO_AUDIT = mysqli_query($dbc,$INSERT_TO_AUDIT); //Insert to PaymentAudit
            
            $UPDATE_UNPAID_AMOUNT_IN_CLIENT_TABLE = "UPDATE clients
            SET clients.total_unpaid  = (total_unpaid - '$GET_PAYMENT_OF_CLIENT')
            WHERE client_id ='$GET_CLIENT_ID_FROM_MENU';";

            $RESULT_UPDATE_UNPAID_AMOUNT_IN_CLIENT_TABLE=mysqli_query($dbc,$UPDATE_UNPAID_AMOUNT_IN_CLIENT_TABLE); //Update Total Unpaid in clients table

            $UPDATE_UNPAID_AMOUNT_IN_UNPAIDCLIENTS_TABLE = "UPDATE unpaid_clients
            SET unpaid_clients.totalunpaid  = (totalunpaid - '$GET_PAYMENT_OF_CLIENT')
            WHERE clientID = '$GET_CLIENT_ID_FROM_MENU' AND ordernumber = '$GET_OR_FROM_AJAX_SESSION';";

            $RESULT_UPDATE_UNPAID_AMOUNT_IN_UNPAID_CLIENTS_TABLE = mysqli_query($dbc,$UPDATE_UNPAID_AMOUNT_IN_UNPAIDCLIENTS_TABLE);  //Update Total Unpaid in clients table
            if(!$RESULT_UPDATE_UNPAID_AMOUNT_IN_UNPAID_CLIENTS_TABLE) 
            {
                die('Error: ' . mysqli_error($dbc));
            } 
            else 
            {
               
            }


            
          }//END IF ISSET
          else
          {
            echo '<script language="javascript">';
            echo 'alert("Please INPUT Amount!");';
            echo '</script>';
          }
         
        }//END IF ISSET
        
        ?>
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
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <script type="text/javascript">
      function validate(obj) {
          obj.value = valBetween(obj.value, obj.min, obj.max); //Gets the value of input alongside with min and max
          console.log(obj.value);
      }

      function valBetween(v, min, max) {
          return (Math.min(max, Math.max(min, v))); //compares the value between the min and max , returns the max when input value > max
      }
  </script> <!-- To avoid the users input more than the current Max per item -->

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
    <!-- <script src="../vendors/parsleyjs/dist/parsley.min.js"></script> -->
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <script>            
    $('#damageTable tbody button.btn.btn-success').on('click', function(e) 
    {              
      var buttonValue = $(this).val();
      
      request = $.ajax({
          url: "ajax/unpaid_client_get_ordernumber.php",
          type: "POST",
          data: {post_order_number: buttonValue},
          success: function(data) 
          {
            // alert(data);

          }//END SUCCESS
          
      });//END AJAX
    });                        
    </script>
   
 
    
  </body>
</html>
