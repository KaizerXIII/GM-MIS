<!DOCTYPE html>
<?php
require_once('DataFetchers/mysql_connect.php');

?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Economic Order Quantity</title>

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
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- JQUERY Required Scripts -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 
</head>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <?php
        require_once("nav.php");
        ?>
    </div>
    <!-- page content -->
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row tile_count">

        </div>
        <!-- /top tiles -->


        <div class="col-md-12 col-sm-6 col-xs-6">
            <div class="x_panel">
                <div class="x_title">
                    <!-- Note that only a maximum of 5 items can be checked -->
                    <h3><b>Economic Order Quantity | Inventory </b></h3>
                    
                    <?php
                        $SQL_GET_FROM_EOQ_TABLE = "SELECT * FROM ref_eoqformula";
                        $RESULT_GET_FROM_EOQ_TABLE = mysqli_query($dbc,$SQL_GET_FROM_EOQ_TABLE);
                        $ROW_RESULT_GET_FROM_EOQ_TABLE = mysqli_fetch_array($RESULT_GET_FROM_EOQ_TABLE,MYSQLI_ASSOC);

                        echo '<h2> Acquisition Cost: ₱ '.$ROW_RESULT_GET_FROM_EOQ_TABLE['AcquisitionCost'].'  | Holding Cost Percentage: '. $ROW_RESULT_GET_FROM_EOQ_TABLE['InventoryCost'].'% </h2>';

                    ?>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" >

                    <table id="datatable" class="table table-striped table-bordered" width="300px" >
                        <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Category</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php

                        require_once('DataFetchers/mysql_connect.php');

                        $sqlToFormula = "SELECT * FROM ref_eoqformula";
                        $resultOfSql = mysqli_query($dbc,$sqlToFormula);

                        $AcquisitionCostFromDB = array();
                        $HoldingCostFromDB = array();

                        while($rowOfResult=mysqli_fetch_array($resultOfSql,MYSQLI_ASSOC))
                        {
                            $AcquisitionCostFromDB[] = $rowOfResult['AcquisitionCost'];
                            $HoldingCostFromDB[] = $rowOfResult['InventoryCost'];
                        }


                        $query = "SELECT * FROM items_trading 
                              JOIN ref_itemtype 
                              WHERE ref_itemtype.itemtype_id = items_trading.itemtype_id";

                        $result=mysqli_query($dbc,$query);

                        $count = 0;
                        $arrayofCount = array();// to give unique ID to <td> in tabol

                        $itemNameArray = array();
                        $itemPrice = array();
                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                        {
                            $itemNameArray[] = $row['item_name'];
                            $itemPrice[] = $row['price'];

                            echo' <tr>';
                            echo'<td id = itemNameRow',$count,' width="250px" onclick="myTD(this)">';
                            echo $row['item_name'];
                            echo'</td>';
                            echo'<td id = itemTypeRow',$count,' width="250px">';
                            echo $row['itemtype'];
                            echo'</td>';
                            echo '</tr>';

                            $arrayofCount[] = $count;
                            $count += 1;
                        }
                        echo '<script>';
                        echo 'var arrayCountFromPHP = '.json_encode($arrayofCount).';';
                        echo 'var itemNameFromPHP = '.json_encode($itemNameArray).';';
                        echo ' var ItemPriceFromPHP = '.json_encode($itemPrice).';';

                        echo 'var ordering_cost = ' .json_encode($AcquisitionCostFromDB).';';
                        echo ' var AcquisitionCostFromPHP = '.json_encode($AcquisitionCostFromDB).';';
                        echo ' var HoldingCostFromPHP = '.json_encode($HoldingCostFromDB).';'; //Gets Necessary Variables from PHP to be used in javascript
                        echo '</script>'
                        ?>



                        </tbody>

                        <div class="x_content; col-md-12 col-sm-9 col-xs-12 bg-white" id ="eoqchartID">

                            <canvas id="eoqChart" height = "100"> </canvas>

                        </div> <!-- Canvas Div -->

                        <div class="slidecontainer" id = "sliderAmount">
                            <input type="range" min="1" max="" value="" class="slider" id="rangeSlider"> 

                            <h3><p>3-Month Demand Value: <b><span id="value"></span></b></p></h3>
                            <!-- Current Demand Within 3 Months: 
                            
                            <input id = "maxInput" type ="number" min = "0" onkeydown="return processKey(event)" value = "0">  -->
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


                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

</div>
<?php
require_once('DataFetchers/mysql_connect.php');


// $itemPrice = array();

