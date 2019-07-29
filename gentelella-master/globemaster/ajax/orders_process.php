<?php
    session_start();
    require_once('./mysql_connect.php');

    $CLIENT_ID = $_POST['post_client_id'];
    $PAYMENT_ID = $_POST['post_payment_id'];
    $CART_TOTAL = $_POST['post_cart_total'];                               
    $PAYMENT_STATUS = $_POST['post_payment_status'];
    $DOWNPAYMENT = $_POST['post_downpayment'];

    $CURRENT_OR = $_POST['post_current_or'];
    $INSTALL_STATUS = "No Installation";
    $EXPECTED_DATE = $_POST['post_expected_date'];       
    
    $ORDER_DELIVERY_STATUS = $_SESSION['DeliveryStatus'];
    $FAB_STATUS = $_SESSION['FabricationStatus'];

    $CART_ITEM_ID = $_POST['post_cart_item_id'];
    $CART_ITEM_QTY = $_POST['post_cart_item_qty'];
    

    $SANITIZED_CART_TOTAL = filter_var($CART_TOTAL,FILTER_SANITIZE_NUMBER_FLOAT,FILTER_FLAG_ALLOW_FRACTION);

    if($ORDER_DELIVERY_STATUS == "PickUp") //IF order is pickup
    {
        $sqlInsertToOrdersTable = "INSERT INTO orders(ordernumber, client_id, order_date, payment_id, totalamt, order_status, installation_status, fab_status, payment_status)
        VALUES(
            '$CURRENT_OR',
            '$CLIENT_ID', 
            Now(),  
            '$PAYMENT_ID', 
            '$SANITIZED_CART_TOTAL',
            '$ORDER_DELIVERY_STATUS',
            '$INSTALL_STATUS',
            '$FAB_STATUS',
            '$PAYMENT_STATUS');";
        $resultofInsertToOrders = mysqli_query($dbc,$sqlInsertToOrdersTable);  // Insert To Orders
        if($PAYMENT_STATUS == "Unpaid") // Adds Unpaid amount to Client Tabol
        {
            $SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE = "UPDATE clients
            SET clients.total_unpaid  = (total_unpaid + '$SANITIZED_CART_TOTAL')
            WHERE client_id ='$CLIENT_ID';";
            $RESULT_UNPAID_TOTAL=mysqli_query($dbc,$SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE);
                if(!$RESULT_UNPAID_TOTAL) 
                {
                    die('Error: ' . mysqli_error($dbc));
                } 
            $CURRENT_TOTAL = $SANITIZED_CART_TOTAL - $DOWNPAYMENT;
            $SQL_INSERT_TO_UNPAID_TABLE = "INSERT INTO unpaid_clients(clientID, ordernumber, init_unpaid, totalunpaid) 
            VALUES('$CLIENT_ID', '$CURRENT_OR', '$SANITIZED_CART_TOTAL','$CURRENT_TOTAL');"; 
            $RESULT_INSERT_TO_UNPAID_TABLE=mysqli_query($dbc,$SQL_INSERT_TO_UNPAID_TABLE); //Inserts to UNPAID Client Table for reference
            
            if(!$RESULT_INSERT_TO_UNPAID_TABLE) 
            {
                die('Error: ' . mysqli_error($dbc));
                echo "Error in Insert Unpaid";
            } 
            else 
            {
                $GET_UNPAID_TABLE = "SELECT * FROM unpaid_clients WHERE ordernumber ='$CURRENT_OR'";
                $RESULT_GET_UNPAID_TABLE=mysqli_query($dbc,$GET_UNPAID_TABLE);
                $ROW_RESULT_GET_UNPAID_TABLE = mysqli_fetch_assoc($RESULT_GET_UNPAID_TABLE); 
                
                $UNPAID_ID = $ROW_RESULT_GET_UNPAID_TABLE['unpaidID'];
                
                $INSERT_TO_AUDIT="INSERT INTO unpaidaudit(unpaidID, payment_amount, payment_date)
                VALUES('$UNPAID_ID','$DOWNPAYMENT', now())";
                $RESULT_INSERT_TO_AUDIT=mysqli_query($dbc,$INSERT_TO_AUDIT); 
            }
          
            

                                                                   
        }//END IF PAYMENT = UNPAID

        $ITEM_NAME = array();
            $ITEM_PRICE = array();
            $DELIVERY_STATUS =  $ORDER_DELIVERY_STATUS;
            
            
            foreach($CART_ITEM_ID as $i=>$ITEM_ID)
            {
                $sqlGetFromItemTrading = "SELECT * FROM items_trading WHERE item_id = '$ITEM_ID';";
                $resultofInsertToOrderDetails = mysqli_query($dbc,$sqlGetFromItemTrading);
                while($rowOfSelect=mysqli_fetch_array($resultofInsertToOrderDetails,MYSQLI_ASSOC))
                {
                    $ITEM_NAME[] = $rowOfSelect['item_name'];
                    $ITEM_PRICE[] = $rowOfSelect['price'];                                        
                }

                $sqlInsertToOrderDetails = "INSERT INTO order_details(ordernumber, client_id, item_id, item_name, item_price, item_qty, item_status)
                VALUES(
                    '$CURRENT_OR',
                    '$CLIENT_ID',
                    '$ITEM_ID',
                    '$ITEM_NAME[$i]',
                    '$ITEM_PRICE[$i]',
                    '$CART_ITEM_QTY[$i]',
                    '$DELIVERY_STATUS');";
                $resultofInsertToOrderDetails = mysqli_query($dbc,$sqlInsertToOrderDetails); //Insert To Order DEtails
                
                
                $sqlToSubtractFromItemsTrading = "UPDATE items_trading
                SET items_trading.item_count  = (item_count - '$CART_ITEM_QTY[$i]'),
                last_update = Now() 
                WHERE item_id ='$ITEM_ID';";
                    $resultOfSubtract=mysqli_query($dbc,$sqlToSubtractFromItemsTrading); //Subtracts From Inventory
                    if(!$resultOfSubtract) 
                    {
                        die('Error: ' . mysqli_error($dbc));
                    } 
                    else 
                    {
                        echo '<script language="javascript">';
                        echo 'alert("Subtract Successfull");';
                        echo '</script>';
                        header("Location: ViewOrders.php");
                    }                                                                      
                }//End For


    }//END IF PICKUP

    //<--------------------------------------------------------[ CHECKER ]--------------------------------------------------------------------------------------->
    echo $CLIENT_ID. "\n";
    echo $PAYMENT_ID. "\n";
    echo "Cart Total: ". $SANITIZED_CART_TOTAL. "\n";
    echo "Currrent OR: ".$CURRENT_OR. "\n";
    echo "Downpayment: ".$DOWNPAYMENT. "\n";
    echo $EXPECTED_DATE. "\n";
    echo $ORDER_DELIVERY_STATUS. "\n";
    echo $FAB_STATUS. "\n";
    echo $PAYMENT_STATUS. "\n";

    foreach($CART_ITEM_ID as $INDEX=>$ITEM_ID)
    {
        echo "Cart ITEM ID: ". $ITEM_ID. "\n";
        echo "Cart ITEM QTY: ". $CART_ITEM_QTY[$INDEX]. "\n";
    }


?>