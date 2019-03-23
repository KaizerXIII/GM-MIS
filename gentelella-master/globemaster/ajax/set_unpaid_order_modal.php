<?php
    session_start();
    //<------------------------------------------------------------------------------------------------------>
   require_once('mysql_connect.php');
    $_SESSION['ordernumber_array_from_unpaid_customer_php'] = $_POST['post_order_number'];
    

?>