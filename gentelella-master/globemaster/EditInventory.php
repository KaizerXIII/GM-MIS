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
    <!-- JQUERY Required Scripts -->
        
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 
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
                                <font color = "black"><h1>Edit Inventory - 
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
                                </h1></font>
                                <div class="clearfix"></div>
                            </div> <!--END Xtitle-->
                           
                            <div class="x_content">

                               <?php
                                    $GET_ID = $_SESSION['item_IDfromView'];
                                    $discountpercent = array();
                                    $discountdateend = array();
                                    $discountstatus = array();
                                    $ON_DISCOUNT = "On Discount";
                                    $queryDiscountNotif = "SELECT * FROM discounts  
                                    JOIN items_trading ON items_trading.item_id = discounts.item_id
                                    WHERE items_trading.item_id = '$GET_ID' 
                                    AND items_trading.onDiscount = '$ON_DISCOUNT';";
                                    $resultDiscountNotif = mysqli_query($dbc,$queryDiscountNotif);
                                  
                                    while($rowDiscountNotif = mysqli_fetch_array($resultDiscountNotif,MYSQLI_ASSOC))
                                    {
                                        $discountpercent[] = $rowDiscountNotif['percentage'];
                                        $discountdateend[] = $rowDiscountNotif['dateEnd'];
                                        $discountstatus[] = $rowDiscountNotif['onDiscount'];
    
                                    }
                                   
                                  
                                    for($i = 0; $i < sizeof($discountpercent); $i++)
                                    {
                                        if($discountstatus[$i] = "On Discount")
                                        {
                                    
                                        echo '<div class="col-md-12 col-sm-12 col-xs-12" >';
                                         echo '<p><font color = "red">This item is on a '.$discountpercent[$i].'% discount. The discount will end at '.$discountdateend[$i].'</font></p>';
                                        echo '</div>';
                                  
                                        }
                                        else
                                        {
                                            echo "<p><font color = 'blue'>This item is currently on its regular price.</font></p>";
                                        }
                                    }
                                    
                                ?>

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
                                            <div class="form-group">
                                                <br><br>
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id = "item_price" class="form-control" readonly="readonly" style="text-align:right">
                                                </div>
                                            </div>
                                            
                                        </div> <!--END XPanel-->
                                    </div> <!--END Class Colmd-->
                                          
                                    <!-- <div class="col-md-6 col-sm-6 col-xs-12" >                                  
                                        <div class="x_panel" >

                                            <center><font color = "#09961e"><h3><i class="fa fa-cubes"></i>Restocking</h3></font></center>
                                            <div class="ln_solid"></div> -->

                                            <!-- <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-1">
                                                    <button type="button" class="btn btn-round btn-primary" id = "restockbtnE" onclick = "enableRestocking();" style = "display:block"><i class="fa fa-cubes"></i> Enable Restocking</button>
                                                    <button type="button" class="btn btn-round btn-danger" id = "restockbtnD" onclick = "disableRestocking();" style = "display:none"><i class="fa fa-cubes"></i> Disable Restocking</button>
                                                </div>
                                            </div> -->
                                            
                                            <!-- <div class="form-group">
                                                <br>
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Restock Amount:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" name ="restockAmount" oninput = "validate(this)"  id = "restockamt" class="form-control" min = "1" max ="1000" placeholder = "0">
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>

                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12" align = "center">
                                                    <button type="button" class="btn btn-success"  id = "updatestock" name ="restockBtn" onclick = "insert_and_update_restock()" >Update</button> -->


                                                   <script>
                                                   function insert_and_update_restock()
                                                   {       
                                                        var GET_RESTOCK_QTY = document.getElementById("restockamt").value;  
                                                        if(confirm("Are you sure to Restock Item? "))
                                                        {
                                                            request = $.ajax({
                                                            url: "ajax/insert_and_update_restock.php",
                                                            type: "POST",
                                                            data: {
                                                                post_item_id: <?php echo  $_SESSION['item_IDfromView'];?>,
                                                                post_restock_quantity: GET_RESTOCK_QTY
                                                            },
                                                                success: function(data, textStatus)
                                                                {
                                                                    alert(data);
                                                                    window.location.href = "EditInventory.php";  
                                                                }//End Scucess                                                        
                                                            }); // End ajax   

                                                       }    //END IF
                                                       else
                                                       {
                                                           alert("Action: Cancelled");
                                                       }                                      
                                                        

                                                         
                                                   } // End Function
                                                   </script>

                                            <!-- </div> Col MD -->
                                        <!-- </div> FormGRP -->
                                  
                                <!-- </div> END Xpanel -->
                            <!-- </div>END Col MD -->

                            <div class="col-md-6 col-sm-6 col-xs-12" >                                  
                                        <div class="x_panel" >

                                            <center><font color = "#eda01c"><h3><i class="fa fa-tags"></i> Discounts</h3></font></center>
                                            <div class="ln_solid"></div>

                                            <!-- <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-1">
                                                    <button type="button" class="btn btn-round btn-primary" id = "discountbtnE" onclick = "enableDiscount();" style = "display:block"><i class="fa fa-tags"></i> Enable Discounts</button>
                                                    <button type="button" class="btn btn-round btn-danger" id = "discountbtnD" onclick = "disableDiscount();" style = "display:none"><i class="fa fa-tag"></i> Disable Discounts</button>
                                                </div>
                                            </div> -->
                                            
                                            <div class="form-group">
                                                <br>
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Discount Amount:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number" name ="discountamt" id = "discountamt" class="form-control" value = "" min = "1" max="30" placeholder= "%" oninput="validate(this)">
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>

                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12" align = "center">
                                                <!--  -->
                                                    <button type="button" class="btn btn-success" onclick = "updatediscountalert()" id = "updatediscount" name ="discountBtn" >Update</button>
                                            </div> <!-- Col MD -->
                                        </div> <!-- FormGRP -->
                                  
                                </div> <!--END Xpanel -->
                            </div><!--END Col MD-->
                            <div class="col-md-6 col-sm-6 col-xs-12" >                                  
                                        <div class="x_panel" >

                                            <center><font color = "red"><h3><i class="fa fa-fire"></i> Damages</h3></font></center>
                                            <div class="ln_solid"></div>
                                            <font color = "red">The damage input here are automatically tagged as environmental (e.g. decay, discoloration, etc.)</font>
                                            <div class="form-group">
                                                <br>
                                                <label class="control-label col-md-4 col-sm-4 col-xs-12">Damaged Quantity:</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="number"  id = "damage_qty" class="form-control" value = "" min = "1" max="30" placeholder= "Input amount in pieces" oninput="validate(this)">
                                                </div>
                                            </div>

                                            <div class="ln_solid"></div>

                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12" align = "center">
                                                <!--  -->
                                                    <button type="button" class="btn btn-success" id = "update_dmg">Update</button>
                                            </div> <!-- Col MD -->
                                        </div> <!-- FormGRP -->
                                  
                                </div> <!--END Xpanel -->
                            </div><!--END Col MD-->

                            <div class="clearfix"></div>
                            <br>
                            <!-- <div class="col-md-12 col-sm-12 col-xs-12">
                                <button type="button" class="btn btn-round btn-danger" id = "unhideDamageDivbtn" onclick = "unhideDamageDiv();" style = "display:block"><i class="fa fa-eye"></i> Unhide Damaged Item Input</button>
                                <button type="button" class="btn btn-round btn-dark" id = "hideDamageDivbtn" onclick = "hideDamageDiv();" style = "display:none"><i class="fa fa-eye-slash"></i> Hide Damaged Item Input</button>
                            </div> -->
                            <div style = "display:none" id="damageDiv"><!--  show/hide div-->
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
                                               <input   name ="damagePercent" type="number" id = "percentdmg" class="form-control"  placeholder="Max 100%" max = "100" min = "0" oninput="validate(this)">
                                           </div>
                                       </div>

                                       <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Price Each (Of Unusable)</label>
                                           <div class="col-md-6 col-sm-6 col-xs-12">
                                               <input   name = "damagePrice" type="number" id = "priceeach" class="form-control" readonly="readonly" style="text-align:right">
                                           </div>
                                       </div>  

                                       <div class="form-group">
                                           <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Loss</label>
                                           <div class="col-md-6 col-sm-6 col-xs-12">
                                               <input   name ="totalLoss" type="number" id = "totalloss" class="form-control" readonly="readonly" style="text-align:right">
                                           </div>
                                       </div>

                                       <div class="ln_solid"></div>

                                       <div class="form-group" id="UpdateDamageForm" >
                                           <div class="col-md-12 col-sm-12 col-xs-12" align = "right">
                                               <button type="button" class="btn btn-success" id = "updatedmg" name = "UpdateDamage" >Update</button>
                                               <button type="button" class="btn btn-danger" onclick = "cancelDamaged()" id = "canceldmg">Cancel</button>
                                           </div>
                                        </div>

                                   </div> <!--END XPANEL -->
                               </div><!--END ColMD-->

                                    <div class="col-md-6 col-sm-6 col-xs-12" >
                                        
                                        <div class="x_panel">

                                             <center><h3>List of Damaged Items for:
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
                                                                <th>Damaged Item Name</th>
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
                                </div><!-- End show/hide div-->

                               <div class="col-md-12 col-sm-12 col-xs-12" align = "right">
                                        
                                        <div class="ln_solid"></div>
                                            <button name = "confirmButton" type="button" class="btn btn-success" onclick ="generalAlert()">Confirm</button>
                                            <!-- <button type="reset" class="btn btn-warning" onclick="clearLocalStorage()">Archive</button> -->

                                        </div><!--END Col MD-->
                                    
                            </div> <!--END X Panel-->
                        </div><!--END Col MD-->
                        </div>
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

        $ORIGINAL_RESTOCK_DATE = $row['last_restock'];
        $FORMATTED_RESTOCK_DATE = date("D, F d Y H:i:s", strtotime($ORIGINAL_RESTOCK_DATE));
        $ORIGINAL_UPDATE_DATE = $row['last_update'];
        $FORMATTED_UPDATE_DATE = date("D, F d Y H:i:s", strtotime($ORIGINAL_UPDATE_DATE));

        $lastRestockArray[] = $FORMATTED_RESTOCK_DATE; 
        $lastUpdateArray[] = $FORMATTED_UPDATE_DATE; 
        
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
    // var confirmButton = document.getElementById('updatedmg'); 
    // var itemNameInEditInventory = document.getElementById('sku_id');
    // var itemPriceInEditInventory = document.getElementById('item_price');
    // var damagePercentage = document.getElementById('percentdmg');
    // var priceEachBox = document.getElementById('priceeach');
    // var dmgQtyBox = document.getElementById('dmgqty');
    // var totalLossBox = document.getElementById('totalloss');
    
    
    // damagePercentage.onkeyup = function()
    // {
        
    //     var inputValue = damagePercentage.value;    
    //     var calculateDamagePrice = inputValue / 100;
    //     var priceEach = itemPriceInEditInventory.value * calculateDamagePrice;
    //     var totalLoss = dmgQtyBox.value * priceEach;
       
    //     priceEachBox.innerHTML = priceEach.toFixed(2)
    //     totalLossBox.innerHTML = totalLoss.toFixed(2);
    //     priceEachBox.value = priceEach.toFixed(2); 
    //     totalLossBox.value = totalLoss.toFixed(2);
    // }
    
    // confirmButton.onclick = function() 
    // {  
    //     var inputValue = damagePercentage.value;    
   
    // }
