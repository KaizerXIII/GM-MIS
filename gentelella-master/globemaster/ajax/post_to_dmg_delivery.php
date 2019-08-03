<?php
    session_start();
    require_once('mysql_connect.php');
    
    $_SESSION['name_from_delivery'] = array();
    $_SESSION['qty_from_delivery'] = array();

    $_SESSION['name_from_delivery'] = $_POST['post_item_name'];
    $_SESSION['qty_from_delivery'] = $_POST['post_item_qty']; 
   
    $CURRENT_DR = $_POST['post_dr_number'];

    $GET_OR_FROM_DR = "SELECT * FROM scheduledelivery WHERE delivery_Receipt = '$CURRENT_DR'";
    $RESULT_GET_OR = mysqli_query($dbc, $GET_OR_FROM_DR);
    $ROW_RESULT_GET_OR = mysqli_fetch_assoc($RESULT_GET_OR);

    $_SESSION['current_dr_or'] = $ROW_RESULT_GET_OR['ordernumber'];
    
    echo  $_SESSION['current_dr_or'] ;