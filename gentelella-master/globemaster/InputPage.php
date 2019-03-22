<!DOCTYPE html>
<?php
      require_once('DataFetchers/mysql_connect.php');
    
?> <!-- PHP END -->
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Input Page</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
    <?php
            require_once("nav.php");    
            ?>
      <div class="main_container">

            

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Input EOQ Requirements</h2>                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method = "POST">

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Inventory Holding:  <span class="required">* </span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="InventoryHoldingCost" name = "InventoryHoldingCostName"required="required" class="form-control col-md-7 col-xs-12" placeholder = "Input Percentage ( % )" min="0" oninput="this.value = Math.abs(this.value)">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Acquisition Cost:  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" min="0" id="AcquisitionCost" name = "AcquisitionCostName"required="required" class="form-control col-md-7 col-xs-12" min="0" oninput="this.value = Math.abs(this.value)">
                        </div>
                      </div>             
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-danger" type="button">Cancel</button>
						              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success" name = "SubmitBtn" onclick="return getConfirmation()">Submit</button>

                           <?php
                             require_once('DataFetchers/mysql_connect.php');
                            if(isset($_POST['SubmitBtn']))
                            {
                                $inventoryHoldingPercentageFromHTML = $_POST['InventoryHoldingCostName'];
                                $AcquistionCostFromHTML = $_POST['AcquisitionCostName'];

                                echo'<br>';
                                echo $inventoryHoldingPercentageFromHTML;
                                echo'<br>';
                                echo $AcquistionCostFromHTML;
                               

                                $sqlInsert = " REPLACE INTO ref_eoqformula (formulaID, InventoryCost, AcquisitionCost)
                                VALUES ('1','$inventoryHoldingPercentageFromHTML', '$AcquistionCostFromHTML');";
                                $result=mysqli_query($dbc,$sqlInsert); 
                                
                                if(!mysqli_query($dbc,$sqlInsert)) 
                                {
                                  die('Error: ' . mysqli_error($dbc));
                                } 
                                else 
                                {
                                    echo '<script language="javascript">';
                                    echo 'alert("Successful!");';
                                    echo '</script>';
                                }
                            }
                          ?>
                          <script>
                            function getConfirmation() 
                            {
                              var retVal = confirm("Do you want to continue ?");
                                if( retVal == true ) 
                                {                                   
                                    return true;
                                } 
                                else 
                                {
                                    return false;
                                }
                            }
                            </script>

                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

             <div class="clearfix"></div>
            
            <div class="row">
              <div class="col-md-5 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Input Target Sales for NEXT Month</h2>                   
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method = "POST">

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Target Sales:  <span class="required">* </span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="targetSales" name = "targetSales"required="required" class="form-control col-md-7 col-xs-12" min="0">
                        </div>
                      </div>
                                
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-12 col-sm-6 col-xs-12 col-md-offset-3">
                          <button class="btn btn-danger" type="button">Cancel</button>
						              <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success" name = "submitNextMonthSales" onclick="">Submit</button>

                          <?php   
                            if(isset($_POST['submitNextMonthSales']))
                            {
                              $GET_NEXT_MONTH_SALES = $_POST['targetSales'];
                              $UPDATE_NEXT_MONTH_COL = "UPDATE ref_eoqformula
                              SET ref_eoqformula.nextMonthSales  = ('$GET_NEXT_MONTH_SALES')
                              WHERE formulaID ='1';";
                              $RESULT_UPDATE_NEXT_MONTH_SALES=mysqli_query($dbc,$UPDATE_NEXT_MONTH_COL);
                              if(!$RESULT_UPDATE_NEXT_MONTH_SALES) 
                              {
                                  die('Error: ' . mysqli_error($dbc));
                              } 
                              else 
                              {
                                  echo '<script language="javascript">';
                                  echo 'alert("Updated: Targetted Next Month Sales!");';
                                  echo '</script>';
                                  
                              }        
                            }

                          ?>

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

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	
  </body>
</html>
