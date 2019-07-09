<?php
session_start();
require_once('mysql_connect.php');

$GET_STATUS_SHIPPED = $_POST['post_status_shipped'];
$GET_SUPPLY_ORDER_NUMBER = $_POST['post_supply_order_number'];

$UPDATE_SET_STATUS_SHIPPED = "UPDATE supply_order
                              SET supply_order.supply_order_status  = ('$GET_STATUS_SHIPPED')
                              WHERE supply_order_id = '$GET_SUPPLY_ORDER_NUMBER';";
                              $RESULT_UPDATE_SET_STATUS_SHIPPED=mysqli_query($dbc,$UPDATE_SET_STATUS_SHIPPED);
                              if(!$RESULT_UPDATE_SET_STATUS_SHIPPED)
                              {
                                die('Error: ' . mysqli_error($dbc));
                                echo "Error: Status update unsuccessful.";
                              }
                              else
                              {

                              }
?>