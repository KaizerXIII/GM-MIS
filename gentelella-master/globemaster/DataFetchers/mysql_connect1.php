<?php
$dbc=mysqli_connect('localhost','root','1234','depotdb');


if (!$dbc) {
 die('Could not connect: '.mysql_error());
}

?>