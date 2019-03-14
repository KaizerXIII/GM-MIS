<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Edit Inventory</title>

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
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
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
        </div><!--END Main Container?-->
                <!-- page content -->
            <div class="right_col" role="main">
                    <!-- top tiles -->
                    
                    

                    <!-- /top tiles -->

                    

                  
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <div class="x_panel" >
                            <div class="x_title">
                                <h1>Edit Inventory - 
                                    <?php
                                     if(isset($_GET['sku_id'], $_GET['item_id']))
                                     {
                                        $_SESSION['getIDfromView'] = $_GET['sku_id'];
                                        $_SESSION['item_IDfromView'] = $_GET['item_id']; //Stores the Value of Get from View Inventory
                                        echo $_SESSION['getIDfromView']; 
                                        
                                     }
                                     else
                                     {
                                        // echo $_GET['getValue'];
                                        echo $_SESSION['getIDfromView']; 
                                     }
                                    ?>
                                
                                <div class="clearfix"></div>
                            </div> <!--END Xtitle-->
                           
                            <div class="x_content">
                                <br>

                                <form class="form-horizontal form-label-center" method="GET">

                                
                                    <div class="col-md-6 col-sm-6 col-xs-12" >
                                        <div class="x_panel" >

                                            <center><font color = "#2a5eb2"><h3>Item Details </h1>
                                            
                                            </h3></font></center>
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">SKU </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "sku_id" class="form-control" readonly="readonly" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Name</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input name = "pangalan" type="text" id = "item_name" class="form-control" readonly="readonly">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Type</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "item_tyoe" class="form-control" readonly="readonly" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Count</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "item_count" class="form-control" readonly="readonly" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "supplier_name" class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "item_price" class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Warehouse Location</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "warehouse_name" class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Restock</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "last_restock" class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Update</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "last_update" class="form-control" readonly="readonly">
                                                </div>
                                            </div>
                                            
                                        </div> <!--END XPanel-->
                                    </div> <!--END Class Colmd-->
                                          
                                    <div class="col-md-6 col-sm-6 col-xs-12" >                                  
                                        <div class="x_panel" >

                                            <center><font color = "#09961e"><h3>Restocking</h3></font></center>
                                            <div class="ln_solid"></div>

                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-1">
                                                    <button type="button" class="btn btn-round btn-primary" id = "restockbtnE" onclick = "enableRestocking();" style = "display:block"><i class="fa fa-cubes"></i> Enable Restocking</button>
                                                    <button type="button" class="btn btn-round btn-danger" id = "restockbtnD" onclick = "disableRestocking();" style = "display:none"><i class="fa fa-cubes"></i> Disable Restocking</button>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <br>
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Restock Amount:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" name ="restockAmount" id = "restockamt" class="form-control" value = "0" min = "1">
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>

                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12" align = "center">
                                                <!--  -->
                                                    <button type="submit" class="btn btn-success" onclick = "updatestockalert(this)" id = "updatestock" name ="restockBtn" >Update</button>
                                                    <button type="reset" class="btn btn-danger" id = "resetstockinput">Reset</button>

                                                      <?php  // UPDATE item stock 
                                                        
                                                        require_once('DataFetchers/mysql_connect.php');
                                                        if(isset($_GET['restockBtn'], $_GET['restockAmount'])) //checks if both GET have values because the form post is = "GET"                                                    
                                                        {               
                                                         
                                                            $restockCount = $_GET['restockAmount'];
                                                            
                                                            $itemIDfromViewInventory = $_SESSION['item_IDfromView'];
                                                            $sqlInsert = "UPDATE items_trading  
                                                            SET items_trading.item_count  = (item_count + '$restockCount'),
                                                            last_restock = Now() 
                                                            WHERE item_id ='$itemIDfromViewInventory';"; //Updates the item count in DB
                                                            $result=mysqli_query($dbc,$sqlInsert); 
                                                            
                                                            if(!$result) 
                                                            {
                                                                die('Error: ' . mysqli_error($dbc));
                                                            } 
                                                            else 
                                                            {
                                                                echo '<script language="javascript">';
                                                                echo 'alert("Successful!");';
                                                                echo '</script>';
                                                            }

                                                            $itemID =  $_SESSION['item_IDfromView'];
                                                            $queryToInserttoRestockTable = "INSERT INTO restock_detail (item_id, quantity, restock_date)
                                                            VALUES ('$itemID','$restockCount',Now())";
                                                            $result=mysqli_query($dbc,$queryToInserttoRestockTable); 

                                             
                                                        }                                                     
                                                    ?>

                                                   

                                            </div> <!-- Col MD -->
                                        </div> <!-- FormGRP -->
                                  
                                </div> <!--END Xpanel -->
                            </div><!--END Col MD-->

                             <div class="col-md-6 col-sm-6 col-xs-12" >
                                   
                                   <div class="x_panel" id ="damageDiv">

                                        <center><font color = "red"><h3>Add Damaged Item:  
                                        <?php
                                               if(isset($_GET['id']))
                                               {
                                                   
                                                   echo $_SESSION['getIDfromView']; 
                                                   
                                               }
                                               else
                                               {
                                                   // echo $_GET['getValue'];
                                                   echo $_SESSION['getIDfromView']; 
                                                   
                                               }
                                       ?>
                                       </h3></font></center>

                                       <div class="ln_solid"></div>   
                                   
                                       <div class="form-group">
                                           <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-1">
                                               <button type="button" class="btn btn-round btn-warning" id = "addDamage" onclick = "enableDamaged()"><i class="fa fa-plus-circle"></i> Add a Damaged Item</button>
                                            
                                           </div>
                                       </div>

                                       
                                       <div class="form-group">
                                       <br>
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Damaged Quantity</label>
                                           <div class="col-md-6 col-sm-6 col-xs-12">
                                               <input   name ="damageQuantity" type="number" id = "dmgqty" class="form-control"  max = "" min = "0" >
                                           </div>
                                       </div>

                                       <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Percentage of Damage</label>
                                           <div class="col-md-6 col-sm-6 col-xs-12">
                                               <input   name ="damagePercent" type="number" id = "percentdmg" class="form-control"  placeholder="Max 100%" max = "100" min = "0" >
                                           </div>
                                       </div>

                                       <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Price Each</label>
                                           <div class="col-md-6 col-sm-6 col-xs-12">
                                               <input   name = "damagePrice" type="number" id = "priceeach" class="form-control" readonly="readonly" >
                                           </div>
                                       </div>  

                                       <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Loss</label>
                                           <div class="col-md-6 col-sm-6 col-xs-12">
                                               <input   name ="totalLoss" type="number" id = "totalloss" class="form-control" readonly="readonly">
                                           </div>
                                       </div>

                                       <div class="ln_solid"></div>

                                       <div class="form-group" id="UpdateDamageForm" >
                                           <div class="col-md-12 col-sm-12 col-xs-12" align = "right">
                                               <button type="submit" class="btn btn-success" id = "updatedmg" name = "UpdateDamage">Update</button>
                                               <button type="reset" class="btn btn-primary" id = "resetdmg">Reset</button>
                                               <button type="reset" class="btn btn-danger" onclick = "cancelDamaged()" id = "canceldmg">Cancel</button>

                                               <script>
                                                    function loginForm() 
                                                    {
                                                        document.getElementById("UpdateDamageForm").click();
                                                    }
                                                </script>
                                              
                                               <?php

                                              
                                                if(isset($_GET['UpdateDamage'],$_GET['damageQuantity']))
                                                {               
                                                    echo "sho mi da waeee";
                                                   
                                                    $damageQuantityFromHTML = $_GET['damageQuantity'];
                                                    $damagePercentFromHTML = $_GET['damagePercent'];                                                    
                                                    $damageTotalFromHTML = $_GET['totalLoss'];

                                                    echo $damageQuantityFromHTML;
                                                    echo $damagePercentFromHTML;
                                                    echo $damageTotalFromHTML;

                                                    $_SESSION['getDamageQuantity'] = $damageQuantityFromHTML;
                                                    $_SESSION['getDamagePercent'] = $damagePercentFromHTML;
                                            
                                                     $_SESSION['getDamageLoss'] = $damageTotalFromHTML;
                                                   
                                                }

                                                ?>
                                           </div>
                                        </div>

                                   </div> <!--END XPANEL -->
                               </div><!--END ColMD-->

                               <div class="clearfix"></div>
                                    <br>
                                    <div class="col-md-6 col-sm-6 col-xs-12" >
                                        
                                        <div class="x_panel">

                                             <center><h3>Recently Added Damages for Item:
                                             <?php
                                                    if(isset($_GET['id']))
                                                    {
                                                        
                                                        echo $_SESSION['getIDfromView']; 
                                                        
                                                    }
                                                    else
                                                    {
                                                        // echo $_GET['getValue'];
                                                        echo $_SESSION['getIDfromView'];    
                                                    }
                                            ?>
                                            </h3></center>

                                             <div class="ln_solid"></div>   

                                             <!-- recently damaged table -->
                                             <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                
                                                    <div class="x_content">

                                                        <table id ="damageTable" class="table">
                                                            <thead>
                                                                <tr>    
                                                                <th>New Item Name</th>
                                                                <th>Quantity</th>
                                                                
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                
                                                                </tr>                                                         
                                                            </tbody>
                                                        </table>
                                                        
                                                    </div> <!--END Xcontent-->
                                                </div><!--END Col MD-->
                                            </div><!--END Class-row -->
                                        
                                        </div><!--END XPanel-->
                                    
                                </div><!--ENDCol MD-->

                               <div class="col-md-12 col-sm-12 col-xs-12" align = "right">
                                        
                                        <div class="ln_solid"></div>
                                            <button name = "confirmButton" type="submit" class="btn btn-success" onclick ="generalAlert()">Confirm</button>
                                            <button type="reset" class="btn btn-warning" onclick="clearLocalStorage()">Archive</button>

                                            <?php 
                                            
                                                if(isset($_GET['confirmButton']))
                                                {
                                                    
                                                    $currentItemID = $_SESSION['item_IDfromView'];
                                                    $currentItemName = $_SESSION['current_name'];

                                                    $currentDmgQuantity = $_SESSION['getDamageQuantity'];
                                                    $currentDmgPercent = $_SESSION['getDamagePercent'];
                                            
                                                    $currentDmgLoss =  $_SESSION['getDamageLoss'];

                                                
        
                                                  
                                                    $insertToDamageTable = "INSERT INTO damage_item (refitem_id, item_name, damage_percentage, item_quantity,total_loss,last_update)
                                                    VALUES ('$currentItemID', '$currentItemName','$currentDmgPercent','$currentDmgQuantity','$currentDmgLoss',Now())";
                                                    $resultofInsert  = mysqli_query($dbc, $insertToDamageTable); 

                                                    if(!$resultofInsert) 
                                                    {
                                                        die('Error: ' . mysqli_error($dbc));
                                                        echo '<script language="javascript">';
                                                        echo 'alert("Error In Insert!");';
                                                        echo '</script>';
                                                    } 
                                                    else 
                                                    {
                                                        echo '<script language="javascript">';
                                                        echo 'alert("Successful!");';
                                                        echo '</script>';
                                                    }
                                                }
                                            
                                                
                                            ?>
                                        </div><!--END Col MD-->
                                    
                            </div> <!--END X Panel-->
                        </div><!--END Col MD-->
                            </form>
                                    
                                    
                                    
                                
                              
                                    
                                        
                        
                    </div><!--END Role=Main -->
                </div><!--END Container Body-->
          
