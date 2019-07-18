<?php
session_start();
require_once('mysql_connect.php');

$GET_STATUS_AR = $_POST['post_status_AR'];
$GET_SUPPLY_ORDER_NUMBER = $_POST['post_supply_order_number'];

$UPDATE_SET_STATUS_AR = "UPDATE supply_order
                              SET supply_order.supply_order_status  = ('$GET_STATUS_AR')
                              WHERE supply_order_id = '$GET_SUPPLY_ORDER_NUMBER';";
                              $RESULT_UPDATE_SET_STATUS_AR=mysqli_query($dbc,$UPDATE_SET_STATUS_AR);
                              if(!$RESULT_UPDATE_SET_STATUS_AR)
                              {
                                die('Error: ' . mysqli_error($dbc));
                                echo "Error: Status update unsuccessful.";
                              }
                              else
                              {

                              }
?>