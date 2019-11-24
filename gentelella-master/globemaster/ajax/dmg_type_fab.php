<?php
    session_start();
    require_once('mysql_connect.php');

    $GET_DMG_NAME = $_POST['post_dmg_item'];
    $GET_DMG_QTY =$_POST['post_dmg_qty'];
    $GET_REPLACE_NAME = $_POST['post_replace_item'];
    $GET_REPLACE_QTY = $_POST['post_replace_qty'];

    $DMG_SOURCE = "Fabrication";
    
    for($i = 0; $i < sizeof($GET_DMG_NAME); $i++)
    {
        echo "DMG NAME: ".$GET_DMG_NAME[$i]."\n";
        echo "DMG QTY: ".$GET_DMG_QTY[$i]."\n";
        echo "REPLACEMENT NAME: ".$GET_REPLACE_NAME[$i]."\n";
        echo "REPLACEMENT QTY: ".$GET_REPLACE_QTY[$i]."\n";

        $TRIM_R_NAME = trim($GET_REPLACE_NAME[$i]); //Trimmed to remove other Bullshits for proper comparison
        
        $GET_ITEM_INFO ="SELECT * FROM items_trading WHERE item_name ='$GET_DMG_NAME[$i]'"; //For DMG Item Name
        $RESULT_GET_INFO = mysqli_query($dbc, $GET_ITEM_INFO);
        $ROW_RESULT_GET_INFO = mysqli_fetch_assoc($RESULT_GET_INFO);

        $GET_ITEM_REPLACEMENT ="SELECT * FROM items_trading WHERE item_name ='$TRIM_R_NAME'"; //For Replacement Item Name
        $RESULT_GET_REPLACEMENT = mysqli_query($dbc, $GET_ITEM_REPLACEMENT);
        $ROW_RESULT_GET_REPLACEMENT = mysqli_fetch_assoc($RESULT_GET_REPLACEMENT);
        
        $CURRENT_DMG_ID = $ROW_RESULT_GET_INFO['item_id']; //Gets the DMG item id
        $LOSS = (int) $ROW_RESULT_GET_INFO['price'] * (int) $GET_DMG_QTY[$i]; // Gets the Loss based on the item price of company

        $CURRENT_REPLACEMENT_ID = $ROW_RESULT_GET_REPLACEMENT['item_id']; //Replacement item id

        $INSERT_TO_DMG_TBL = "INSERT INTO damage_item (refitem_id, item_name, item_quantity, total_loss, dmg_source, last_update) 
        VALUES('$CURRENT_DMG_ID','$GET_DMG_NAME[$i]','$GET_DMG_QTY[$i]','$LOSS','$DMG_SOURCE',now())";
        $RESULT_INSERT_DMG = mysqli_query($dbc, $INSERT_TO_DMG_TBL);
      
        $UPDATE_ITEM_STOCK = "UPDATE items_trading SET item_count = (item_count - '$GET_REPLACE_QTY[$i]'),
        item_inside_warehouse = (item_inside_warehouse - '$GET_REPLACE_QTY[$i]')
        WHERE item_id = '$CURRENT_REPLACEMENT_ID'";
        $RESULT_ITEM_STOCK = mysqli_query($dbc, $UPDATE_ITEM_STOCK);

     
    }
    

    
?>