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
                    <form method="POST" class="form-horizontal form-label-left" >

                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Damaged Product Name <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">

                        <select name="select_dmg_item" id="select_dmg_item" required="required" class="form-control col-md-7 col-xs-12">
                        <option value = "">Choose...</option>
                         <?php
                               for($i = 0; $i < sizeof($_SESSION['qty_from_delivery']); $i++)
                               {
                                 $ITEM_QTY =  $_SESSION['qty_from_delivery'][$i];
                                 $ITEM_NAME = $_SESSION['name_from_delivery'][$i];
                                 
                                 echo'<option value = "'.$ITEM_QTY.'">'.$ITEM_NAME.'</option>'; //Temporary option value = ITEM_QTY
                               }
                          ?>
 
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Damaged Product Quantity <span class="required">*</span>
                        </label>
                        <!-- limit this to quantity available on order -->
                         <div class="col-md-4 col-sm-6 col-xs-12">
                          <input type="number" id="damaged_item_qty" name="damaged_item_qty" oninput = "validate(this)" required="required" class="form-control col-md-7 col-xs-12"/> 
                        </div>
                        
                      </div>
                      <!-- Two buttons to choose for replenish or replace -->
                      <div class="form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12"> <br>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <button type="button" id ="replacement_btn" class="btn btn-round btn-primary" >Replace With the Same Product</button>
                          <!-- <button type="button" id ="discard_btn" class="btn btn-round btn-danger" >Discard Product from Order</button> -->
                        </div>
                      </div>
                   

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
                   
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Product Name</th>
                          <th>Quantity</th>
                          <th>Status</th>
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
  


    <script>

    
      $(document).on('change', '#select_dmg_item', function() {
        
          $("#damaged_item_qty").attr({
              "max": $(this).val()         // values (or variables) here
            });
        });

    </script> <!-- Adds the max value based on ordered item-->

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

    $("#replacement_btn").on('click', function(e){
          var current_damaged_item = $("#select_dmg_item :selected").text();   
          var current_damaged_item_qty = $("#damaged_item_qty").val();  
          if($("#damaged_item_qty").val() != '' && $("#select_dmg_item").val() != '' && $("#damaged_item_qty").val() != 0)
          {                                                            
                                                                                
            var damage_table = document.getElementById('datatable').insertRow();                          
            damage_table.innerHTML = "<tr> <td class = dmg_item_name>" + current_damaged_item + "</td> <td class = dmg_item_qty > "+current_damaged_item_qty+" </td>  <td> </td> <td> <button type='button' class='delete_current_row'> <font color = 'red' size = '5'><i class='fa fa-close'></i></font> </button></td>";                                                         
           
            $("#select_dmg_item :selected").attr({
              "value":  $("#select_dmg_item :selected").val() - current_damaged_item_qty   //Subtracts the value from input 
            });

            $("#damaged_item_qty").attr({
              "max": $("#select_dmg_item :selected").val()         //replaces the max value with subtravcted value
            });

            $("#damaged_item_qty").val("");  //Resets input for qty
          }
          else
          {
              alert("Please Fill up all required fields correctly!");
          }
                                                                                                                              
       
    });//END FUNCTION

    $(document).ready(function(){
      

            $("#datatable").on('click','.delete_current_row',function(){ //Gets the [table name] on click OF [class inside table] 
                var closest_tr = $(this).closest('tr').find('.dmg_item_name').text();
                var closest_tr_qty = $(this).closest('tr').find('.dmg_item_qty').text();
                console.log(closest_tr);

                $('#select_dmg_item').children('option:selected').each(function() {
               //Loops through all options and finds the item name 
                    if($(this).text() == closest_tr)
                    {
                      $("#select_dmg_item :selected").attr({
                        "value":  parseInt($("#select_dmg_item :selected").val()) + parseInt(closest_tr_qty)    //adds the value when the row is removed 
                      });
                      $("#damaged_item_qty").attr({
                        "max": $("#select_dmg_item :selected").val() //replaces the max value with added value
                      });
                      $("#damaged_item_qty").val("");     //Resets the input for qty               
                    }
                    else
                    {

                    }
                });
                $(this).closest('tr').remove(); //Removes the row clicked
                
                
            });//END onclick

           

        });  //Removes Row    
    </script>
    
    
    
    
        
  </body>
</html>
