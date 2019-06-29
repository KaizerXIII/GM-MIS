<?php
    session_start();

    $_SESSION['get_client_id_from_customer_menu'] = $_POST['post_client_id'];

    echo "Current Client ID = ".$_SESSION['get_client_id_from_customer_menu'] ;


?>