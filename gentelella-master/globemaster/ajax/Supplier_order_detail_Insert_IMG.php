<?php
    session_start();
    require_once('mysql_connect.php');
        $supply_order_number = $_POST['supply_order_number'];
        
     //<--------------------------------------------------------[ UPLOADED FILE Checker ]----------------------------------------------------->
                          
    //    echo "Upload: " . $_FILES['file']['name'] . "<br>";
    //    echo "Type: " . $_FILES['file']['type'] . "<br>";
    //    echo "Size: " . ($_FILES['file']['size'] / 1024) . " kB<br>";
    //    echo "Stored in: " . $_FILES['file']['tmp_name'];

       $filename = $_FILES['file']['name'];
       $filetype = $_FILES['file']['type'];
       $filesize = $_FILES['file']['size'];

       $allowed = array("JPG" => "image/JPG", "jpg" => "image/jpg", "jpeg" => "image/jpeg", "JPEG" => "image/JPEG", "png" => "image/png", "PNG" => "image/PNG",); //Checks the File type extension 
       
       $ext = pathinfo($filename, PATHINFO_EXTENSION);

       if(!array_key_exists($ext, $allowed))
       {
         die("Error: Please select a valid file format.");
         echo "Error: Please select a valid file format.";
       }

       $maxsize = 10 * 1024 * 1024;
       if($filesize > $maxsize)
       {
         die("Error: File size is larger than the allowed limit."); //10 MB max 
         echo "Error: File size is larger than the allowed limit.";
       } 

       $blob = addslashes(file_get_contents($_FILES['file']['tmp_name']));  
       $SQL_UPDATE_IMG = "UPDATE supply_order SET arrival_reference = '$blob' WHERE supply_order_id = '$supply_order_number'";
       $RESULT_INSERT_IMG = mysqli_query($dbc,$SQL_UPDATE_IMG); 
       if(!$RESULT_INSERT_IMG) 
       {
           die('Error: ' . mysqli_error($dbc));
       } 
       else 
       {
           echo '<script language="javascript">';
           echo 'alert("Image Uploaded!");';
           echo '</script>';
       }                                            
   //<--------------------------------------------------------[ UPLOADED FILE Checker ]----------------------------------------------------->

?>