</body>
<!-- /page content -->
<?php
    require_once('DataFetchers/mysql_connect.php');
   
    $skuID = $_SESSION['getIDfromView'];

    $skuArray = array();
    $itemNameArray = array();
    $itemTypeArray = array();
    $itemCountArray = array();
    $supplierArray = array(); 
    $priceArray = array(); 
    $warehouseArray = array();
    $lastRestockArray = array();
    $lastUpdateArray = array();

    $query = "SELECT * FROM items_trading
    JOIN warehouses ON warehouses.warehouse_id = items_trading.warehouse_id
    JOIN suppliers ON suppliers.supplier_id = items_trading.supplier_id
    JOIN ref_itemtype ON ref_itemtype.itemtype_id = items_trading.itemtype_id
    WHERE sku_id =  '$skuID'
    order by item_id
    ;";

    $result = mysqli_query($dbc, $query);
    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
    {
        $skuArray[] = $row['sku_id'];
        $itemNameArray[] = $row['item_name']; 
        $itemTypeArray[] = $row['itemtype']; 
        $itemCountArray[] = $row['item_count']; 
        $supplierArray[] = $row['supplier_name']; 
        $priceArray[] = $row['price']; 
        $warehouseArray[] = $row['warehouse']; 
        $lastRestockArray[] = $row['last_restock']; 
        $lastUpdateArray[] = $row['last_update']; 

        
    }
    
    $_SESSION['current_name'] = $itemNameArray[0];
    echo '<script>';

    echo "var sku_idfromPHP = ".json_encode($skuArray).";";
    echo "var itemNamefromPHP = ".json_encode($itemNameArray).";";
    echo "var itemTypefromPHP = ".json_encode($itemTypeArray).";";
    echo "var itemCountfromPHP = ".json_encode($itemCountArray).";";
    echo "var supplierNamefromPHP = ".json_encode($supplierArray).";";
    echo "var itempricefromPHP = ".json_encode($priceArray).";";
    echo "var warehousefromPHP = ".json_encode($warehouseArray).";";
    echo "var lastRestockfromPHP = ".json_encode($lastRestockArray).";";
    echo "var lastUpdatefromPHP = ".json_encode($lastUpdateArray).";"; // Get values from items_trading table to JS Variable
        
    echo "var SKUfromHTML = document.getElementById('sku_id');";
    echo "var itemNamefromHTML = document.getElementById('item_name');";
    echo "var itemTypefromHTML = document.getElementById('item_tyoe');";
    echo "var itemCountfromHTML = document.getElementById('item_count');";
    echo "var supplierfromHTML = document.getElementById('supplier_name');";
    echo "var itemPricefromHTML = document.getElementById('item_price');";
    echo "var warehousefromHTML = document.getElementById('warehouse_name');";
    echo "var lastRestockfromHTML = document.getElementById('last_restock');";
    echo "var lastUpdatefromHTML = document.getElementById('last_update');";
       
    echo 'SKUfromHTML.value = sku_idfromPHP[0];';
    echo 'itemNamefromHTML.value = itemNamefromPHP[0];';
    echo 'itemTypefromHTML.value = itemTypefromPHP[0];';
    echo 'itemCountfromHTML.value = itemCountfromPHP[0];';
    echo 'supplierfromHTML.value = supplierNamefromPHP[0];';
    echo 'itemPricefromHTML.value = itempricefromPHP[0];';
    echo 'warehousefromHTML.value = warehousefromPHP[0];';
    echo 'lastRestockfromHTML.value = lastRestockfromPHP[0];';
    echo 'lastUpdatefromHTML.value = lastUpdatefromPHP[0];';

    echo '</script>';

    
                                          
    
