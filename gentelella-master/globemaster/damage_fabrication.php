<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  
    <title>Damaged Item on Fabrication </title>

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

      <!-- JQUERY Required Scripts -->
      <script type="text/javascript" src="js/script.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
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
                  <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">OR-1 Damaged Item on Fabrication</h1><br>
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
                    <form method="POST" class="form-horizontal form-label-left" >

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Damaged Item Name <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">

                        <select name="select_damaged_item" id="select_damaged_item" required="required" class="form-control col-md-7 col-xs-12">
                        <option value = "">Choose...</option>
                         <?php
                                for($i = 0; $i < sizeof($_SESSION['qty_from_fab']); $i++)
                                {
                                  $ITEM_QTY =  $_SESSION['qty_from_fab'][$i];
                                  $ITEM_NAME = $_SESSION['name_from_fab'][$i];
                                  echo'<option value = "'.$ITEM_QTY.'">'.$ITEM_NAME.'</option>'; //Temporary option value = ITEM_QTY
                                }
                                    
                                
                            ?>
 
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Damaged Item Quantity <span class="required">*</span>
                        </label>
                        <!-- limit this to quantity available on order -->
                       
                          
                          <div class="col-md-4 col-sm-6 col-xs-12">
                          <input type="text" name="damaged_item_name" id="damaged_item_name" required="required" oninput ="validate(this)" class="form-control col-md-7 col-xs-12"/>';
                          </div>
                         
                       
                         
                        
                      </div>
                      <!-- Two buttons to choose for replenish or replace -->
                      <div class="form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12"> <br>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <button type="button" class="btn btn-round btn-primary" onclick="revertdisable()"; name = "replenish_btn" id = "replenish_btn">Replenish</button>
                          <button type="button" class="btn btn-round btn-warning" onclick="showreplace();">Replace</button>
                        </div>
                      </div>
                      <!-- FOR REPLACE ITEM -->
                      <div class="form-group" >
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Replacement Item Name <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">

                        <select name="replacementName" id = "replacementName" required="required" class="form-control col-md-7 col-xs-12" disabled>
                        <option value = "">Choose...</option>
                         <?php
                                require_once('DataFetchers/mysql_connect.php');
                                $query = "SELECT * FROM items_trading";
                                $result=mysqli_query($dbc,$query);
                                $option = "";
                                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {
                                    echo'<option value = "'.$row['item_id'].'">'.$row['item_name'].'</option>';
                                }
                            ?>
 
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Quantity <span class="required">*</span>
                        </label>
                        <!-- limit this to quantity available on order -->
                         <div class="col-md-3 col-sm-6 col-xs-12">
                          <input type="text" name="replacementQty"  id = "replacementQty" oninput ="validate(this)" required="required" class="form-control col-md-7 col-xs-12" disabled/> 
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <button class = "btn btn-success btn-sm" id = "addReplace" disabled onclick="revertdisable();">Add</button>
                        </div> 
                      </div>
                      <!-- END FOR REPLACE ITEM  -->

                      <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Damaged/ Replaced Items</h2>
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
                          <th>Item Name</th>
                          <th>Quantity</th>
                          <th>Replacement Item Name</th>
                          <th>Replacement Item Quantity</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
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

    <script> 
                              
        $(document).on('change', '#select_damaged_item', function() {
          $("#damaged_item_name").attr({
              "max": $(this).val()         // values (or variables) here
            });
        });

        $(document).on('change', '#select_damaged_item', function() {
          $("#replacementQty").attr({
              "max": $(this).val()         // values (or variables) here
            });
        });
        
        

    </script><!-- Adds the max value based on ordered item-->

    <script type="text/javascript">
      function validate(obj) {
          obj.value = valBetween(obj.value, obj.min, obj.max); //Gets the value of input alongside with min and max
          console.log(obj.value);
      }

      function valBetween(v, min, max) {
          return (Math.min(max, Math.max(min, v))); //compares the value between the min and max , returns the max when input value > max
      }
    </script> <!-- To avoid the users input more than the current Max per item -->

<script>
        $(function()
        {
            $("#replenish_btn").on('click', function(e){
              var current_damaged_item = $("#select_damaged_item :selected").text();   
              var current_damaged_item_qty = $("#select_damaged_item").val();  
              if($("#damaged_item_name").val() != '' && $("#select_damaged_item").val() != '' && $("#damaged_item_name").val() != 0)
              {                                                            
                                                                                    
                var damage_table = document.getElementById('datatable').insertRow();                          
                damage_table.innerHTML = "<tr> <td>" + current_damaged_item + "</td> <td> "+current_damaged_item_qty+" </td> <td> </td> <td> </td> <td> <button type='button' class='delete_current_row'> <font color = 'red' size = '5'><i class='fa fa-close'></i></font> </button></td>";                                                         
              }
              else
              {
                  alert("Please Fill up all required fields correctly!");
              }
                                                                                                                                  
            })// END JQUERY
        });//END FUNCTION

        $(function()
        {
            $("#addReplace").on('click', function(e){
              var current_damaged_item = $("#select_damaged_item :selected").text();   
              var current_damaged_item_qty = $("#select_damaged_item").val();  

              var current_replacement_item = $("#replacementName :selected").text();   
              var current_replacement_item_qty = $("#replacementQty").val();  

              if(current_replacement_item != '' && current_replacement_item_qty != '' && current_replacement_item_qty != 0)
              {                                                            
                                                                                    
                var damage_table = document.getElementById('datatable').insertRow();                          
                damage_table.innerHTML = "<tr> <td>" + current_damaged_item + "</td> <td> "+current_damaged_item_qty+" </td>  <td> "+current_replacement_item+" </td> <td> "+current_replacement_item_qty+" </td><td> <button type='button' class='delete_current_row'> <font color = 'red' size = '5'><i class='fa fa-close'></i></font> </button></td>";                                                         
              }
              else
              {
                  alert("Please Fill up all required fields correctly!");
              }
                                                                                                                                  
            })// END JQUERY
        });//END FUNCTION

        $(document).ready(function(){
            $("#datatable").on('click','.delete_current_row',function(){ //Gets the [table name] on click OF [class inside table] 
                $(this).closest('tr').remove();
                });

        });  //Removes Row    
    </script><!-- Adds the Rows based on replinished or Replaced -->
    
        
    
    
    
        
  </body>
</html>
