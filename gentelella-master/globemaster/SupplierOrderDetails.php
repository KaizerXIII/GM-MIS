<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>GM - View Restock Orders</title>

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

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
            <?php
                require_once("nav.php"); 
               
            ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <!-- <div>
                  <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">ORDERS FOR RESTOCKING</h1><br>
              </div> -->
            </div>
            <!-- <br><br><br><br> -->

              <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">

                    <!-- <p class="text-muted font-13 m-b-30">
                      
                        <button type="button" class="btn btn-success" onclick="window.location.href='newOrderForm.php'"><i class="fa fa-plus" onclick =""></i> Create Order </button>
                      
                    </p><br>
					 -->
                     <?php
                          if(isset($_GET['so_id']))
                          {                     
                            $_SESSION['supply_order_id'] = $_GET['so_id']; //Stores the Value of Get from View Inventory
                                            
                          }
                          else
                          {                        
                             
                          }
                          $CURRENT_SO_ID_NUMBER = $_SESSION['supply_order_id']; //Stores the value of SO ID

                          //Gets all the required Information from table based on the ID
                          $SQL_GET_SO_FROM_DB = "SELECT supply_order_id,
                          CAST(supply_order_date AS DATE) as SD,
                           CAST(supply_order_expdate AS DATE) as SXD,
                            CAST(DATE_ADD(supply_order_expdate, INTERVAL 14 DAY) AS DATE) AS EXP_RANGE,
                             supply_order_total_quantity,
                              supply_order_status 
                              FROM supply_order
                               WHERE supply_order_id = '$CURRENT_SO_ID_NUMBER'";
                          $RESULTS_GET_FROM_DB = mysqli_query($dbc, $SQL_GET_SO_FROM_DB);
                          $ROW_RESULT_GET_FROM_DB = mysqli_fetch_array($RESULTS_GET_FROM_DB,MYSQLI_ASSOC);


                     
                   echo '<div class = "col-md-6">'; 
                        echo "<h3> SR - ", $ROW_RESULT_GET_FROM_DB['supply_order_id'],'</h3>';
                        echo '<br>';
                        echo '<b>Order Date: </b>', $ROW_RESULT_GET_FROM_DB['SD']; 
                    echo'</div>'; 
                    echo'<div class = "col-md-6" align = "right" >';
                    echo'    <b><font color = "black">Expected Date of Arrival: </font></b>',  $ROW_RESULT_GET_FROM_DB['SXD'],' to ',  $ROW_RESULT_GET_FROM_DB['EXP_RANGE'] ;
                    echo'</div> ';
                    ?>
                    <div align = "right">Change shipment status: <button type="button" class="btn btn-round btn-primary btn-xs">Arrived at China Port</button> 
                    OR <button type="button" class="btn btn-round btn-primary btn-xs">Shipped from China Port</button> 
                    OR <button type="button" class="btn btn-round btn-primary btn-xs">Arrived at Philippines Port</button></div>
                    OR <button type="button" class="btn btn-round btn-success btn-xs">On the way to warehouse</button>
                    <div class = "col-md-12" align = "center" style="z-index: 1">
                        <ul class="progressbar">
                            <li class="active" >Purchased</li>
                            <li>Shipping</li>
                            <li>Delivered</li>
                        </ul>
                    </div> 
                        <br>
                        <table border="0" style="width: 50%;" align = "center" frame="box">
                        <tr>
                          <th>03 Jun 2019 - 14:18</th>
                          <th>Your package has been shipped with LEX PH with tracking number LPT0000009649313.To track your parcel, click on our Tracking Page</th>
                        </tr>
                        <tr>
                          <td>January</td>
                          <td>$100</td>
                        </tr>
                        <tr>
                          <td>February</td>
                          <td>$80</td>
                        </tr>
                      </table>
                            <!-- <div class = "col-md-2">
                                <span class = "text"> 
                                    03 Jun 2019 - 14:18
                                </span>
                            </div>
                            <div class = "col-md-10">
                                <span class = "text"> 
                                    Your package has been shipped with LEX PH with tracking number LPT0000009649313.To track your parcel, click on our Tracking Page
                                </span>
                            </div> -->
                    <div class="clearfix"></div>
                        <center><font color = "#4192f4">View Details</font></center>
                    </div>
                    <form method = "POST" action = "SupplierOrderDetails_Damage.php">
                        <div>                    
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="50%" align = "center">
                          <thead>
                            <tr>
                              <th>Item Name</th>
                              <th>Supplier</th>
                              <th>Quantity</th>
                              <th align = "center">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                           $_SESSION['list_of_items']=array();
                           $_SESSION['list_of_qty']=array();
                          
                            $SQL_SELECT_SO_DETAILS_FROM_DB = "SELECT * FROM supply_order_details WHERE supply_order_id = '$CURRENT_SO_ID_NUMBER '";
                            $RESULT_GET_SO_DETAILS = mysqli_query($dbc, $SQL_SELECT_SO_DETAILS_FROM_DB);
                            while($row=mysqli_fetch_array($RESULT_GET_SO_DETAILS,MYSQLI_ASSOC))
                            {
                              $stringname = $row['supply_item_name'];
                              $qty = $row['supply_item_quantity'];
                              
                                echo '<tr>';
                                    echo '<td ><input type="hidden" name = "item_name" value = "'.$row['supply_item_name'].'">'.$row['supply_item_name'].'</td>';
                                    echo '<td>'.$row['supplier_name'].'</td>';
                                    echo '<td>'.$row['supply_item_quantity'].'</td>';
                                    echo '<td align = "center">';
                                    echo '<button type="button" class="btn btn-round btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-smsupply"><i class = "fa fa-wrench"></i> Edit</button>';
                                    echo '<button type="button" class="btn btn-round btn-success btn-xs" data-toggle="modal" data-target=".bs-example-modal-smnewitem" id="restock_page">Create</button>';
                                    echo '</td>    ';      
                                echo '</tr> '; 
                                // echo $stringname;

                               
                                array_push($_SESSION['list_of_items'], $stringname);
                                array_push($_SESSION['list_of_qty'], $qty);
                                
                              
                            }
                           
                            echo $_SESSION['list_of_items'][0];
                            echo $_SESSION['list_of_qty'][0];
                           
                            ?>      
                          </tbody>
                        </table><br>
                        <div class = "clearfix"></div>
                        <div class = "ln_solid"></div>
                        <div align = "right">
                          <button type="submit" class="btn btn-round btn-success" name = "restock_items">Proceed <i class = "fa fa-arrow-right"></i></button>
                        </div>
                      </form>
                    </div>
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
    
                      
                            
                            
<!-- mid modal for edit supply qty-->
<div class="modal fade bs-example-modal-smsupply" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Edit Arrived Quantity</h4>
      </div>
      <div class="modal-body">
        
      <form method = "POST" action = "">
        <span><h4><b>Item Name:</b> <?php echo $stringname; ?></h4></span>
        <!-- add backend -->
        <div class = "form-group">
          <label class = "control-label col-md-3 " for = "arrived">Quantity Arrived <span class="required">*</span></label>
          <div class="col-md-9">
            <input type="text" id="arrived" class="form-control col-md-7 col-xs-12">
          </div>
        </div>
      </div>
      <br>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
      </form>  
    </div>
  </div>
