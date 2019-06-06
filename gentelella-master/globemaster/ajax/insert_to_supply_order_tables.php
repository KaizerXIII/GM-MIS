<?php
    session_start();

    $_SESSION['order_form_item_id'] = $_POST['post_item_id'];
    $_SESSION['order_form_item_qty'] = $_POST['post_item_qty'];
    // echo $_POST['deltype'];
    echo $_SESSION['order_form_item_id'][0];
    echo $_SESSION['order_form_item_qty'][0];


?>