?>

<script>
    var confirmButton = document.getElementById('updatedmg'); 

    var itemNameInEditInventory = document.getElementById('sku_id');
    var itemPriceInEditInventory = document.getElementById('item_price');

    var damagePercentage = document.getElementById('percentdmg');
    var priceEachBox = document.getElementById('priceeach');
    var dmgQtyBox = document.getElementById('dmgqty');
    var totalLossBox = document.getElementById('totalloss');
    
    
    damagePercentage.onkeyup = function()
    {
        
        var inputValue = damagePercentage.value;    
        var calculateDamagePrice = inputValue / 100;
        var priceEach = itemPriceInEditInventory.value * calculateDamagePrice;
        var totalLoss = dmgQtyBox.value * priceEach;
       
        priceEachBox.innerHTML = priceEach.toFixed(2)
        totalLossBox.innerHTML = totalLoss.toFixed(2);

        priceEachBox.value = priceEach.toFixed(2); 
        totalLossBox.value = totalLoss.toFixed(2);

    }
    
    confirmButton.onclick = function() 
    {  
        var inputValue = damagePercentage.value;    
        var newName = itemNameInEditInventory.value + damagePercentage.value;
        if(inputValue.length == 0)
        {
            alert("No Input Found");
        }
        else
        {
        
            var newRow = document.getElementById('damageTable').insertRow();                       
            newRow.innerHTML = "<tr> <td>"+ newName+ "</td> <td>" + damagePercentage.value+ "</td> </tr>";

            // damagePercentage.value = "";
            // dmgQtyBox.value = "";
            // priceEachBox.value = "";
            // totalLossBox.value = "";

        }
       
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

<!-- Restocking Onclick -->
<script>
// restock section
    var restockbtnE = document.getElementById("restockbtnE");
    var restockbtnD = document.getElementById("restockbtnD");
    var restockinput = document.getElementById("restockamt"); 

    var updatestock = document.getElementById("updatestock"); 
    var resetstock = document.getElementById("resetstockinput"); 

// damaged section

    var damagedbtn = document.getElementById("addDamage"); 

    var damagedqty = document.getElementById("dmgqty"); 
    var percentdmg = document.getElementById("percentdmg"); 
    var priceeach = document.getElementById("priceeach"); 
    var totalloss = document.getElementById("totalloss"); 

    var updatedamaged = document.getElementById("updatedmg"); 
    var resetdamaged = document.getElementById("resetdmg"); 
    var canceldamaged = document.getElementById("canceldmg"); 

    damagedbtn.disabled = false;

    restockinput.disabled = true;
    updatestock.disabled = true;
    resetstock.disabled = true;


    damagedqty.disabled = true;
    percentdmg.disabled = true;
    priceeach.disabled = true;
    totalloss.disabled = true;

    updatedamaged.disabled = true;
    resetdamaged.disabled = true;
    canceldamaged.disabled = true;

    function enableRestocking()
    {
        restockbtnE.style.display = "none";
        restockbtnD.style.display = "block";

        restockinput.disabled = false;
        updatestock.disabled = false;
        resetstock.disabled = false;
        
    }
    function disableRestocking()
    {
        restockbtnE.style.display = "block";
        restockbtnD.style.display = "none";

        restockinput.disabled = true;
        updatestock.disabled = true;
        resetstock.disabled = true;

        var insideval = restockinput.value = "0";
    }

    function updatestockalert()
    {
        var insideval = restockinput.value;
        alert("Do you want to restock this amount: " + insideval);

    }
    function generalAlert()
    {
        alert("Do you want to Continue?");
    }

    function enableDamaged()
    {
        damagedbtn.disabled = true;

        damagedqty.disabled = false;
        percentdmg.disabled = false;
        priceeach.disabled = false;
        totalloss.disabled = false;

        updatedamaged.disabled = false;
        resetdamaged.disabled = false;
        canceldamaged.disabled = false;
    }

    function cancelDamaged()
    {
        damagedbtn.disabled = false;

        damagedqty.disabled = true;
        percentdmg.disabled = true;
        priceeach.disabled = true;
        totalloss.disabled = true;

        updatedamaged.disabled = true;
        resetdamaged.disabled = true;
        canceldamaged.disabled = true;
    }
</script>


</body>

</html>