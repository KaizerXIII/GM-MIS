<?php
    session_start();
    require_once('mysql_connect.php');

    $_SESSION['supply_item_id'] = $_POST['post_item_id'];
    $_SESSION['supply_item_qty'] = $_POST['post_item_qty'];
    $_SESSION['supplier_name'] = $_POST['post_supplier_id'];

    $TOTALQTY = array_sum($_SESSION["supply_item_qty"]);
    

    //Gets the Supplier Name based on the ID
    // for($j = 0; $j < count($_SESSION['supplier_id']); $j++ )
    // {
        
    //     $SUPPLIER_ID = $_SESSION['supplier_id'][$j];

    //     $SQL_GET_SUPPLIER_NAME = "SELECT * FROM suppliers WHERE supplier_id = '$SUPPLIER_ID'";
    //     $RESULT_GET_SUPPLIER_NAME =mysqli_query($dbc,$SQL_GET_SUPPLIER_NAME); 
    //     $ROW_RESULT_SUPPLIER_NAME = mysqli_fetch_assoc($RESULT_GET_SUPPLIER_NAME);

    //     $GET_SUPPLIER_NAME= $ROW_RESULT_SUPPLIER_NAME['supplier_name'];

        
    // } 

    //Inserts first to Supply Order Table
    $SQL_INSERT_TO_SUPPLIER_ORDER_TABLE = "INSERT into supply_order (supply_order_date, supply_order_expdate, supply_order_total_quantity, supply_order_status) 
    VALUES 
    (
        now(), 
        now() + INTERVAL 14 DAY,
        '$TOTALQTY',
        'Purchased' 
    );";
    $RESULT_INSERT_SUPPLY_ORDER_TABLE =mysqli_query($dbc,$SQL_INSERT_TO_SUPPLIER_ORDER_TABLE); 


    //Gets the Current SO from Supply table
    $SELECT_CURRENT_SO = "SELECT max(supply_order_id) as CURRENT_SO FROM supply_order";
    $RESULT_SELECT_CURRRENT_SO = mysqli_query($dbc,$SELECT_CURRENT_SO);
    $ROW_RESULT = mysqli_fetch_assoc($RESULT_SELECT_CURRRENT_SO);
    $CURRENT_SO = $ROW_RESULT['CURRENT_SO'];

    //Inserts to the Supply details whichs contains the individual items and their quantity
    $counter = 0;
    for($i = 0; $i < count($_SESSION['supply_item_id']) ; $i++) //Loops through the array of ID
    {
        $CURRENT_ID = $_SESSION['supply_item_id'][$i];
        $CURRENT_ITEM_QTY = $_SESSION['supply_item_qty'][$i];
        $CURRENT_SUPPLIER_NAME = $_SESSION['supplier_name'][$i];

        $SQL_FIND_ITEM = "SELECT * FROM items_trading WHERE item_id ='$CURRENT_ID' ;"; //Searches for the Item name based on the ID
        $RESULT_FIND_ITEM =  mysqli_query($dbc,$SQL_FIND_ITEM);
        $ROW_RESULT_FIND_ITEM = mysqli_fetch_assoc($RESULT_FIND_ITEM);
        $CURRENT_ITEM_NAME = $ROW_RESULT_FIND_ITEM['item_name'];


        //Inserts to Supply Order Details
        $SQL_INSERT_TO_SUPPLY_DETAILS = "INSERT INTO supply_order_details (supply_order_id, supply_item_name, supply_item_quantity, supplier_name) 
        VALUES ('$CURRENT_SO', '$CURRENT_ITEM_NAME', '$CURRENT_ITEM_QTY','$CURRENT_SUPPLIER_NAME');";
        $RESULT_INSERT_TO_DETAILS =  mysqli_query($dbc,$SQL_INSERT_TO_SUPPLY_DETAILS);

        echo "Value of ID Array = ", $CURRENT_ID,"\n";
        echo "Value of QTY Array = ",$CURRENT_ITEM_QTY,"\n";
        echo "Current item Name = ",$CURRENT_ITEM_NAME,"\n";
        echo "\n";
        //Checker
       
    }

    if(!$RESULT_INSERT_SUPPLY_ORDER_TABLE) 
    {
        die('Error: ' . mysqli_error($dbc));
    } 
    else 
    {
      echo "Items Purchased From Supplier!";
    }


   //-------------------------------Checker at This Part---------------------------------------------------
    echo "Item ID at [1] = ", $_SESSION['supply_item_id'][1] ,"\n";
    echo "Total Quantity of item @ [1] = " ,$_SESSION['supply_item_qty'][1] ,"\n";
    echo "Supplier ID @ [1] = " ,$_SESSION['supplier_id'][0] ,"\n";
    echo "Total QTY of ALL items in Array = ", $TOTALQTY;


?>