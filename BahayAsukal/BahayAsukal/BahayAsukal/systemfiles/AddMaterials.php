<?php
session_start();
require_once('mysql_connect.php');
$query = "SELECT * FROM user WHERE username = '{$_SESSION['username']}'";
$result=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
$_SESSION['fname'] = $row['first_name'];
$_SESSION['lname'] = $row['last_name'];
$_SESSION['fullname'] = $row['first_name'] . ' ' . $row['last_name'];


if(isset($_POST['add']))
{
    $name = $_POST['materialname'];
    
    $uom = $_POST['uom'];
    
        require_once('mysql_connect.php');
        $query="SELECT materialName from raw_material where materialName= '{$name}'";
        $result=mysqli_query($dbc,$query);
        if ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            echo "<script> alert('Raw Material already exists'); </script>";
        }else{
              $query="INSERT INTO raw_material(materialID, materialName, uom, material_qty)
                VALUES(nextMaterialID(), '$name', '$uom', 0)";
                $result=mysqli_query($dbc,$query);
                echo "<script> alert('Raw Material added'); </script>";
        }
        
}
?>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sugarhouse</title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                
                <?php
                require_once("nav.php");    
                ?>

                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Add Raw Material </h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <br />
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" data-parsley-validate class="form-horizontal form-label-left">

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                <input type="text" id="materialname" required="required" class="form-control col-md-7 col-xs-12" name="materialname" onkeyup="checkMaterialName();">
                                            </div>
                                             <label for="middle-name" id="materialExist" class="control-label red"></label>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Unit of Measurement <span class="required">*</span>
                                            </label>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <input type="text" id="uom" name="uom" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div><br><br>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button id="addrawbtn" class="btn btn-success" name="add" >Add Raw Material</button>
                                                <button class="btn btn-primary" type="reset">Reset Fields</button>
                                                
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /page content -->

            </div>
        </div>

        <script>
            
            function checkMaterialName(){

            let materialname = document.getElementById("materialname").valueOf().value;

            $.ajax({
                type: 'POST',
                url: "ajax/checkMaterial.php",
                data:{
                    materialname: materialname
                },
                success: function(result){
                    if(result == 0)
                        {
                            document.getElementById("materialExist").innerHTML = "Raw Material already exists!";
                            document.getElementById("addrawbtn").disabled = true;
                        }
                    else if(result == 1)
                        {
                            document.getElementById("materialExist").innerHTML = "";
                            document.getElementById("addrawbtn").disabled = false;
                        }
                    else if(result == 2)
                        {
                            document.getElementById("materialExist").innerHTML = "invalid input";
                            document.getElementById("addrawbtn").disabled = true;
                        }
                    else if(result == 3)
                        {
                            document.getElementById("materialExist").innerHTML = "invalid input";
                            document.getElementById("addrawbtn").disabled = true;
                        }
                    //alert(result);
            }});
        }
        
        </script>
        
        <!-- jQuery -->
        <script src="../vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="../vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="../vendors/nprogress/nprogress.js"></script>
        <!-- Chart.js -->
        <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
        <!-- jQuery Sparklines -->
        <script src="../vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
        <!-- Flot -->
        <script src="../vendors/Flot/jquery.flot.js"></script>
        <script src="../vendors/Flot/jquery.flot.pie.js"></script>
        <script src="../vendors/Flot/jquery.flot.time.js"></script>
        <script src="../vendors/Flot/jquery.flot.stack.js"></script>
        <script src="../vendors/Flot/jquery.flot.resize.js"></script>
        <!-- Flot plugins -->
        <script src="../vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
        <script src="../vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
        <script src="../vendors/flot.curvedlines/curvedLines.js"></script>
        <!-- DateJS -->
        <script src="../vendors/DateJS/build/date.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="../vendors/moment/min/moment.min.js"></script>
        <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="../build/js/custom.min.js"></script>
    </body>

    </html>