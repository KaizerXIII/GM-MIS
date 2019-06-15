<html lang="en">
<?php 
 require_once('DataFetchers/mysql_connect.php');
?>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GM - Supplier Order Form </title>

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

        <script>
            window.onbeforeunload = function () {
                return "Are you sure";
            };
        </script>


       
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
                            <div>
                                <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">DAMAGED GOODS</h1><br>
                            </div>
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
                                                $queryTogetMaxOR = " SELECT count(supply_order_id)+1 as TOTALOR FROM supply_order";
                                                $resultOfQuery=mysqli_query($dbc,$queryTogetMaxOR);
                                                $row = mysqli_fetch_array($resultOfQuery,MYSQLI_ASSOC);

                                                $CurrentOR = "SR - ".$row['TOTALOR'];                                                           
                                                echo "<b>".$CurrentOR."</b>";
                                                $orderNumber = $CurrentOR;

                                               //CHANGE TO SUPPLIER ORDER NUMBER IN THE FUTURE
                                            ?>
                                        </h3>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                    

                                        <form class="form-horizontal form-label-left" method="POST">

                                            <div class="form-group col-md-12 col-sm-11 col-xs-12">
                                            <div class="form-group col-md-3 col-sm-11 col-xs-12">
                                                <font color = "black" size = "5"><b>Select a Damaged Item:</b></font>
                                            </div> 
                                                <div class="col-md-2 col-sm-2 col-xs-12">
                                                    <select class="form-control col-md-12 col-xs-12" id="supplierID" name="supplierID"> //change id
                                                        <?php

                                                            require_once('DataFetchers/mysql_connect.php');
                                                            $SQL_SUPPLIER_LIST="SELECT supplier_id, supplier_name FROM suppliers ORDER BY supplier_name ASC";
                                                            $result=mysqli_query($dbc,$SQL_SUPPLIER_LIST);
                                                            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                                            {
                                                                echo "<option value=".$row['supplier_id']."> ".$row['supplier_name']."</option>";  
                                                            }
                                                        ?> 
                                                    </select>
                                                </div>
                                            <div class="form-group">
                                                <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                                                        <thead>
                                                        <tr>
                                                            <th>Item Name</th>
                                                            <th>Quantity</th>
                                                            <th>% of Damage</th>                       
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>Granite A</td>
                                                            <td align = "right">10</td>
                                                            <td align = "right">30%</td>
                                                            <td align = "center"><font color = "red" size = "5"><i class="fa fa-close"></i></font></td>
                                                        </tr>

                                                        <?php

                                                            // require_once('DataFetchers/mysql_connect.php');
                                                            // $SQL_ITEM_LIST = "SELECT * FROM items_trading;";
                                                            // $result1=mysqli_query($dbc,$SQL_ITEM_LIST);

                                                            // $itemCountArray = array();
                                                            // while($row=mysqli_fetch_array($result1,MYSQLI_ASSOC) )
                                                            // {
                                                            //     $queryItemType = "SELECT itemtype FROM ref_itemtype WHERE itemtype_id =" . $row['itemtype_id'] . ";";
                                                            //     $resultItemType = mysqli_query($dbc,$queryItemType);
                                                            //     $rowItemType=mysqli_fetch_array($resultItemType,MYSQLI_ASSOC);
                                                            //     $itemType = $rowItemType['itemtype'];

                                                            //     $queryWarehouse = "SELECT warehouse FROM warehouses WHERE warehouse_id =" . $row['warehouse_id'] . ";";
                                                            //     $resultWarehouse = mysqli_query($dbc,$queryWarehouse);
                                                            //     $rowWarehouse=mysqli_fetch_array($resultWarehouse,MYSQLI_ASSOC);
                                                            //     $warehouse = $rowWarehouse['warehouse'];

                                                            //     $querySupplierName = "SELECT supplier_name FROM suppliers WHERE supplier_id =" . $row['supplier_id'] . ";";
                                                            //     $resultSupplierName = mysqli_query($dbc,$querySupplierName);
                                                            //     $rowSupplierName=mysqli_fetch_array($resultSupplierName,MYSQLI_ASSOC);
                                                            //     $supplierName = $rowSupplierName['supplier_name'];

                                                                    
                                                            //     echo '<tr class ="tableRow">';
                                                            //         echo '<td  id = ',$row['item_id'],' >';
                                                            //         echo $row['item_name'];
                                                            //         echo '</td>';
                                                            //         echo '<td>';
                                                            //         echo $itemType;
                                                            //         echo '</td>';
                                                            //         echo '<td>';
                                                            //         echo $row['item_count'];
                                                            //         echo '</td>';

                                                                   
                                                            //         echo '<td align = right>';
                                                            //         echo  "N/A";
                                                            //         echo '</td>';

                                                                                                                            
                                                            //         echo '<td >';
                                                            //         echo '<input  style="text-align:right;" type="number" oninput="validate(this)" id="quantity',$row['item_id'],'" name="quantity',$row['item_id'],'"  min="0" max ="1000" value="" placeholder ="0"></input>';
                                                            //         echo '</td>';

                                                            //         echo '<td align = center >';
                                                            //         echo '<button type="button" class="btn btn-round btn-success" name ="add" value ="',$row['item_id'],'" > + </button>';
                                                            //         echo '</td>';

                                                            //     echo '</tr>';                                                                                  
                                                            // }
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
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12" align = "right">
                        <button type="button" class="btn btn-primary" name="complete_order" onclick = "confirmAdd();">Next</button>
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
        var CurrentTotal = 0; //Gets the current quantity in order
        var item_id_in_cart = []; // Get This

            $('#datatable-checkbox tbody button.btn.btn-success').on('click', function(e) {
                var row = $(this).closest('tr');
                var buttonValue = $(this).val();
                            
                var get_supplier_from_dropdown = document.getElementById("supplierID"); //gets the supplier name based on Dropdown
                var get_supplier_id = get_supplier_from_dropdown.value; //Gets the ID of the supplier
                var get_supplier_name = get_supplier_from_dropdown.options[get_supplier_from_dropdown.selectedIndex].text; //converts to string of the selected index
               
                item_id_in_cart.push(buttonValue);
                
                var payment = document.getElementById("payment");
                var itemQuantity = document.getElementById("quantity"+buttonValue).value;
                document.getElementById("quantity"+buttonValue).value = "";
                
                // console.log('TR 1 cell: ' + row.find('td:first').text());
                // console.log('TR 2 cell: ' + row.find('td:nth-child(2)').text());
                // console.log('TR 3 cell: ' + row.find('td:nth-child(3)').text());
                // console.log('TR 4 cell: ' + row.find('td:nth-child(4)').text());
               
                var currentName =  row.find('td:first').text(); 
                // console.log("Current Name = " + currentName);
                if(itemQuantity == 0)
                {
                    alert("No Quantity Set!");
                    item_id_in_cart.pop(); //Removes the ID from the array
                }
               
                else
                {
                    
                    var qty_old = 0
                    var item_does_not_exist = true;
                    var supplier_does_not_exist = true;

                    var qty_array =[];
                    var sp_name_array = [];

                    $('.sp_name').each(function(i){ 
                        var get_sp_name = $(this).attr('sp_id');  //Places all the supplier ID in the array FIRST
                        sp_name_array.push(get_sp_name);
                    });

                    
                    $('.qtys').each(function(i) //Pushes the val_id into the array SECOND then iterates through each
                    { 
                        var get_qty = $(this).attr('val_id');
                        qty_array.push(get_qty);

                        for(var i = 0; i <= qty_array.length; i++)
                    { 
                        if (get_supplier_id == sp_name_array[i] && buttonValue == qty_array[i])//checks i there is existing item
                        {
                    
                            console.log("IF Statement works");
                            var supplier_does_not_exist = false;
                            // var current_stock = parseInt(row.find('td:nth-child(3)').text());
                            qty = $(this).text();  //Ye Old quantity, not the price
                                                                
                                qty_old = parseInt(qty.replace(/\,/g,''), 10); //old qty in cart table

                                item_does_not_exist = false; //item does exist
                                new_qty = parseInt(itemQuantity) + qty_old; //adds old qty with current qty in cart

                                CurrentTotal = CurrentTotal + parseInt(itemQuantity);
                                total_qty.value = CurrentTotal;  
                        
                                $(this).text(new_qty); // ye new qty
                                item_id_in_cart.pop(); //Removes ID from array since item already exist
                                                        
                        }           
                
                        else
                        {
                            var supplier_does_not_exist = true;
                        }

                    }

                    });
               

                    console.log("Array 1 = "+qty_array[0]);
                    console.log("Array 2 = "+sp_name_array[0]);

                    if(item_does_not_exist && supplier_does_not_exist)
                        {

                            var price =row.find('td:nth-child(3)').text().replace("₱ ", ""); //Removes the peso sign to make it as INT rather than string
                            var valid= row.find('td:nth-child(3)');
                            var ParsePrice = parseFloat(price.replace(/\,/g,''), 10);

                            // count =  count +1+ parseFloat(price.replace(/\,/g,''), 10);
                            // count =  count+ parseFloat(price.replace(/\,/g,''), 10);
                            var TotalQuantity = parseInt(itemQuantity);
                            

                            CurrentTotal = CurrentTotal + parseInt(itemQuantity);

                            var newRow = document.getElementById('cart').insertRow();                       
                            newRow.innerHTML = "<tr> <td id = "+buttonValue +">" + currentName + "</td> <td class='qtys' price ='"+ParsePrice+"' val_id='"+buttonValue+"'> " + itemQuantity + " </td><td class ='sp_name' sp_id = '"+get_supplier_id+"'> "+get_supplier_name+" </td><td> <button type='button' class='btn btn-danger' name ='remove' onclick= 'DeleteRow(this)' value ='"+TotalQuantity+"' > - </button></td>";
                            total_qty.value = CurrentTotal;                             
                            // payment.value = "₱ "+ totalPayment;
                            
                            // payment.value = "₱ "+ CurrentTotal.toFixed(2);
                            itemName++;
                            quantity++;                         
                        } // END IF                                                 
                    }   // END ELSE    
                    // $(".qtys").each(function(i){ // this gets all the classes in the order table.
                    //         if (buttonValue ==$(this).attr('val_id') )
                    //         { //checks i there is existing item
                                
                    //                 // var current_stock = parseInt(row.find('td:nth-child(3)').text());
                    //                 qty = $(this).text();  //Ye Old quantity, not the price
                                                                
                    //                 qty_old = parseInt(qty.replace(/\,/g,''), 10); //old qty in cart table

                    //                 item_does_not_exist = false; //item does exist
                    //                 new_qty = parseInt(itemQuantity) + qty_old; //adds old qty with current qty in cart

                    //                 CurrentTotal = CurrentTotal + parseInt(itemQuantity);
                    //                 total_qty.value = CurrentTotal;  
                            
                    //                 $(this).text(new_qty); // ye new qty
                    //                 item_id_in_cart.pop(); //Removes ID from array since item already exist
                                    
                    //                 //     var oldPrice =  $(this).attr('price');
                    //                 //     var newPrice = $(this).attr('price') * new_qty;

                    //                 //     var subtractOldamount = qty_old *oldPrice;
                    //                 //     CurrentTotal = (CurrentTotal - subtractOldamount);
                                                                                
                    //                 //     CurrentTotal = CurrentTotal+ newPrice;
                    //                 //     payment.value = "₱ "+  CurrentTotal.toFixed(2) ;
                                    
                    //                 // console.log("Old Amount = "+subtractOldamount);                                   
                    //                 // console.log("Old Price = "+oldPrice);
                    //                 // console.log("Current Total = "+CurrentTotal);
                    //                 console.log("Current Item Quantity = " + itemQuantity);
                    //                 // console.log(row.find('td:nth-child(3)').text());
                    //         } //END IF
                    //     });//END FUNCTION
                        
                       

            }); //END 1st JQUERY FUNCTION
             function DeleteRow(obj) 
               {               
                var buttonValue =obj.value;     
                var paymentBox = document.getElementById("payment");

                    var td = event.target.parentNode; // event.target will be the input element.
                    var tr = td.parentNode; // the row to be removed
                    var cartQuantity = tr.cells[1].innerHTML; // The item quantity in cart;
            
                    // var cartPrice = tr.cells[2].innerHTML.replace("₱ ", ""); //Gets Value of Cell in TR and Removes Peso Sign             
                    // var AmountToBeSubtracted = cartQuantity *  parseFloat(cartPrice.replace(/\,/g,''), 10);

                    // console.log("Cart Price = " + cartPrice);
                    console.log("Cart Quantity = " + cartQuantity);
                    // console.log("Total Amount = " + AmountToBeSubtracted);

                    CurrentTotal = CurrentTotal - parseInt(cartQuantity);
                    total_qty.value = CurrentTotal;  

                // var paymentValue = paymentBox.value.replace("₱ ", "");
              
                // CurrentTotal = (CurrentTotal.toFixed(2) - AmountToBeSubtracted.toFixed(2)); //Limits the Decimal points to 2
                // paymentBox.value = "₱ " + CurrentTotal.toFixed(2);

                    console.log("button value = "+buttonValue);
                    console.log("Total Quantity Value = "+CurrentTotal);
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
                    total_qty.value = 0;
                }           
            </script>
            <!-- <script>
            function getValue(obj) 
            {
                var status = obj.value;
                var strLink = "CreateJobOrderFab.php?order_id=<?php echo $CurrentOR?> & delivery_status =" + status;
                document.getElementById("nextpage").setAttribute("href",strLink);

              
            } -->
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

        <script>
            function insert_to_supply_table()
                {
                    var GET_SUPPLIER_ID=[]; 
                    var GET_CART_QTY=[];
                    $('#cart tr td:nth-child(2)').each(function (e) 
                    {
                        
                        var getValue =parseInt($(this).text());
                        console.log(getValue);
                        GET_CART_QTY.push(getValue);
                    }); //ENd jquery
                    $('#cart tr td:nth-child(3)').each(function (e) 
                    {
                        
                        var get_supplier_Value = $(this).text();
                        console.log(get_supplier_Value);
                        GET_SUPPLIER_ID.push(get_supplier_Value);
                    }); //ENd jquery
                    
                    request = $.ajax({
                        url: "ajax/insert_to_supply_order_tables.php",
                        type: "POST",
                        data: {post_item_id: item_id_in_cart,
                            post_item_qty: GET_CART_QTY,
                            post_supplier_id: GET_SUPPLIER_ID
                        },
                        success: function(data, textStatus)
                        {
                        
                        }//End Scucess                   
                    }); // End ajax    
                } //End function
                
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>

    <!-- Alert Box -->
    <script>
    function confirmalert()
    {
      confirm("Are you sure you want to enter the following data?");
      window.location.reload();
    }
    </script>

    <!-- Confirm Script -->
    <script>
        function confirmAdd()
        {
            confirm("Are you sure you want to add the items to the inventory?");
        }
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
    </body>
</html>
