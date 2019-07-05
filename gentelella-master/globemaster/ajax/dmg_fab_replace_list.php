<?php
    session_start();
    require_once('mysql_connect.php');

    $ITEM_PRICE = $_POST['post_item_price'];
    
      
    $SQL_GET_PRICE = "SELECT * FROM items_trading WHERE price >= '$ITEM_PRICE'";
    $RESULT_GET_PRICE=mysqli_query($dbc,$SQL_GET_PRICE);
    echo'<option>Choose..</option>';
    while($ROW_RESULT_GET_PRICE=mysqli_fetch_array($RESULT_GET_PRICE, MYSQLI_ASSOC))
    {
        $ITEM_PRICE = $ROW_RESULT_GET_PRICE['price']; 
        
        echo'<option value = "'.$ROW_RESULT_GET_PRICE['item_count'].'" price = "'.$ITEM_PRICE.'">'.$ROW_RESULT_GET_PRICE['item_name'].' | ₱'.$ITEM_PRICE.'</option>'; //Temporary option value = ITEM_QTY     
        
    }
 
      
    //<-----------------------------------------[ Checker ] ---------------------------->
    for($i = 0; $i < sizeof($_SESSION['name_from_fab']); $i++)
    {
        echo $_SESSION['name_from_fab'][$i];
    }
?>