</script>
<script>
    
    // var update_button = document.getElementById('updatedmg');
    // var input_damage_qty = document.getElementById('dmgqty');
    // var input_damage_percent = document.getElementById('percentdmg');
    // var input_damage_price = document.getElementById('priceeach');
    // var input_damage_total = document.getElementById('totalloss');
    
    // update_button.onclick = function()
    // {
    //     DoAjax();
        
    //     var newName = itemNameInEditInventory.value + damagePercentage.value;
    //     if(input_damage_qty.length == 0)
    //     {
    //         alert("No Input Found");
    //     }
    //     else
    //     {       
    //         var newRow = document.getElementById('damageTable').insertRow();                       
    //         newRow.innerHTML = "<tr> <td>"+ newName+ "</td> <td>" + dmgQtyBox.value+ "</td> </tr>";   
            
    //         input_damage_qty.value = "";
    //         input_damage_percent.value = "";
    //         input_damage_price.value = "";
    //         input_damage_total.value = "";       
    //     }
        
       
    //  } //End function
    //  function DoAjax()
    //  {
    //     request = $.ajax({
    //     url: "ajax/insert_dmg_and_usable_to_db.php",
    //     type: "POST",
    //         data:{post_damage_qty: input_damage_qty.value, //Never forget to get the Value from the <INPUTS>
    //             post_damage_percent: input_damage_percent.value,
    //             post_damage_price: input_damage_price.value,
    //             post_damage_total: input_damage_total.value,
    //             post_damage_item: itemNameInEditInventory.value
    //         },
    //         success: function(data)
    //         {
    //             console.log(data);
    //             alert(data);   
    //         }//End Scucess        
    //     }); // End ajax
      
    //  }
