<?php
    session_start();
    require_once('mysql_connect.php');

    $GET_ITEM_ID = $_POST['post_item_id'];
    $GET_DMG_QTY = $_POST['post_dmg_qty'];

    $DMG_SOURCE = "Environmental";
   
    $SQL_GET_ITEM_ID = "SELECT * FROM items_trading WHERE item_id = '$GET_ITEM_ID'";
    $RESULT_GET_ITEM_ID = mysqli_query($dbc,$SQL_GET_ITEM_ID);
    $ROW_RESULT_GET_ID = mysqli_fetch_assoc($RESULT_GET_ITEM_ID);

    $CURRENT_NAME = $ROW_RESULT_GET_ID['item_name'];
    $CURRENT_PRICE = $ROW_RESULT_GET_ID['price'];
    $TOTAL_LOSS = $GET_DMG_QTY * $CURRENT_PRICE;

    $INSERT_TO_DMG_TABLE = "INSERT INTO damage_item (refitem_id, item_name, item_quantity,total_loss, dmg_source, last_update)
    VALUES('$GET_ITEM_ID','$CURRENT_NAME', '$GET_DMG_QTY','$TOTAL_LOSS','$DMG_SOURCE', Now())";
    $RESULT_INSERT_TO_DMG_TABLE = mysqli_query($dbc,$INSERT_TO_DMG_TABLE);
    if(!$RESULT_INSERT_TO_DMG_TABLE)
    {
        echo "Error in Insert to DMG TBL";
    }
    else
    {
        $SQL_UPDATE_ITEMS_TRADING = "UPDATE items_trading
        SET item_count = (item_count - '$GET_DMG_QTY')
        WHERE item_id = '$GET_ITEM_ID'";
        $RESULT_UPDATE_TABLE = mysqli_query($dbc,$SQL_UPDATE_ITEMS_TRADING);
    }

    
?>