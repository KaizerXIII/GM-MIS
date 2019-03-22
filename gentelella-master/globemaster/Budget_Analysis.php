<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Budget Analysis</title>

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
        <div class="main_container">
					<?php
            require_once("nav.php");    
          ?>
          </div>
            <!-- /sidebar menu -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
           <!-- <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"> Target Sales: </span>
              <div class="count">2500</div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"> Total Sales: </span>
              <div class="count">500</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top">Total Profit: </span>
              <div class="count green">2,500,000</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Incurred Cost: </span>
              <div class="count">764,567</div>
            </div>-->
           
          </div>
          <!-- /top tiles -->

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                    <h3>Budget Analysis:    <small> <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                      <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                      <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                    </div></small></h3>
                    
                  </div>
                
                </div>

                <!-- Add Data module -->
                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target=".bs-example-modal-lg"><i class = "fa fa-plus"></i> Add Data</button>

                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Add Expected Data</h4>
                      </div>

                      <div class = "modal-body">
                      <form class="form-horizontal form-label-left" method="post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                        <span class="section">Input for Expected Data Each Month</span>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Year <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="year" placeholder = "Input a year of analysis" required type="number" min="2001" max="2099" step="1" value="2019" />
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">January <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="jan" placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0" />
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">February <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="feb"  placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0" />
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">March <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="mar" placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0"/>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">April <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="apr" placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0"/>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">May <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="may" placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0"/>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">June <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="jun" placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0"/>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">July <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="jul" placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0"/>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">August <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="aug" placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0"/>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">September <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="sept" placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0"/>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">October <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="oct" placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0"/>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">November <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="nov" placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0"/>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">December <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="customer" class="form-control col-md-7 col-xs-12" name="dec" placeholder = "Input a monetary amount (e.g. 1000.00)" required type="number" required name="price" min="0" step=0.1 value = "0"/>
                            <br>
                            <br>
                            <br>
                            <button type="submit" class="btn btn-success btn-lg" name = "submit" value = "submit">Submit </button>
                            <button type="reset" class="btn btn-danger btn-lg">Reset </button>
                            <!-- php start -->
                            <?php
                            $year = $jan = $feb = $mar = $apr = $may = $jun = $jul = $aug = $sept = $oct = $nov = $dec = "";

                              if($_SERVER["REQUEST_METHOD"] == "POST")
                              {
                                $year = test_input($_POST['year']);
                                $jan = test_input($_POST['jan']);
                                $feb = test_input($_POST['feb']);
                                $mar = test_input($_POST['mar']);
                                $apr = test_input($_POST['apr']);
                                $may = test_input($_POST['may']);
                                $jun = test_input($_POST['jun']);
                                $jul = test_input($_POST['jul']);
                                $aug = test_input($_POST['aug']);
                                $sept = test_input($_POST['sept']);
                                $oct = test_input($_POST['oct']);
                                $nov = test_input($_POST['nov']);
                                $dec = test_input($_POST['dec']);

                                // $expected = array($_POST['jan'], $_POST['feb'], $_POST['mar'], $_POST['apr'], $_POST['may'], $_POST['jun'], $_POST['jul'], $_POST['aug'], $_POST['sept'], $_POST['aug'], $_POST['nov'], $_POST['dec']);
                              $expected = 5000;                              }

                              function test_input($data) {
                                $data = trim($data);
                                $data = stripslashes($data);
                                $data = htmlspecialchars($data);
                                return $data;
                             }
                            

                             
                             $test1 = array (112, 223, 334, 445, 445, 556, 775, 889)          
                            ?>
                            <!-- php end -->
                          </div>
                        </div>

                        
                        
                      </form>
                    </div>
                    </div>
                  </div>
                </div>
                <!-- End Add Data Modal -->
                
                
                <!-- test -->
                <?php 
                // foreach ($_POST as $a)
                // echo $a;
                ?>



                <div class="row">
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>
                          <?php 
                            if (isset($_POST["year"]))
                            {
                              echo "Sales Variance Analysis for Year ", $_POST['year'];
                            }
                            else 
                              echo "Sales Variance Analysis for Year ", date('Y'); 
                          ?>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                          </li>
                          <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                            </ul>
                          </li>
                          <li><a class="close-link"><i class="fa fa-close"></i></a>
                          </li>
                        </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                        <canvas id="mybarChart" width="350" height="260">></canvas>
                      </div>
                    </div>
                    <div class="slidecontainer" id = "sliderAmount">
                            <input type="range" min="1" max="50" value="50" class="slider" id="rangeSlider"> </input>

                            <p>Value: <span id="value"></span></p>
                            Set Estimated Annual Demand: <input id = "maxInput" type ="number" min = "0" onkeydown="return processKey(event)" value = "0"> </input>
                            <script>
                                function processKey(e)
                                {
                                    if (null == e)
                                        e = window.event ;
                                    if (e.keyCode == 13)  {
                                        // document.getElementById("maxInput").click();

                                        var getInputEntered = document.getElementById("maxInput");
                                        var getValueofInputEntered = getInputEntered.value;

                                        var slider = document.getElementById("rangeSlider");
                                        slider.setAttribute("max",getValueofInputEntered);


                                        return false;
                                    }
                                }
                            </script>

                        </div>
                  </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Current Analysis:  </h2>

                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>For the Month</th>
                            <th>Actual Sales</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 

                            require_once('DataFetchers/mysql_connect.php');
                            $query = "SELECT months, SUM(IFNULL(totalamt,0)) as totalamtsales 
                            FROM months m
                            LEFT JOIN orders o
                            on MONTHNAME(order_date) = m.months
                            WHERE YEAR(order_date) is NULL or YEAR(order_date) = 2019 
                            GROUP BY months
                            ORDER BY monthsid;";
                            $result = mysqli_query($dbc,$query);
                            while($result1=mysqli_fetch_array($result,MYSQLI_ASSOC))
                            {

                              echo '<tr>';
                              echo '<td>';
                              echo $result1['months'];
                              echo '</td>';
                              echo '<td align= "right">';
                              echo "₱",$result1['totalamtsales'];
                              echo '</td>';
                              echo '</tr>';
                            }
                          ?>
                        </tbody>
                      </table>
  
                    </div>
                  </div>
                </div>
          <br>

          

         
        <!-- /page content -->

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
    <!-- <script src="../build/js/custom.min.js"></script>

    <script src="../vendors/echarts/dist/echarts.min.js"></script>
    <script src="../vendors/echarts/map/js/world.js"></script> -->
    
    <script>
        // Bar chart

      
      if ($('#mybarChart').length )
      { 

			  $(document).ready(function()
        {
        $.ajax({
          url: "DataFetchers/DataTest.php",
          method: "GET",
          success: function(data) {
            console.log(data);
            // var itemid = [];
            // var itemname = [];
            // var itemlabel = [];
            // var itemprice = [];
            // var itemcount = [];
            var totalsales_month = [];
            var itemcount1 = <?php echo json_encode($test1); ?>;
            var expected = [];
            var variancearray = [];

            console.log(data);

            for(var i in data) 
            {
              // itemid.push("Item " + data[i].item_id);
              // itemname.push(data[i].item_name);
              // itemlabel.push(data[i].item_name + "-" + "Item " + data[i].item_id);
              // itemprice.push(data[i].price);
              // itemcount.push(data[i].item_count);
              console.log(data[i]);

              totalsales_month.push(data[i].totalamtsales);
              expected.push(5000);

              variancearray.push(Math.abs(data[i].totalamtsales - expected[i]));

              console.log(variancearray);
            }
			  
            var ctx = document.getElementById("mybarChart");
            var mybarChart = new Chart(ctx, 
            {
              type: 'line',
              data: 
              {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [{
                label: 'Actual Sales',
                borderColor: "#26B99A",
                backgroundColor: 'rgba(0,0,0,0.5)',
                data: totalsales_month},{
                label: 'Expected Sales',
                borderColor: "#273746",
                data: expected},{
                label: 'Sales Variance',
                borderColor: "#DF013A",
                data: variancearray}]
            },
              options: 
              {
                responsive: true,
                scales: 
                {
                  xAxes: 
                  [{
                    ticks: 
                    {
                      beginAtZero: false
                    } 
                  }],
                  // xAxes:[{stacked: true}],
                  yAxes: 
                  [{
                    // stacked: true
                    ticks: 
                    {
                      beginAtZero: false
                    }
                  }]
                }
              }
            });
          }
        })
      })
    } 
    
  </script>

<script>
    var slider = document.getElementById("rangeSlider");
    var output = document.getElementById("value");
    output.innerHTML = slider.value;

    slider.oninput = function() {
        output.innerHTML = this.value;
    }
</script> <!-- Script to Get Value of OnChange from Slider -->
  <style>
    .slidecontainer {
        width: 100%;
    }

    .slider {
        -webkit-appearance: none;
        width: 100%;
        height: 25px;
        background: #d3d3d3;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .slider:hover {
        opacity: 1;
    }

    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 25px;
        height: 25px;
        background: #4CAF50;
        cursor: pointer;
    }

    .slider::-moz-range-thumb {
        width: 25px;
        height: 25px;
        background: #4CAF50;
        cursor: pointer;
    }
</style>
	
  </body>
</html>
