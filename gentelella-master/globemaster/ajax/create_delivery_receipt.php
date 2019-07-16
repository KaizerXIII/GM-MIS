<?php
    session_start();
    require_once('mysql_connect.php');

    $deliveryReceipt;
    $DELIVERY_STATUS;

    $ACTUAL_DELIVERY_DATE = $_POST['post_delivery_date'];
    $EXPECTED_DATE_FROM_HTML = $_POST['post_expected_date'];

    $SQL_FORMATTED_DATE = date('Y-m-d', strtotime($ACTUAL_DELIVERY_DATE));
    
    $driverFromHTML = $_POST['post_driver_name'];
    $truckPlateFromHTML = $_POST['post_truck_plate'];
    $customerNameFromHTML = $_POST['post_customer_name'];
    $destinationFromHTML = $_POST['post_destination'];

    $SelectOrderNumber = $_POST['post_selected_or'];

    $GET_TOTAL_WEIGHT =  preg_replace('~\D~', '',$_POST['post_order_weight']); //Removes the KG
    $GET_TRUCK_CAP = preg_replace('~\D~', '',$_POST['post_truck_cap']);
  
    echo $ACTUAL_DELIVERY_DATE."\n";
    echo $EXPECTED_DATE_FROM_HTML."\n";
    echo $driverFromHTML."\n";
    echo $truckPlateFromHTML."\n";
    echo $customerNameFromHTML."\n";
    echo $destinationFromHTML."\n";
    echo $SelectOrderNumber."\n";
    echo $GET_TOTAL_WEIGHT."\n";
    echo $GET_TRUCK_CAP."\n";
    echo $GET_TRUCK_CAP - $GET_TOTAL_WEIGHT."\n";

    $query = "SELECT count(delivery_Receipt) as Count, delivery_status FROM scheduledelivery;";
    $resultofQuery = mysqli_query($dbc, $query);
    while($rowofResult=mysqli_fetch_array($resultofQuery,MYSQLI_ASSOC))
    {
        $deliveryReceipt = "DR - ".($rowofResult['Count'] + 1); //Get The Delivery Receipt
        $DELIVERY_STATUS = $rowofResult['delivery_status'];
    };

    if(strtotime($ACTUAL_DELIVERY_DATE) < strtotime($EXPECTED_DATE_FROM_HTML) )
    {
        $DELIVER_STATUS = "Order In Progress";
        echo "Order In Progress?";
    }
    
    else
    {
        $DELIVER_STATUS = "Late Delivery";
        
        echo "Late Delivery \n";
    }
    echo "Current DR: ".$deliveryReceipt."\n";
    $SQL_CHK_BULK_TABLE = "SELECT * FROM bulk_order WHERE bulk_order_date = '$SQL_FORMATTED_DATE' AND truck_assigned ='$truckPlateFromHTML';"; 
    $RESULT_CHK_BULK_TABLE =  mysqli_query($dbc,$SQL_CHK_BULK_TABLE);
    
    if(mysqli_num_rows($RESULT_CHK_BULK_TABLE)==0) //CHecks Bulk Orders if Date = The set deliv date
    {
        $CURRENT_CAP = $GET_TRUCK_CAP - $GET_TOTAL_WEIGHT;
        $INSERT_TO_BULK_ORDER = "INSERT INTO bulk_order(
        truck_assigned,
        current_truck_cap,
        bulk_order_status,
        bulk_order_date)               
        VALUES(
            '$truckPlateFromHTML',
            '$CURRENT_CAP',
            'Delivery in Progress',
            '$SQL_FORMATTED_DATE'
        );";
        $RESULT_INSERT_TO_BULK = mysqli_query($dbc,$INSERT_TO_BULK_ORDER);
        
        $GET_BO_NUM = "SELECT max(bulk_order_id) as BULK_ORDER_ID FROM bulk_order"; //Gets the latest inserted Bulk Order ID 
        $RESULT_GET_BO = mysqli_query($dbc,$GET_BO_NUM);
        $ROW_GET_BO = mysqli_fetch_assoc($RESULT_GET_BO);
        $CURRENT_BO_ID = $ROW_GET_BO['BULK_ORDER_ID'];

        $INSERT_TO_BULK_DETAILS = "INSERT INTO bulk_order_details(
            reference_bulk_or,
            bulk_order_details_dr,
            dr_weight, 
            dr_status,time_in,time_out)          
            VALUES(
            '$CURRENT_BO_ID',
            '$deliveryReceipt',
            '$GET_TOTAL_WEIGHT',
            '$DELIVERY_STATUS',null,null)";
        $RESULT_INSERT_BULK_DETAILS =  mysqli_query($dbc,$INSERT_TO_BULK_DETAILS);
        if(!$RESULT_INSERT_BULK_DETAILS)
        {
            echo "Insert: Error in Details \n";
        }
        
    }
    else
    {
        $ROW_RESULT_CHK_BULK = mysqli_fetch_array($RESULT_CHK_BULK_TABLE,MYSQLI_ASSOC);
        $CURRENT_BULK_ID = $ROW_RESULT_CHK_BULK['bulk_order_id'];

        $SQL_UPDATE_BULK_ORDER = "UPDATE bulk_order SET current_truck_cap = (current_truck_cap - '$GET_TOTAL_WEIGHT') WHERE bulk_order_id = '$CURRENT_BULK_ID'";
        $RESULT_UPDATE_BULK_TABLE =  mysqli_query($dbc,$SQL_UPDATE_BULK_ORDER);

        $INSERT_TO_BULK_DETAILS = "INSERT INTO bulk_order_details(
            reference_bulk_or,
            bulk_order_details_dr,
            dr_weight, 
            dr_status,
            time_in,time_out)            
            VALUES(
            '$CURRENT_BULK_ID',
            '$deliveryReceipt',
            '$GET_TOTAL_WEIGHT',
            '$DELIVERY_STATUS',null,null)";
        $RESULT_INSERT_BULK_DETAILS =  mysqli_query($dbc,$INSERT_TO_BULK_DETAILS);
        if(!$RESULT_INSERT_BULK_DETAILS)
        {
            echo "Update: Error in Details \n";
        }
         
    }              
    

    $INSERT_TO_SCHED_DELIVER_TABLE = "INSERT INTO scheduledelivery(
        
        delivery_Receipt,
        ordernumber,
        delivery_weight,
        delivery_Date,
        driver,
        truck_Number,
        customer_Name,
        Destination,
        delivery_status)
        
        VALUES(
        '$deliveryReceipt',
        '$SelectOrderNumber',
        '$GET_TOTAL_WEIGHT',
        '$SQL_FORMATTED_DATE',
        '$driverFromHTML',
        '$truckPlateFromHTML',
        '$customerNameFromHTML',
        '$destinationFromHTML',
        '$DELIVER_STATUS');"; //Insert Required Element from HTML to DB

    $RESULT_INSERT_TO_SCHED_DELIVERY_TABLE = mysqli_query($dbc,$INSERT_TO_SCHED_DELIVER_TABLE);
    if(!$RESULT_INSERT_TO_SCHED_DELIVERY_TABLE) 
    {
        die('Error: ' . mysqli_error($dbc));
        echo '<script language="javascript">';
        echo 'alert("Error In Insert");';
        echo '</script>';
    } 
    else 
    {
                            
    }

    // $SchedID++; //Add +1 to Primary to Avoid Error on Duplicate key : Stupid kase ayaw gawin Auto incrememt, napaka BOBITO!
    $deliveryReceipt++;

    $UPDATE_ORDERS_TABLE = "UPDATE orders
    SET orders.order_status  = ('$DELIVER_STATUS')                                       
    WHERE ordernumber ='$SelectOrderNumber';";
    $RESULT_ORDER_TABLE = mysqli_query($dbc,$UPDATE_ORDERS_TABLE);
   

 //<-----------------------------------------[ QUERY FOR PRIMARY KEY]---------------------------------------->
    // $queryItemID = "SELECT count(SchedID)+1 as Count FROM scheduledelivery; ";
    // $resultItemID = mysqli_query($dbc,$queryItemID);
    // $rowResultItemID = mysqli_fetch_assoc($resultItemID);
    // $SchedID = $rowResultItemID['Count']; // Get SchedID and Add 1 for DR - | Extra Query Kase ayaw gawin Auto increment , ambobo talaga
    //<-----------------------------------------[ QUERY FOR PRIMARY KEY]---------------------------------------->   
    
    // $orderNumArray = array();
    // $queryOrderDetails = "SELECT * FROM orders
    // join order_details ON orders.ordernumber = order_details.ordernumber 
    // WHERE order_status = 'Deliver'";
    // $resultOrderDetails = mysqli_query($dbc,$queryOrderDetails);
    // while($rowResult = mysqli_fetch_array($resultOrderDetails))
    // {
    //     $orderNumArray[] = $rowResult['ordernumber'];
    // };
?>