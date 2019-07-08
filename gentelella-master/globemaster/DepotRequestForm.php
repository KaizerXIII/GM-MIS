<html lang="en">
<?php 
 
?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GM - Tiles Request Form </title>

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
        <!-- bootstrap-daterangepicker -->
        <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <link href="../vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <!-- JQUERY Required Scripts -->
        <script type="text/javascript" src="js/script.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 
        <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"   integrity="sha256-xI/qyl9vpwWFOXz7+x/9WkG5j/SVnSw21viy8fWwbeE="   crossorigin="anonymous"></script>          
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                
                <?php
                require_once("navDepot.php");                   
                ?>

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">GLOBEMASTER DEPOT TILES REQUEST FORM</h1><br>
                        </div>
            <br><br><br><br>

                        <div class="clearfix"></div>


                        <div class="col-md-12 col-sm-6 col-xs-12">

                            <div class="x_content">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h3> 
                                           
                                            <?php
                                                $GET_DEPOT = "SELECT max(depot_request_id) as MAX_OR
                                                FROM mydb.depot_request";                           
                                                $RESULT_GET_DEPOT=mysqli_query($dbc,$GET_DEPOT);
                                                $ROW_GET_DEPOT = mysqli_fetch_array($RESULT_GET_DEPOT,MYSQLI_ASSOC);

                                                $CurrentOR = "Depot OR - ".$ROW_GET_DEPOT['MAX_OR'];                                                           
                                                echo $CurrentOR;
                                            ?>
                                        </h3>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                    

                                        <form class="form-horizontal form-label-left" method="POST">

                                            <!-- <div class="form-group">
                                                <h1><font color = "black"><label class="control-label col-md-11 col-sm-11 col-xs-12" style = "text-align: left;">Select Client:</label></font></h1>
                                                <div class="col-md-2 col-sm-2 col-xs-12" style = "align: left;">
                                                    <select class="form-control col-md-12 col-xs-12" id="clientID" name="clientID">
                                                <?php

                                                    require_once('DataFetchers/mysql_connect.php');
                                                    $SQL_CLIENT_LIST="SELECT client_id, client_name FROM clients WHERE client_status = 'Allowed'";
                                                    $result=mysqli_query($dbc,$SQL_CLIENT_LIST);
                                                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                                    {
                                                        echo "<option value=".$row['client_id']."> ".$row['client_name']."</option>";  
                                                    }
                                                ?> 
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <hr> -->
                                            <div class="form-group">
                                                <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                                                        <thead>
                                                        <tr>
                                                            <th>Trading SKU</th>
                                                            <th>Depot Reference Name</th>
                                                                                                                   
                                                            <th>Trading Price</th>
                                                            <th>Trading Current Stock </th>
                                                            
                                                            <th class="col-md-1 col-sm-1 col-xs-1">Quantity</th>
                                                            <th>Add</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php

                                                            require_once('DataFetchers/mysql_connect.php');
                                                            $GET_DEPOT = "SELECT * 
                                                            FROM mydb.items_trading
                                                            JOIN depotdb.gm_products
                                                            ON gm_products.UnitName = items_trading.item_name
                                                            JOIN depotdb.gm_inventorystocks
                                                            ON gm_inventorystocks.ProductID = gm_products.ProductID";
                                                            $RESULT_GET_DEPOT=mysqli_query($dbc,$GET_DEPOT);
                                                            while($ROW_RESULT_GET_DEPOT=mysqli_fetch_array($RESULT_GET_DEPOT,MYSQLI_ASSOC))
                                                            {                                                                   

                                                                    
                                                                echo '<tr class ="tableRow">';
                                                                    echo '<td >';
                                                                    echo $ROW_RESULT_GET_DEPOT['sku_id'];
                                                                    echo '</td>'; 
                                                                    echo '<td >';
                                                                    echo $ROW_RESULT_GET_DEPOT['UnitName'];
                                                                    echo '</td>';                                                                          
                                                                    echo '<td align = right>';
                                                                    echo  '₱'." ".number_format($ROW_RESULT_GET_DEPOT['price'], 2);
                                                                    echo '</td>';
                                                                    echo '<td align = right class = ',$ROW_RESULT_GET_DEPOT['item_id'],'>';
                                                                    echo $ROW_RESULT_GET_DEPOT['item_count'];
                                                                    echo '</td>';

                                                                                                                            
                                                                    echo '<td >';
                                                                    echo '<input  style="text-align:right;" type="number" oninput="validate(this)" id="quantity',$ROW_RESULT_GET_DEPOT['item_id'],'" name="quantity',$ROW_RESULT_GET_DEPOT['item_id'],'"  min="0" max ="',$ROW_RESULT_GET_DEPOT['item_count'],'" value="" placeholder ="0"></input>';
                                                                    echo '</td>';

                                                                    echo '<td align = center >';
                                                                    echo '<button type="button" class="btn btn-round btn-success" name ="add" value ="',$ROW_RESULT_GET_DEPOT['item_id'],'" > + </button>';
                                                                    echo '</td>';

                                                                echo '</tr>';                                                                                  
                                                            }
                                                        ?>  
                                                        </tbody>
                                                        <script type="text/javascript">
                                                            function validate(obj) {
                                                                obj.value = valBetween(obj.value, obj.min, obj.max); //Gets the value of input alongside with min and max
                                                                console.log(obj.value);
                                                            }

                                                            function valBetween(v, min, max) {
                                                                return (Math.min(max, Math.max(min, v))); //compares the value between the min and max , returns the max when input value > max
                                                            }
                                                        </script> <!-- To avoid the users input more than the current Max per item -->
                                                    </table>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label class="red" id="quantityAlert"></label>
                                                </div>
                                            </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Order Cart</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="productTable">                                                   
                               
                                <table id="cart" class="table table-striped table-bordered bulk_action">
                                  <thead>
                                    <tr>
                                        <th>Trading SKU</th>
                                         <th>Depot Reference Name</th>
                                         <th>Price</th>
                                         <th>Quantity</th>
                                         <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <tr>
                                        
                                    </tr>
                                  </tbody>
                                </table>
                                <h4 align = "right"> Total Payment: <input style="text-align:right;" readonly="readonly" name="totalPayment" id ="payment" value="0"> </h4>
                            </div>                        
                        </div>
                    </div>
                </div>
                                                                 
                
                <div class="form-group">
                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3" align = "right">
                        <button type="button" class="btn btn-primary btn-lg btn-round" align="center" name="next" data-toggle="modal" data-target=".bs-example-modal-md" onclick ="checkCart()">Next Step <i class = "fa fa-arrow-right"></i></button>
                    </div>

            <!-- Add Order2 Modal -->
            
            <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-hidden="true" id ="finalizeOrder" >
              <div class="modal-dialog modal-md" >
                <div class="modal-content" >

                  <div class="modal-header">
              
                    <h4 class="modal-title" id="myModalLabel">Finalize Request</h4>
                  </div>

                  <div class = "modal-body">
                  <form class="form-horizontal form-label-left" method="POST" action= "<?php echo $_SERVER["PHP_SELF"];?>">


                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-2">Payment Type</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="btn btn-default dropdown-toggle" name="paymentID" id = "paymentID">
                            <?php
                                require_once('DataFetchers/mysql_connect.php');
                                $SQL_PAYMENT_LIST="SELECT * FROM ref_payment";
                                $result=mysqli_query($dbc,$SQL_PAYMENT_LIST);
                                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                {
                                    echo "<option value=".$row['payment_id']."> ".$row['paymenttype']."</option>";  
                                }

                                
                                ?> 
                            </select>
                        </div>
                    </div>
                    

                    <div id = "ifYes" style = "display:block">
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12 col-md-offset-2" >Expected Date<span class="required">*</span>
                            </label>
                            
                            <div class="col-md-2 col-sm-6 col-xs-12 input-group date">
                                <input id="expectedDate" name="getExpectedDelivery" class=" btn btn-default form-control col-md-7 col-xs-12 col-md-offset-1 deliveryDate" data-validate-length-range="6" data-validate-words="2" name="name1" type="date" min="<?php echo date("Y-m-d", strtotime("+1days")); ?>">
                                <!-- <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span> -->
                                <style>
                                    .deliveryDate {
                                        -moz-appearance:textfield;
                                    }
                                    
                                    .deliveryDate::-webkit-outer-spin-button,
                                    .deliveryDate::-webkit-inner-spin-button {
                                        -webkit-appearance: none;
                                        margin: 0;
                                    }
                                </style> <!-- To Remove the Up/Down Arrows from Date Selection -->
                            </div>
                        </div>
                    </div>
                
                  
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-12" align = "right">
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <!--   -->
                        <input id="send_to_ajax" name ="viewOrderButton" type="button" class="btn btn-success" style="visibility:visible"  value ="Submit" required="required"></input>
                        <!-- <input type="button" class="btn btn-primary" id="fabricationpage" style="visibility:hidden"  onclick="nextpageWithFabrication()" value ="Next Step"></input>  -->
                                  
                      </div>
                    </div>

                    </form>
                    <!-- Order 2 -->                   
                  
                    </div>
                </div>
              </div>
            </div>
            <br>
            <br>
            <!-- End Order2 Modal -->
                                        </div>
                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
            <!-- /page content -->
        </div>


        <script>
        var count = 0;
        var itemName = "item"+1;
        var quantity = "quantity"+1;
        var currentName = ""; 
        var CurrentTotal = 0; //Gets the current total to pay
        var item_id_in_cart = []; // Get This

            $('#datatable-checkbox tbody button.btn.btn-success').on('click', function(e) {
                var row = $(this).closest('tr');
                var buttonValue = $(this).val();

                item_id_in_cart.push(buttonValue);
                
                var payment = document.getElementById("payment");
                var itemQuantity = document.getElementById("quantity"+buttonValue).value;
                document.getElementById("quantity"+buttonValue).value = "";
                
                // console.log('TR 1 cell: ' + row.find('td:first').text());
                // console.log('TR 2 cell: ' + row.find('td:nth-child(2)').text());
                // console.log('TR 3 cell: ' + row.find('td:nth-child(3)').text());
                // console.log('TR 4 cell: ' + row.find('td:nth-child(4)').text());
               
                var currentName =  row.find('td:first').text(); 
                console.log("Current Name = " + currentName);
                if(itemQuantity == 0)
                    {
                        alert("No Quantity Set!");
                    }
                    else
                    {
                        
                    var qty_old = 0
                    var item_does_not_exist = true;
                        $(".qtys").each(function(i){ // this gets all the classes in the order table.
                            if (buttonValue ==$(this).attr('val_id'))
                            { //checks i there is existing item

                                var current_stock = parseInt(row.find('td:nth-child(4)').text());

                                    qty = $(this).text().replace("₱ ", "");                                    
                                    var estinamted_total =  parseInt(itemQuantity) + parseInt(qty);

                                    qty_old = parseFloat(qty.replace(/\,/g,''), 10); //old qty in cart table
                                    
                                    console.log("Current Stock = " +current_stock);
                                    console.log("estinamted_total =  "+ estinamted_total);

                                    if(estinamted_total > current_stock && ((estinamted_total - current_stock) <= 0))  //checks if estimated total is greater than current stocks
                                    {
                                        alert("Cannot exceed Current Stock!");
                                        item_does_not_exist = false; //item does exist
                                    }
                                    else
                                    {
                                        item_does_not_exist = false; //item does exist
                                        new_qty = parseFloat(itemQuantity) + qty_old; //adds old qty with current qty in cart

                                        $(this).text(new_qty);
                                            var oldPrice =  $(this).attr('price');
                                            var newPrice = $(this).attr('price') * new_qty;

                                            var subtractOldamount = qty_old *oldPrice;
                                            CurrentTotal = (CurrentTotal - subtractOldamount);
                                            
                                        
                                            CurrentTotal = CurrentTotal+ newPrice;
                                        payment.value = "₱ "+  CurrentTotal.toFixed(2) ;
 
                                        var current_max;
                                        $("."+buttonValue).each(function() {
                                            cellText = parseInt($(this).html());                                             
                                            $(this).text(cellText - itemQuantity);
                                            current_max =  $(this).text(cellText - itemQuantity);
                                        }); //Subtracts the added item count in the cart 

                                        $("#quantity"+buttonValue).attr({
                                            "max": current_max.text() 
                                        }); 
                                    }      
                                    console.log("Old Amount = "+subtractOldamount);                                   
                                    console.log("Old Price = "+oldPrice);
                                    console.log("Current Total = "+CurrentTotal);
                            }
                        });
                        if(item_does_not_exist){

                            var price =row.find('td:nth-child(3)').text().replace("₱ ", ""); //Removes the peso sign to make it as INT rather than string
                            var valid= row.find('td:nth-child(3)');
                            var ParsePrice = parseFloat(price.replace(/\,/g,''), 10);

                            // count =  count +1+ parseFloat(price.replace(/\,/g,''), 10);
                            // count =  count+ parseFloat(price.replace(/\,/g,''), 10);
                            var totalPayment = (ParsePrice * itemQuantity);

                            CurrentTotal = CurrentTotal + totalPayment;

                            var newRow = document.getElementById('cart').insertRow();                       
                            newRow.innerHTML = "<tr> <td id = "+buttonValue +">" + currentName + "</td> <td>" + row.find('td:nth-child(2)').text() +" </td> <td>" + row.find('td:nth-child(3)').text() + "</td> <td class='qtys' price ='"+ParsePrice+"' val_id='"+buttonValue+"'> " + itemQuantity + " </td> <td> <button type='button' class='btn btn-danger' name ='remove' onclick= 'DeleteRow(this)' value ='"+totalPayment.toFixed(2)+"' > - </button></td>"
                             
                            // payment.value = "₱ "+ totalPayment;
                           
                            payment.value = "₱ "+ CurrentTotal.toFixed(2);

                            itemName++;
                            quantity++;

                            var current_max;
                             $("."+buttonValue).each(function() {
                                var cellText = parseInt($(this).html()); 
                                
                                $(this).text(cellText - itemQuantity);
                                current_max =  $(this).text(cellText - itemQuantity);
                            }); //Subtracts the added item count in the cart 

                            $("#quantity"+buttonValue).attr({
                                "max": current_max.text() 
                            });

                            console.log("Current Total = ");
                        } // END IF                                                 
                    }   // END ELSE    

            }) //END FUNCTION
             function DeleteRow(obj) 
               {
                
                        var buttonValue =obj.value;     
                        var paymentBox = document.getElementById("payment");

                            var td = event.target.parentNode; // event.target will be the input element.
                            var tr = td.parentNode; // the row to be removed
                   
                            var cartPrice = tr.cells[2].innerHTML.replace("₱ ", ""); //Gets Value of Cell in TR and Removes Peso Sign 
                            var cartQuantity = tr.cells[3].innerHTML;
                            var AmountToBeSubtracted = cartQuantity *  parseFloat(cartPrice.replace(/\,/g,''), 10);
                            console.log("Cart Price = " + cartPrice);
                            console.log("Cart Quantity = " + cartQuantity);
                            console.log("Total Amount = " + AmountToBeSubtracted);
                     
                        // var paymentValue = paymentBox.value.replace("₱ ", "");
                        
                        console.log("button value = "+buttonValue);
                        console.log("Total Payment Value = "+CurrentTotal);
                        CurrentTotal = (CurrentTotal.toFixed(2) - AmountToBeSubtracted.toFixed(2)); //Limits the Decimal points to 2
                        paymentBox.value = "₱ " + CurrentTotal.toFixed(2);

                        var current_max;
                        $("."+tr.cells[0].id).each(function() {
                            cellText = parseInt($(this).html()); 
                           
                                $(this).text(cellText + parseInt(cartQuantity));
                            current_max =  $(this).text(cellText + parseInt(cartQuantity));
                        }); //Adds the item count back to the stock

                        $("#quantity"+tr.cells[0].id).attr({
                            "max": current_max.text() 
                        });       
                        
                         tr.parentNode.removeChild(tr); 

                                 
                }                    
            </script>         
            <script>
                function destroyTable()
                {
                    var table = document.getElementById("cart");      //Deletes All Rows of Table except Header before Inserting new Rows   
                    for(var i = table.rows.length - 1; i > 0; i--)
                    {     
                        table.deleteRow(i);
                    } //END FOR
                }           
            </script>
            <script>
            $('#expectedDate').datepicker({ dateFormat: 'MM, dd, yy' })

            

            $('#send_to_ajax').on('click', function(e){
                var GET_CART_QTY=[];
            $('#cart tr td:nth-child(4)').each(function (e) 
            {
                var getValue =parseInt($(this).text());
                console.log("Cart VAlue: "+getValue);
                GET_CART_QTY.push(getValue);
            }) //ENd jquery
                if(confirm("Submit the Depot Request?"))
                {
                    request = $.ajax({
                    url: "ajax/insert_to_depot_request.php",
                    type: "POST",
                    data: {post_item_id: item_id_in_cart,
                        post_item_qty: GET_CART_QTY,
                        post_total_price: $('#payment').val(),
                        post_requested_date: $('#expectedDate').val()
                    },
                    success: function(data, textStatus)
                    {
                        alert("Requistion Successful");
                        window.location.href= "ViewDepotRequests.php";
                    }//End Scucess
                    
                    }); // End ajax 
                }
                else
                {
                    alert("Action: Cancelled");
                }
           
            });

        </script>
        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
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
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
            <!-- Datepicker -->
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        
        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>
        <!-- bootstrap-datetimepicker -->
        <script src="../vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

        <script>
            $('#myDatepicker').datetimepicker();

            $('#myDatepicker2').datetimepicker({
                format: 'YYYY-MM-DD HH:MM:SS'
            });

            $('#myDatepicker3').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $('#myDatepicker4').datetimepicker({
                ignoreReadonly: true,
                allowInputToggle: true
            });

            $('#datetimepicker6').datetimepicker();

            $('#datetimepicker7').datetimepicker({
                useCurrent: false
            });

            $("#datetimepicker6").on("dp.change", function(e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });

            $("#datetimepicker7").on("dp.change", function(e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });
        </script>
        

<script text/javascript> 

function checkCart()
{
    $(document).ready(function() 
    {
        if($('#cart tr').length == 2) 
        {
            alert("WARNING: No Item(s) in Cart!"); 
            console.log("Table Length = " +$('#cart').length );
            $('#finalizeOrder').modal('toggle'); //Toggles the Modal to prevent No item in Cart [FOR NOW]
            
        }
        else
        {
            // alert("OK!"); 
            console.log("TR Length = " +$('#cart tr').length );
        }
    });
}




   </script>

<!-- Style for page title -->
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

<

    </body>
</html>
