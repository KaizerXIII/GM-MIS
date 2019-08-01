<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title>GM MIS | Inventory Report</title>

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
	
    <!-- bootstrap-progressbar -->
    <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <!-- JQUERY -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
   
    
<script type="text/javascript" src="js/script.js"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
   
    <div class="main_container">
        <?php
          require_once("nav.php");   
        ?>
    </div>

        <!-- page content -->
        <div class="right_col" role="main">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h1><b>Inventory Report:  </b>
                      <select id="selectWarehouse" name = "selectWarehouse" style=" width:250px";>
                            <option value="">Choose... </option>
                                <?php
                                require_once("print.php"); 
                                    require_once('DataFetchers/mysql_connect.php');
                                    $query = "SELECT * FROM items_trading
                                    join warehouses ON items_trading.warehouse_id = warehouses.warehouse_id
                                    GROUP BY warehouse";                      
                                    $resultofQuery =  mysqli_query($dbc, $query);
                                    while($row=mysqli_fetch_array($resultofQuery,MYSQLI_ASSOC))
                                    {
                                      echo '<option value="'.$row['warehouse'].'">'.$row['warehouse'].'</option> ';
                                    }

                                               
                                ?> <!-- PHP END [ Getting the Warehouses from DB ]-->    
                                                      <option value="">All </option>             
                        </select>
                      </h1>
                      <script>  //Filter Table based on Warehouse                   
                            var get_select_value = document.getElementById("selectWarehouse");
                            get_select_value.onchange = function()
                            {
                              console.log(get_select_value.value); 
                              var getTable = $('#datatable-buttons').DataTable();
                              
                              getTable.columns(4).search(get_select_value.value).draw();
                              //Get the col of table and searches IF it contains the [VALUE] inside () then draws the table accordingly 
                            }                                                                          
                      </script> 
                     
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        <div class="well" style="overflow: auto">

                          <!-- <div class='col-md-4'>
                              <div class="form-group">
                                <input type="date" name="startdate" id = "startdate" onchange ="setStartDate(this)" class="form-control col-md-7 col-xs-12 deliveryDate">
                              </div>
                          </div> -->
                          <center>
                          <div id="report_range" class="btn btn-primary btn-lg" >
                          <span></span> <b class="caret"></b>

                              
                          </div></center>
                          <!-- <div class="col-md-4">
                                <p>Please pick a date range for the respective report</p>
                          </div> -->
                            <!-- <div class='col-md-4'>
                              <div class="form-group">
                                <input type="date" name="enddate" id = "enddate" onchange ="setEndDate(this)" class="form-control col-md-7 col-xs-12 deliveryDate">
                              </div>
                          </div> -->

                        </div>
                        <script>
                        
                            $(document).ready(function() {
                              

                            $(function() {
                              
                              var current_time = moment().valueOf();
                              var start = moment("2019-01-01 00:00:00");
                              var end = moment(current_time);

                              function cb(start, end) {
                                $('#report_range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                              }

                              $('#report_range').daterangepicker({
                                startDate: start,
                                endDate: end,
                                ranges: {
                                  'Today': [moment(), moment()],
                                  'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                                  'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                                  
                                  'This Month': [moment().startOf('month'), moment().endOf('month')],
                                  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                                }
                              }, cb);

                              cb(start, end);

                            });


                            $('#report_range').on('apply.daterangepicker', function(ev, picker) { //Applies the changes on the Datepicker
                              var start = picker.startDate;
                              var end = picker.endDate;
                              var getTable = $('#datatable-buttons').DataTable();

                              $.fn.dataTable.ext.search.push( //Checks all the dates between start and end then pushes it to array
                                function(settings, data, dataIndex) {
                                  var min = start;
                                  var max = end;
                                  var startDate = new Date(data[2]); //gets the date in the specific col of the table
                                  
                                  if (min == null && max == null) {
                                    return true;
                                  }
                                  if (min == null && startDate <= max) {
                                    return true;
                                  }
                                  if (max == null && startDate >= min) {
                                    return true;
                                  }
                                  if (startDate <= max && startDate >= min) {
                                    return true;
                                  }
                                  return false;
                                }
                              );
                              getTable.draw(); //Draws table based on the dates between start and end compared to the column 
                              $.fn.dataTable.ext.search.pop();//Pops the function
                              });
                            });
                        </script>
                       
                    
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th width ="50px">SKU</th>
                          <th width ="100px">Item Name</th>
                          <th width ="100px">Last Restock</th>
                          <th width ="50px">Total Item Count</th>
                          <th width ="100px">Warehouse</th>
                          <th width ="50px">Inventory In</th>
                          <th width ="50px">Inventory Out</th>
                        </tr>
                      </thead>
                      <tbody id = "DaBodi">
                       
                        <?php
                           require_once('DataFetchers/mysql_connect.php');
                          $query = "SELECT * FROM items_trading
                          join warehouses ON items_trading.warehouse_id = warehouses.warehouse_id
                          ORDER BY warehouse";                      
                          $resultofQuery =  mysqli_query($dbc, $query);
                          while($row=mysqli_fetch_array($resultofQuery,MYSQLI_ASSOC))
                          {
                            $id = $row['item_id'];
                            $totalProcuredquery = "SELECT sum(quantity) as TotalProcured, item_id FROM restock_detail WHERE item_id = '$id' ;";
                            $resultforTotal =  mysqli_query($dbc, $totalProcuredquery);
                            $row2 = mysqli_fetch_array($resultforTotal,MYSQLI_ASSOC);

                            $GET_INV_OUT = "SELECT SUM(item_qty) AS Total_Sold  
                            FROM mydb.orders
                            JOIN scheduledelivery
                            ON scheduledelivery.ordernumber = orders.ordernumber
                            JOIN order_details
                            ON order_details.ordernumber = orders.ordernumber
                            WHERE order_details.item_id = '$id' AND ((orders.order_status = 'PickUp' AND orders.payment_status = 'Paid')
                            OR (orders.payment_status = 'Paid' AND (orders.order_status = 'Delivered' OR orders.order_status = 'Late Delivery')));";
                            $RESULT_INV_OUT = mysqli_query($dbc, $GET_INV_OUT);
                            $ROW_RESULT_INV_OUT = mysqli_fetch_array($RESULT_INV_OUT,MYSQLI_ASSOC);

                            echo '<tr>';
                              echo ' <td> '.$row['sku_id']. '</td>';
                              echo ' <td>'.$row['item_name'].' </td>';
                              echo ' <td>'.$row['last_restock'].' </td>';
                              echo ' <td align="right">'.$row['item_count'].' </td>';
                              echo ' <td align="left">'.$row['warehouse'].' </td>';
                              echo ' <td align="right">'.$row2['TotalProcured'].' </td>';
                              echo ' <td align="right">'.$ROW_RESULT_INV_OUT['Total_Sold'].' </td>';
                            echo '</tr>';
                          }
                        ?>                
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          <!-- top tiles -->
          <div class="row tile_count">
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
    <!-- Chart.js -->
    <script src="../vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- FullCalendar -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/fullcalendar/dist/fullcalendar.min.js"></script>
    <!-- gauge.js -->
    <script src="../vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="../vendors/skycons/skycons.js"></script>
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
    <!-- JQVMap -->
    <script src="../vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="../vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <!-- <script src="../vendors/datatables.net-buttons/js/buttons.print.js"></script> -->
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>


    <div id = "gmlogo" class = "gmlogo">
      <img src = "images/GM%20LOGO" width = "80px" height = "80px">GM LOGO HERE
      <span id = "username"><?php echo $_SESSION['firstname']." ".$_SESSION['lastname'] ?></span>
    </div>

    <script>
    console.log($('#dalugu').attr('src'));
      /*!
      * Print button for Buttons and DataTables.
      * 2016 SpryMedia Ltd - datatables.net/license
      */

      (function( factory ){
        if ( typeof define === 'function' && define.amd ) {
          // AMD
          define( ['jquery', 'datatables.net', 'datatables.net-buttons'], function ( $ ) {
            return factory( $, window, document );
          } );
        }
        else if ( typeof exports === 'object' ) {
          // CommonJS
          module.exports = function (root, $) {
            if ( ! root ) {
              root = window;
            }

            if ( ! $ || ! $.fn.dataTable ) {
              $ = require('datatables.net')(root, $).$;
            }

            if ( ! $.fn.dataTable.Buttons ) {
              require('datatables.net-buttons')(root, $);
            }

            return factory( $, root, root.document );
          };
        }
        else {
          // Browser
          factory( jQuery, window, document );
        }
      }(function( $, window, document, undefined ) {
      'use strict';
      var DataTable = $.fn.dataTable;


      var _link = document.createElement( 'a' );

      /**
       * Convert a `link` tag's URL from a relative to an absolute address so it will
       * work correctly in the popup window which has no base URL.
       *
       * @param  {node}     el Element to convert
       */
      var _relToAbs = function( el ) {
        var url;
        var clone = $(el).clone()[0];
        var linkHost;

        if ( clone.nodeName.toLowerCase() === 'link' ) {
          _link.href = clone.href;
          linkHost = _link.host;

          // IE doesn't have a trailing slash on the host
          // Chrome has it on the pathname
          if ( linkHost.indexOf('/') === -1 && _link.pathname.indexOf('/') !== 0) {
            linkHost += '/';
          }

          clone.href = _link.protocol+"//"+linkHost+_link.pathname+_link.search;
        }

        return clone.outerHTML;
      };


      DataTable.ext.buttons.print = {
        className: 'buttons-print',

        text: function ( dt ) {
          return dt.i18n( 'buttons.print', 'Print' );
        },

        action: function ( e, dt, button, config ) {
          var data = dt.buttons.exportData( config.exportOptions );
          var addRow = function ( d, tag ) {
            var str = '<tr>';

            for ( var i=0, ien=d.length ; i<ien ; i++ ) {
              str += '<'+tag+'>'+d[i]+'</'+tag+'>';
            }

            return str + '</tr>';
          };

          // Construct a table for printing\

          var html = '<table class="'+dt.table().node().className+'">';

          if ( config.header ) {
            html += '<thead>'+ addRow( data.header, 'th' ) +'</thead>';
          }

          html += '<tbody>';
          for ( var i=0, ien=data.body.length ; i<ien ; i++ ) {
            html += addRow( data.body[i], 'td' );
          }
          html += '</tbody>';

          if ( config.footer && data.footer ) {
            html += '<tfoot>'+ addRow( data.footer, 'th' ) +'</tfoot>';
          }

          // Open a new window for the printable table
          var win = window.open( '', '' );
          var title = config.title;

          if ( typeof title === 'function' ) {
            title = title();
          }

          if ( title.indexOf( '*' ) !== -1 ) {
            title= title.replace( '*', $('title').text() );
          }

          win.document.close();

          // Inject the title and also a copy of the style and link tags from this
          // document so the table can retain its base styling. Note that we have
          // to use string manipulation as IE won't allow elements to be created
          // in the host document and then appended to the new window.
          var head = '<title>'+title+'</title>';
          $('style, link').each( function () {
            head += _relToAbs( this );
          } );

          //$(win.document.head).html( head );
          win.document.head.innerHTML = head; // Work around for Edge

          // var logo = document.getElementById("GMLOGO");

          // var img1 = document.createElement("img");
          // img1.src = $('.gmlogo').children('img').attr('src');

          // $('#gmlogodiv').appendChild($('.gmlogo').children('img').clone());

          var printedby = document.getElementById("username").innerHTML;
          // Inject the table and other surrounding information
          win.document.body.innerHTML =
            '<center><h1>GLOBE MASTER TRADING</h1></center>'+
            '<br>'+
            '<center>Inventory Report</center>'+
            '<div>'+config.message+'</div>'+
            '<div align  "right"><b>Printed by: '+printedby+'</b></div>'+
            html;
          // $(win.document.body).html(
          // 	'<h1>'+title+'</h1>'+
          // 	'<div>'+config.message+'</div>'+
          // 	html
          // );
          
         
          if ( config.customize ) {
            config.customize( win );
          }

          setTimeout( function () {
            if ( config.autoPrint ) {
              win.print(); // blocking - so close will not
              win.close(); // execute until this is done
            }
          }, 250 );
        },

        title: '*',

        message: '',

        exportOptions: {},

        header: true,

        footer: false,

        autoPrint: true,

        customize: null
      };


      return DataTable.Buttons;
      }));

    </script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <style>
      .deliveryDate {
          -moz-appearance:textfield;
      }
      
      .deliveryDate::-webkit-outer-spin-button,
      .deliveryDate::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
      }
  </style> <!-- To Remove the Up/Down Arrows from Date Selection -->
	
  </body>

</html>
