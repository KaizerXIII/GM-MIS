<?php
    session_start();
    require_once('mysql_connect.php');

    $GET_DMG_NAME = $_POST['post_dmg_item'];
    $GET_DMG_QTY =$_POST['post_dmg_qty'];
    $GET_REPLACE_NAME = $_POST['post_replace_item'];
    $GET_REPLACE_QTY = $_POST['post_replace_qty'];

    $DMG_SOURCE = "Delivery";

    $SQL_GET_MAX_OR = " SELECT count(ordernumber)+1 as TOTALOR FROM orders";
    $RESULT_GET_MAX_OR=mysqli_query($dbc,$SQL_GET_MAX_OR);
    $ROW_RESULT_MAX_OR = mysqli_fetch_array($RESULT_GET_MAX_OR,MYSQLI_ASSOC);

    $CurrentOR = "OR - ".$ROW_RESULT_MAX_OR['TOTALOR'];
    $OR_FROM_DR = $_POST['post_current_or'];
    $FAB_STATUS = "No Fabrication";
    $ORDER_STATUS = "Deliver";
    echo "Current OR From DR: ".$_POST['post_current_or']."\n";
    $TOTAL_PRICE = 0;

    for($i = 0; $i < sizeof($GET_DMG_NAME); $i++)
    {
        echo "DMG NAME: ".$GET_DMG_NAME[$i]."\n";
        echo "DMG QTY: ".$GET_DMG_QTY[$i]."\n";
        echo "REPLACEMENT NAME: ".$GET_REPLACE_NAME[$i]."\n";
        echo "REPLACEMENT QTY: ".$GET_REPLACE_QTY[$i]."\n";

        $TRIM_R_NAME = trim($GET_REPLACE_NAME[$i]); //Trimmed to remove other Bullshits for proper comparison
        
        $GET_ITEM_INFO ="SELECT * FROM items_trading WHERE item_name ='$GET_DMG_NAME[$i]'"; //For DMG Item Name
        $RESULT_GET_INFO = mysqli_query($dbc, $GET_ITEM_INFO);
        $ROW_RESULT_GET_INFO = mysqli_fetch_assoc($RESULT_GET_INFO);

        $GET_ITEM_REPLACEMENT ="SELECT * FROM items_trading WHERE item_name ='$TRIM_R_NAME'"; //For Replacement Item Name
        $RESULT_GET_REPLACEMENT = mysqli_query($dbc, $GET_ITEM_REPLACEMENT);
        $ROW_RESULT_GET_REPLACEMENT = mysqli_fetch_assoc($RESULT_GET_REPLACEMENT);
        
            $CURRENT_DMG_ID = $ROW_RESULT_GET_INFO['item_id']; //Gets the DMG item id
            $LOSS = $ROW_RESULT_GET_INFO['price'] * $GET_DMG_QTY[$i]; // Gets the Loss based on the item price of company
        
            $CURRENT_REPLACEMENT_ID = $ROW_RESULT_GET_REPLACEMENT['item_id']; //Replacement item id
            $TOTAL_PRICE = $TOTAL_PRICE + ($ROW_RESULT_GET_REPLACEMENT['price'] * $GET_REPLACE_QTY[$i]);//Gets the total replacement price
       
        $INSERT_TO_DMG_TBL = "INSERT INTO damage_item (refitem_id, item_name, item_quantity, total_loss, dmg_source, last_update) 
        VALUES('$CURRENT_DMG_ID','$GET_DMG_NAME[$i]','$GET_DMG_QTY[$i]','$LOSS','$DMG_SOURCE',now())";
        $RESULT_INSERT_DMG = mysqli_query($dbc, $INSERT_TO_DMG_TBL);


        
      
        $UPDATE_ITEM_STOCK = "UPDATE items_trading SET item_count = (item_count - '$GET_REPLACE_QTY[$i]') WHERE item_id = '$CURRENT_REPLACEMENT_ID'";
        $RESULT_ITEM_STOCK = mysqli_query($dbc, $UPDATE_ITEM_STOCK);

        $FINISH_WITH_DAMAGES = "Finished With Damages";

        $UPDATE_DELIVERY_STATUS = "UPDATE scheduledelivery SET delivery_status = '$FINISH_WITH_DAMAGES' WHERE ordernumber = '$OR_FROM_DR'";
        $RESULT_UPDATE_DELIVERY_STATUS = mysqli_query($dbc, $UPDATE_DELIVERY_STATUS);
    }
    $PAYMENT_STATUS = "Paid";
    echo "LOSS: ".$LOSS."\n";    
    echo "TOTAL PRICE: ".$TOTAL_PRICE."\n";
    $INSERT_TO_ORDERS = "INSERT INTO orders (ordernumber, client_id, order_date, expected_date, payment_id, totalamt, order_status, installation_status, fab_status, payment_status)
    SELECT '$CurrentOR', client_id, Now(), NOW() + INTERVAL 3 DAY, payment_id, '$TOTAL_PRICE', '$ORDER_STATUS', installation_status, '$FAB_STATUS', '$PAYMENT_STATUS'
    FROM orders
    WHERE ordernumber ='$OR_FROM_DR'";
    $RESULT_INSERT_TO_ORDERS = mysqli_query($dbc, $INSERT_TO_ORDERS);
    if(!$RESULT_INSERT_TO_ORDERS)
    {
        echo "Error in Insert;";
    }
    else
    {
        echo "Success in Insert;";

        $GET_ORDER_INFO = "SELECT * FROM orders WHERE ordernumber = '$CurrentOR'";
        $RESULT_GET_ORDER_INFO = mysqli_query($dbc, $GET_ORDER_INFO);
        $ROW_RESULT_GET_ORDER_INFO = mysqli_fetch_assoc($RESULT_GET_ORDER_INFO);

        $CLIENT_ID = $ROW_RESULT_GET_ORDER_INFO['client_id'];

        for($j = 0; $j < sizeof($GET_REPLACE_NAME); $j++)
        {
            $TRIM_R_NAME = trim($GET_REPLACE_NAME[$j]); //Trimmed to remove other Bullshits for proper comparison

            $GET_ITEM_REPLACEMENT ="SELECT * FROM items_trading WHERE item_name ='$TRIM_R_NAME'"; //For Replacement Item Name
            $RESULT_GET_REPLACEMENT = mysqli_query($dbc, $GET_ITEM_REPLACEMENT);
            $ROW_RESULT_GET_REPLACEMENT = mysqli_fetch_assoc($RESULT_GET_REPLACEMENT);
            
            $REPLACE_ID = $ROW_RESULT_GET_REPLACEMENT['item_id'];
            $REPLACE_NAME = $ROW_RESULT_GET_REPLACEMENT['item_name'];
            $REPLACE_PRICE = $ROW_RESULT_GET_REPLACEMENT['price'];
            

            $ITEM_STATUS = "Deliver";
            
            $INSERT_TO_ORDER_DETAILS = "INSERT INTO order_details (ordernumber, client_id, item_id, item_name, item_price, item_qty, item_status)
            VALUES('$CurrentOR','$CLIENT_ID','$REPLACE_ID','$REPLACE_NAME', '$REPLACE_PRICE', '$GET_REPLACE_QTY[$j]', '$ITEM_STATUS')";
            $RESULT_INSERT_TO_ORDER_DETAILS = mysqli_query($dbc, $INSERT_TO_ORDER_DETAILS);
        }
    }
    
?>