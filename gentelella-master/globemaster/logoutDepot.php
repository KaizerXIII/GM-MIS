<?php
    session_start();
    unset($_SESSION);
    session_destroy();
    session_write_close();
    header("Location: http://".$_SERVER['HTTP_HOST'].
        dirname($_SERVER['PHP_SELF'])."/loginDepot.php");
    die;
?>