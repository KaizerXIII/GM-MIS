<?php
    session_start();

   //<------------------------------------------------------------------------------------------------------>
   require_once('mysql_connect.php');
   $GET_ID_FROM_EDIT_INVENTORY = $_POST['post_item_id']; // Item ID from Edit
   $GET_DISCOUNT_AMOUNT = $_POST['post_discount_amount']; // Percentage

   $OLD_ITEM_PRICE = 0;
   $NEW_ITEM_PRICE = 0;

   $SQL_GET_ITEM_DETAIL ="SELECT * FROM items_trading WHERE item_id = '$GET_ID_FROM_EDIT_INVENTORY'";
   $RESULT_GET_SQL = mysqli_query($dbc,$SQL_GET_ITEM_DETAIL);
   $ROW_RESULT = mysqli_fetch_array($RESULT_GET_SQL,MYSQLI_ASSOC);

   $OLD_ITEM_PRICE = $ROW_RESULT['price'];
   $DISCOUNT_CHECKER = $ROW_RESULT['onDiscount'];
   $DISCOUNT_STATUS = "On Discount";

   $NEW_ITEM_PRICE = $OLD_ITEM_PRICE * ((100 -  $GET_DISCOUNT_AMOUNT) / 100);

    if($DISCOUNT_CHECKER != $DISCOUNT_STATUS)
    {
        $INSERT_TO_DISCOUNTS = "INSERT INTO discounts (item_id, oldprice, newprice, percentage, dateStart, dateEnd)
        VALUES('$GET_ID_FROM_EDIT_INVENTORY', '$OLD_ITEM_PRICE','$NEW_ITEM_PRICE','$GET_DISCOUNT_AMOUNT', Now(), Now() + interval 1 month);";
        $RESULT_INSERT = mysqli_query($dbc, $INSERT_TO_DISCOUNTS);


        $UPDATE_ITEMS_TRADING = "UPDATE items_trading
        SET items_trading.price =('$NEW_ITEM_PRICE'),
        items_trading.onDiscount =('$DISCOUNT_STATUS'),
        last_update = Now()
        WHERE item_id = '$GET_ID_FROM_EDIT_INVENTORY';";
        $RESULT_UPDATE=mysqli_query($dbc,$UPDATE_ITEMS_TRADING);  
        if(!$RESULT_UPDATE) 
        {
            die('Error: ' . mysqli_error($dbc));
        } 
        else 
        {
            echo 'Discount is Set!';
             
        }
    }//End 1st IF
    else
    {
        echo 'Item has already have a Discount!';
        
    }
   

//<------------------------------------------------------------------------------------------------------>

?>