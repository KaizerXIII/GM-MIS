<?php
ob_start();
session_start();
$_SESSION['user'] = 1;
$user="";
$fname="";
$lname="";
if(!(isset($_SESSION['usertype']))){
    header("Location: http://".$_SERVER['HTTP_HOST'].
        dirname($_SERVER['PHP_SELF'])."/login.php");
}
?>

<script type="text/javascript"> 
  function display_c(){
    var refresh=1000; // Refresh rate in milli seconds
    mytime=setTimeout('display_ct()',refresh)
  }
  function display_ct() {
    var x = new Date()
    document.getElementById('ct').innerHTML = x;
    tt=display_c();
 }
 
</script>


    <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title">
                <a href="MainDashboard.php" class="site_title"><img src="images/GM%20LOGO.png" width = "50px" height = "50px" onload = "display_ct()"><font face="Couture Bold Italic" size="4" color="#1D2B51">Globe Master</font></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/user.png" alt="..." class="img-circle profile_img">
              </div><br>
              <div class="profile_info">
                <span>
                <?php
                  require_once('DataFetchers/mysql_connect.php');
                  $checkuser = "SELECT usertype, usertype_id FROM gm_usertype WHERE usertype_id = '{$_SESSION['usertype']}'";
                  $result=mysqli_query($dbc,$checkuser);
                  $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                  //$_SESSION['usertype']=$row['usertype'];

                  $checkuser1 = "SELECT * FROM gm_users WHERE usertype_id = '{$_SESSION['usertype']}'";
                  $result1=mysqli_query($dbc,$checkuser1);
                  $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);


                $user=$row['usertype'];
                
                    echo "<h2><font face='Couture Bold'>Welcome, ";
                    echo "<br>";
                    echo $_SESSION["firstname"];
                    echo " ";
                    echo $_SESSION["lastname"];
                    echo "</font></h2>";
                  
        
                ?>
                </span>
              </div><br><hr>
            </div><br>
            <!-- /menu profile quick info -->

            

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">

                  <li><a><i class="fa fa-archive"></i> Inventory <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php
                     
                     
                      if($user == "CFO" or $user == "MKT" or $user == "SALES" or $user == 'INV' or $user == 'CEO' or $user == 'Superuser'){
                      echo "<li><a href='ViewInventory.php'>View Inventory</a></li>";
                        }
                      ?>
                      
                      <?php
                      if($user == 'CEO' or $user == 'CFO' or $user == 'MKT' or $user == 'Superuser'){
                      echo "<li><a>Economic order Quantity (EOQ)<span class='fa fa-chevron-down'></span></a>";
                      echo "<ul class='nav child_menu'>";
                      if($user == 'CFO'){
                      echo    "<li><a href='InputPage.php'>Input EOQ Details</a></li>";
                      
                      }
                      if($user == 'CEO' or $user == 'CFO' or $user == 'MKT' or $user == 'Superuser'){
                      echo    "<li><a href='EOQInventory.php'>View Inventory EOQ</a></li>";
                      }
                      echo "</ul>"; 
                     echo "</li>";
                  }
                      ?>
                     
                      <?php
                      if($user == 'CEO' or $user == 'CFO' or $user == 'MKT' or $user == 'Superuser'){
                      echo "<li><a href='assets_trading.php'>Item Sales Visualization</a></li>";
                      }
                      ?>
                        
                    
                      <?php
                     if($user == 'MKT' or $user == 'SALES' or $user == 'INV' or $user == 'Superuser'){
                  
                      echo "<li><a href='qrcodegenerationNew.php'>Generate QR Code</a></li>";
                      
                        }
                      ?>
                    </ul>
                  </li>

                  <?php
                     if($user == 'CEO' or $user == 'SALES' or $user == 'Superuser'){
                  

                  echo "<li><a><i class='fa fa-car'></i> Deliveries <span class='fa fa-chevron-down'></span></a>";
                  echo   "<ul class='nav child_menu'>";
                  if($user == 'CEO' or $user == 'SALES' or $user == 'Superuser'){
                  echo    "<li><a href='Deliveries.php'>View Deliveries</a></li>";
                }
                if($user == 'SALES' or $user == 'Superuser'){
                  echo    "<li><a href='CreateDeliveryReceipt.php'>Generate Delivery Receipt</a></li>";
                }
                  echo   "</ul>";
                  echo "</li>";
                        }
                  ?>

                  <?php
                     if($user == 'MKT' or $user == 'SALES' or $user == 'INV' or $user == 'Superuser'){
                  

                  echo "<li><a><i class='fa fa-external-link-square'></i> Orders <span class='fa fa-chevron-down'></span></a>";
                  echo "<ul class='nav child_menu'>";
                  if($user == 'MKT' or $user == 'SALES' or $user == 'Superuser'){
                  echo    "<li><a href='ViewOrders.php'>View Orders</a></li>";
                }
                  if ($user == 'INV' or $user == 'Superuser'){
                  echo    "<li><a>View Fabrication Orders <span class='fa fa-chevron-down'></span></a>";
                  echo       "<ul class='nav child_menu'>";
                  echo         "<li><a href='FabricationApproval.php'> Fabrication Approval </a></li>";
                  echo         "<li><a href='#'>Finished Fabrication</a></li>";
                  echo       "</ul>";
                  echo    "</li>";
                 
                }
                   echo  "</ul>";
                  echo "</li>";
                        }
                  ?>
                  <?php
                    if($user == 'CFO' or $user == 'MKT' or $user == 'Superuser'){
                      echo "<li><a><i class='fa fa-user'></i> Clients <span class='fa fa-chevron-down'></span></a>";
                      echo  "<ul class='nav child_menu'>";
                
                      echo "<li><a href='CustomerMenu.php'>View Clients</a></li>";
                      echo "</ul>";
                      echo "</li>";
                    }
                  ?>


                  <?php
                     if($user == 'CEO' or $user == 'CFO' or $user == 'MKT' or $user == 'Superuser'){
                  

                  echo "<li><a><i class='fa fa-bar-chart-o'></i> Data Analytics <span class='fa fa-chevron-down'></span></a>";
                  echo   "<ul class='nav child_menu'>";
                  echo     "<li><a> Sales <span class='fa fa-chevron-down'></span></a>";
                  echo       "<ul class='nav child_menu'>";
                  echo         "<li><a href='budget_analysis.php'>Sales Variance Analysis</a></li>";
                  echo         "<li><a href='choosesalesforecast.php'>Sales Forecasting</a></li>";
                  echo       "</ul>";
                  echo    "</li>";
                  echo    "<li><a> Inventory <span class='fa fa-chevron-down'></span></a>";
                  echo        "<ul class='nav child_menu'>";
                  echo            "<li><a href='chooseinventoryforecast.php'>Inventory Forecasting</a></li>";
                  echo         "</ul>";
                  echo    "</li>";
                  echo   "</ul>";
                  echo "</li>";

                  
                        }
                  ?>

                  <?php
                      if($user == 'CEO' or $user == 'CFO' or $user == 'MKT' or $user == 'Superuser'){
                  

                  echo "<li><a><i class='fa fa-folder-open'></i> Reports <span class='fa fa-chevron-down'></span></a>";
                  echo   "<ul class='nav child_menu'>";
                  if($user == 'CEO' or $user == 'CFO' or $user == 'MKT' or $user == 'INV' or $user == 'Superuser'){
                    echo     "<li><a href='Inventory Report.php'>Inventory Report</a></li>";
                  }
                  echo    "<li><a href='Sales Report.php'>Sales Report</a></li>";
                  if($user == 'CEO' or $user == 'CFO' or $user == 'MKT' or $user == 'SALES' or $user == 'Superuser'){
                    echo    "<li><a href='Delivery Report.php'>Delivery Report</a></li>";
                  }
                  if($user == 'CEO' or $user == 'CFO' or $user == 'MKT' or $user == 'INV' or $user == 'Superuser'){
                     echo    "<li><a href='Damage Report.php'>Damages Report</a></li>";
                  }
                  echo   "</ul>";
                  echo "</li>";

                        }
                  ?>
              
              
            
                </ul>
              </div>
            </div>
            <!-- /sidebar menu sdfghjkjhgfdsdfghjk -->


            <!-- Modal Trigger -->
            <!-- Small modal -->
                   <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Small modal</button> -->

            

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt="">
                    <?php
                  require_once('DataFetchers/mysql_connect.php');
                  $checkuser = "SELECT usertype, usertype_id FROM gm_usertype WHERE usertype_id = '{$_SESSION['usertype']}'";
                  $result=mysqli_query($dbc,$checkuser);
                  $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                  //$_SESSION['usertype']=$row['usertype'];

                  $checkuser1 = "SELECT * FROM gm_users WHERE usertype_id = '{$_SESSION['usertype']}'";
                  $result1=mysqli_query($dbc,$checkuser1);
                  $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
                    echo $_SESSION["firstname"];
                    echo " ";
                    echo $_SESSION["lastname"];
                    echo "  ";
                  
        
                ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                <div id='ct' class="monika" style="font-size:120%"></div>

                <li role="presentation" class="dropdown">
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">

                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel2">Inventory Report</h4>
                  </div>
                  <div class="modal-body">
                    <h4>Select a Type of Forecast</h4>
                    <br> -->
                        <!-- Split button -->
                        <!-- <center><div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="invforecastlabel">
                          Choose..
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li id = "invnaive" onclick="changetonaive();"><a href="#">Naive Forecasting</a>
                            </li>
                            <li id = "invshortterm" onclick = "changetost();"><a href="#">Short-Term Forecasting</a>
                            </li>
                            <li id = "invtimerseries" onclick = "changetots();"><a href="#">Time-Series Forecasting</a>
                            </li>
                            <li class="divider"></li>
                            <li onclick = "toggledatepicker()" id="customdatepick"><a href="#">Custom Date Picker</a>
                            </li>
                          </ul>
                        </div>

                        <div name = "datepickers" style = "display:none" id = "datepickerdiv">

                       <div class="daterangepicker dropdown-menu ltr single opensright show-calendar picker_1 xdisplay"><div class="calendar left single" style="display: block;"><div class="daterangepicker_input"><input class="input-mini form-control active" type="text" name="daterangepicker_start" value="" style="display: none;"><i class="fa fa-calendar glyphicon glyphicon-calendar" style="display: none;"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"><table class="table-condensed"><thead><tr><th class="prev available"><i class="fa fa-chevron-left glyphicon glyphicon-chevron-left"></i></th><th colspan="5" class="month">Oct 2016</th><th class="next available"><i class="fa fa-chevron-right glyphicon glyphicon-chevron-right"></i></th></tr><tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr></thead><tbody><tr><td class="weekend off available" data-title="r0c0">25</td><td class="off available" data-title="r0c1">26</td><td class="off available" data-title="r0c2">27</td><td class="off available" data-title="r0c3">28</td><td class="off available" data-title="r0c4">29</td><td class="off available" data-title="r0c5">30</td><td class="weekend available" data-title="r0c6">1</td></tr><tr><td class="weekend available" data-title="r1c0">2</td><td class="available" data-title="r1c1">3</td><td class="available" data-title="r1c2">4</td><td class="available" data-title="r1c3">5</td><td class="available" data-title="r1c4">6</td><td class="available" data-title="r1c5">7</td><td class="weekend available" data-title="r1c6">8</td></tr><tr><td class="weekend available" data-title="r2c0">9</td><td class="available" data-title="r2c1">10</td><td class="available" data-title="r2c2">11</td><td class="available" data-title="r2c3">12</td><td class="available" data-title="r2c4">13</td><td class="available" data-title="r2c5">14</td><td class="weekend available" data-title="r2c6">15</td></tr><tr><td class="weekend available" data-title="r3c0">16</td><td class="available" data-title="r3c1">17</td><td class="today active start-date active end-date available" data-title="r3c2">18</td><td class="available" data-title="r3c3">19</td><td class="available" data-title="r3c4">20</td><td class="available" data-title="r3c5">21</td><td class="weekend available" data-title="r3c6">22</td></tr><tr><td class="weekend available" data-title="r4c0">23</td><td class="available" data-title="r4c1">24</td><td class="available" data-title="r4c2">25</td><td class="available" data-title="r4c3">26</td><td class="available" data-title="r4c4">27</td><td class="available" data-title="r4c5">28</td><td class="weekend available" data-title="r4c6">29</td></tr><tr><td class="weekend available" data-title="r5c0">30</td><td class="available" data-title="r5c1">31</td><td class="off available" data-title="r5c2">1</td><td class="off available" data-title="r5c3">2</td><td class="off available" data-title="r5c4">3</td><td class="off available" data-title="r5c5">4</td><td class="weekend off available" data-title="r5c6">5</td></tr></tbody></table></div></div><div class="calendar right" style="display: none;"><div class="daterangepicker_input"><input class="input-mini form-control" type="text" name="daterangepicker_end" value="" style="display: none;"><i class="fa fa-calendar glyphicon glyphicon-calendar" style="display: none;"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"><table class="table-condensed"><thead><tr><th></th><th colspan="5" class="month">Nov 2016</th><th class="next available"><i class="fa fa-chevron-right glyphicon glyphicon-chevron-right"></i></th></tr><tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr></thead><tbody><tr><td class="weekend off available" data-title="r0c0">30</td><td class="off available" data-title="r0c1">31</td><td class="available" data-title="r0c2">1</td><td class="available" data-title="r0c3">2</td><td class="available" data-title="r0c4">3</td><td class="available" data-title="r0c5">4</td><td class="weekend available" data-title="r0c6">5</td></tr><tr><td class="weekend available" data-title="r1c0">6</td><td class="available" data-title="r1c1">7</td><td class="available" data-title="r1c2">8</td><td class="available" data-title="r1c3">9</td><td class="available" data-title="r1c4">10</td><td class="available" data-title="r1c5">11</td><td class="weekend available" data-title="r1c6">12</td></tr><tr><td class="weekend available" data-title="r2c0">13</td><td class="available" data-title="r2c1">14</td><td class="available" data-title="r2c2">15</td><td class="available" data-title="r2c3">16</td><td class="available" data-title="r2c4">17</td><td class="available" data-title="r2c5">18</td><td class="weekend available" data-title="r2c6">19</td></tr><tr><td class="weekend available" data-title="r3c0">20</td><td class="available" data-title="r3c1">21</td><td class="available" data-title="r3c2">22</td><td class="available" data-title="r3c3">23</td><td class="available" data-title="r3c4">24</td><td class="available" data-title="r3c5">25</td><td class="weekend available" data-title="r3c6">26</td></tr><tr><td class="weekend available" data-title="r4c0">27</td><td class="available" data-title="r4c1">28</td><td class="available" data-title="r4c2">29</td><td class="available" data-title="r4c3">30</td><td class="off available" data-title="r4c4">1</td><td class="off available" data-title="r4c5">2</td><td class="weekend off available" data-title="r4c6">3</td></tr><tr><td class="weekend off available" data-title="r5c0">4</td><td class="off available" data-title="r5c1">5</td><td class="off available" data-title="r5c2">6</td><td class="off available" data-title="r5c3">7</td><td class="off available" data-title="r5c4">8</td><td class="off available" data-title="r5c5">9</td><td class="weekend off available" data-title="r5c6">10</td></tr></tbody></table></div></div><div class="ranges" style="display: none;"><div class="range_inputs"><button class="applyBtn btn btn-sm btn-success" type="button">Apply</button> <button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button></div></div></div>


                        <fieldset>
                          <br><br>
                          <div class="control-group">
                            <div class="controls">
                              <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="single_cal1" placeholder="First Name" aria-describedby="inputSuccess2Status">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status" class="sr-only">(success)</span>
                              </div>
                            </div>
                          </div>
                        </fieldset>

                        <p> to </p>

                         <div class="daterangepicker dropdown-menu ltr single opensright show-calendar picker_2 xdisplay"><div class="calendar left single" style="display: block;"><div class="daterangepicker_input"><input class="input-mini form-control active" type="text" name="daterangepicker_start" value="" style="display: none;"><i class="fa fa-calendar glyphicon glyphicon-calendar" style="display: none;"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"><table class="table-condensed"><thead><tr><th class="prev available"><i class="fa fa-chevron-left glyphicon glyphicon-chevron-left"></i></th><th colspan="5" class="month">Oct 2016</th><th class="next available"><i class="fa fa-chevron-right glyphicon glyphicon-chevron-right"></i></th></tr><tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr></thead><tbody><tr><td class="weekend off available" data-title="r0c0">25</td><td class="off available" data-title="r0c1">26</td><td class="off available" data-title="r0c2">27</td><td class="off available" data-title="r0c3">28</td><td class="off available" data-title="r0c4">29</td><td class="off available" data-title="r0c5">30</td><td class="weekend available" data-title="r0c6">1</td></tr><tr><td class="weekend available" data-title="r1c0">2</td><td class="available" data-title="r1c1">3</td><td class="available" data-title="r1c2">4</td><td class="available" data-title="r1c3">5</td><td class="available" data-title="r1c4">6</td><td class="available" data-title="r1c5">7</td><td class="weekend available" data-title="r1c6">8</td></tr><tr><td class="weekend available" data-title="r2c0">9</td><td class="available" data-title="r2c1">10</td><td class="available" data-title="r2c2">11</td><td class="available" data-title="r2c3">12</td><td class="available" data-title="r2c4">13</td><td class="available" data-title="r2c5">14</td><td class="weekend available" data-title="r2c6">15</td></tr><tr><td class="weekend available" data-title="r3c0">16</td><td class="available" data-title="r3c1">17</td><td class="today active start-date active end-date available" data-title="r3c2">18</td><td class="available" data-title="r3c3">19</td><td class="available" data-title="r3c4">20</td><td class="available" data-title="r3c5">21</td><td class="weekend available" data-title="r3c6">22</td></tr><tr><td class="weekend available" data-title="r4c0">23</td><td class="available" data-title="r4c1">24</td><td class="available" data-title="r4c2">25</td><td class="available" data-title="r4c3">26</td><td class="available" data-title="r4c4">27</td><td class="available" data-title="r4c5">28</td><td class="weekend available" data-title="r4c6">29</td></tr><tr><td class="weekend available" data-title="r5c0">30</td><td class="available" data-title="r5c1">31</td><td class="off available" data-title="r5c2">1</td><td class="off available" data-title="r5c3">2</td><td class="off available" data-title="r5c4">3</td><td class="off available" data-title="r5c5">4</td><td class="weekend off available" data-title="r5c6">5</td></tr></tbody></table></div></div><div class="calendar right" style="display: none;"><div class="daterangepicker_input"><input class="input-mini form-control" type="text" name="daterangepicker_end" value="" style="display: none;"><i class="fa fa-calendar glyphicon glyphicon-calendar" style="display: none;"></i><div class="calendar-time" style="display: none;"><div></div><i class="fa fa-clock-o glyphicon glyphicon-time"></i></div></div><div class="calendar-table"><table class="table-condensed"><thead><tr><th></th><th colspan="5" class="month">Nov 2016</th><th class="next available"><i class="fa fa-chevron-right glyphicon glyphicon-chevron-right"></i></th></tr><tr><th>Su</th><th>Mo</th><th>Tu</th><th>We</th><th>Th</th><th>Fr</th><th>Sa</th></tr></thead><tbody><tr><td class="weekend off available" data-title="r0c0">30</td><td class="off available" data-title="r0c1">31</td><td class="available" data-title="r0c2">1</td><td class="available" data-title="r0c3">2</td><td class="available" data-title="r0c4">3</td><td class="available" data-title="r0c5">4</td><td class="weekend available" data-title="r0c6">5</td></tr><tr><td class="weekend available" data-title="r1c0">6</td><td class="available" data-title="r1c1">7</td><td class="available" data-title="r1c2">8</td><td class="available" data-title="r1c3">9</td><td class="available" data-title="r1c4">10</td><td class="available" data-title="r1c5">11</td><td class="weekend available" data-title="r1c6">12</td></tr><tr><td class="weekend available" data-title="r2c0">13</td><td class="available" data-title="r2c1">14</td><td class="available" data-title="r2c2">15</td><td class="available" data-title="r2c3">16</td><td class="available" data-title="r2c4">17</td><td class="available" data-title="r2c5">18</td><td class="weekend available" data-title="r2c6">19</td></tr><tr><td class="weekend available" data-title="r3c0">20</td><td class="available" data-title="r3c1">21</td><td class="available" data-title="r3c2">22</td><td class="available" data-title="r3c3">23</td><td class="available" data-title="r3c4">24</td><td class="available" data-title="r3c5">25</td><td class="weekend available" data-title="r3c6">26</td></tr><tr><td class="weekend available" data-title="r4c0">27</td><td class="available" data-title="r4c1">28</td><td class="available" data-title="r4c2">29</td><td class="available" data-title="r4c3">30</td><td class="off available" data-title="r4c4">1</td><td class="off available" data-title="r4c5">2</td><td class="weekend off available" data-title="r4c6">3</td></tr><tr><td class="weekend off available" data-title="r5c0">4</td><td class="off available" data-title="r5c1">5</td><td class="off available" data-title="r5c2">6</td><td class="off available" data-title="r5c3">7</td><td class="off available" data-title="r5c4">8</td><td class="off available" data-title="r5c5">9</td><td class="weekend off available" data-title="r5c6">10</td></tr></tbody></table></div></div><div class="ranges" style="display: none;"><div class="range_inputs"><button class="applyBtn btn btn-sm btn-success" type="button">Apply</button> <button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button></div></div></div>


                        <fieldset>
                          <div class="control-group">
                            <div class="controls">
                              <div class="col-md-12 xdisplay_inputx form-group has-feedback">
                                <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
                                <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                              </div>
                            </div>
                          </div>
                        </fieldset>

                        
                      </div>
                      </center>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success">Show Forecast</button>
                  </div>

                </div>
              </div>
            </div> -->


            <!-- /modals -->
            
            <!-- SALES VARIANCE ANALYSIS MODALS -->
            <div id="SalesVarianceAnalysis" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <center><h3 class="modal-title"><img src="images/GM%20LOGO.png" width = "50px" height = "50px">Sales Variance Analysis</h3>
                  </div>
                  <div class="modal-body">
                    <center><h4>CHOOSE YOUR STORE FOR ANALYSIS:</h4>
                    <div class="btn-group">
                          <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="salesvariancelabel">
                          Choose..
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li id = "svtrading" onclick="changetotrading();"><a href="#">Trading</a>
                            </li>
                            <li id = "svdepot" onclick = "changetodepot();"><a href="#">Depot</a>
                            </li>
                          </ul>
                        </div>  
                    
                  </div>
                  <div class="modal-footer">
                      <a href="SalesVarianceAnalysis.php"><button type="submit" class="btn btn-primary">Next</button></a>  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>

              </div>
            </div>

        <!-- Custom Fonts -->
    <style>
        
        @font-face {
        font-family: "Couture Bold Italic";
        src: url("css/fonts/couture-bldit.otf");
        }
        
        @font-face {
        font-family: "Couture Bold";
        src: url("css/fonts/couture-bld.otf");
        }
        
        .navbar nav_title {
            font-family: 'COUTURE Bold', Arial, sans-serif;
            font-weight:normal;
            font-style:normal;
            color: #1D2B51;
            }
        
        /* h3 {
            font-family: 'COUTURE Bold', Arial, sans-serif;
            font-weight:normal;
            font-style:normal;
            color: #1D2B51;
            }
        h4 {
            font-family: 'COUTURE Bold', Arial, sans-serif;
            font-weight:normal;
            font-style:normal;
            color: #1D2B51;
            font-size: 15px;
            } */
    </style>  


    <!-- SCRIPTS -->

          <!-- Change Button Label Script -->
          <script>
            var invforecastlabel = document.getElementById("invforecastlabel");
            
            var invnaive = document.getElementById("invnaive");
            var invshortterm = document.getElementById("invshortterm");
            var invtimeseries = document.getElementById("invtimerseries");
            function changetonaive()
            {
              invforecastlabel.innerHTML = "Naive Forecasting";
              
            }
            function changetots()
            {
              invforecastlabel.innerHTML = "Time Series Forecasting";
              
            }
            function changetost()
            {
              invforecastlabel.innerHTML = "Short Term Forecasting";
              
            }
          </script>

          <!-- Toggle datepicker script -->
          <script>
            var customdatepick = document.getElementById("customdatepick");
            var datepickerdiv = document.getElementById("datepickerdiv");
            var invforecastlabel = document.getElementById("invforecastlabel");
            
            function toggledatepicker()
            {
              datepickerdiv.style.display = "block";
              invforecastlabel.innerHTML = "Custom Date Pick";
            }
          </script>
                  
          <!-- Change Button Label Analysis -->
          <script>
            var salesvariancelabel = document.getElementById("salesvariancelabel");
            
            var svtrading = document.getElementById("svtrading");
            var svdepot = document.getElementById("svdepot");
        
            function changetotrading()
            {
              salesvariancelabel.innerHTML = "GLOBEMASTER TRADING";
              
            }
            function changetodepot()
            {
              salesvariancelabel.innerHTML = "GLOBEMASTER DEPOT";
              
            }
          </script>

          <!-- Toggle datepicker script -->
          <script>
            var customdatepick = document.getElementById("customdatepick");
            var datepickerdiv = document.getElementById("datepickerdiv");
            var invforecastlabel = document.getElementById("invforecastlabel");
            
            function toggledatepicker()
            {
              datepickerdiv.style.display = "block";
              invforecastlabel.innerHTML = "Custom Date Pick";
            }
          </script>          

          