</div>   
  
<!-- mid Modal end -->
<!-- large modal for edit supply qty-->
<div class="modal fade bs-example-modal-smnewitem" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel2">Edit Arrived Quantity</h4>
      </div>
      <div class="modal-body">
        
      <form method="POST" class="form-horizontal form-label-left" id = "item_detail" >
        
      <span><h4>Add temporary item <?php echo $stringname;?> to the inventory.</h4></span>
      <br>
      <div class="form-group">
        <label class="control-label col-md-4 col-sm-3 col-xs-12">Item Category <span class="required">*</span>
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
        <label class="control-label col-md-4 col-sm-3 col-xs-12">Stock Keeping Unit (SKU) <span class="required">*</span>
        </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" name="skuid" id="sku_id" name="last-name" required="required" class="form-control col-md-7 col-xs-12"/>
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-4 col-sm-3 col-xs-12">Choose Supplier <span class="required">*</span>
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
        <label class="control-label col-md-4 col-sm-3 col-xs-12" for="last-name">Item Name <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" name="item_name" id="itemName" name="last-name" required="required" class="form-control col-md-7 col-xs-12">
        </div>
      </div>
      <div class="form-group">
        <label for="middle-name" class="control-label col-md-4 col-sm-3 col-xs-12">Warehouse Location</label>
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
        <label class="control-label col-md-4 col-sm-3 col-xs-12">Threshold Amount <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input name="threshold" id ="threshold_amount" class="form-control col-md-7 col-xs-12" required="required" type="number" min = "0" max ="9999">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-4 col-sm-3 col-xs-12">Unit Price <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input name="price" id="item_price" class="form-control col-md-7 col-xs-12" required="required" type="number" step="0.01" placeholder = "1000.00">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-4 col-sm-3 col-xs-12">Item Weight<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input name="item_weight" id="item_weight" class="form-control col-md-7 col-xs-12" required="required" type="number" step="0.01" placeholder = "100 KG">
        </div>
      </div>
      <div class="form-group" align = "right">
        <!-- <div class="col-md-6 col-sm-6 col-xs-12"> -->
          <button name="submitBtn" class="btn btn-success" type="button" id= "add_button">Add</button>
          <button class="btn btn-primary" type="reset">Reset</button>
        <!-- </div>z -->
      </div>
    </form>
    </div>
  </div>
</div>   
  
<!-- Large Modal end -->

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

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>

    <script> //Function to send data to EditInventory.php
        var Row = document.getElementById("datatable-responsive");
        var Cells = Row.getElementsByTagName("td");
        

        var url = "EditInventory.php?item_name=";
        var href_to_edit_inventory =  document.getElementById("restock_page");
        var current_item_name = Cells[0].innerText;
        // href_to_edit_inventory.href = url+Cells[0].innerText;
      
        
    </script> 
    
    <!-- Confirm add to inventory -->
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
    <style>
        .container1 {
        width: 600px;
        margin: 100px auto; 
        }
        .progressbar {
        margin: 0;
        padding: 0;
        counter-reset: step;
        }
        .progressbar li {
            list-style-type: none;
            width: 33.3%;
            float: left;
            font-size: 12px;
            position: relative;
            text-align: center;
            text-transform: uppercase;
            color: #7d7d7d;
        }
        .progressbar li:before {
            width: 30px;
            height: 30px;
            content: counter(step);
            counter-increment: step;
            line-height: 30px;
            border: 2px solid #7d7d7d;
            display: block;
            text-align: center;
            margin: 0 auto 10px auto;
            border-radius: 50%;
            background-color: white;
        }
        .progressbar li:after {
            width: 100%;
            height: 2px;
            content: '';
            position: absolute;
            background-color: #7d7d7d;
            top: 15px;
            left: -50%;
            z-index: -1;     
        }
        .progressbar li:first-child:after {
        content: none;
        }
        .progressbar li.active {
        color: green;
        }
        .progressbar li.active:before {
        border-color: #55b776;
        }
        .progressbar li.active + li:after {
        background-color: #55b776;
        }
    </style>

    
    <style>
        #mydiv3{
        text-align:left;
        border-style:solid;
        border-width: 2px;
    }
    </style>
  </body>
</html>