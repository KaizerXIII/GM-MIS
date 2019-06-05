<?php
    session_start();
    require_once('mysql_connect.php');

    $RESTOCK_QTY = $_POST['post_restock_quantity'];
    $ITEM_NAME_FROM_INVENTORY = $_POST['post_item_name']; 

    $GET_ITEM_ID_FROM_NAME = "SELECT item_id FROM items_trading WHERE item_name = '$ITEM_NAME_FROM_INVENTORY'"; //Gets the Name from EditInvetory Reworked via SOD
    $RESULT_GET_NAME =mysqli_query($dbc,$GET_ITEM_ID_FROM_NAME); 
    $row = mysqli_fetch_assoc($RESULT_GET_NAME);

    $CURRENT_ITEM_ID = $row['item_id']; //Gets the ID based from the name

    $UPDATE_ITEM_TRADING_RESTOCK = "UPDATE items_trading 
    SET items_trading.item_count  = (item_count + '$RESTOCK_QTY'),
    last_restock = Now() 
    WHERE item_id ='$CURRENT_ITEM_ID';"; //Updates the item count in DB

    $RESULT_RESTOCK=mysqli_query($dbc,$UPDATE_ITEM_TRADING_RESTOCK);    

    

    $itemID =  $CURRENT_ITEM_ID;//Adds items to restock table
    $SQL_INSERT_RESTOCK_DETAILS = "INSERT INTO restock_detail (item_id, quantity, restock_date)
    VALUES ('$CURRENT_ITEM_ID','$RESTOCK_QTY',Now())";
    $RESULT_INSERT_RESTOCK_DETAIL =mysqli_query($dbc,$SQL_INSERT_RESTOCK_DETAILS); 

    if(!$RESULT_RESTOCK || !$RESULT_INSERT_RESTOCK_DETAIL) 
    {
        die('Error: ' . mysqli_error($dbc));
    } 
    else 
    {
      echo "Item Restocked!";
    }
   
?>