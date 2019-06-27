<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>Damaged Product on Delivery </title>

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
        <!-- Custom Fonts -->
        <style>

            @font-face {
            font-family: "Couture Bold";
            src: url("css/fonts/couture-bld.otf");
            }

            h1 {
                font-family: 'COUTURE Bold', Arial, sans-serif;
                font-weight:normal;
                font-style:normal;
                font-size: 50px;
                color: #1D2B51;
                }

        </style>      
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div>
                  <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">DR-1 Damaged Item on Delivery</h1><br>
                  <!-- Add actual OR num here -->
              </div>
            </div>
            <br><br><br><br>
            
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    IF ITEM TO BE REPLENISHED IS OUT OF STOCK...
                    <br>
                    <font color = "red">The item(s) <b>Granite-A, Granite-B, Granite-C </b>is out of stock and is not available for replenishment. Please inform the customer (09278281281).</font>
                    <br>
                    *The phone number is based on the customer info. 
                    <form method="POST" class="form-horizontal form-label-left" id = "item_detail" >

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Damaged Product Name <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">

                        <select name="selectItemtype" id="select_item_type" required="required" class="form-control col-md-7 col-xs-12" onchange="getType(this)">
                        <option value = "">Choose...</option>
                         <?php
                                // require_once('DataFetchers/mysql_connect.php');
                                // $query = "SELECT * FROM ref_itemtype";
                                // $result=mysqli_query($dbc,$query);
                                // $option = "";
                                // while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                // {
                                //     echo'<option value = "'.$row['itemtype'].'">'.$row['itemtype'].'</option>';
                                // }
                            ?>
 
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Damaged Product Quantity <span class="required">*</span>
                        </label>
                        <!-- limit this to quantity available on order -->
                         <div class="col-md-4 col-sm-6 col-xs-12">
                          <input type="text" name="skuid" id="sku_id" name="last-name" required="required" class="form-control col-md-7 col-xs-12"/> 
                        </div>
                        
                      </div>
                      <!-- Two buttons to choose for replenish or replace -->
                      <div class="form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12"> <br>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <button type="button" class="btn btn-round btn-primary" onclick="showreplace();">Replace With the Same Product</button>
                          <button type="button" class="btn btn-round btn-danger" onclick="revertdisable();">Discard Product from Order</button>
                        </div>
                      </div>
                      <!-- FOR REPLACE ITEM -->
                      <!-- <div class="form-group" >
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Replacement Item Name <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">

                        <select name="selectItemtype" id = "replacementName" required="required" class="form-control col-md-7 col-xs-12" onchange="getType(this)" disabled>
                        <option value = "">Choose...</option>
                         <?php
                                // require_once('DataFetchers/mysql_connect.php');
                                // $query = "SELECT * FROM ref_itemtype";
                                // $result=mysqli_query($dbc,$query);
                                // $option = "";
                                // while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                // {
                                //     echo'<option value = "'.$row['itemtype'].'">'.$row['itemtype'].'</option>';
                                // }
                            ?>
 
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Quantity <span class="required">*</span>
                        </label> -->
                        <!-- limit this to quantity available on order -->
                         <!-- <div class="col-md-3 col-sm-6 col-xs-12">
                          <input type="text" name="skuid"  id = "replacementQty" name="last-name" required="required" class="form-control col-md-7 col-xs-12" disabled/> 
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <button class = "btn btn-success btn-sm" id = "addReplace" disabled onclick="revertdisable();">Add</button>
                        </div> 
                      </div> -->
                      <!-- END FOR REPLACE ITEM  -->

                      <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Damaged Products</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p> -->
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Product Name</th>
                          <th>Quantity</th>
                          <th></th>
                        </tr>
                      </thead>


                      <tbody>
                        <tr>
                          <td>Tiger Nixon</td>
                          <td align = "right">3</td>
                          <td align = "center"><font color = "red"><i class="fa fa-close"></i></font></td>
                        </tr>
                        <tr>
                          <td>Garrett Winters</td>
                          <td align = "right">3</td>
                          <td align = "center"><font color = "red"><i class="fa fa-close"></i></font></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
                      
                      </div><div class="form-group" align = "right">
                        <!-- <div class="col-md-6 col-sm-6 col-xs-12"> -->
                          <button name="submitBtn" class="btn btn-success" type="button" id= "add_button">Submit</button>
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button class="btn btn-danger" type="cancel">Cancel</button>
                        <!-- </div>z -->
                      </div>

                      <?php

                      require_once('DataFetchers/mysql_connect.php');
                        if(isset($_POST['submitBtn']))
                        {
                            $sku_id = $_POST['skuid'];
                            $itemName = $_POST['item_name']; //Stores the Values from Textbox in HTML
                          
                            $itemPrice = $_POST['price'];
                            $itemThreshold = $_POST['threshold'];

                            $warehouseIDfromSelect = $_POST['selectWarehouse'];
                            $itemTypeIDfromSelect = $_POST['selectItemtype'];
                            $supplierIDFromSelect = $_POST['supplier'];

                            $CHECK_IF_SAME_NAME_IN_ITEMS_TRADING = "SELECT * FROM items_trading";
                            $RESULT_CHECKER=mysqli_query($dbc,$CHECK_IF_SAME_NAME_IN_ITEMS_TRADING);
                            while($ROW_CHECKER = mysqli_fetch_array($RESULT_CHECKER,MYSQLI_ASSOC))
                            {
                              if($ROW_CHECKER['item_name'] == $itemName)
                              {
                                die('Error: Duplicate Item Detected');
                              }
                            }
                            
                           

                            $queryWarehouseID = "SELECT warehouses.warehouse_id FROM warehouses WHERE warehouse = '$warehouseIDfromSelect'";
                            $resultWarehouseID = mysqli_query($dbc,$queryWarehouseID);                                
                            $rowWarehouseID = mysqli_fetch_assoc($resultWarehouseID); //Query for getting WarehouseID 

                            $queryItemtypeID = "SELECT ref_itemtype.itemtype_id FROM ref_itemtype WHERE itemtype = '$itemTypeIDfromSelect'";
                            $resultItemtype = mysqli_query($dbc,$queryItemtypeID);                                
                            $rowItemtypeID = mysqli_fetch_assoc($resultItemtype); //Query For getting itemtypeID
                            
                            $querySupplierID = "SELECT supplier_id FROM suppliers WHERE supplier_name = '$supplierIDFromSelect'";
                            $resultSupplierID = mysqli_query($dbc,$querySupplierID);                                
                            $rowSupplierID = mysqli_fetch_assoc($resultSupplierID); //Query For getting itemtypeID

                            $WareHouseID = $rowWarehouseID['warehouse_id'];
                            $ItemtypeID = $rowItemtypeID['itemtype_id'];
                           
                            $SupplierID = $rowSupplierID['supplier_id'];
                            $DiscountStatus = "Regular Price";

                            echo  "warehouse = ".$WareHouseID;
                            echo  "itemtype = ".$ItemtypeID;
                            echo  "itemID = ".$ItemID;
                            echo  "supplierID = ".$SupplierID;
                            echo  "skuid =  ".$sku_id;
                            echo  "item name =  ".$itemName;
                            echo  "3shold = ".$itemThreshold;
                            echo  "price = ".$itemPrice;

                            $sql = "INSERT INTO items_trading (sku_id, item_name, itemtype_id, item_count, last_restock, last_update, threshold_amt, warehouse_id, supplier_id, price, onDiscount)
                            Values(                           
                            '$sku_id',
                            '$itemName', 
                            '$ItemtypeID',
                            '0', now(),now(),
                            '$itemThreshold',
                            '$WareHouseID',
                            '$SupplierID',
                            '$itemPrice',
                            '$DiscountStatus')";

                            $result=mysqli_query($dbc,$sql);
                            if(!$result) 
                            {
                                die('Error: ' . mysqli_error($dbc));
                            } 
                            else 
                            {
                                echo '<script language="javascript">';
                                echo 'alert("Items Added Successfully");';
                                echo '</script>';
                                header("Location: ViewInventory.php");
                            }              
                        }//END ISSET