</script>

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
    // var restockbtnE = document.getElementById("restockbtnE");
    // var restockbtnD = document.getElementById("restockbtnD");
    // var restockinput = document.getElementById("restockamt"); 
    // var updatestock = document.getElementById("updatestock"); 
    // restockinput.disabled = true;
    // updatestock.disabled = true;
    // function enableRestocking()
    // {
    //     restockbtnE.style.display = "none";
    //     restockbtnD.style.display = "block";
    //     restockinput.disabled = false;
    //     updatestock.disabled = false;
        
    // }
    // function disableRestocking()
    // {
    //     restockbtnE.style.display = "block";
    //     restockbtnD.style.display = "none";
    //     restockinput.disabled = true;
    //     updatestock.disabled = true;
    //     var insideval = restockinput.placeholder = "0";
    // }
    function updatestockalert()
    {
        
        var insideval = restockinput.value;
        confirm("Do you want to restock this amount: " + insideval);
        
    }
    function generalAlert()
    {
        if(confirm("Do you want to Return?"))
        {
            window.location.href = "ViewInventory.php";  
        }
        else
        {
            alert("Action: Cancelled");
        }
    }
</script>

<script>
    // // damaged section
    // var damagedbtn = document.getElementById("addDamage"); 
    // var damagedqty = document.getElementById("dmgqty"); 
    // var percentdmg = document.getElementById("percentdmg"); 
    // var priceeach = document.getElementById("priceeach"); 
    // var totalloss = document.getElementById("totalloss"); 
    // var updatedamaged = document.getElementById("updatedmg");  
    // var canceldamaged = document.getElementById("canceldmg"); 
    // damagedbtn.disabled = false;
    // damagedqty.disabled = true;
    // percentdmg.disabled = true;
    // priceeach.disabled = true;
    // totalloss.disabled = true;
    // updatedamaged.disabled = true;
    // canceldamaged.disabled = true;
    // function enableDamaged()
    // {
    //     damagedbtn.disabled = true;
    //     damagedqty.disabled = false;
    //     percentdmg.disabled = false;
    //     priceeach.disabled = false;
    //     totalloss.disabled = false;
    //     updatedamaged.disabled = false;
    //     canceldamaged.disabled = false;
    // }
    // function cancelDamaged()
    // {
    //     damagedbtn.disabled = false;
    //     damagedqty.disabled = true;
    //     percentdmg.disabled = true;
    //     priceeach.disabled = true;
    //     totalloss.disabled = true;
    //     updatedamaged.disabled = true;
    //     canceldamaged.disabled = true;
    // }
