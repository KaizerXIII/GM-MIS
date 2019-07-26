<?php
    session_start();
    require_once('mysql_connect.php');

   $DMG_NAME_ARRAY = $_POST['post_dmg_name'];
   $DMG_QTY_ARRAY = $_POST['post_dmg_qty'];
   $ORIG_QTY_ARRAY = $_POST['post_orig_qty'];

   $DMG_SOURCE = "Supplier Shipment";
   $CURRENT_ID;
   $CURRENT_PRICE;
   $TOTAL_LOSS;
   $UNDAMAGED_QTY;

   for($i = 0; $i < sizeof($DMG_NAME_ARRAY); $i++)
   {
    $DMG_ITEM_NAME = $DMG_NAME_ARRAY[$i];
    $TRIMMED = trim($DMG_ITEM_NAME); //To remove unseen bullshits to properly compare

    $SQL_GET_ITEM_ID = "SELECT * FROM items_trading WHERE item_name = '$TRIMMED'";
    $RESULT_GET_ITEM_ID = mysqli_query($dbc,$SQL_GET_ITEM_ID);
    $ROW_RESULT_GET_ID = mysqli_fetch_assoc($RESULT_GET_ITEM_ID);

    $CURRENT_ID = $ROW_RESULT_GET_ID['item_id'];
    $CURRENT_PRICE = $ROW_RESULT_GET_ID['price'];
    $TOTAL_LOSS = $DMG_QTY_ARRAY[$i] * $CURRENT_PRICE;

    $UNDAMAGED_QTY = $ORIG_QTY_ARRAY[$i] - $DMG_QTY_ARRAY[$i];

    $INSERT_TO_DMG_TABLE = "INSERT INTO damage_item (refitem_id, item_name, item_quantity,total_loss, dmg_source, last_update)
    VALUES('$CURRENT_ID','$DMG_ITEM_NAME', '$DMG_QTY_ARRAY[$i]','$TOTAL_LOSS','$DMG_SOURCE', Now())";
    $RESULT_INSERT_TO_DMG_TABLE = mysqli_query($dbc,$INSERT_TO_DMG_TABLE);
    if(!$RESULT_INSERT_TO_DMG_TABLE)
    {
        echo "Error in Insert to DMG TBL";
    }
    else
    {
        $SQL_UPDATE_ITEMS_TRADING = "UPDATE items_trading
        SET item_count = (item_count + '$UNDAMAGED_QTY')
        WHERE item_name = '$TRIMMED'";
        $RESULT_UPDATE_TABLE = mysqli_query($dbc,$SQL_UPDATE_ITEMS_TRADING);
    }

    echo "DMG ITEM NAME: ". $DMG_ITEM_NAME."\n";
    echo "DMG ITEM ID: " .$CURRENT_ID."\n";
    echo "DMG ITEM PRICE: " .$CURRENT_PRICE."\n";
    echo "DMG ITEM TOTAL: ".$TOTAL_LOSS."\n";
    echo "UNDMG ITEM TOTAL: ".$UNDAMAGED_QTY."\n";
    
   }
   

  
  

    
?>