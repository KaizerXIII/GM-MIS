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
        // $sqlInsertToOrdersTable = "INSERT INTO orders(ordernumber, client_id, order_date, payment_id, totalamt, order_status, installation_status, fab_status, payment_status)
        // VALUES(
        //     '$CURRENT_OR',
        //     '$CLIENT_ID', 
        //     Now(),  
        //     '$PAYMENT_ID', 
        //     '$SANITIZED_CART_TOTAL',
        //     '$ORDER_DELIVERY_STATUS',
        //     '$INSTALL_STATUS',
        //     '$FAB_STATUS',
        //     '$PAYMENT_STATUS');";
        // $resultofInsertToOrders = mysqli_query($dbc,$sqlInsertToOrdersTable);  // Insert To Orders
        // if($PAYMENT_STATUS == "Unpaid") // Adds Unpaid amount to Client Tabol
        // {
        //     $SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE = "UPDATE clients
        //     SET clients.total_unpaid  = (total_unpaid + '$SANITIZED_CART_TOTAL')
        //     WHERE client_id ='$CLIENT_ID';";
        //     $RESULT_UNPAID_TOTAL=mysqli_query($dbc,$SQL_INSERT_UNPAID_AMOUNT_TO_CLIENT_TABLE);
        //         if(!$RESULT_UNPAID_TOTAL) 
        //         {
        //             die('Error: ' . mysqli_error($dbc));
        //         } 
        //     $CURRENT_TOTAL = $SANITIZED_CART_TOTAL - $DOWNPAYMENT;
        //     $SQL_INSERT_TO_UNPAID_TABLE = "INSERT INTO unpaid_clients(clientID, ordernumber, init_unpaid, totalunpaid) 
        //     VALUES('$CLIENT_ID', '$CURRENT_OR', '$SANITIZED_CART_TOTAL','$CURRENT_TOTAL');"; 
        //     $RESULT_INSERT_TO_UNPAID_TABLE=mysqli_query($dbc,$SQL_INSERT_TO_UNPAID_TABLE); //Inserts to UNPAID Client Table for reference
            
        //     if(!$RESULT_INSERT_TO_UNPAID_TABLE) 
        //     {
        //         die('Error: ' . mysqli_error($dbc));
        //         echo "Error in Insert Unpaid";
        //     } 
        //     else 
        //     {
        //         $GET_UNPAID_TABLE = "SELECT * FROM unpaid_clients WHERE ordernumber ='$CURRENT_OR'";
        //         $RESULT_GET_UNPAID_TABLE=mysqli_query($dbc,$GET_UNPAID_TABLE);
        //         $ROW_RESULT_GET_UNPAID_TABLE = mysqli_fetch_assoc($RESULT_GET_UNPAID_TABLE); 
                
        //         $UNPAID_ID = $ROW_RESULT_GET_UNPAID_TABLE['unpaidID'];
                
        //         $INSERT_TO_AUDIT="INSERT INTO unpaidaudit(unpaidID, payment_amount, payment_date)
        //         VALUES('$UNPAID_ID','$DOWNPAYMENT', now())";
        //         $RESULT_INSERT_TO_AUDIT=mysqli_query($dbc,$INSERT_TO_AUDIT); 
        //     }                                                                 
        // }//END IF PAYMENT = UNPAID

        $ITEM_NAME = array();
        $ITEM_PRICE = array();
        $DELIVERY_STATUS =  $ORDER_DELIVERY_STATUS;
        $CURRENT_ITEMS_IN = array();
        $CURRENT_ITEMS_OUT = array();
        $CURRENT_ITEM_WAREHOUSE = array();
        
        foreach($CART_ITEM_ID as $i=>$ITEM_ID)
        {
            $sqlGetFromItemTrading = "SELECT * FROM items_trading WHERE item_id = '$ITEM_ID'";
            $resultofInsertToOrderDetails = mysqli_query($dbc,$sqlGetFromItemTrading);
            while($rowOfSelect=mysqli_fetch_array($resultofInsertToOrderDetails,MYSQLI_ASSOC))
            {
                $ITEM_NAME[] = $rowOfSelect['item_name'];
                $ITEM_PRICE[] = $rowOfSelect['price'];   
                $CURRENT_ITEMS_IN[] = $rowOfSelect['item_inside_warehouse'];  
                $CURRENT_ITEMS_OUT[] = $rowOfSelect['item_outside_warehouse'];  
                $CURRENT_ITEM_WAREHOUSE[] = $rowOfSelect['warehouse_id'];                                    
            }

            // $sqlInsertToOrderDetails = "INSERT INTO order_details(ordernumber, client_id, item_id, item_name, item_price, item_qty, item_status)
            // VALUES(
            //     '$CURRENT_OR',
            //     '$CLIENT_ID',
            //     '$ITEM_ID',
            //     '$ITEM_NAME[$i]',
            //     '$ITEM_PRICE[$i]',
            //     '$CART_ITEM_QTY[$i]',
            //     '$DELIVERY_STATUS');";
            // $resultofInsertToOrderDetails = mysqli_query($dbc,$sqlInsertToOrderDetails); //Insert To Order DEtails

            $GET_WAREHOUSE_CAP = "SELECT * FROM warehouses WHERE warehouse_id = '$CURRENT_ITEM_WAREHOUSE[$i]'"; //Gets the warehouse
            $RESULT_WAREHOUSE_CAP = mysqli_query($dbc,$GET_WAREHOUSE_CAP);
            $ROW_RESULT_WAREHOUSE_CAP = mysqli_fetch_assoc($RESULT_WAREHOUSE_CAP);
            
            $WAREHOUSE_INSIDE_CAP = $ROW_RESULT_WAREHOUSE_CAP['in_capacity'];
            $CURRENT_IN_WAREHOUSE = $ROW_RESULT_WAREHOUSE_CAP['current_in_capacity'];
            
            if( $CART_ITEM_QTY[$i]  > $CURRENT_ITEMS_IN[$i])
            {
                $GET_OUTSIDE_ITEMS = abs($CURRENT_ITEMS_IN[$i] - $CART_ITEM_QTY[$i]);

                $sqlToSubtractFromItemsTrading = "UPDATE items_trading
                SET items_trading.item_count  = (item_count - '$CART_ITEM_QTY[$i]'),
                item_inside_warehouse = (item_inside_warehouse - '$CURRENT_ITEMS_IN[$i]'),
                item_outside_warehouse = (item_outside_warehouse - '$GET_OUTSIDE_ITEMS'),
                last_update = Now() 
                WHERE item_id ='$ITEM_ID';";
                $resultOfSubtract=mysqli_query($dbc,$sqlToSubtractFromItemsTrading); //Subtracts From Inventory
                if(!$resultOfSubtract) 
                {
                    die('Error: ' . mysqli_error($dbc));
                }
                else
                {
                    echo "Success in Update trading";
                }

                $SQL_UPDATE_WAREHOUSE_OUT= "UPDATE warehouses
                SET current_in_capacity = (current_in_capacity - '$CURRENT_ITEMS_IN[$i]'),
                out_capacity = (out_capacity -'$GET_OUTSIDE_ITEMS')
                WHERE warehouse_id = ' $CURRENT_ITEM_WAREHOUSE[$i]'";
                $RESULT_UPDATE_WAREHOUSE_OUT = mysqli_query($dbc,$SQL_UPDATE_WAREHOUSE_OUT); //UPDATES the OUT of warehouse after ordering
                
                $SQL_GET_HIGHEST = "SELECT *,IF (item_outside_warehouse > '0','True','False') as FLAG
                FROM mydb.items_trading
                WHERE warehouse_id = '$CURRENT_ITEM_WAREHOUSE[$i]'
                HAVING FLAG = 'True'
                ORDER BY price
                DESC
                LIMIT 1"; //Gets the highest price of items that will be pushed;
                $RESULT_GET_HIGHEST = mysqli_query($dbc,$SQL_GET_HIGHEST);
                $ROW_RESULT_GET_HIGHEST = mysqli_fetch_assoc($RESULT_GET_HIGHEST);

                $HIGHEST_ITEM_ID = $ROW_RESULT_GET_HIGHEST['item_id'];
                $HIGHEST_ITEM_OUTSIDE_COUNT = $ROW_RESULT_GET_HIGHEST['item_outside_warehouse'];
                $HIGHEST_ITEM_WAREHOUSE_ID = $ROW_RESULT_GET_HIGHEST['warehouse_id'];

                if( ($CURRENT_IN_WAREHOUSE + $HIGHEST_ITEM_OUTSIDE_COUNT) > $WAREHOUSE_INSIDE_CAP)
                {
                    $SUBTRACTED_VALUE_GOING_INSIDE = abs($CURRENT_IN_WAREHOUSE - $HIGHEST_ITEM_OUTSIDE_COUNT);

                    $PUSH_ITEMS_INSIDE_WAREHOUSE = "UPDATE items_trading
                    SET item_inside_warehouse = (item_inside_warehouse + '$SUBTRACTED_VALUE_GOING_INSIDE'),
                    item_outside_warehouse = (item_outside_warehouse - ' $SUBTRACTED_VALUE_GOING_INSIDE'),
                    last_update = Now()
                    WHERE item_id ='$HIGHEST_ITEM_ID';";
                    $RESULT_PUSH_ITEMS = mysqli_query($dbc,$PUSH_ITEMS_INSIDE_WAREHOUSE);

                    $SQL_UPDATE_WAREHOUSE_OUT= "UPDATE warehouses
                    SET current_in_capacity = (current_in_capacity + '$SUBTRACTED_VALUE_GOING_INSIDE'),
                    out_capacity = (out_capacity -'$SUBTRACTED_VALUE_GOING_INSIDE')
                    WHERE warehouse_id = ' $HIGHEST_ITEM_WAREHOUSE_ID'";
                    $RESULT_UPDATE_WAREHOUSE_OUT = mysqli_query($dbc,$SQL_UPDATE_WAREHOUSE_OUT); //UPDATES the OUT of warehouse after PUSH
                }
                else
                {
                    $PUSH_ITEMS_INSIDE_WAREHOUSE = "UPDATE items_trading
                    SET item_inside_warehouse = (item_inside_warehouse + '$HIGHEST_ITEM_OUTSIDE_COUNT'),
                    item_outside_warehouse = (item_outside_warehouse - ' $HIGHEST_ITEM_OUTSIDE_COUNT'),
                    last_update = Now()
                    WHERE item_id ='$HIGHEST_ITEM_ID';";
                    $RESULT_PUSH_ITEMS = mysqli_query($dbc,$PUSH_ITEMS_INSIDE_WAREHOUSE);

                    $SQL_UPDATE_WAREHOUSE_IN= "UPDATE warehouses
                    SET current_in_capacity = (current_in_capacity - '$HIGHEST_ITEM_OUTSIDE_COUNT')
                    WHERE warehouse_id = '$HIGHEST_ITEM_WAREHOUSE_ID'";
                    $RESULT_UPDATE_WAREHOUSE_IN = mysqli_query($dbc,$SQL_UPDATE_WAREHOUSE_IN); //UPDATES the IN of warehouse
                }
                
                

            }
            else
            {
               

                $sqlToSubtractFromItemsTrading = "UPDATE items_trading
                SET items_trading.item_count  = (item_count - '$CART_ITEM_QTY[$i]'),
                item_inside_warehouse = (item_inside_warehouse - '$CART_ITEM_QTY[$i]'),
                last_update = Now() 
                WHERE item_id ='$ITEM_ID';";
                $resultOfSubtract=mysqli_query($dbc,$sqlToSubtractFromItemsTrading); //Subtracts From Inventory
                if(!$resultOfSubtract) 
                {
                    die('Error: ' . mysqli_error($dbc));
                }
                else
                {
                    echo "Success in Update trading \n";
                }
                
                $SQL_UPDATE_WAREHOUSE_IN= "UPDATE warehouses
                SET current_in_capacity = (current_in_capacity - '$CART_ITEM_QTY[$i]')
                WHERE warehouse_id = '$CURRENT_ITEM_WAREHOUSE[$i]'";
                $RESULT_UPDATE_WAREHOUSE_IN = mysqli_query($dbc,$SQL_UPDATE_WAREHOUSE_IN); //UPDATES the IN of warehouse

                $SQL_GET_HIGHEST = "SELECT *,IF (item_outside_warehouse > '0','True','False') as FLAG
                FROM mydb.items_trading
                WHERE warehouse_id = '$CURRENT_ITEM_WAREHOUSE[$i]'
                HAVING FLAG = 'True'
                ORDER BY price
                DESC
                LIMIT 1"; //Gets the highest price of items that will be pushed;
                $RESULT_GET_HIGHEST = mysqli_query($dbc,$SQL_GET_HIGHEST);
                $ROW_RESULT_GET_HIGHEST = mysqli_fetch_assoc($RESULT_GET_HIGHEST);

                $HIGHEST_ITEM_ID = $ROW_RESULT_GET_HIGHEST['item_id'];
                $HIGHEST_ITEM_OUTSIDE_COUNT = $ROW_RESULT_GET_HIGHEST['item_outside_warehouse'];
                $HIGHEST_ITEM_WAREHOUSE_ID = $ROW_RESULT_GET_HIGHEST['warehouse_id'];

                if( ($CURRENT_IN_WAREHOUSE + $HIGHEST_ITEM_OUTSIDE_COUNT) > $WAREHOUSE_INSIDE_CAP)
                {
                    $SUBTRACTED_VALUE_GOING_INSIDE = $WAREHOUSE_INSIDE_CAP - $CURRENT_IN_WAREHOUSE;
                    echo $SUBTRACTED_VALUE_GOING_INSIDE ;

                    $PUSH_ITEMS_INSIDE_WAREHOUSE = "UPDATE items_trading
                    SET item_inside_warehouse = (item_inside_warehouse + '$SUBTRACTED_VALUE_GOING_INSIDE'),
                    item_outside_warehouse = (item_outside_warehouse - ' $SUBTRACTED_VALUE_GOING_INSIDE'),
                    last_update = Now()
                    WHERE item_id ='$HIGHEST_ITEM_ID';";
                    $RESULT_PUSH_ITEMS = mysqli_query($dbc,$PUSH_ITEMS_INSIDE_WAREHOUSE);

                    $SQL_UPDATE_WAREHOUSE_OUT= "UPDATE warehouses
                    SET current_in_capacity = (current_in_capacity + '$SUBTRACTED_VALUE_GOING_INSIDE'),
                    out_capacity = (out_capacity -'$SUBTRACTED_VALUE_GOING_INSIDE')
                    WHERE warehouse_id = ' $HIGHEST_ITEM_WAREHOUSE_ID'";
                    $RESULT_UPDATE_WAREHOUSE_OUT = mysqli_query($dbc,$SQL_UPDATE_WAREHOUSE_OUT); //UPDATES the OUT of warehouse after PUSH
                }
                else
                {
                    $PUSH_ITEMS_INSIDE_WAREHOUSE = "UPDATE items_trading
                    SET item_inside_warehouse = (item_inside_warehouse + '$HIGHEST_ITEM_OUTSIDE_COUNT'),
                    item_outside_warehouse = (item_outside_warehouse - ' $HIGHEST_ITEM_OUTSIDE_COUNT'),
                    last_update = Now()
                    WHERE item_id ='$HIGHEST_ITEM_ID';";
                    $RESULT_PUSH_ITEMS = mysqli_query($dbc,$PUSH_ITEMS_INSIDE_WAREHOUSE);

                    $SQL_UPDATE_WAREHOUSE_IN= "UPDATE warehouses
                    SET current_in_capacity = (current_in_capacity - '$HIGHEST_ITEM_OUTSIDE_COUNT')
                    WHERE warehouse_id = '$HIGHEST_ITEM_WAREHOUSE_ID'";
                    $RESULT_UPDATE_WAREHOUSE_IN = mysqli_query($dbc,$SQL_UPDATE_WAREHOUSE_IN); //UPDATES the IN of warehouse
                }
            }
           
                                                                    
        }//End Foreach


    }//END IF PICKUP

    else if($_SESSION['DeliveryStatus'] == "Deliver") //IF ORder is Deliver
    {            
        $sqlInsertToOrdersTable = "INSERT INTO orders(ordernumber, client_id, order_date, expected_date, payment_id, totalamt, order_status, installation_status, fab_status, payment_status)
        VALUES(
            '$CURRENT_OR',
            '$CLIENT_ID', 
            Now(),
            '$EXPECTED_DATE',  
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
            $sqlGetFromItemTrading = "SELECT * FROM items_trading WHERE item_id = '$ITEM_ID'";
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
            last_update = Now(), 
            WHERE item_id ='$ITEM_ID';";
                $resultOfSubtract=mysqli_query($dbc,$sqlToSubtractFromItemsTrading); //Subtracts From Inventory
                if(!$resultOfSubtract) 
                {
                    die('Error: ' . mysqli_error($dbc));
                } 
                                                                    
        }//End For

    }//END ELSE IF DELIVER

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