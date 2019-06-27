<?php
    session_start();
    $_SESSION['name_from_fab'] = array();
    $_SESSION['qty_from_fab'] = array();

    array_push($_SESSION['name_from_fab'],$_POST['post_item_name']);
    array_push($_SESSION['qty_from_fab'],$_POST['post_item_qty']);  

    $GET_POST_ITEM_NAME;
    $GET_POST_ITEM_QTY;

    


?>