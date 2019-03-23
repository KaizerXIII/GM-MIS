<?php
    session_start();
    //<------------------------------------------------------------------------------------------------------>
   require_once('mysql_connect.php');
    $_SESSION['ordernumber_array_from_unpaid_customer_php'] = $_POST['post_order_number'];
    $GET_CLIENT_ID_FROM_MENU = $_POST['post_client_id'];

    $GET_OR_FROM_AJAX_SESSION =  $_SESSION['ordernumber_array_from_unpaid_customer_php'];

    $SQL_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE = "SELECT * FROM unpaid_clients WHERE clientID ='$GET_CLIENT_ID_FROM_MENU' AND ordernumber ='$GET_OR_FROM_AJAX_SESSION'";
    $RESULT_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE = mysqli_query($dbc,$SQL_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE);
    while($ROW_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE = mysqli_fetch_array($RESULT_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE,MYSQLI_ASSOC))
    {       
  
        $GET_INITIAL_UNPAID = number_format($ROW_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE['init_unpaid'], 2);
        $GET_REMAINING_UNPAID = number_format($ROW_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE['totalunpaid'], 2);
    echo '<div class="form-group">';
    echo '  <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Initial Unpaid Amount</label>';
    echo '  <div class="col-md-3 col-sm-3 col-xs-12">';
    echo '      <input type="text" id = "item_price" class="form-control" readonly="readonly" style="text-align:right" value ="₱ '.$GET_INITIAL_UNPAID.'" ';
    echo '       ">';
    echo '   </div>';
    echo '</div>';

    echo ' <div class="form-group">';
    echo '    <label class="control-label col-md-3 col-sm-3 col-xs-12">Remaining Unpaid Amount</label>';
    echo '   <div class="col-md-3 col-sm-3 col-xs-12">';
    echo '        <input type="text" id = "item_price" class="form-control" readonly="readonly" style="text-align:right"  value ="₱ '.$GET_REMAINING_UNPAID.'" ';
    echo '        ">';
    echo '    </div>';
    echo ' </div>';
  
  $_SESSION['SET_MAX_BY_TOTAL_UNPAID'] = $ROW_UNPAID_TOTAL_FROM_UNPAID_CLIENT_TABLE['totalunpaid'];
  }

?>