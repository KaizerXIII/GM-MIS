<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/favicon.ico" type="image/ico" />
    <title>GM - Fabrication Approval</title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
     <!-- JQUERY Required Scripts -->
     <script type="text/javascript" src="js/script.js"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
            <?php
                require_once("nav.php");    
            ?>
        
        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div>
                  <center><h1><img src="images/GM%20LOGO.png" width = "80px" height = "80px">ORDERS WITH FABRICATION REQUEST</h1><br>
              </div>
            </div>
            <br><br><br><br>

              <div class="clearfix"></div>
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <div>
                    <div class="x_content">
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $BLOB = array();
                        $FAB_DESCRIPTION = array();

                        $ITEM_NAME_FROM_OR_DETAILS = array();
                        $ORDER_NUMBER = array();
                        $ORDER_STATUS = array();
                        $EXPECTED_DATE = array();

                        $PAYMENT_TYPE = array();
                        $CLIENT_NAME = array();

                        require_once('DataFetchers/mysql_connect.php');

                        $query = "SELECT * FROM orders WHERE (fab_status = 'For Fabrication') OR (fab_status = 'Under Fabrication') ORDER BY orderID ASC ;";
                        $result=mysqli_query($dbc,$query);
                        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                        {

                          $ORDER_NUMBER[] = $row['ordernumber'];
                          $ORDER_STATUS[] = $row['fab_status'];
                          $EXPECTED_DATE[] = $row['expected_date'];

                       

                          $queryPaymentType = "SELECT paymenttype FROM ref_payment WHERE payment_id =" . $row['payment_id'] . ";";
                          $resultPaymentType = mysqli_query($dbc,$queryPaymentType);
                          $rowPaymentType=mysqli_fetch_array($resultPaymentType,MYSQLI_ASSOC);

                          $PAYMENT_TYPE[] = $rowPaymentType['paymenttype'];

                          $queryClientName = "SELECT client_name FROM clients WHERE client_id =" . $row['client_id'] . ";";
                          $resultClientName = mysqli_query($dbc,$queryClientName);
                          $rowClientName=mysqli_fetch_array($resultClientName,MYSQLI_ASSOC);

                           $CLIENT_NAME[] = $rowClientName['client_name'];
                           

                          // $SQL_GET_JOB_FAB = "SELECT * FROM joborderfabrication WHERE order_number =  ".."; ";
                          // $RESULT_JOB_FAB = mysqli_query($dbc,$SQL_GET_JOB_FAB);
                          // $ROW_RESULT_FAB=mysqli_fetch_array($RESULT_JOB_FAB,MYSQLI_ASSOC);
                          
                          // $FAB_DESCRIPTION[] = $ROW_RESULT_FAB['fab_description'];
                          // $BLOB[] = $ROW_RESULT_FAB['reference_drawing'];  

                        }  
                        
                        

                        for($i = 0; $i < sizeof($ORDER_NUMBER); $i ++)
                        {
                         // Gets the Blob and Description
                          $SQL_GET_JOB_FAB = "SELECT * FROM joborderfabrication WHERE order_number = '$ORDER_NUMBER[$i]';";
                          $RESULT_JOB_FAB = mysqli_query($dbc,$SQL_GET_JOB_FAB);
                          while($ROW_RESULT_FAB=mysqli_fetch_array($RESULT_JOB_FAB,MYSQLI_ASSOC))
                          {
                            $FAB_DESCRIPTION[] = $ROW_RESULT_FAB['fab_description'];
                            $BLOB[] = $ROW_RESULT_FAB['reference_drawing'];                                
                          }
                          
                            echo '<tr>';
                              echo '<td>';
                                echo '<div class="panel panel-default">';
                                  echo '<div class="panel-body">';
                                    echo '<div class = "row">';

                                      echo '<div class = "col-md-6">';
                                        echo '<img src = "data:image/jpg;base64,'. base64_encode($BLOB[$i]).'" border-style = "border-width:3px;"style = "height:40vh; width:30vw">'; 
                                      echo '</div>';

                                      echo '<div class = "col-md-6">';
                                        echo '<div class = "row"><h2><b>Order Number:</b> '. $ORDER_NUMBER[$i].'</h2></div>';
                                        
                                        
                                        $SQL_GET_FAB_STATUS = "SELECT * FROM orders WHERE ordernumber = '$ORDER_NUMBER[$i]';";
                                        $RESULT_FAB_STATUS = mysqli_query($dbc,$SQL_GET_FAB_STATUS);
                                        $ROW_RESULT_STATUS = mysqli_fetch_array($RESULT_FAB_STATUS,MYSQLI_ASSOC);

                                        

                                          echo '<div class = "row"><h3><b>Order Status:</b> '. $ORDER_STATUS[$i].'</h3></div>';
                                        if($ROW_RESULT_STATUS['fab_status'] == "Under Fabrication")
                                        {
                                          echo '<a class="current_anchored_row" href="javascript:" current_or = "'.$ORDER_NUMBER[$i].'">Was an item damaged during production? Click here!</a>';
                                        }
                                        else
                                        {

                                        }
                                          echo '<br><br><br>';

                                     

                                        echo '<div class = "row">';
                                          echo '<div class = "col-md-6">';
                                            echo '<p><b>Items Ordered:</b></p>';  

                                             
                                            
                                                $SQL_GET_OR_NUMBER = "SELECT * FROM order_details WHERE ordernumber = '$ORDER_NUMBER[$i]'";
                                                $RESULT_GET_OR =  mysqli_query($dbc,$SQL_GET_OR_NUMBER);
                                                while($ROW_RESULT_GET_OR = mysqli_fetch_array($RESULT_GET_OR,MYSQLI_ASSOC))
                                                {
                                                  $ITEM_NAME_FROM_OR_DETAILS[] = $ROW_RESULT_GET_OR ['item_name'];
                                                                                              
                                                  echo '<span class="fab_row_name">'. $ROW_RESULT_GET_OR ['item_name'],"</span> - <span class=fab_row_qty>",$ROW_RESULT_GET_OR ['item_qty'] ,"</span>pc/s  <br>";
                                                                                                                                          
                                                }
                                                                        
                                            
                                        echo '</div>';    

                                      echo '<div class = "col-md-6">';
                                      if($EXPECTED_DATE[$i] != NULL)
                                      {
                                        echo '<p><b>Expected Delivery Date:</b> '.$EXPECTED_DATE[$i].'<p>';
                                      }
                                      else
                                      {
                                        echo '<p><b>Expected Delivery Date:</b> N/A<p>';
                                      }
                                        
                                        echo '<p><b>Description:</b> '.$FAB_DESCRIPTION[$i].'<p>';

                                        if($ORDER_STATUS[$i] == "For Fabrication")
                                        {
                            
                                          echo '<button type="button" class="btn btn-round btn-danger" id = "disapporveBtn" onclick = "disApproveconfirm(this)" value ="'.$ORDER_NUMBER[$i].'">Disapprove</button>';
                                          echo '<button type="button" class="btn btn-round btn-primary" id = "approveBtn" onclick = "Approveconfirm(this)" value ="'.$ORDER_NUMBER[$i].'">Approve</button>';
                                          echo '<button type="button" class="btn btn-round btn-success" id = "finishBtn" disabled>Finish</button>';
                            
                                        }
                                        else if($ORDER_STATUS[$i] == "Under Fabrication")
                                        {
                                
                                          echo '<button type="button" class="btn btn-round btn-primary" disabled>Approve</button>';
                                          echo '<button type="button" class="btn btn-round btn-success" onclick = "Finishconfirm(this)" value ="'.$ORDER_NUMBER[$i].'">Finish</button> ';
                                          
                                        }          
                                      echo '</div>';              

                                    echo '</div>'; // END <div class row>
                                  echo '</div>'; // END <div class panel body>
                                echo '</div>'; //END div class panel pabnel Default                   
                          echo '</td>';
                        echo '</tr>';                       
                        }// END FOR     
                      ?>  
                      </tbody>
                    </table><br>
                    <div>
                   
                        <script>
                        var post_row_item_name = [];
                        var post_row_item_qty = []; 
                          
                            $(".current_anchored_row").on('click',function(){

                            var split_name = $(this).closest("tr").find('span.fab_row_name').map(function(){ //Gets the currently selected <a> and searches the closest <tr> then finds the <span> with a class = fab_row_name
                              return $(this).text();
                            }).get().toString().split(','); //Splits the object by , to an array

                            var split_qty = $(this).closest("tr").find('span.fab_row_qty').map(function(){
                              return $(this).text();
                            }).get().toString().split(',');



                            $.each(split_name, function(){
                             
                              post_row_item_name.push(this.toString()); //Jquery [For Each] of the variable splitted, it will push to the array
                            })

                            $.each(split_qty, function(){
                              post_row_item_qty.push(parseInt(this));
                            })
                                                      
                            console.log(post_row_item_name);
                            console.log(post_row_item_qty);
                            if(confirm("Confirm: There is/are items that are damaged?"))
                            {
                              request = $.ajax({
                              url: "ajax/post_to_dmg_fab.php",
                              type: "POST",
                              data:{
                                  post_item_name: post_row_item_name, //IF FROM PHP ECHO NEVER FORGET THE "" 
                                  post_item_qty: post_row_item_qty,
                                  post_current_or: $(this).attr('current_or')
                                }, 
                                success: function(data) 
                                { 
                                  window.location.href = "damage_fabrication.php";                                   
                                }//End Success                       
                              }); //End Ajax              
                            }
                            else
                            {
                              alert("Action: Cancelled");
                              post_row_item_name = [];
                              post_row_item_qty = []; 
                              
                            }
                                                                         
                            });
    
                          
                         
                          </script> 
                        <script>   
                         
                          function send_to_dmg_fab() 
                          {
                            console.log(post_row_item_name);
                            
                          }

                        </script>                       

                    <!-- approve/disapprove/finish -->
                  <script>
                    function Approveconfirm(obj)
                    {
                      if(confirm("Do you want to approve this fabrication request?"))
                      {
                        
                        console.log(obj.value);

                        var SET_UNDER_FAB_STATUS = "Under Fabrication";
                        var SET_ORDER_NUMBER = obj.value;
                        
                        request = $.ajax({
                        url: "ajax/set_under_fabrication.php",
                        type: "POST",
                        data: {post_under_fab: SET_UNDER_FAB_STATUS,
                        post_order_number: SET_ORDER_NUMBER                        
                        },
                          success: function(data, textStatus)
                          {
                            alert("Fabrication Approved");
                            window.location.href= "FabricationApproval.php";
                          }//End Scucess
                        
                        }); // End ajax    

                      
                      }//END IF
                    }
                  </script>
                  <script>
                    function disApproveconfirm(obj)
                    {
                      if(confirm("Do you want to disapprove this fabrication request?"))
                      {
                        if(confirm("Are you sure?"))
                        {
                          var SET_UNDER_FAB_STATUS = "Disapproved";
                          var SET_ORDER_NUMBER = obj.value;
                          
                          request = $.ajax({
                          url: "ajax/set_under_fabrication.php",
                          type: "POST",
                          data: {post_under_fab: SET_UNDER_FAB_STATUS,
                          post_order_number: SET_ORDER_NUMBER                        
                          },
                            success: function(data, textStatus)
                            {
                              alert("Fabrication Disapproved");
                              window.location.href= "FabricationApproval.php";
                            }//End Scucess
                          
                          }); // End ajax    
                        }
                        else
                        {
                          
                        }
                      }
                      else
                      {
                        
                      }
                    }
                  </script>
                  <script>
                    function Finishconfirm(obj)
                    {
                      if(confirm("Is this fabrication finished?"))
                      {
                        var SET_UNDER_FAB_STATUS = "Finished Fabrication";
                        var SET_ORDER_NUMBER = obj.value;

                        console.log(SET_UNDER_FAB_STATUS);
                        console.log(obj.value);
                          
                          request = $.ajax({
                          url: "ajax/set_finished_fab.php",
                          type: "POST",
                          data: {
                            post_under_fab: SET_UNDER_FAB_STATUS,
                            post_order_number: SET_ORDER_NUMBER                        
                          },
                            success: function(data, textStatus)
                            {
                              alert("Fabrication Finished");
                              window.location.href= "FabricationApproval.php";
                            }//End Scucess
                          
                          }); // End ajax  
                      }//End IF
                      else
                      {

                      }
                    }//END function
                  </script>
<!-- approve/disapprove/finish -->
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    
    <!-- Custom Fonts -->
    <style>
        
        @font-face {
        font-family: "Couture Bold";
        src: url("css/fonts/couture-bld.otf");
        }
        
        h1 {
            font-family: 'COUTURE Bold', Arial, sans-serif;
            font-weight:normal;
            font-style:normal;
            font-size: 50px;
            color: #1D2B51;
            }
        h2 {
            font-family: 'COUTURE', Arial, sans-serif;
            font-weight:normal;
            font-style:normal;
            font-size: 30px;
            color: #1D2B51;
            }

    </style>    

    <style>
    p {
        word-break: break-all;
        white-space: normal;
    }
    </style>




  </body>
</html>