<?php
    session_start();
    require_once('mysql_connect.php');

    $TRUCK_STATUS = $_POST['post_truck_status'];
    $BULK_ORDER_ID = $_POST['post_bulk_id'];

    date_default_timezone_set('Asia/Manila'); //Sets the timezone to PH
    $NOW = date('Y-m-d H:i:s'); //Gets time now

    if($TRUCK_STATUS == "Deploy")
    {
        $UPDATE_TIME_OUT = "UPDATE bulk_order
        SET time_out = '$NOW'
        WHERE bulk_order_id = '$BULK_ORDER_ID'";
        $RESULT_UPDATE_TIME_OUT = mysqli_query($dbc,$UPDATE_TIME_OUT);

        $GET_BULK_INFO = "SELECT * FROM bulk_order
        JOIN trucktable 
        ON trucktable.truckplate = bulk_order.truck_assigned
        WHERE bulk_order_id = '$BULK_ORDER_ID'";
        $RESULT_UPDATE_AVAILABILITY = mysqli_query($dbc,$GET_BULK_INFO);
        $ROW_RESULT_UPD8_AVAILABILITY = mysqli_fetch_assoc($RESULT_UPDATE_AVAILABILITY);
        $GET_TP = $ROW_RESULT_UPD8_AVAILABILITY['truck_assigned'];

        $UPDATE_TRUCK_STATUS = "UPDATE trucktable
        SET truck_availability = 'Out for Delivery'
        WHERE truckplate = '$GET_TP'";
        $RESULT_UPDATE_AVAILABILITY = mysqli_query($dbc,$UPDATE_TRUCK_STATUS);
        if(!$RESULT_UPDATE_AVAILABILITY)
        {
            echo "Sum Ting Wung";
        }
        else
        {
            echo $NOW;
        }
    }
    else
    {
        $UPDATE_TIME_IN = "UPDATE bulk_order
        SET time_in = '$NOW'
        WHERE bulk_order_id = '$BULK_ORDER_ID'";
        $RESULT_UPDATE_TIME_IN = mysqli_query($dbc,$UPDATE_TIME_IN);

        $GET_BULK_INFO = "SELECT * FROM bulk_order
        JOIN trucktable 
        ON trucktable.truckplate = bulk_order.truck_assigned
        WHERE bulk_order_id = '$BULK_ORDER_ID'";
        $RESULT_UPDATE_AVAILABILITY = mysqli_query($dbc,$GET_BULK_INFO);
        $ROW_RESULT_UPD8_AVAILABILITY = mysqli_fetch_assoc($RESULT_UPDATE_AVAILABILITY);
        $GET_TP = $ROW_RESULT_UPD8_AVAILABILITY['truck_assigned'];

        $UPDATE_TRUCK_STATUS = "UPDATE trucktable
        SET truck_availability = 'Available'
        WHERE truckplate = '$GET_TP'";
        $RESULT_UPDATE_AVAILABILITY = mysqli_query($dbc,$UPDATE_TRUCK_STATUS);
        if(!$RESULT_UPDATE_AVAILABILITY)
        {
            echo "Sum Ting Wung";
        }
        else
        {
            echo $NOW;
        }
    }


?>