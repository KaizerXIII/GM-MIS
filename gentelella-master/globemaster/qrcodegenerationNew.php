<?php
    // function printQRCode($url, $size = 180) {
    //     return '<img id = "qrID" src="http://chart.apis.google.com/chart?chs=' . $size . 'x' . $size . '&cht=qr&chl=' . urlencode($url) . '" />';
    // }
    // Include Print Function
    include("print.php");
    // --
    if (isset($_GET['var_PHP_data'])) {
      print_r( $_GET['var_PHP_data']);
    } else {
?> 
 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | QR Code Generation</title>

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
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">

    <!-- Onhange Script -->
    <!-- QR Code Change Referenced from: http://www.snappymaria.com/misc/RealtimeQRCreator.html -- for future reference. This is OFFICIALLY DEPRECATED as of MARCH 18, 2019 -->

    <!-- NEW QR Code generation script referenced from http://goqr.me/api/doc/create-qr-code/ -- for future reference. -->
    <script type = "text/javascript">
      "use strict";
      var prevURL = "", qrSize = 170;
      function OnQRDataChange()
      {
        var qrData = document.getElementById("combine").value;
        alert(qrData);
        var qrURL = "https://api.qrserver.com/v1/create-qr-code/?data=" + encodeURIComponent(qrData) + "&size=" + qrSize + "x" + qrSize + "&bgcolor=e6ff0c";
        // alert(qrURL);
        if(prevURL !== qrURL)
        {
          alert("QR changed! Scan to confirm!");
          prevURL = qrURL;
          alert(qrURL);
          var qrID = document.getElementById("qrID");
          qrID.src = qrURL;
          qrID.alt = qrURL;
        }
      }
    </script>
    <!-- End QR Onchange script -->
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php
          require_once("nav.php");    
        ?>
      </div>
        <!-- page content -->
      <div class="right_col" role="main" style = "min-height: 1075px;">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1><i class="fa fa-qrcode"></i>  QR Code Generator</h1>
                   
                    <div class="clearfix"></div>
                  </div>

            <div class="col-md-10 col-sm-10 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Inventory Item Selection</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                      Select an inventory SKU to generate a QR code respectively. <br><font color = "red"> The QR code changes based on the clicked SKU. Please scan the QR code to confirm.</font>
                    </p>
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Item ID</th>
                          <th>Item Name</th>
                          <th>Item Type</th>
                          <th>Supplier</th>
                          <th>Stock</th>
                          <th>Warehouse Location</th>
                          <th>Price</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          require_once('DataFetchers\mysql_connect.php');
                          $querytogetDBTable = "SELECT item_id, item_name, itemtype, item_count, supplier_name, warehouse, price, sku_id FROM items_trading g 
                          JOIN ref_itemtype f ON g.itemtype_id
                          JOIN suppliers s ON g.supplier_id
                          JOIN warehouses w ON g.warehouse_id
                          WHERE g.itemtype_id = f.itemtype_id
                          AND g.supplier_id = s.supplier_id
                          AND g.warehouse_id = w.warehouse_id
                          ORDER BY g.item_id ASC";
                          $resultofQuery =  mysqli_query($dbc, $querytogetDBTable);

                          $itemid = array();
                          $itemname = array();
                          $itemtype = array();
                          $supplier = array();
                          $warehouse = array();
                          $price = array();
                          $SKU = array();
                          $stock = array();
                          
                          while($rowofResult=mysqli_fetch_array($resultofQuery,MYSQLI_ASSOC))
                          {
                            $itemid[] = $rowofResult['item_id'];
                            $SKU[] = $rowofResult['sku_id'];
                            $itemname[] = $rowofResult['item_name'];
                            $itemtype[] = $rowofResult['itemtype'];
                            $supplier[] = $rowofResult['supplier_name'];
                            $warehouse[] = $rowofResult['warehouse'];
                            $price[] = $rowofResult['price'];
                            $stock[] = $rowofResult['item_count'];
                            echo " <tr>";
                              echo '<td id = "SKU" onclick = "SKUclick(this), OnQRDataChange()">';
                              echo $rowofResult['sku_id'];
                              echo '</input></a></td>';  
                              echo '<td>';
                              echo $rowofResult['item_name'];
                              echo '</td>'; 
                              echo '<td>';
                              echo $rowofResult['itemtype'];
                              echo '</td>';  
                              echo '<td>';
                              echo $rowofResult['supplier_name'];
                              echo '</td>';  
                              echo '<td>';
                              echo $rowofResult['item_count'];
                              echo '</td>';
                              echo '<td>';
                              echo $rowofResult['warehouse'];
                              echo '</td>';  
                              echo '<td align = "right">';
                              echo '₱'." ".number_format($rowofResult['price'], 2);
                              echo '</td>';   
                            echo "</tr>";
                          };
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <br><br><br><br><br><br><br><br><br><br>
                <div class="col-md-2 col-sm-2 col-xs-12" id = "printQR" align = "center">

                <input type='text' style='display:none' id='itemsku' value = ''/>
                 <input type='text' style='display:none' id='itemname' value = ''/>
                 <input type='text' style='display:none' id='itemtype' value = ''/>
                 <input type='text' style='display:none' id='supplier' value = ''/>
                 <input type='text' style='display:none' id='warehouse' value = ''/>
                 <input type='text' style='display:none ' id='price' value = ''/>
                 <input type='text' style='display:none ' id='stock' value = ''/>
                 <input type='text' style='display:none' id='combine' value = '' onchange = "OnQRDataChange()" onkeyup = "OnQRDataChange()"/>
                 
                 <!-- <div id = 'result'></div> -->
                <div align = "center">
                 <img id = "qrID" src="https://api.qrserver.com/v1/create-qr-code/?data=Globe Master Trading&size=170x170&bgcolor=e6ff0c" alt="https://api.qrserver.com/v1/create-qr-code/?data=Globe Master Trading&size=170x170&bgcolor=e6ff0c"/>
                <br>
                 <label id='itemid' value = ''>Globe Master Trading Official QR Code</label>
                </div>
                 
                </div>
                <center><button type="button" class="btn btn-primary" onclick="printDiv('printQR')"><i class="fa fa-print"></i> Print Me!</button></center>
              </div>
            </div>
            
            <p class="text-muted font-13 m-b-30">
                      This QR Code generation tool is referenced from http://goqr.me/api/doc/create-qr-code/. a QR Code API.
                    </p>
          </div>
        </div>
      </div>
    </div>
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
    
    <!-- OnClick Function for td -->
    <script>
      function SKUclick(obj)
      {
        var itemid = <?php echo json_encode($itemid); ?>;
        var itemname = <?php echo json_encode($itemname); ?>;
        var itemtype = <?php echo json_encode($itemtype); ?>;
        var supplier = <?php echo json_encode($supplier); ?>;
        var warehouse = <?php echo json_encode($warehouse); ?>;
        var price  = <?php echo json_encode($price); ?>;
        var sku = <?php echo json_encode($SKU); ?>;
        var stock = <?php echo json_encode($stock); ?>;

        var itemidVal = document.getElementById("itemid");
        var skuVal = document.getElementById("itemsku");
        var itemnameVal = document.getElementById("itemname");
        var itemtypeVal = document.getElementById("itemtype");
        var supplierVal = document.getElementById("supplier");
        var warehouseVal = document.getElementById("warehouse");
        var priceVal = document.getElementById("price");
        var stockVal = document.getElementById("stock");
        var combineVal = document.getElementById("combine");
        // alert(obj.textContent);
        var varvar = obj.textContent;
        for(i=0; i <= sku.length; i++)
        {
          if(varvar == sku[i])
          {
            
            itemidVal.innerHTML = "SKU: " + sku[i];
            itemnameVal.value = itemname[i];
            itemtypeVal.value = itemtype[i];
            supplierVal.value = supplier[i];
            warehouseVal.value = warehouse[i];
            stockVal.value = stock[i];
            priceVal.value = price[i];
            combineVal.value = "SKU: " + sku[i] + " | " + "Item Name: " + itemname[i] + " | " + "Item Type: " + itemtype[i] + " | " 
            + "Supplier: " + supplier[i] + " | " + "Warehouse Location: " + warehouse[i] + " | " + "Item Price: " + price[i] + " | "
            + "Item Stock: " + stock[i];
            // alert(combineVal);
            var var_data = [sku[i], itemname[i], itemtype[i], supplier[i], warehouse[i], price[i], stock[i]];
            // alert(var_data);
            $.ajax({
              url: 'qrcodegeneration.php',
              type: 'GET',
                data: { var_PHP_data: var_data },
                success: function(data) {
                    // do something;
                  // alert("WOO!");
                  // alert(data);
                  $('#result').html(data);
                }
            });
          }
        }
      }
    </script>
	<style>
  td { cursor: pointer; }
  </style>
  </body>
</html>
<?php } ?>