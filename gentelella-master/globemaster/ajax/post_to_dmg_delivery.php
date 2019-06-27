<?php
    session_start();
   
$_SESSION['name_from_delivery'] = array();
$_SESSION['qty_from_delivery'] = array();

$_SESSION['name_from_delivery'] = $_POST['post_item_name'];
$_SESSION['qty_from_delivery'] = $_POST['post_item_qty'];
    


?>