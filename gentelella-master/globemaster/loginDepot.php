<?php
session_start();
require_once('DataFetchers/mysql_connect1.php');
// session_destroy();
if(isset($_POST['login']))
{
    $_SESSION['username'] = $_POST['loginuser'];
    $_SESSION['password'] = $_POST['loginpass'];
    require_once('DataFetchers/mysql_connect1.php');
    $checkuser = "SELECT * FROM gm_users WHERE username = '{$_SESSION['username']}' AND password = '{$_SESSION['password']}'";
    $result=mysqli_query($dbc,$checkuser);
    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result) > 0)
    {
        $_SESSION["username"] = $row['username'];
        $_SESSION["usertype"] = $row["usertype_id"];
        $_SESSION["firstname"] = $row["first_name"];
        $_SESSION["lastname"] = $row["last_name"];

        header("Location: http://".$_SERVER['HTTP_HOST'].
            dirname($_SERVER['PHP_SELF'])."/DepotDashboard.php");
    }
    else
    {
        $error = "Invalid login, please try again.";
    }
    // echo $_SESSION["usertype"], $_SESSION["username"];
  }
?>





<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>GM MIS | LOGIN</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="images/GM%20LOGO.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                        <div>
                            <h1 align="center"><font size="6">Globe Master Home Depot</font></h1><br>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" id="loginuser" name="loginuser" class="form-control input_user" value="" placeholder="Username" required>
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" id="loginpass" name="loginpass" class="form-control input_pass" value="" placeholder="Password" required>
                        </div><br>
                        <?php 
                          if(isset($error))
                          {
                            echo "<h4><b><center><font color ='red'> $error</font></h4>";
                          } 
                        ?>
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="submit" name="login" class="btn login_btn">LOGIN</button>
                        </div>
					</form>
				</div>
				
			</div>
		</div>
	</div>
</body>
    
<style>
    
    
    @font-face {
    font-family: "Couture Bold Italic";
    src: url("css/fonts/couture-bldit.otf");
    }

		body,
		html {
			margin: 0;
			padding: 0;
			background-image: url("images/globemasterbackground.jpg") !important;
			/* Full height */
			height: 100%; 

			/* Center and scale the image nicely */
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
		}
		.user_card {
			height: 450px;
			width: 350px;
			margin-top: auto;
			margin-bottom: auto;
			background: #f39c12;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: #FFFACD;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 4px solid black;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #1D2B51 !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: #1D2B51 !important;
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #1D2B51 !important;
		}
    
    
        h1 {
            font-family: 'COUTURE Bold Italic', Arial, sans-serif;
            font-weight:normal;
            font-style:normal;
            color: #1D2B51;
            }
        button {
        font-family: 'COUTURE Bold', Arial, sans-serif;
            font-weight:normal;
            font-style:normal;
            color: #1D2B51;
            }
        h4 {
            font-family: 'COUTURE Bold Italic', Arial, sans-serif;
            font-weight:normal;
            font-style:normal;
            color: #1D2B51;
            font-size: 10px;
            }
    }
        
</style>
</html>
