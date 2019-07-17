<?php
    session_start();
    require_once('mysql_connect.php');

    $GET_SKU_ID = $_POST['post_sku_id'];
    $GET_ITEM_NAME = $_POST['post_item_name'];
    $GET_ITEM_PRICE = $_POST['post_item_price'];
    $GET_ITEM_THRESHOLD = $_POST['post_item_threshold'];

    $GET_WAREHOUSE_ID = $_POST['post_warehouse_id'];
    $GET_TYPE_ID = $_POST['post_type_id'];
    $GET_SUPPLIER_ID = $_POST['post_supplier_id'];
    $GET_ITEM_WEIGHT = $_POST['post_item_weight'];

    $DiscountStatus = "Regular Price";

    $queryWarehouseID = "SELECT warehouses.warehouse_id FROM warehouses WHERE warehouse = '$GET_WAREHOUSE_ID'";
    $resultWarehouseID = mysqli_query($dbc,$queryWarehouseID);                                
    $rowWarehouseID = mysqli_fetch_assoc($resultWarehouseID); //Query for getting WarehouseID 

    $queryItemtypeID = "SELECT ref_itemtype.itemtype_id FROM ref_itemtype WHERE itemtype = '$GET_TYPE_ID'";
    $resultItemtype = mysqli_query($dbc,$queryItemtypeID);                                
    $rowItemtypeID = mysqli_fetch_assoc($resultItemtype); //Query For getting itemtypeID
    
    $querySupplierID = "SELECT supplier_id FROM suppliers WHERE supplier_name = '$GET_SUPPLIER_ID'";
    $resultSupplierID = mysqli_query($dbc,$querySupplierID);                                
    $rowSupplierID = mysqli_fetch_assoc($resultSupplierID); //Query For getting itemtypeID

    $queryItemID = "SELECT item_id FROM items_trading ORDER BY item_id DESC LIMIT 1 ";
    $resultItemID = mysqli_query($dbc,$queryItemID);
    $rowResultItemID = mysqli_fetch_assoc($resultItemID);

    $WAREHOUSE_ID = $rowWarehouseID['warehouse_id'];
    $ITEM_TYPE_ID = $rowItemtypeID['itemtype_id'];
    $ITEM_ID = $rowResultItemID['item_id']+1;
    $SUPPLIER_ID = $rowSupplierID['supplier_id'];

    $SQL_ADD_INVENTORY = "INSERT INTO items_trading (item_id, sku_id, item_name, itemtype_id, item_count, last_restock, last_update, threshold_amt, warehouse_id, supplier_id, price,onDiscount, current_eoq, item_weight)
    Values(
    '$ITEM_ID',
    '$GET_SKU_ID',
    '$GET_ITEM_NAME', 
    '$ITEM_TYPE_ID',
    '0', now(),now(),
    '$GET_ITEM_THRESHOLD',
    '$WAREHOUSE_ID',
    '$SUPPLIER_ID',
    '$GET_ITEM_PRICE',
    '$DiscountStatus',
    '0.00',
    '$GET_ITEM_WEIGHT')";

    $RESULT_ADD_INVENTORY=mysqli_query($dbc,$SQL_ADD_INVENTORY);
    if(!$RESULT_ADD_INVENTORY) 
    {
        die('Error: ' . mysqli_error($dbc));
        echo ("Unsuccessful");
    } 
    else 
    {      
        // echo ("Items Added Successfully");        
    }              
    
    $GET_LAST_ENTRY = "SELECT * 
    FROM items_trading 
    ORDER BY item_id DESC
    LIMIT 1";
    $RESULT_LAST_ENTRY = mysqli_query($dbc,$GET_LAST_ENTRY);                                
    $ROW_RESULT_LAST_ENTRY = mysqli_fetch_assoc($RESULT_LAST_ENTRY); //Query For getting itemtypeID

    echo '<td sp_itm_nm ="'.$ROW_RESULT_LAST_ENTRY['item_name'].'"><input type="hidden" name = "item_name" value = "'.$ROW_RESULT_LAST_ENTRY['item_name'].'">'.$ROW_RESULT_LAST_ENTRY['item_name'].'</td>';
?>