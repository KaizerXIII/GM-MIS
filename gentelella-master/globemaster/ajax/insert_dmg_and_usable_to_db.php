<?php
    session_start();
    require_once('mysql_connect.php');
    $GET_DMG_QTY = $_POST['post_damage_qty'];
    $GET_DMG_PERCENT = $_POST['post_damage_percent'];
    $GET_DMG_PRICE = $_POST['post_damage_price'];
    $GET_DMG_TOTAL = $_POST['post_damage_total'];
    $GET_DMG_ITEM_NAME = $_POST['post_damage_item'];
    $ITEM_ID_FROM_DB = $_SESSION['item_IDfromView'];

    // $SQL_GET_ITEM_ID = "SELECT item_id FROM items_tradings WHERE sku_id = $GET_DMG_ITEM_NAME";
    // $RESULT_GET_SQL = mysqli_query($dbc,$SQL_GET_ITEM_ID);
    // while($ROW_RESULT=mysqli_fetch_array($RESULT_GET_SQL,MYSQLI_ASSOC))
    // {
    //     $ITEM_ID_FROM_DB = $ROW_RESULT['item_id'];
    // } 

    $SQL_INSERT_DMG_TABLE = "INSERT INTO damage_item (refitem_id, item_name, damage_percentage, item_quantity,total_loss,last_update)
    VALUES ('$ITEM_ID_FROM_DB', '$GET_DMG_ITEM_NAME','$GET_DMG_PERCENT','$GET_DMG_QTY','$GET_DMG_TOTAL',Now())";
    $RESULT_GET_SQL = mysqli_query($dbc,$SQL_INSERT_DMG_TABLE);
    if(! $RESULT_GET_SQL) 
    {
        die('Error: ' . mysqli_error($dbc));
    } 
    else 
    {
        echo 'Damaged Item Added!';
    
    }

    $UNDAMAGED_PERCENTAGE = 100 - $GET_DMG_PERCENT;
    

    $NEW_ITEM_NAME = $GET_DMG_ITEM_NAME.' - '. $UNDAMAGED_PERCENTAGE.'% ' ;

    $SQL_SELECT_FROM_ITEMS_TRADING = "SELECT * FROM items_trading WHERE item_id = '$ITEM_ID_FROM_DB'";
    $RESULT_SELECT_SQL = mysqli_query($dbc,$SQL_SELECT_FROM_ITEMS_TRADING);
    $ROW_RESULT_SELECT_SQL = mysqli_fetch_assoc($RESULT_SELECT_SQL); //Gets the item details

    $GET_SKU_ID = $ROW_RESULT_SELECT_SQL['sku_id'];
    $GET_ITEM_TYPE_ID = $ROW_RESULT_SELECT_SQL['itemtype_id'];
    $GET_WAREHOUSE_ID = $ROW_RESULT_SELECT_SQL['warehouse_id'];
    $GET_SUPPLIER_ID = $ROW_RESULT_SELECT_SQL['supplier_id'];
    $GET_ITEM_PRICE = $ROW_RESULT_SELECT_SQL['price']; 

    $NEW_SKU = $GET_SKU_ID.' - '. $UNDAMAGED_PERCENTAGE.'% ' ;

    // $ROW_RESULT_SELECT_SQL['item_name']; // New Item Name based on how much usable part.
    // $ROW_RESULT_SELECT_SQL['item_count'];
    // $ROW_RESULT_SELECT_SQL['last_restock']; //NOW()
    // $ROW_RESULT_SELECT_SQL['last']; //NOW()
    // $ROW_RESULT_SELECT_SQL['threshold'];   //threshold auto set to 0 [zero]  
    // $ROW_RESULT_SELECT_SQL['onDiscount']; AUTO SET TO REGULAR PRICE

    $UNDAMAGED_PRICE = $GET_ITEM_PRICE - $GET_DMG_PRICE; //Price based on usable part

    $INSERT_UNDAMAGED_ITEM_PART = "INSERT INTO items_trading (sku_id, item_name, itemtype_id, item_count, last_restock, last_update, threshold_amt, warehouse_id, supplier_id, price, onDiscount)
    Values(                           
    '$NEW_SKU',
    '$NEW_ITEM_NAME', 
    '$GET_ITEM_TYPE_ID',
    '$GET_DMG_QTY', now(),now(),
    '0',
    '$GET_WAREHOUSE_ID',
    '$GET_SUPPLIER_ID',
    '$UNDAMAGED_PRICE',
    'Regular Price')";

    $result=mysqli_query($dbc,$INSERT_UNDAMAGED_ITEM_PART);
    if(!$result) 
    {
        die('Error: ' . mysqli_error($dbc));
    } 
    else 
    {
      
        echo "Undamaged Item Added Successfully";

        
    }              

    

    
   
    
?>