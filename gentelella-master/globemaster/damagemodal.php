<!-- Hyperlink for add supplier modal -->
<div class="col-md-6 col-sm-2 col-xs-12"><span>
                                                    <a href="#bannerformmodal" data-toggle="modal" data-target=".bs-example-modal-lg2"><font size = "4">Click here to add a new supplier</font></a>
                                                </span> </div>
                                                <!-- New Supplier Modal Start -->
                                                <div id = "bannerformmodal" class="modal fade bs-example-modal-lg2" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                        </button>
                                                        <h4 class="modal-title" id="myModalLabel">Add a New Supplier</h4>
                                                    </div>

                                                    <div class = "modal-body">
                                                    <form class="form-horizontal form-label-left" method="POST" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                                                        <span class="section">Supplier Info</span>
                                                        <br>
                                                        <div class="item form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Supplier Name <span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-7 col-sm-6 col-xs-12">
                                                                <input id="addsupplierName" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="addsupplierName" placeholder="Please enter the supplier's name" required="required" type="text" required>
                                                            </div>
                                                        </div>
                                                        <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Contact Number <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-7 col-sm-6 col-xs-12">
                                                            <input id="addsupplierNumber" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="addsupplierNumber" placeholder="Please enter the supplier's contact number" required="required" type="text" required>
                                                        </div>
                                                        </div>
                                                        <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
                                                        </label>
                                                        <div class="col-md-7 col-sm-6 col-xs-12">
                                                            <input id="addsupplierEmail" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="addsupplierEmail" placeholder="Please enter the supplier's e-mail address" required="required" type="email">
                                                        </div>
                                                        </div>
                                                        <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Address
                                                        </label>
                                                        <div class="col-md-7 col-sm-6 col-xs-12">
                                                            <textarea id="addsupplierAddress" name="addsupplierAddress" class="form-control col-md-7 col-xs-12" placeholder="Please enter the supplier's address" required></textarea>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <div class="ln_solid"></div>
                                                        <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-3">
                                                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                            <button class="btn btn-primary" data-dismiss="modal">Reset</button>
                                                            <button id="send" name = "submit_btn" type="submit" class="btn btn-success" onclick="confirmalert()">Submit</button>
                                                            <br><br>
                                                        </div>
                                                        <!-- Add Inventory -->
                                                        
                                                        <?php
                                                            require_once('DataFetchers/mysql_connect.php');

                                                            $addsname = $addscontact = $addsemail = $addsaddress = $addsidinsert = "";

                                                            if(isset($_POST["submit_btn"]))
                                                            {
                                                                $addsquery = "SELECT max(supplier_id) FROM suppliers";
                                                                $addsresult1 = mysqli_query($dbc,$addsquery);
                                                                
                                                                $addsid = mysqli_fetch_array($addsresult1,MYSQLI_ASSOC);
                                                                
                                                                $addsidinsert = $addsid["max(supplier_id)"] + 1;
                                                                // echo $idinsert; for testing

                                                                $addsname = test_input($_POST['addsupplierName']);
                                                                $addscontact = test_input($_POST['addsupplierNumber']);
                                                                $addsemail = test_input($_POST['addsupplierEmail']);
                                                                $addsaddress = test_input($_POST['addsupplierAddress']);
                                                                // $status = test_input($_POST['status']);

                                                                // echo '<script language="javascript">';
                                                                // echo 'confirm(Are you sure you want to enter the following data?)';  //not showing an alert box.
                                                                // echo '</script>';
                                                            

                                                                $sql = "INSERT INTO suppliers (supplier_id, supplier_name, supplier_address, supplier_contactno, supplier_email)
                                                                Values(
                                                                '$addsidinsert',
                                                                '$addsname', 
                                                                '$addsaddress',
                                                                '$addscontact',
                                                                '$addsemail');";

                                                                $resultinsert = mysqli_query($dbc,$sql);
                                                                header('Location: '.$_SERVER['REQUEST_URI']);
                                                                

                                                            }

                                                            function test_input($data) 
                                                            {
                                                                $data = trim($data);
                                                                $data = stripslashes($data);
                                                                $data = htmlspecialchars($data);
                                                                return $data;
                                                            }
                                                    ?>
                                                    </form>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                                <br>
                                                <br>
                                                <!-- New Supplier Modal End -->