?>
                      
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
   

    <script>
      var add_btn = document.getElementById("add_button");    
        add_btn.onclick = function()
        {
          var  SET_SKU_ID = document.getElementById("sku_id").value;
          var  SET_ITEM_NAME = document.getElementById("itemName").value;
          var  SET_ITEM_PRICE = document.getElementById("item_price").value;
          var  SET_ITEM_THRESHOLD = document.getElementById("threshold_amount").value;
          var  SET_WAREHOUSE_ID = document.getElementById("warehouse_id").value;
          var  SET_TYPE_ID = document.getElementById("select_item_type").value;
          var  SET_SUPPLIER = document.getElementById("supplier_id").value; 

          if(!SET_SKU_ID || !SET_ITEM_NAME || !SET_ITEM_PRICE || !SET_ITEM_THRESHOLD || !SET_WAREHOUSE_ID || !SET_TYPE_ID || !SET_SUPPLIER) //Checker
          {
            alert("Please Fill Up All Input");
          }
          else
          {
            if(confirm("Confirmation: Add New Item to Inventory?"))
            {
              request = $.ajax({
                    url: "ajax/add_inventory.php",
                    type: "POST",
                    data: {
                      post_sku_id: SET_SKU_ID,
                      post_item_name: SET_ITEM_NAME,
                      post_item_price: SET_ITEM_PRICE,
                      post_item_threshold: SET_ITEM_THRESHOLD,
                      post_warehouse_id: SET_WAREHOUSE_ID,
                      post_type_id: SET_TYPE_ID,
                      post_supplier_id: SET_SUPPLIER
                    }, //{Variable name, variable value}
                    success: function(data) 
                    { //To test data
                        alert(data);
                        window.location.href = "ViewInventory.php";  
                    }//End Success
                  
                });//End Ajax
                alert("Item Added Successfully!");
            }
            else
            {
              alert("Action: Cancelled");
            }
          }    
        } //End onclikc   
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
    <!-- Parsley
    <script src="../vendors/parsleyjs/dist/parsley.min.js"></script> -->
    <!-- Autosize -->
    <script src="../vendors/autosize/dist/autosize.min.js"></script>
    <!-- jQuery autocomplete -->
    <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    <!-- starrr -->
    <script src="../vendors/starrr/dist/starrr.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script>
  <?php
  
  require_once('C:\xampp\htdocs\GM-MIS\gentelella-master\globemaster\DataFetchers\mysql_connect.php');
  $arrayOfPrefix = array();
  $arrayOfItemType = array();
  $query = "SELECT * FROM ref_itemtype";
  $result=mysqli_query($dbc,$query);
  while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
  {
    $arrayOfPrefix[] = $row['item_prefix'];
    $arrayOfItemType[] = $row['itemtype'];
  }

  echo "var PrefixFromPHP = ".json_encode($arrayOfPrefix).";";
  echo "var itemTypeFromPHP = ".json_encode($arrayOfItemType).";";
  ?>
  
     function getType(selectItemType)    
     {
      var dropdownValue = selectItemType.value;
       for (var i = 0; i < PrefixFromPHP.length; i++)
       {
         if(itemTypeFromPHP[i] == dropdownValue)
         {
          var item = document.getElementById('itemName');
          item.value = PrefixFromPHP[i]+" ";
          console.log(PrefixFromPHP[i]);
         }
       }
      
     
     }
    </script>

     <script>
      $("#item_price").change(function()
      {
      
        var $this = $(this);
        $this.val(parseFloat($this.val()).toFixed(2));
          
      }); //Sets the Decimal
    </script>

<!-- Show replacement script -->
    <script>
      var replaceName = document.getElementById('replacementName');
      var replaceQty = document.getElementById('replacementQty');
      var addReplace = document.getElementById('addReplace');
      function showreplace()
      {
        replaceName.disabled = false;
        replaceQty.disabled = false;
        addReplace.disabled = false;
      }
      function revertdisable()
      {
        replaceName.disabled = true;
        replaceQty.disabled = true;
        addReplace.disabled = true;
        // Baka need to ayusin kasi yung button na to mag aadd sa table.
      }
    </script>
    
    
    
    
        
  </body>
</html>
