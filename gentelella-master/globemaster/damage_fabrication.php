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
                  <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px"><?php echo $_SESSION['fab_current_or']; ?> Damaged Item on Fabrication</h1><br>
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
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Damaged Item Name <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">

                        <select name="select_damaged_item" id="select_damaged_item" required="required" class="form-control col-md-7 col-xs-12">
                        <option value = "">Choose...</option>
                        
                            </select>
                        </div>
                        <h2><span id = "stocks" >Selected Item Qty: </span></h2>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Damaged Item Quantity <span class="required">*</span>
                        </label>
                        <!-- limit this to quantity available on order -->
                                               
                          <div class="col-md-4 col-sm-6 col-xs-12">
                            <input type="text" name="damaged_item_name" id="damaged_item_name" required="required" oninput ="validate(this)" class="form-control col-md-7 col-xs-12"/>
                          </div>                                                                      
                          <h2><span id = "replenish_stock" >Replenish Item Stock: </span></h2>
                      </div>
                      <!-- Two buttons to choose for replenish or replace -->
                      <div class="form-group">
                      <label class="control-label col-md-4 col-sm-3 col-xs-12"> <br>
                        </label>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                          <button type="button" class="btn btn-round btn-primary" onclick="revertdisable();" name = "replenish_btn" id = "replenish_btn">Replenish</button>
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
                                
                            ?>
 
                            </select>
                        </div>
                        <h2><span id = "replacement_stock" >Replacement Item Stock: </span></h2>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-4 col-sm-3 col-xs-12">Quantity <span class="required">*</span>
                        </label>
                        <!-- limit this to quantity available on order -->
                         <div class="col-md-3 col-sm-6 col-xs-12">
                          <input type="text" name="replacementQty"  id = "replacementQty" oninput ="validate(this)" required="required" class="form-control col-md-7 col-xs-12" disabled/> 
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                          <button class = "btn btn-success btn-sm" id = "addReplace" disabled onclick="revertdisable()">Add</button>
                        </div> 
                      </div>
                      <!-- END FOR REPLACE ITEM  -->

                      <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-7 col-sm-12 col-xs-12 col-md-offset-2">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Damage Replacement Details</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <!-- <p class="text-muted font-13 m-b-30">
                      DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                    </p> -->
                    <table id="datatable_replenish" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Damaged Item Name</th>
                          <th>Damaged Quantity</th>
                          <th>Replacement Item Name</th>
                          <th>Replacement Item Quantity</th>
                          
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
                      
                      </div><div class="form-group" align = "right">
                        <!-- <div class="col-md-6 col-sm-6 col-xs-12"> -->
                          <button name="submitBtn" class="btn btn-success" type="button" id= "submit_dmg">Submit</button>
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button class="btn btn-danger" type="cancel">Cancel</button>
                        <!-- </div>z -->
                      </div>
                    <script>  
                    $('#submit_dmg').on('click', function(e){
                      var dmg_name_array = new Array();
                      var dmg_qty_array = new Array();
                      var replace_name_array = new Array();
                      var replace_qty_array = new Array();

                      $('#datatable_replenish tbody tr:not(:first-child)').each(function(){
                        var dmg_name = $(this).closest('tr').find('td:first').text().split('|')[0];
                        var dmg_qty = $(this).closest('tr').find('td:nth-child(2)').text();
                        
                        var replace_name = $(this).closest('tr').find('td:nth-child(3)').text().split('|')[0];
                        var replace_qty = $(this).closest('tr').find('td:nth-child(4)').text();

                        dmg_name_array.push(dmg_name);
                        dmg_qty_array.push(dmg_qty);
                        replace_name_array.push(replace_name);
                        replace_qty_array.push(replace_qty);

                       
                      });

                      if(confirm("Submit Damage items?"))
                      {
                        request = $.ajax({
                        url: "ajax/dmg_type_fab.php",
                        type: "POST",
                        data: {
                          post_dmg_item: dmg_name_array,
                          post_dmg_qty: dmg_qty_array,
                          post_replace_item: replace_name_array,
                          post_replace_qty: replace_qty_array                                                 
                        },
                        success: function(data, textStatus)
                        {
                          alert("Damages have been successfully Replaced and Recorded!");
                           if(confirm("Go back to Fabrication Approval?"))
                           {
                            window.location.href= "FabricationApproval.php";
                           }
                           else
                           {
                             window.location.href= "damage_fabrication.php";
                           }
                            
                            

                        }//End Success
                        
                        }); // End ajax 
                      }
                      else
                      {
                        alert("Action: Cancelled");
                      }
                    })

                    </script>
                   
                      
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
            
          $("#stocks").text("Selected Item Qty: " + $(this).val());  //Set the current stocks of the items in dropdown
          $('#replenish_stock').text("Replenish Item Stock: " + $("#select_damaged_item :selected").attr("current_stock")); 

          $("#damaged_item_name").val("");
            
          request = $.ajax({
          url: "ajax/dmg_fab_replace_list.php",
          type: "POST",
          data:{
              post_item_price: $("#select_damaged_item :selected").attr("price")
            }, 
            success: function(data) 
            { 
            
            $("#replacementName").html(data);
            $("#replacement_stock").text("Replacement Item Stock: ");                        
            }//End Success                       
          }); //End Ajax   
          
        });

        $(document).on('change', '#replacementName', function() {
          $("#replacementQty").attr({
              "max": $("#select_damaged_item").val()         // values (or variables) here
            });
            $("#replacement_stock").text("Replacement Item Stock: " + $(this).val());  //Set the current stocks of the items in dropdown
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
              var current_damaged_item_qty = $("#damaged_item_name").val();  

              var current_replacement_item = $("#replacementName :selected").text();   
              var current_replacement_item_qty = $("#replacementQty").val();  
 
              var item_does_not_exist = true;
              if($("#damaged_item_name").val() != '' && $("#select_damaged_item").val() != '' && $("#damaged_item_name").val() != 0 || $("#damaged_item_name").val() > parseInt($('#replenish_stock').text()))
              {                                                            
                
              $("#datatable_replenish tbody tr td.dmg_item_name").each(function(i){
              
              if(current_damaged_item ==$(this).text())
              {
                item_does_not_exist = false;
                $(this).next().text(parseInt($(this).next().text())+parseInt(current_damaged_item_qty)); //Gets the NEXT DOM value after the current selected class

                $(this).nextAll().eq(2).text(
                  parseInt($(this).nextAll().eq(2).text()) + 
                  parseInt(current_damaged_item_qty)
                );
                $("#select_damaged_item :selected").attr({
                "value":  $("#select_damaged_item :selected").val() - current_damaged_item_qty   //Subtracts the value from input 
                  });

                  $("#damaged_item_name").attr({
                    "max": $("#select_damaged_item :selected").val()         //replaces the max value with subtravcted value
                  });

                  $("#damaged_item_name").val("");  //Resets input for qty 

                  $("#stocks").text("Selected Item Qty: " + $("#select_damaged_item :selected").val() );
              }
              
              }); //END JQUERY
                if(item_does_not_exist)
                {
                
                      var damage_table_replenish = document.getElementById('datatable_replenish').insertRow();  
                                            
                      damage_table_replenish.innerHTML = "<tr> <td class = 'dmg_item_name'>" + current_damaged_item + "</td> <td class = dmg_item_qty> "+current_damaged_item_qty+" </td> <td>"+current_damaged_item+" <td>"+current_damaged_item_qty+"</td><td> <button type='button' class='delete_current_row'> <font color = 'red' size = '5'><i class='fa fa-close'></i></font> </button></td>";    
                      
                      $("#select_damaged_item :selected").attr({
                        "value":  $("#select_damaged_item :selected").val() - current_damaged_item_qty   //Subtracts the value from input 
                      });

                      $("#damaged_item_name").attr({
                        "max": $("#select_damaged_item :selected").val()         //replaces the max value with subtravcted value
                      });

                      $("#damaged_item_name").val("");  //Resets input for qty 

                      $("#stocks").text("Selected Item Qty: " + $("#select_damaged_item :selected").val() );
                      
                                                    
                    
                }
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
              var current_damaged_item_qty = $("#damaged_item_name").val();  

              var current_replacement_item = $("#replacementName :selected").text();   
              var current_replacement_item_qty = $("#replacementQty").val();  
              
              var replacement_item_does_not_exist = true;
          if(current_replacement_item != '' && current_replacement_item_qty != '' && current_replacement_item_qty != 0)
            {  
              $("#datatable_replenish tbody tr td.replace_item").each(function(i){
                
              if(current_replacement_item.trim() == $(this).text().trim()) //Trim to remove all other BS inorder to compare properly
              {                      
                replacement_item_does_not_exist = false;
                $(this).next().text(parseInt($(this).next().text())+parseInt(current_replacement_item_qty)); //Gets the NEXT DOM value after the current selected class

                $(this).prev().text(
                  parseInt($(this).prev().text()) + 
                  parseInt(current_replacement_item_qty)
                );

                $("#select_damaged_item :selected").attr({
                    "value":  $("#select_damaged_item :selected").val() - current_replacement_item_qty   //Subtracts the value from input 
                  });

                $("#damaged_item_name").attr({
                      "max": $("#select_damaged_item :selected").val() 
                  });

                  $("#replacementQty").attr({
                    "max": $("#select_damaged_item :selected").val()         //replaces the max value with subtravcted value
                  });

                  $("#replacementQty").val("");  //Resets input for qty 

                  $("#stocks").text("Selected Item Qty: " + $("#select_damaged_item :selected").val() );
              }             
            }); //END JQUERY

              if(replacement_item_does_not_exist)
              {                                                                                                                                                            
                  var damage_table = document.getElementById('datatable_replenish').insertRow();                          
                  damage_table.innerHTML = "<tr> <td>" + current_damaged_item + "</td> <td> "+current_replacement_item_qty+" </td> <td class=replace_item> "+current_replacement_item+" </td> <td class = replace_qty > "+current_replacement_item_qty+" </td><td> <button type='button' class='delete_current_row'> <font color = 'red' size = '5'><i class='fa fa-close'></i></font> </button></td>";                                                         
                  $("#select_damaged_item :selected").attr({
                    "value":  $("#select_damaged_item :selected").val() - current_replacement_item_qty   //Subtracts the value from input 
                  });
                  $("#damaged_item_name").attr({
                      "max": $("#select_damaged_item :selected").val() 
                  });

                  $("#replacementQty").attr({
                    "max": $("#select_damaged_item :selected").val()         //replaces the max value with subtravcted value
                  });

                  $("#replacementQty").val("");  //Resets input for qty 

                  $("#stocks").text("Selected Item Qty: " + $("#select_damaged_item :selected").val() );
               
              }
            }
          else
          {
              alert("Please Fill up all required fields correctly!");
          }  
                                                                                                                                  
            })// END JQUERY
        });//END FUNCTION

        $(document).ready(function(){
            $("#datatable_replenish").on('click','.delete_current_row',function(){ //Gets the [table name] on click OF [class inside table] 
              var closest_tr = $(this).closest('tr').find('td:nth-child(1)').text();
              var closest_tr_qty = $(this).closest('tr').find('td:nth-child(2)').text(); 

              var tr_replace_name = $(this).closest('tr').find('td:nth-child(3)').text();
              var tr_replace_qty = $(this).closest('tr').find('td:nth-child(4)').text();               

              
                $("#select_damaged_item option:contains("+closest_tr+")").attr({
                  "value":  parseInt($("#select_damaged_item option:contains("+closest_tr+")").val()) + parseInt(closest_tr_qty)    //adds the value when the row is removed 
                });
 
                $("#damaged_item_name").attr({
                  "max": $("#select_damaged_item :selected").val() //replaces the max value with added value of input
                });
                
                $("#damaged_item_name").val("");     //Resets the input for qty

                $("#replacementQty").attr({
                    "max": $("#select_damaged_item :selected").val()         //replaces the max value with subtravcted value
                  });

                $("#replacementQty").val("");  //Resets input for qty     

                $("#stocks").text("Selected Item Qty: " + $("#select_damaged_item :selected").val() );           
                   
              
              $(this).closest('tr').remove();
              });//Removes Row    of [REPLACEMENT TABLE]

        });  
        
        $(document).ready(function(){
            $("#datatable_replacement").on('click','.delete_current_row',function(){ //Gets the [table name] on click OF [class inside table] 
              var closest_tr = $(this).closest('tr').find('.dmg_item_name').text();
              var closest_tr_qty = $(this).closest('tr').find('.replace_qty').text();
                console.log(closest_tr);

                $('#select_damaged_item').children('option:selected').each(function() {
               //Loops through all options and finds the item name 
                    
                      $("#select_damaged_item :selected").attr({
                        "value":  parseInt($("#select_damaged_item :selected").val()) + parseInt(closest_tr_qty)    //adds the value when the row is removed 
                      });
                      $("#damaged_item_name").attr({
                        "max": $("#select_damaged_item :selected").val() //replaces the max value with added value
                      });
                      $("#damaged_item_name").val("");     //Resets the input for qty 

                      $("#stocks").text("Selected Item Qty: " + $("#select_damaged_item :selected").val() );              
                   
                });
              $(this).closest('tr').remove();
              });

        });  //Removes Row    of [REPLENISH TABLE]
        
    </script><!-- Adds the Rows based on replinished or Replaced -->
    
        
    <script>
    request = $.ajax({
    url: "ajax/damage_fab_item_list.php",
    type: "POST",
    data:{
        
      }, 
      success: function(data) 
      { 
       $("#select_damaged_item").html(data);
                          
      }//End Success                       
    }); //End Ajax   
    </script>
    
    
        
  </body>
</html>
