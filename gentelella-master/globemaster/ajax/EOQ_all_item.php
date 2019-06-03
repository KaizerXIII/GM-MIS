<?php
require_once('../DataFetchers/mysql_connect.php');

$query_insert = "SELECT warehouses.warehouse_id FROM warehouses WHERE warehouse = '$GET_WAREHOUSE_ID'";
$resultWarehouseID = mysqli_query($dbc,$queryWarehouseID);                                
$rowWarehouseID = mysqli_fetch_assoc($resultWarehouseID); //Query for getting WarehouseID 

?>