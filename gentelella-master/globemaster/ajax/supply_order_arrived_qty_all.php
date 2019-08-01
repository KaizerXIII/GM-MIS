<?php
    session_start();
    require_once('mysql_connect.php');
    

    $GET_ARRIVED_QTY =  $_POST['post_item_qty'];
    $GET_ARRIVED_NAME = $_POST['post_item_name'];
    $GET_ARRIVED_OR = $_POST['post_supply_OR'];
    $GET_SUPP_NAME = $_POST['post_item_supplier'];

    for($i = 0 ; $i < sizeof($GET_ARRIVED_NAME); $i++ )
    {
        $SQL_GET_ARRIVED_CURRENT_VALUE = "SELECT * FROM supply_order_details WHERE (supply_item_name = '$GET_ARRIVED_NAME[$i]') AND (supply_order_id = '$GET_ARRIVED_OR') AND (supplier_name = '$GET_SUPP_NAME[$i]')";
        $RESULT_GET_ARRIVED_CURRENT_VALUE = mysqli_query($dbc,$SQL_GET_ARRIVED_CURRENT_VALUE);
        $ROW_RESULT_GET_ARRIVED_CURRENT_VALUE = mysqli_fetch_array($RESULT_GET_ARRIVED_CURRENT_VALUE,MYSQLI_ASSOC);

        $UPDATE_ARRIVED_VALUE = $GET_ARRIVED_QTY[$i] + $ROW_RESULT_GET_ARRIVED_CURRENT_VALUE['supply_arrived_quantity'];

        $SQL_UPDATE_SUPPLY_DETAILS = "UPDATE supply_order_details SET supply_arrived_quantity = '$UPDATE_ARRIVED_VALUE' WHERE (supply_item_name = '$GET_ARRIVED_NAME[$i]') AND (supply_order_id = '$GET_ARRIVED_OR')AND (supplier_name = '$GET_SUPP_NAME[$i]')";
        $RESULT_SQL_UPDATE_SUPPLY_DETAILS = mysqli_query($dbc,$SQL_UPDATE_SUPPLY_DETAILS);
        
        if(!$RESULT_SQL_UPDATE_SUPPLY_DETAILS || !$RESULT_GET_ARRIVED_CURRENT_VALUE)
        {
            die('Error: ' . mysqli_error($dbc));
            echo "Error: Closing Connection";
        }
        else
        {
            echo "Update Successful!";
            echo $GET_ARRIVED_QTY[$i] ;
        }
    }
    

   

?>