</script>


<script>
    // discount section
    // var discountbtnE = document.getElementById("discountbtnE");
    // var discountbtnD = document.getElementById("discountbtnD");
    // var discountinput = document.getElementById("discountamt"); 
    // var updatediscount = document.getElementById("updatediscount"); 
    // discountinput.disabled = true;
    // updatediscount.disabled = true;
    // function enableDiscount()
    // {
    //     discountbtnE.style.display = "none";
    //     discountbtnD.style.display = "block";
    //     discountinput.disabled = false;
    //     updatediscount.disabled = false;
        
    // }
    // function disableDiscount()
    // {
    //     discountbtnE.style.display = "block";
    //     discountbtnD.style.display = "none";
    //     discountinput.disabled = true;
    //     updatediscount.disabled = true;
    //     var insideval1 = discountinput.value = "";
    // }
    function updatediscountalert() //Update Discount
    {
        insertDiscount();
    
    }
</script>

<!-- hide/show damage div script -->
<script>
    var damageDiv = document.getElementById("damageDiv");
    var unhidebtn = document.getElementById("unhideDamageDivbtn");
    var hidebtn = document.getElementById("hideDamageDivbtn");
    var damagedqty = document.getElementById("dmgqty"); 
    var percentdmg = document.getElementById("percentdmg"); 
    var priceeach = document.getElementById("priceeach"); 
    var totalloss = document.getElementById("totalloss"); 
    function unhideDamageDiv()
    {
        damageDiv.style.display = "block";
        hidebtn.style.display = "block";
        unhidebtn.style.display = "none";
        
    }
    function hideDamageDiv()
    {
        damageDiv.style.display = "none";
        hidebtn.style.display = "none";
        unhidebtn.style.display = "block";
        damagedqty.value = "";
        percentdmg.value = "";
        priceeach.value = "";
        totalloss.value = "";
        
    }
</script>
<script> //Sets the discount for the Item selected
                                                   
var discount_button = document.getElementById('discountBtn'); 
var discount_amount = document.getElementById('discountamt'); 
    function insertDiscount()
    {
        if(confirm("Confirm Discount: "+discount_amount.value+"%"))
        {
            request = $.ajax({
            url: "ajax/discountInsert.php",
            type: "POST",
                data:{
                    post_discount_amount: discount_amount.value, //Never forget to get the Value from the <INPUTS>
                    post_item_id: <?php echo $_SESSION['item_IDfromView']; ?>
                    
                },
                success: function(data)
                {
                    console.log(data);
                    alert(data);   
                    window.location.href = "EditInventory.php";  
                   
                }//End Scucess
                        
            }); // End ajax     
        }
    }                                                                                                     
</script>
<script>
$('#update_dmg').on('click', function(e){
    if(confirm("Confirm Inventory Damages?"))
        {
            request = $.ajax({
            url: "ajax/dmg_type_env.php",
            type: "POST",
                data:{                   
                    post_item_id: "<?php echo $_SESSION['item_IDfromView']; ?>",
                    post_dmg_qty: $('#damage_qty').val()
                },
                success: function(data)
                {
                    
                    //window.location.href = "EditInventory.php";  
                   
                }//End Scucess
                        
            }); // End ajax     
        }
})
</script>
</body>

</html>