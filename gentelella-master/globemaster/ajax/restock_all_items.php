<?php
    session_start();
    require_once('mysql_connect.php');

    $GET_RESTOCK_NAMES = $_POST['post_item_name'];
    $GET_RESTOCK_QTY =  $_POST['post_item_qty'];

    

    for($i = 0; $i < sizeof($GET_RESTOCK_NAMES); $i++)
    {
        $SQL_GET_ITEM_ID = "SELECT * FROM items_trading WHERE item_name = '$GET_RESTOCK_NAMES[$i]'";
        $RESULT_GET_ITEM_ID = mysqli_query($dbc,$SQL_GET_ITEM_ID);
        $ROW_RESULT_GET_ID = mysqli_fetch_assoc($RESULT_GET_ITEM_ID);

        $CURRENT_ID = $ROW_RESULT_GET_ID['item_id'];
        $CURRENT_WAREHOUSE = $ROW_RESULT_GET_ID['warehouse_id'];

        $GET_WAREHOUSE_CAP = "SELECT * FROM warehouses WHERE warehouse_id = '$CURRENT_WAREHOUSE'"; //Gets the warehouse
        $RESULT_WAREHOUSE_CAP = mysqli_query($dbc,$GET_WAREHOUSE_CAP);
        $ROW_RESULT_WAREHOUSE_CAP = mysqli_fetch_assoc($RESULT_WAREHOUSE_CAP);
        
        $WAREHOUSE_INSIDE_CAP = $ROW_RESULT_WAREHOUSE_CAP['in_capacity'];
        $CURRENT_IN_WAREHOUSE = $ROW_RESULT_WAREHOUSE_CAP['current_in_capacity'];

        $INSERT_TO_RESTOCK_DETAIL = "INSERT INTO restock_detail (item_id, quantity, restock_date)
        VALUES('$CURRENT_ID', '$GET_RESTOCK_QTY[$i]', Now())";
        $RESULT_INSERT = mysqli_query($dbc,$INSERT_TO_RESTOCK_DETAIL);
        if(!$RESULT_INSERT) 
        {
            die('Error: ' . mysqli_error($dbc));
            echo "Error In Insert! \n";
        } 
        else 
        {
            
        }

        
        
        if( ($CURRENT_IN_WAREHOUSE+$GET_RESTOCK_QTY[$i]) > $WAREHOUSE_INSIDE_CAP)
        {
            $ITEMS_IN = $WAREHOUSE_INSIDE_CAP - $CURRENT_IN_WAREHOUSE;

            $ITEMS_OUT = $GET_RESTOCK_QTY[$i] - $ITEMS_IN;

            $SQL_UPDATE_ITEMS_TRADING = "UPDATE items_trading
            SET item_count = (item_count + '$GET_RESTOCK_QTY[$i]'),
            item_inside_warehouse = (item_inside_warehouse +'$ITEMS_IN'),
            item_outside_warehouse = (item_outside_warehouse + '$ITEMS_OUT')
            WHERE item_name = '$GET_RESTOCK_NAMES[$i]'";
            $RESULT_UPDATE_TABLE = mysqli_query($dbc,$SQL_UPDATE_ITEMS_TRADING);
           

            $SQL_UPDATE_WAREHOUSE_OUT= "UPDATE warehouses
            SET current_in_capacity = (current_in_capacity + '$ITEMS_IN'),
            out_capacity = (out_capacity + '$ITEMS_OUT')
            WHERE warehouse_id = '$CURRENT_WAREHOUSE'";
            $RESULT_UPDATE_WAREHOUSE_OUT = mysqli_query($dbc,$SQL_UPDATE_WAREHOUSE_OUT); //UPDATES the IN of warehouse


        }
        else
        {
            $SQL_UPDATE_ITEMS_TRADING = "UPDATE items_trading
            SET item_count = (item_count + '$GET_RESTOCK_QTY[$i]'),
            item_inside_warehouse = (item_inside_warehouse +'$GET_RESTOCK_QTY[$i]')
            WHERE item_name = '$GET_RESTOCK_NAMES[$i]'";
            $RESULT_UPDATE_TABLE = mysqli_query($dbc,$SQL_UPDATE_ITEMS_TRADING);
            if(!$RESULT_UPDATE_TABLE) 
            {
                die('Error: ' . mysqli_error($dbc));
                echo "Error In Update! \n";
            } 
            else 
            {
                echo "Success in Update Trading \n";
            }
    
            $SQL_UPDATE_WAREHOUSE_IN= "UPDATE warehouses
            SET current_in_capacity = (current_in_capacity + '$GET_RESTOCK_QTY[$i]')
            WHERE warehouse_id = '$CURRENT_WAREHOUSE'";
            $RESULT_UPDATE_WAREHOUSE_IN = mysqli_query($dbc,$SQL_UPDATE_WAREHOUSE_IN); //UPDATES the IN of warehouse
            if(!$RESULT_UPDATE_WAREHOUSE_IN) 
            {
                die('Error: ' . mysqli_error($dbc));
                echo "Error In Update! \n";
            } 
            else 
            {
                echo "Success in Update Warehouse   \n";
            }
        }
        
        
    }

    // for($i = 0; $i < sizeof($GET_RESTOCK_NAMES); $i++)
    // {
    //     echo $GET_RESTOCK_NAMES[$i];
    //     echo $GET_RESTOCK_QTY[$i];
    // }


?>