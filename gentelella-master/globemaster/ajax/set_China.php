<?php
session_start();
require_once('mysql_connect.php');

$GET_STATUS_CHINA = $_POST['post_status_china'];
$GET_SUPPLY_ORDER_NUMBER = $_POST['post_supply_order_number'];

$UPDATE_SET_STATUS_CHINA = "UPDATE supply_order
                              SET supply_order.supply_order_status  = ('$GET_STATUS_CHINA')
                              WHERE supply_order_id = '$GET_SUPPLY_ORDER_NUMBER';";
                              $RESULT_UPDATE_SET_STATUS_CHINA=mysqli_query($dbc,$UPDATE_SET_STATUS_CHINA);
                              if(!$RESULT_UPDATE_SET_STATUS_CHINA)
                              {
                                die('Error: ' . mysqli_error($dbc));
                                echo "Error: Status update unsuccessful.";
                              }
                              else
                              {

                              }
?>