// $queryToGetItemPrice = "SELECT * FROM items_trading";
// $resultOfQuery=mysqli_query($dbc,$queryToGetItemPrice);
// while($rowOfResultQuery=mysqli_fetch_array($resultOfQuery,MYSQLI_ASSOC))
// {
//   for($i = 0; $i < sizeof($itemNameArray); $i++)
//   {
//     if($rowOfResultQuery['item_name']==$itemNameArray[$i])
//     {
//       $itemPrice[] = $rowOfResultQuery['price'];
//       // echo  $itemPrice[$i];
//     }
//   }
// }



// echo $AcquisitionCostFromDB[0], "<br>";
// echo $HoldingCostFromDB[0]/100;


?> <!-- END PHP EOQ FORMULA -->



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

<!-- ECharts -->
<script src="../vendors/echarts/dist/echarts.min.js"></script>
<script src="../vendors/echarts/map/js/world.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<script>
    // Line chart
    <?php
    require_once('DataFetchers/mysql_connect.php');
    $query = "SELECT * FROM items_trading";
    $result=mysqli_query($dbc,$query);
    $itemQty = array();
    $TOTAL_DEMAND = array();

    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
        $length = count($row);
        $i = $row['item_id'];
        foreach((array) $i as $count)
        {
            $query1 = "SELECT *,SUM(item_qty) as total_amount FROM order_details where item_id = '".$count."' GROUP BY 1,2";
            $resultOrderDetail = mysqli_query($dbc,$query1);
            if (!$resultOrderDetail) {
                printf("Error: %s\n", mysqli_error($dbc));
                exit();
            }
            $qtyfromOrderDeatils = mysqli_fetch_array($resultOrderDetail,MYSQLI_ASSOC);
            $itemQty[] = $qtyfromOrderDeatils['total_amount'];
        }
        
        $SQL_GET_2_MONTHS_DEMAND = "SELECT od.*,SUM(od.item_qty) as total_amount FROM
        order_details od JOIN orders o on od.ordernumber = o.ordernumber 
        where od.item_id = '$i' and (o.order_date 
        between DATE_SUB(DATE(NOW()), INTERVAL 90 DAY ) and DATE(NOW())) GROUP BY 1,2";
        $RESULT_GET_2_MONTHS_DEMAND = mysqli_query($dbc,$SQL_GET_2_MONTHS_DEMAND);
        $ROW_RESULT_GET_2_MONTHS_DEMAND = mysqli_fetch_array($RESULT_GET_2_MONTHS_DEMAND,MYSQLI_ASSOC);

        $TOTAL_DEMAND[] = $ROW_RESULT_GET_2_MONTHS_DEMAND['total_amount']/90;
        
        echo "var demandFromPHP = ".json_encode($TOTAL_DEMAND).";";
       
                            
    }
    ?>
    

    var expected = <?php  echo json_encode($itemQty)?>;
    var label_data = [];
    label_data.push(0);
    for (var i = 1; i <=20; i++) {
        label_data.push(i*10); //questionable: why 100?
    }

    var ctx = document.getElementById("eoqChart");
    myChart = new Chart(ctx, {
        type: 'bar',
        //Acquisition Costs. HoldingCost, ItemPrices
        data: {
            labels: label_data,
            datasets: [
                {
                    label: "Annual Holding Cost",
                    data: [],
                    fill: false,
                    type:'line',
                    backgroundColor: [
                        '#ff151a'
                    ],
                    borderColor:
                        '#ff151a',
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1},

                {
                    label: "Annual Acquisition Costs",
                    data: [],
                    type:'line',
                    fill: false,
                    backgroundColor: [
                        'rgba(38, 185, 154, 0.31)'
                    ],
                    borderColor:
                        'rgba(38, 185, 154, 0.7)',
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1},
                {
                    label: "Annual Total Costs",
                    data: [],
                    fill: false,
                    type:'line',
                    backgroundColor: [
                        'rgba(38, 185, 154, 0.31)'
                    ],
                    borderColor:
                        'rgba(38, 185, 154, 0.7)',
                    pointBorderColor: "rgba(38, 185, 154, 0.7)",
                    pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                    pointHoverBackgroundColor: "#fff",
                    pointHoverBorderColor: "rgba(220,220,220,1)",
                    pointBorderWidth: 1,},
                {
                    label: "E.O.Q",
                    data: [],
                    fill: false,
                    type:'line',
                    backgroundColor: [
                        '#ff151a'
                    ],
                    borderColor:
                        '#046f00',
                    pointStyle: 'triangle',
                    pointRadius: 20,
                    pointBorderColor: "#046f00",
                    pointBackgroundColor: "#046f00",
                    pointHoverBackgroundColor: "#046f00",
                    pointHoverBorderColor: "#046f00",
                    pointBorderWidth: 1},


            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                    }
                }],
                xAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }

    });
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


