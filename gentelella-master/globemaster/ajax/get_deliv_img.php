<?php
    session_start();
    require_once('mysql_connect.php');

    $GET_OR_NUMBER = $_POST['post_or_number'];

    $FAB_DESC;
    $FAB_IMG;

    $RETURN_ARRAY = array();
    $SQL_GET_FAB_DESC = "SELECT * FROM joborderfabrication WHERE order_number = '$GET_OR_NUMBER'";
    $RESULT_GET_FAB_DESC = mysqli_query($dbc,$SQL_GET_FAB_DESC);
    $ROW_RESULT_GET_FAB_DESC = mysqli_fetch_array($RESULT_GET_FAB_DESC,MYSQLI_ASSOC);

    $FAB_DESC =  $ROW_RESULT_GET_FAB_DESC['fab_description'];
    $FAB_IMG = $ROW_RESULT_GET_FAB_DESC['reference_drawing'];

    $RETURN_ARRAY = [$GET_OR_NUMBER, $FAB_DESC,base64_encode($FAB_IMG)];
    echo json_encode($RETURN_ARRAY);
?>