<?php
    session_start();
    require_once('mysql_connect.php');
  
if($_POST['post_status']== "approved")
{
    $GET_ITEMS_SKU = $_POST['post_item_sku'];
    $GET_ITEMS_QTY = $_POST['post_item_qty'];  
    $GET_DEPOT_REF = $_POST['post_depot_reference'];
    $GET_DEPOT_OR = $_POST['post_depot_or'];

    $SQL_UPDATE_DEPOT_REQUEST_STATUS = "UPDATE depot_request
    SET depot_request_status = 'Requisition Approved'
    WHERE depot_request_id = '$GET_DEPOT_OR';";
    $RESULT_UPDATE_STATUS = mysqli_query($dbc,$SQL_UPDATE_DEPOT_REQUEST_STATUS);

    for($i = 0; $i < sizeof($GET_ITEMS_SKU);$i++ )
    {    
                
        $SQL_UPDATE_ITEMS_TRADING = "UPDATE mydb.items_trading
        SET item_count = (item_count - '$GET_ITEMS_QTY[$i]'),
        last_update = now()
        WHERE sku_id = '$GET_ITEMS_SKU[$i]';";
        $RESULT_UPDATE_ITEMS_TRADING = mysqli_query($dbc,$SQL_UPDATE_ITEMS_TRADING);
        if(!$RESULT_UPDATE_ITEMS_TRADING)
        {
            echo "SOmething went wrong in Update Items Trading";
        }

        $SQL_UPDATE_DEPOT = "UPDATE depotdb.gm_products
        JOIN depotdb.gm_inventorystocks
        ON gm_inventorystocks.ProductID = gm_products.ProductID
        SET StockOnHand = (StockOnHand + '$GET_ITEMS_QTY[$i]'),
        LastModified = now()
        WHERE UnitName = '$GET_DEPOT_REF[$i]'";
        $RESULT_UPDATE_DEPOT = mysqli_query($dbc,$SQL_UPDATE_DEPOT);
        if(!$RESULT_UPDATE_DEPOT)
        {
            echo "SOmething went wrong in Update Depot Items";
        }   
    }
}
else
{
    $GET_DEPOT_OR = $_POST['post_depot_or'];
    
    $SQL_UPDATE_DEPOT_REQUEST_STATUS = "UPDATE depot_request
    SET depot_request_status = 'Requisition Disapproved'
    WHERE depot_request_id = '$GET_DEPOT_OR';";
    $RESULT_UPDATE_STATUS = mysqli_query($dbc,$SQL_UPDATE_DEPOT_REQUEST_STATUS);

}
   

   


?>