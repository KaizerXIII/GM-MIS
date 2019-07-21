<?php
    session_start();
    $_SESSION['name_from_fab'] = array();
    $_SESSION['qty_from_fab'] = array();

    $_SESSION['name_from_fab'] = $_POST['post_item_name'];
    $_SESSION['qty_from_fab'] = $_POST['post_item_qty'];
    $_SESSION['fab_current_or'] = $_POST['post_current_or'];
       
   
      
    //<-----------------------------------------[ Checker ] ---------------------------->
    for($i = 0; $i < sizeof($_SESSION['name_from_fab']); $i++)
    {
        echo $_SESSION['name_from_fab'][$i];
    }
?>