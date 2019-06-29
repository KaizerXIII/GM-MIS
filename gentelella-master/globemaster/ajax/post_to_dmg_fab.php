<?php
    session_start();
    require_once('DataFetchers/mysql_connect.php');
    $_SESSION['name_from_fab'] = array();
    $_SESSION['qty_from_fab'] = array();

    $_SESSION['name_from_fab'] = $_POST['post_item_name'];
    $_SESSION['qty_from_fab'] = $_POST['post_item_qty'];

    for($i = 0; $i < sizeof($_SESSION['name_from_fab']); $i++)
    {
      $ITEM_QTY =  $_SESSION['qty_from_fab'][$i];
      $ITEM_NAME = $_SESSION['name_from_fab'][$i];

      $SQL_CHECK_ITEM_QTY = "SELECT * FROM items_trading WHERE item_name = '$ITEM_NAME'";
      $RESULT_CHECK_ITEM_QTY =  mysqli_query($dbc,$SQL_CHECK_ITEM_QTY);
      $ROW_CHECK_ITEM_QTY=mysqli_fetch_array($RESULT_CHECK_ITEM_QTY,MYSQLI_ASSOC);
      if($ROW_CHECK_ITEM_QTY['item_count'] > $ITEM_QTY)
      {

      }
     

    }     
   
      
    //<-----------------------------------------[ Checker ] ---------------------------->
    for($i = 0; $i < sizeof($_SESSION['name_from_fab']); $i++)
    {
        echo $_SESSION['name_from_fab'][$i];
    }
?>