<script>


    var curr_item_selected_price = 200;
    var demand = slider.value;
    var eoq = 100;
    var this_obj = null;
    var slide = document.getElementById('rangeSlider'),
        sliderDiv = document.getElementById("sliderAmount");
    slider.onchange = function()
    {
        demand = this.value;
        $('#value').text(demand);
        myTD(this_obj);
        //recompute_chart(curr_item_selected_price);
    }

    function myTD(obj) {
//  alert(obj.innerHTML);
        var textFromHTML = obj.innerHTML;
        this_obj = obj;
        console.log(AcquisitionCostFromPHP);
        console.log(ItemPriceFromPHP);
        console.log(HoldingCostFromPHP);
        for(var i = 0; i < itemNameFromPHP.length; i++){
            
            if(itemNameFromPHP[i] == textFromHTML )
            {
               
                
                var eoq = Math.sqrt((2 * demand * AcquisitionCostFromPHP[0]) / ((HoldingCostFromPHP[0]/100) * ItemPriceFromPHP[i]));
                var Final = eoq.toFixed(2);
                // echo 'tableCell[i].textContent = Final;

                curr_item_selected_price = ItemPriceFromPHP[i];
                window.eoq = Final;
                computeLabels(Final);
                recompute_chart(ItemPriceFromPHP[i]);

                console.log(demandFromPHP[i]);
                $("#rangeSlider").attr({
                    "max": demandFromPHP[i] + 1000,
                    "value": demandFromPHP[i].toFixed(2)
                });
                // $('#value').text($("#rangeSlider").attr('value'));
                console.log("EOQ Val: "+Final);   
                // echo'break;';
            };//End IF

        } //End For

    } //END Function
    function recompute_chart(item_cost){
        //Annual Holding Cost
        //computeLabels()
        window.myChart.data.datasets[0].data.splice(0,25);
        window.myChart.data.datasets[0].data.push(null);
        window.myChart.data.datasets[1].data.splice(0,25);
        window.myChart.data.datasets[1].data.push(null);
        window.myChart.data.datasets[2].data.splice(0,25);
        window.myChart.data.datasets[2].data.push(null);
        window.myChart.data.datasets[3].data.splice(0,25);
        placed = false;
        for (var i = 1; i <= 20; i++) {


            //Annual Acquisition Cost
            // fxn = (annual demand / qty) * ordering cost(50,000) static yan muna
            pt1 = (demand/window.myChart.data.labels[i])*AcquisitionCostFromPHP[0];
            window.myChart.data.datasets[0].data.push(pt1);
            //Annual Holding Costs


            pt2 = (window.myChart.data.labels[i]/2)*HoldingCostFromPHP[0]/100*item_cost;
            window.myChart.data.datasets[1].data.push(pt2);
            //Annual Total Cost
            pt3 = pt1+pt2;
            window.myChart.data.datasets[2].data.push(pt3);
            if (placed === false && (i*100>eoq)){
                placed = true;
                if (eoq === parseFloat(i*100)) {
                    not_equals = false;
                    placed = false;
                }
                if(not_equals){
                    window.myChart.data.datasets[0].data.push(pt1);
                    window.myChart.data.datasets[1].data.push(pt2);
                    window.myChart.data.datasets[2].data.push(pt3);
                    window.myChart.data.datasets[3].data.push(eoq*(HoldingCostFromPHP[0]));
                }

            }else{
                window.myChart.data.datasets[3].data.push(null);
            }

            window.myChart.update();
        }
        console.log("Garp:"+ window.myChart.data.datasets[3].data);
        window.myChart.update();
    }
    //Annual Holding Costs. Annual Acquisition Cost, Annual Total Cost
    function computeLabels(eoq){
        window.myChart.data.labels.splice(0,25);
        placed = false;
        not_equals=true;
        for (var i = 1; i <=20; i++) {
            if (placed === false && (i*100>eoq)) {
                if (eoq === parseFloat(i * 100)) {
                    not_equals = false;
                }
                
                if (not_equals) {
                    window.myChart.data.labels.push(eoq);
                }
                placed = true;
            }
            window.myChart.data.labels.push(i*100);
        }
        window.myChart.update();
    }
</script>

</body>
</html>
