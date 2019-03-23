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
  </head>

  <body class="nav-md" onload="LoadCurrentTotal()";>
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
                  <?php
                    if(isset($_GET['order_id']))
                    {
                   
                     $_SESSION['getORNumber'] = $_GET['order_id']; //Stores the Value of Get from Order Form
                    }
                  ?>
                <h1>Customer Details - [<?php echo $_SESSION['getORNumber'];?>]</h1><br>
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
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
<!-- NEW FABRICATION DETAILS DESIGN -->
<div class="col-md-6 col-sm-6 col-xs-12" >
    <div class="x_panel" >

        <center><font color = "#2a5eb2"><h3>Customer Details </h1>
        
        </h3></font></center>
        <div class="ln_solid"></div>
<!-- INSERT IF HERE -->
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact Number</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name = "pangalan" type="text" id = "item_name" class="form-control" readonly="readonly">
            </div>
        </div>
        <!-- Show only when order status is for delivery -->
        <div class="form-group" style = "display:block">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">E-mail Address</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input name = "pangalan" type="text" id = "item_name" class="form-control" readonly="readonly">
            </div>
        </div>
        <!-- meh -->
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id = "item_tyoe" class="form-control" readonly="readonly">
            </div>
        </div>
        <div class="form-group">
            <br><br>
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Unpaid Amount</label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id = "item_price" class="form-control" readonly="readonly" style="text-align:right">
            </div>
        </div>
        
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
                    <td></td>
                    <td></td>
                    <td></td>
                    <td align = "center"><i onclick = "teit()"class="fa fa-money"  data-toggle="modal" data-target=".bs-example-modal-lg"></td>
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
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Initial Unpaid Amount</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id = "item_price" class="form-control" readonly="readonly" style="text-align:right" >
          </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remaining Unpaid Amount</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <input type="text" id = "item_price" class="form-control" readonly="readonly" style="text-align:right" >
          </div>
        </div>
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
        <input type="text" id = "item_price" class="form-control" style="text-align:right" >
  </div>
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Save changes</button>
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

  <script>
  var installbtn = document.getElementById("installbutton");
    installbtn.required = true;
    function removerequired()
    {
      installbtn.required = false;
    }
  </script>
    

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
    <?php
      echo '<script>';
      echo 'var radioButton = document.getElementById("installDiv");';
      if($currentStatus == "Deliver")
      {
        echo 'radioButton.style.display = "block"';
      } 
      echo ' </script>'; //Unhides Installation Button when Order is Deliver
    ?>
    <script>
    function LoadCurrentTotal()
    {
      var fab_total = document.getElementById("total_amount");
      var getTotal = localStorage.getItem("settotal").replace("₱ ", "");

      console.log(parseFloat(getTotal));

      fab_total.innerHTML = parseFloat(getTotal);
      fab_total.value =parseFloat(getTotal);
      
    }     
    </script>

    <script>
   
    $("#fab_cost").change(function()
    {
    
      var $this = $(this);
      $this.val(parseFloat($this.val()).toFixed(2));
        
    }); //Sets the Decimal

    var fab_cost = document.getElementById("fab_cost");
    var fab_total = document.getElementById("total_amount");

   
    
    fab_cost.onkeyup = function()
    {
        var getTotal = localStorage.getItem("settotal").replace("₱ ", "");
        parseFloat(getTotal);
        var inputValue = fab_cost.value;

        console.log(getTotal);
        console.log(inputValue);        
        var currentTotal = parseFloat(getTotal) + parseFloat(inputValue) ;        
        console.log(currentTotal);

        fab_total.innerHTML = currentTotal.toFixed(2);
        fab_total.value = currentTotal.toFixed(2);
    }

   </script>

   <script>
    function testScript()
    {
      var CurrentOrderDate = new Date().toJSON().slice(0,10);
      console.log(CurrentOrderDate);
    }
   </script>
  </body>
</html>
