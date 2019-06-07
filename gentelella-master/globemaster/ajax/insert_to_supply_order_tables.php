<?php
    session_start();
    require_once('mysql_connect.php');

    $_SESSION['supply_item_id'] = $_POST['post_item_id'];
    $_SESSION['supply_item_qty'] = $_POST['post_item_qty'];
    $TOTALQTY = array_sum($_SESSION["supply_item_qty"]);

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
    for($i = 0; $i < count($_SESSION['supply_item_id']) ; $i++)
    {
        $CURRENT_ID = $_SESSION['supply_item_id'][$i];
        $CURRENT_ITEM_QTY = $_SESSION['supply_item_qty'][$i];
        
        

        $SQL_FIND_ITEM = "SELECT * FROM items_trading WHERE item_id ='$CURRENT_ID' ;";
        $RESULT_FIND_ITEM =  mysqli_query($dbc,$SQL_FIND_ITEM);
        $ROW_RESULT_FIND_ITEM = mysqli_fetch_assoc($RESULT_FIND_ITEM);
        $CURRENT_ITEM_NAME = $ROW_RESULT_FIND_ITEM['item_name'];

        $SQL_INSERT_TO_SUPPLY_DETAILS = "INSERT INTO supply_order_details (supply_order_id, supply_item_name, supply_item_quantity)
        VALUES ('$CURRENT_SO', '$CURRENT_ITEM_NAME', '$CURRENT_ITEM_QTY');";
        $RESULT_INSERT_TO_DETAILS =  mysqli_query($dbc,$SQL_INSERT_TO_SUPPLY_DETAILS);

        echo "Value of ID Array = ", $CURRENT_ID,"\n";
        echo "Value of QTY Array = ",$CURRENT_ITEM_QTY,"\n";
        echo "Current item Name = ",$CURRENT_ITEM_NAME,"\n";
        echo "\n";

       
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
    echo "Total QTY of ALL items in Array = ", $TOTALQTY;


?>