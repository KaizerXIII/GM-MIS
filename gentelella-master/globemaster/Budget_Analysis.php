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
          <div class="row tile_count">
          </div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="dashboard_graph">

                <div class="row x_title">
                  <div class="col-md-6">
                  <!-- dropdown input here? -->
                    <h3>Sales Variance Analysis for the Year: 
                    <select id="selectYear" name = "selectYear" style=" width:90px";>
                                <?php
                                    require_once('DataFetchers/mysql_connect.php');
                                    $query = "SELECT YEAR(order_date) AS years
                                    FROM orders
                                    GROUP BY YEAR(order_date)
                                    ORDER BY YEAR(order_date);";                      
                                    $resultofQuery =  mysqli_query($dbc, $query);
                                    while($row=mysqli_fetch_array($resultofQuery,MYSQLI_ASSOC))
                                    {
                                      echo '<option value="'.$row['years'].'">'.$row['years'].'</option> ';
                                    }           
                                ?> <!-- PHP END [ Getting the Warehouses from DB ]-->   
                        </select></h3> 
                  </div>
                </div>

                <!-- test -->
                <div class="row">
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="x_panel">
                      <div class="x_content">
                      <?php
                        $query1 = "SELECT nextMonthSales 
                        FROM ref_eoqformula;";                      
                        $resultofQuery1 =  mysqli_query($dbc, $query1);
                        $row1=mysqli_fetch_array($resultofQuery1,MYSQLI_ASSOC);
                        // echo $row1['nextMonthSales'];
                      
                        $expectedsales = $row1['nextMonthSales'];
                      ?>

                        <canvas id="mybarChart" width="350" height="180">></canvas>
                      </div>
                    </div>
                    <p><font color = "lightblue">Drag the slider to change expected sales values.</font></p>
                    <p><b>Expected Sales: ₱ <span id="value"></span>.00</b></p>
                    <div class="slidecontainer" id = "sliderAmount">
                            <input type="range" min="1" max="<?php echo $expectedsales + $expectedsales;?>" value="<?php echo $expectedsales;?>" class="slider" id="rangeSlider" onchange = "updateExpected()"> </input>
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

                <div class="col-md-4 col-sm-4 col-xs-12">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Current Data From Paid Sales:  </h2>

                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                      <table class="table table-bordered" id = "walao">
                        <thead>
                          <tr>
                            <th>For the Month</th>
                            <th>Actual Sales</th>
                            <th>Sales Variance</th>
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
                              echo '<td align= "right" id = "variance'.$result1['months'].'">';
                              echo '₱ '."".number_format(($result1['totalamtsales'] - $expectedsales = $row1['nextMonthSales']), 2);
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
      // function changeExpected()
      // {
      //   console.log("hi");  
      // }
    </script>

    
    <script>
        // Bar chart
        
        var variancearray = [];
        var totalsales_month = [];
        var expectedsalesfromPHP = <?php echo json_encode($expectedsales);?>;
      
      if ($('#mybarChart').length)
      { 

			  $(document).ready(function()
        {
        $.ajax({
          url: "DataFetchers/DataTest.php",
          method: "GET",
          success: function(data) {
            console.log(data);

            var expected = [];
            var expectedSlider = document.getElementById("rangeSlider");

            console.log(expectedsalesfromPHP);
            console.log(data);
            
            for(var i in data) 
            {
              console.log(data[i]);

              totalsales_month.push(data[i].totalamtsales);
              expected.push(expectedsalesfromPHP);
              variancearray.push(Math.abs(data[i].totalamtsales - expectedsalesfromPHP)); //computes for variance by subtracting total sales per month to expected sales. gets absolute value.

              console.log(variancearray);
            }
			  
            var ctx = document.getElementById("mybarChart");
            mybarChart = new Chart(ctx, 
            {
              type: 'bar',
              data: 
              {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: 
                [
                  {
                  label: 'Actual Sales',
                  borderColor: "#26B99A",
                  fill:false,
                  data: totalsales_month
                  },
                  {
                  label: 'Expected Sales',
                  borderColor: "#273746",
                  borderDash: [5, 5],
                  fill: 1,
                  backgroundColor: 'rgba(153, 0, 0, 0.5)',
                  data: expected
                  },
                  {
                  label: 'Sales Variance',
                  type: 'line',
                  borderColor: "#DF013A",
                  fill: false,
                  data: variancearray
                  }
                ]
            },
              options: 
              {
                tooltips: 
                {
                  mode: 'label'
                },
                  hover: 
                  {
                    mode:'dataset'
                  },
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
  <!-- UPDATE CHARTS BASED ON SLIDER SCRIPT -->
  <script>
    var expectedSlider = document.getElementById("rangeSlider");
    var variancecompute = [];
    function updateExpected()
    {
      console.log(expectedSlider.value);
      console.log("hrenlo");

      for(var j = 0; j <= 11; j++)
        {
          window.variancearray[j] = 0;
          // console.log(window.variancearray[j]);
        }
      for(var i = 0; i <= 11; i++)
      {
        var expectedsalesrecompute = expectedSlider.value;
        

        window.mybarChart.data.datasets[1].data[i] = expectedsalesrecompute;
        // console.log(window.totalsales_month[i]);
        // console.log(expectedsalesrecompute);
        // console.log(window.mybarChart.data.datasets[2].data);
        // console.log(window.variancearray);
        window.variancearray[i] = (Math.abs(window.totalsales_month[i] - expectedsalesrecompute));
        variancecompute[i] = window.totalsales_month[i] - expectedsalesrecompute;
        console.log("Variance Array: "+variancecompute[i]); 

        console.log(window.variancearray[i]); 
        window.mybarChart.update();
      }

      $('#varianceJanuary').html("₱ " + parseFloat(variancecompute[0]).toFixed(2));
      $('#varianceFebruary').html("₱ " + parseFloat(variancecompute[1]).toFixed(2));
      $('#varianceMarch').html("₱ " + parseFloat(variancecompute[2]).toFixed(2));
      $('#varianceApril').html("₱ " + parseFloat(variancecompute[3]).toFixed(2));
      $('#varianceMay').html("₱ " + parseFloat(variancecompute[4]).toFixed(2));
      $('#varianceJune').html("₱ " + parseFloat(variancecompute[5]).toFixed(2));
      $('#varianceJuly').html("₱ " + parseFloat(variancecompute[6]).toFixed(2));
      $('#varianceAugust').html("₱ " + parseFloat(variancecompute[7]).toFixed(2));
      $('#varianceSeptember').html("₱ " + parseFloat(variancecompute[8]).toFixed(2));
      $('#varianceOctober').html("₱ " + parseFloat(variancecompute[9]).toFixed(2));
      $('#varianceNovember').html("₱ " + parseFloat(variancecompute[10]).toFixed(2));
      $('#varianceDecember').html("₱ " + parseFloat(variancecompute[11]).toFixed(2));

      
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
