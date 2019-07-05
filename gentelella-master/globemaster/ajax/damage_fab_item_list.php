<?php
    session_start();
    require_once('mysql_connect.php');
    $ITEM_QTY =  $_SESSION['qty_from_fab'];
    $ITEM_NAME = $_SESSION['name_from_fab'];
    $ITEM_PRICE;
    echo'<option>Choose..</option>';
    for($i = 0; $i < sizeof($_SESSION['qty_from_fab']); $i++)
    {
      
        $SQL_GET_PRICE = "SELECT price FROM items_trading WHERE item_name = '$ITEM_NAME[$i]' ";
        $RESULT_GET_PRICE=mysqli_query($dbc,$SQL_GET_PRICE);

        $ROW_RESULT_GET_PRICE=mysqli_fetch_assoc($RESULT_GET_PRICE);
        
        $ITEM_PRICE = $ROW_RESULT_GET_PRICE['price']; 

        $ITEM_QTY[$i];
        $ITEM_NAME[$i];
        echo'<option value = "'.$ITEM_QTY[$i].'" price = "'.$ITEM_PRICE.'">'.$ITEM_NAME[$i].' | ₱'.$ITEM_PRICE.'</option>'; //Temporary option value = ITEM_QTY     
    }

    
   
      
    //<-----------------------------------------[ Checker ] ---------------------------->
    for($i = 0; $i < sizeof($_SESSION['name_from_fab']); $i++)
    {
        echo $_SESSION['name_from_fab'][$i];
    }
?>