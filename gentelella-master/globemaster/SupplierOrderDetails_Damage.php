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

        <title>GM - Restocking [Damaged Goods] </title>

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

        <!-- <script>
            window.onbeforeunload = function () {
                return "Are you sure";
            };
        </script> -->


       
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
                                                if(isset($_GET['so_id']))
                                                {
                                                    $GET_SO_ID = $_GET['so_id'];
                                                    echo "SR - ".$GET_SO_ID;
                                                }
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
                                                    <select class="form-control col-md-12 col-xs-12" id="item_name_list" name="item_name_list"> 
                                                        <?php

                                                            require_once('DataFetchers/mysql_connect.php');
                                                            $get_item_from_session = $_SESSION['list_of_items'];
                                                            $get_qty_from_session = $_SESSION['list_of_qty'];

                                                            for($i = 0; $i < count($_SESSION['list_of_items']); $i++)
                                                            {
                                                                $SQL_GET_ITEM_NAME="SELECT * FROM items_trading WHERE item_name = '$get_item_from_session[$i]'";
                                                                $RESULT_GET_ITEM_NAME=mysqli_query($dbc,$SQL_GET_ITEM_NAME);
                                                                if(mysqli_num_rows($RESULT_GET_ITEM_NAME) == 0)
                                                                {
                                                                    $SQL_GET_NEW_ITEM_NAME = "SELECT * FROM new_item_temp_table WHERE new_item_name = '$get_item_from_session[$i]' ";
                                                                    $RESULT_GET_NEW_ITEM_NAME=mysqli_query($dbc,$SQL_GET_NEW_ITEM_NAME);
                                                                    while($row=mysqli_fetch_array($RESULT_GET_NEW_ITEM_NAME,MYSQLI_ASSOC))
                                                                    {
                                                                        echo "<option value=".$get_qty_from_session[$i]."> ".$row['new_item_name']."</option>";  
                                                                    }

                                                                }
                                                                else
                                                                {
                                                                    while($row=mysqli_fetch_array($RESULT_GET_ITEM_NAME,MYSQLI_ASSOC))
                                                                    {
                                                                        echo "<option value=".$get_qty_from_session[$i]."> ".$row['item_name']."</option>";  
                                                                    }
                                                                }
                                                                
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
                                                        </tr>

                                                        

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

                                                        <script type="text/javascript">
                                                        $(function()
                                                        {
                                                            $("#item_name_list").on('click', function(e){
                                                                if(e.offsetY < 0)
                                                                {
                                                                    var current_selected = $(this).find(":selected").text();
                                                                    

                                                                    var damage_table = document.getElementById('datatable-checkbox').insertRow();                          
                                                                    damage_table.innerHTML = "<tr> <td title='This item currently have: "+$(this).val()+" pieces'>" + current_selected + "</td> <td> <input type='number' min = '0' max ='"+$(this).val()+"' oninput ='validate(this)'> </td> <td> <input type='number' min = '1' max = '100' oninput='validate(this)'></td><td> <button type='button' class='delete_current_row'> <font color = 'red' size = '5'><i class='fa fa-close'></i></font> </button></td>";
                                                                    //console.log("New Row MUST BE Inserted");
                                                                    // alert("Works");
                                                                    // console.log($(this).find(":selected").text());
                                                                }
                                                                else
                                                                {
                                                                    
                                                                }
                                                               
                                                            })// END JQUERY                                                                                                                     
                                                        });//END FUNCTION
                                                        $(document).ready(function(){
                                                            $("#datatable-checkbox").on('click','.delete_current_row',function(){ //Gets the [table name] on click OF [class inside table] 
                                                                $(this).closest('tr').remove();
                                                                });

                                                        });  //Removes Row    

                                                        $(document).on("click","select option",function() {console.log("nice to meet you, console ;-)"); });

                                                        </script> <!-- Script to add new rows per click of items in dropdown -->
                                                    </table>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <label class="red" id="quantityAlert"></label>
                                                </div>
                                            </div>           
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12" align = "right">
                        <button type="button" class="btn btn-primary" name="complete_order" onclick = "confirmAdd()">Finish Restocking</button>
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
      <script type="text/javascript">
        function validate(obj) {
            obj.value = valBetween(obj.value, obj.min, obj.max); //Gets the value of input alongside with min and max
            console.log(obj.value);
        }

        function valBetween(v, min, max) {
            return (Math.min(max, Math.max(min, v))); //compares the value between the min and max , returns the max when input value > max
        }
    </script> <!-- To avoid the users input more than the current Max per item -->

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
    .tooltip {
    position: relative;
    display: inline-block;
    
    }

    .tooltip .tooltiptext {
    visibility: hidden;
    width: 180px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
    bottom: 100%;
    left: 50%;
    margin-left: -60px;
    }

    .tooltip:hover .tooltiptext {
    visibility: visible;
    }
</style>  <!-- Tooltip style for onhover -->
    </body>
</html>
