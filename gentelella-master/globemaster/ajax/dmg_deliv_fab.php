<?php
    session_start();
    require_once('./mysql_connect.php');

    $GET_CLIENT_NAME = $_POST['post_client_name'];
    $GET_ITEM_NAMES = $_POST['post_item_name'];
    $GET_ITEM_QTYS = $_POST['post_item_qty'];
    $GET_PAY_ID = $_POST['post_payment_id'];
    $GET_INSTALL_STAT = $_POST['post_install_status'];
    $GET_RENEW_OR = $_POST['post_renew_or'];
    $GET_EXP_DATE = $_POST['post_exp_date'];

    $ORDER_STATUS = "Deliver";
    $PAYMENT_STATUS = "Paid";
    $FAB_STATUS = "For Fabrication";

    $SQL_GET_C_ID = "SELECT * FROM clients WHERE client_name = '$GET_CLIENT_NAME'";
    $RESULT_GET_C_ID=mysqli_query($dbc,$SQL_GET_C_ID);
    $ROW_RESULT_GET_C_ID = mysqli_fetch_array($RESULT_GET_C_ID,MYSQLI_ASSOC);

    $CLIENT_ID = $ROW_RESULT_GET_C_ID['client_id'];

    $SQL_GET_MAX_OR = " SELECT count(ordernumber)+1 as TOTALOR FROM orders";
    $RESULT_GET_MAX_OR=mysqli_query($dbc,$SQL_GET_MAX_OR);
    $ROW_RESULT_MAX_OR = mysqli_fetch_array($RESULT_GET_MAX_OR,MYSQLI_ASSOC);

    $CurrentOR = "OR - ".$ROW_RESULT_MAX_OR['TOTALOR'];      
    
    $INSERT_TO_ORDERS = "INSERT INTO orders (ordernumber, client_id, order_date, expected_date, payment_id, totalamt, order_status, installation_status, fab_status, payment_status)
    SELECT '$CurrentOR', client_id, now(), expected_date, payment_id, totalamt, order_status, installation_status, '$FAB_STATUS', payment_status 
    FROM orders 
    WHERE ordernumber = '$GET_RENEW_OR';";
    $RESULT_RENEW_OR=mysqli_query($dbc,$INSERT_TO_ORDERS);
    if(!$RESULT_RENEW_OR)
    {
        echo "Error in Insert";
    }
    else
    {
        echo "Success in Insert Order";
        $INSERT_TO_DETAILS = "INSERT INTO order_details(ordernumber, client_id, item_id, item_name, item_price,item_qty,item_status)
        SELECT '$CurrentOR', client_id, item_id, item_name, item_price,item_qty,item_status
        FROM order_details
        WHERE ordernumber ='$GET_RENEW_OR'";
        $RESULT_TO_DETAILS=mysqli_query($dbc,$INSERT_TO_DETAILS);
        if(!$RESULT_TO_DETAILS)
        {
            echo "Error in Insert";
        }
        else
        {
            echo "Walao";
        }

        $INSERT_TO_JO = "INSERT INTO joborderfabrication (order_number, fab_description, fab_price, fab_totalprice, reference_drawing)
        SELECT '$CurrentOR',fab_description, fab_price, fab_totalprice, reference_drawing
        FROM joborderfabrication
        WHERE order_number ='$GET_RENEW_OR'";
        $RESULT_INSERT_TO_JO=mysqli_query($dbc,$INSERT_TO_JO);
        if(!$RESULT_INSERT_TO_JO)
        {
            echo "Error in Insert";
        }
        else
        {
            echo "Walao";
        }
    }
    
        

?>