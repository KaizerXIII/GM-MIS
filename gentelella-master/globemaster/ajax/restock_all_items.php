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

        $SQL_UPDATE_ITEMS_TRADING = "UPDATE items_trading
        SET item_count = (item_count + '$GET_RESTOCK_QTY[$i]')
        WHERE item_name = '$GET_RESTOCK_NAMES[$i]'";
        $RESULT_UPDATE_TABLE = mysqli_query($dbc,$SQL_UPDATE_ITEMS_TRADING);
        
    }

    // for($i = 0; $i < sizeof($GET_RESTOCK_NAMES); $i++)
    // {
    //     echo $GET_RESTOCK_NAMES[$i];
    //     echo $GET_RESTOCK_QTY[$i];
    // }


?>