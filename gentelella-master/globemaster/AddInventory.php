<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>Add Inventory </title>

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
                  <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">GLOBEMASTER | ADD INVENTORY</h1><br>
              </div>
            </div>
            <br><br><br><br>
            
            
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                    <form method="POST" class="form-horizontal form-label-left" id = "item_detail" >

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Category <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">

                        <select name="selectItemtype" id="select_item_type" required="required" class="form-control col-md-7 col-xs-12" onchange="getType(this)">
                        <option value = "">Choose...</option>
                         <?php
                                require_once('DataFetchers/mysql_connect.php');
                                $query = "SELECT * FROM ref_itemtype";
                                $result=mysqli_query($dbc,$query);
                                $option = "";
                                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {
                                    echo'<option value = "'.$row['itemtype'].'">'.$row['itemtype'].'</option>';
                                }
                            ?>
 
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Stock Keeping Unit (SKU) <span class="required">*</span>
                        </label>
                         <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="skuid" id="sku_id" name="last-name" required="required" class="form-control col-md-7 col-xs-12"/>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Choose Supplier <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="supplier" id="supplier_id" required="required" class="form-control col-md-7 col-xs-12">
                        <option value = "">Choose...</option>
                            <?php
                                require_once('DataFetchers/mysql_connect.php');
                                $query = "SELECT * FROM suppliers";
                                $result=mysqli_query($dbc,$query);
                                
                                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {
                                   echo '<option value = "'.$row['supplier_name'].'">'.$row['supplier_name'].'</option>';
                                }
                            ?>             
                            </select>
                        </div>
                      </div><br><br>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Item Name <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="item_name" id="itemName" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Warehouse Location</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <select name="selectWarehouse" id="warehouse_id" required="required" class="form-control col-md-7 col-xs-12">
                        <option value = "">Choose...</option>
                          <?php
                                require_once('DataFetchers/mysql_connect.php');
                                $query = "SELECT * FROM warehouses";
                                $result=mysqli_query($dbc,$query);
                               
                                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {
                                   echo '<option value = "'.$row['warehouse'].'" > '.$row['warehouse'].' </option>';
                                }
                            ?>
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Threshold Amount <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input style="text-align:right;" name="threshold" id ="threshold_amount" class="form-control col-md-7 col-xs-12" required="required" type="number" min = "0" max ="9999">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Unit Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input style="text-align:right;" name="price" id="item_price" class="form-control col-md-7 col-xs-12" required="required" type="number" step="0.01" placeholder = "1000.00">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Item Weight<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input style="text-align:right;" name="item_weight" id="item_weight" class="form-control col-md-7 col-xs-12" required="required" type="number" step="0.01" placeholder = "100 KG">
                        </div>
                      </div>
                      <div class="form-group">
                        <!-- <div class="col-md-6 col-sm-6 col-xs-12"> -->
                          <button name="submitBtn" class="btn btn-success" type="button" id= "add_button">Add</button>
						              <button class="btn btn-primary" type="reset">Reset</button>
                        <!-- </div>z -->
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
          var  SET_ITEM_WEIGHT = document.getElementById("item_weight").value; 

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
                      post_supplier_id: SET_SUPPLIER,
                      post_item_weight: SET_ITEM_WEIGHT
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

      $("#item_weight").change(function()
      {
      
        var $this = $(this);
        $this.val(parseFloat($this.val()).toFixed(2));
          
      }); //Sets the Decimal
    </script>
    
    
    
        
  </body>
</html>
