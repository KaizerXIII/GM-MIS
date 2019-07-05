<?php
    session_start();
    require_once('mysql_connect.php');

    $GET_ITEMS_ID = $_POST['post_item_id'];
    $GET_ITEMS_QTY = $_POST['post_item_qty'];
    $GET_TOTAL_PRICE = $_POST['post_total_price'];
    $GET_REQUESTED_DATE = $_POST['post_requested_date'];

    

    $SANITIZED_TOTAL = str_replace("₱","", $GET_TOTAL_PRICE);
    
    $SQL_INSERT_TO_DEPOT_REQUEST = "INSERT INTO depot_request (depot_request_date, depot_expected_date, total_payment, depot_request_status) 
    VALUES (now(),'$GET_REQUESTED_DATE', '$SANITIZED_TOTAL','Order in Progress');";
    $RESULT_INSERT_TO_DEPOT_REQUEST = mysqli_query($dbc,$SQL_INSERT_TO_DEPOT_REQUEST);
    if(!$RESULT_INSERT_TO_DEPOT_REQUEST)
    {
        die('Error: ' . mysqli_error($dbc));
    }
    else
    {
        $SQL_GET_REQUEST_OR = "SELECT max(depot_request_id) as Requisition_Order FROM depot_request";
        $RESULT_GET_REQUEST_OR = mysqli_query($dbc,$SQL_GET_REQUEST_OR);
        $ROW_RESULT_GET_REQUEST_OR = mysqli_fetch_assoc($RESULT_GET_REQUEST_OR);
        $GET_DOR = $ROW_RESULT_GET_REQUEST_OR['Requisition_Order'];
        
        for($i = 0; $i < sizeof($GET_ITEMS_ID);$i++ )
        {
            $SQL_GET_DEPOT_REFERENCE = "SELECT * 
            FROM mydb.items_trading
            JOIN depotdb.gm_products
            ON gm_products.UnitName = items_trading.item_name
            JOIN depotdb.gm_inventorystocks
            ON gm_inventorystocks.ProductID = gm_products.ProductID
            WHERE item_id = '$GET_ITEMS_ID[$i]'";
            $RESULT_GET_DEPOT_REFERENCE =  mysqli_query($dbc,$SQL_GET_DEPOT_REFERENCE);
            $ROW_RESULT_SQL_GET_DEPOT_REFERENCE = mysqli_fetch_assoc($RESULT_GET_DEPOT_REFERENCE);

            $DEPOT_ITEM_REFERENCE = $ROW_RESULT_SQL_GET_DEPOT_REFERENCE['UnitName'];
            $TRADING_PRICE = $ROW_RESULT_SQL_GET_DEPOT_REFERENCE['price'];                   

            $SQL_INSERT_TO_DETAILS = "INSERT INTO depot_request_details(depot_request_number, requested_item_name, requested_item_qty, depot_reference_name, price_each)
            VALUES('$GET_DOR','$GET_ITEMS_ID[$i]','$GET_ITEMS_QTY[$i]','$DEPOT_ITEM_REFERENCE','$TRADING_PRICE');";
            $RESULT_INSERT_TO_DETAILS =  mysqli_query($dbc,$SQL_INSERT_TO_DETAILS);
            
            $SQL_UPDATE_ITEMS_TRADING = "UPDATE mydb.items_trading
            SET item_count = (item_count - '$GET_ITEMS_QTY[$i]'),
            last_update = now()
            WHERE item_id = '$GET_ITEMS_ID[$i]'";
            $RESULT_UPDATE_ITEMS_TRADING = mysqli_query($dbc,$SQL_UPDATE_ITEMS_TRADING);
            if(!$RESULT_UPDATE_ITEMS_TRADING)
            {
                echo "Something Went Wrong at Items Trade";
            }
            else
            {

            }

            $SQL_UPDATE_DEPOT = "UPDATE depotdb.gm_products
            JOIN depotdb.gm_inventorystocks
            ON gm_inventorystocks.ProductID = gm_products.ProductID
            SET StockOnHand = (StockOnHand + '$GET_ITEMS_QTY[$i]'),
            LastModified = now()
            WHERE UnitName = '$DEPOT_ITEM_REFERENCE'";
            $RESULT_UPDATE_DEPOT = mysqli_query($dbc,$SQL_UPDATE_DEPOT);
            if(!$SQL_UPDATE_DEPOT)
            {
                echo "Something Went Wrong at Depot";
            }
            else
            {

            }
        }
    }
    
    

?>