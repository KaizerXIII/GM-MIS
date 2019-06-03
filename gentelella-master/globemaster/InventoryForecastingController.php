<?php

    function get_end_inventory($date, $item_id)
    {
        $dbc=mysqli_connect('127.0.0.1','root','1234','mydb');

        $SQL_GET_TOTAL_SALES_PER_ITEM = "SELECT sum(order_details.item_qty) as CURRENT_SALES FROM orders
        JOIN order_details ON orders.ordernumber = order_details.ordernumber
        WHERE DATE(orders.order_date) = DATE(now()) AND order_details.item_id = '$item_id'";
        $RESULT_GET_TOTAL_SALES_PER_ITEM =  mysqli_query($dbc,$SQL_GET_TOTAL_SALES_PER_ITEM);
        $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM = mysqli_fetch_assoc($RESULT_GET_TOTAL_SALES_PER_ITEM); //Query for Today

        $CURRENT_SALES_PER_ITEM = $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM['CURRENT_SALES'];

        $SQL_GET_RESTOCK_PER_ITEM = "SELECT sum(quantity) AS CURRENT_RESTOCK from restock_detail
        WHERE DATE(restock_date) = DATE(Now()) AND item_id = '$item_id'";
        $RESULT_GET_RESTOCK_PER_ITEM =  mysqli_query($dbc,$SQL_GET_RESTOCK_PER_ITEM);
        $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM = mysqli_fetch_assoc($RESULT_GET_RESTOCK_PER_ITEM);

        $CURRENT_RESTOCK_PER_ITEM = $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM['CURRENT_RESTOCK']; //Query for Today

        $SQL_GET_CURRENT_ITEM_COUNT = "SELECT * FROM items_trading WHERE item_id ='$item_id'";
        $RESULT_GET_CURRENT_ITEM_COUNT =  mysqli_query($dbc,$SQL_GET_CURRENT_ITEM_COUNT);
        $ROW_RESULT_GET_CURRENT_ITEM_COUNT = mysqli_fetch_assoc($RESULT_GET_CURRENT_ITEM_COUNT);

        $CURRENT_ENDING_INVENTORY = $ROW_RESULT_GET_CURRENT_ITEM_COUNT['item_count'] + ($CURRENT_RESTOCK_PER_ITEM - $CURRENT_SALES_PER_ITEM); //dis da ending inventory
        $COMPUTED_DAYS = array();
        $date1=date_create(date('Y-m-d'));
        $date2=date_create($date);
        $diffs=date_diff($date2,$date1);
        $diff = (int)$diffs->format("%a");
        $i = 0;
        // array_push($forecasted_dates, $start_date);
        $date2 = str_replace('-', '/',(date_format($date2, 'Y-m-d')));
        $cur_date_add = date('Y-m-d',strtotime($date2));
        echo $date2;
        while($diff >= $i)
        {
            array_push($COMPUTED_DAYS, $cur_date_add);
            $date2 = str_replace('-', '/', $cur_date_add);
            $cur_date_add = date('Y-m-d',strtotime($date2 . "+1 days"));
            $i++;
        }
        $inventory_array = array();
        
        foreach($COMPUTED_DAYS as $comp_date)
        {
            $SQL_GET_TOTAL_SALES_PER_ITEM = "SELECT sum(order_details.item_qty) as CURRENT_SALES FROM orders
            JOIN order_details ON orders.ordernumber = order_details.ordernumber
            WHERE DATE(orders.order_date) = DATE('$comp_date') AND order_details.item_id = '$item_id'";
            $RESULT_GET_TOTAL_SALES_PER_ITEM =  mysqli_query($dbc,$SQL_GET_TOTAL_SALES_PER_ITEM);
            $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM = mysqli_fetch_assoc($RESULT_GET_TOTAL_SALES_PER_ITEM); //Query for Today
 
            $CURRENT_SALES_PER_ITEM = $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM['CURRENT_SALES'];

            $SQL_GET_RESTOCK_PER_ITEM = "SELECT sum(quantity) AS CURRENT_RESTOCK from restock_detail
            WHERE DATE(restock_date) = DATE('$comp_date') AND item_id = '$item_id'";
            $RESULT_GET_RESTOCK_PER_ITEM =  mysqli_query($dbc,$SQL_GET_RESTOCK_PER_ITEM);
            $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM = mysqli_fetch_assoc($RESULT_GET_RESTOCK_PER_ITEM);

            $CURRENT_RESTOCK_PER_ITEM = $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM['CURRENT_RESTOCK']; //Query for Today
            $CURRENT_ENDING_INVENTORY = $CURRENT_ENDING_INVENTORY + ($CURRENT_RESTOCK_PER_ITEM - $CURRENT_SALES_PER_ITEM); //dis da ending inventory

            array_push($inventory_array,$CURRENT_ENDING_INVENTORY);
        }
        return $inventory_array;
    }

    
    function naive($start_date, $end_date, $item_id){
        $dbc=mysqli_connect('127.0.0.1','root','1234','mydb');

        $forecasted_dates = array();
        $forecasted_date_vals = array();
        $prev_days = array();
        $prev_vals = array();
        $data_return =array();
        $prev_blank = array();
        $cur_blank =array();
        $cur_date_add = $start_date;

        $date1=date_create($start_date);
        $date2=date_create($end_date);
        $diffs=date_diff($date1,$date2);
        $diff = (int)$diffs->format("%a");
        $i = 1;
        array_push($forecasted_dates, $start_date);
        $date1 = str_replace('-', '/', $start_date);
        $cur_date_add = date('Y-m-d',strtotime($date1 . "+1 days"));
        while($diff >= $i){
            array_push($forecasted_dates, $cur_date_add);
            $date1 = str_replace('-', '/', $cur_date_add);
            $cur_date_add = date('Y-m-d',strtotime($date1 . "+1 days"));
            $i++;
        }
        $date1 = str_replace('-', '/', $start_date);

        for ($x = 1; $x <= 33; $x++) {
            $cur_prev_date_add = date('Y-m-d',strtotime($date1 . "-".$x." days"));
            array_push($prev_days,$cur_prev_date_add);
            array_push($prev_blank, null);
        }
        $end_day_inventory = $prev_days[count($prev_days)-1];
        $inventory_array = get_end_inventory($end_day_inventory, $item_id);
        foreach($inventory_array as $inv)
        {       
            array_push($prev_vals,$inv);
        }
        array_push($forecasted_dates, $end_date);

        $ind = 1;

        $already_forecasted_inventory = [];
      
        foreach($forecasted_dates as $date){
            $forecasted_inventory = 0;
            $total_afcast = 0;
            $cur_total_inv = 0;
            for ($x = 1; $x <= count($prev_days)-$ind; $x++) {
                $cur_total_inv += $prev_vals[sizeof($prev_days)-$x];
            }
            $forecasted_inventory = ((float)$cur_total_inv/(33-$ind));
            // echo 'forecasted_inv: '.$forecasted_inventory;   
            if (sizeof($already_forecasted_inventory) > 0){
                foreach($already_forecasted_inventory as $fcast){
                    $total_afcast += $fcast;
                }
                $total_afcast = (float)$total_afcast/sizeof($already_forecasted_inventory);
                $forecasted_inventory = (float)($total_afcast + $forecasted_inventory)/2;
            }

            array_push($already_forecasted_inventory,$forecasted_inventory);
            array_push($forecasted_date_vals, round($forecasted_inventory));
            $ind+=1;
        }

        $final_dates = array_merge(array_reverse($prev_days),$forecasted_dates);
        $final_forecasted_vals = array_merge($prev_blank,$forecasted_date_vals);
        $final_prev_vals = array_merge($prev_vals,$cur_blank);
        array_push($data_return, $final_dates);
        array_push($data_return, $final_forecasted_vals);
        array_push($data_return, $final_prev_vals);
        return $data_return;
    }
    function short_term($start_date, $end_date, $item_id){
        $dbc=mysqli_connect('127.0.0.1','root','1234','mydb');

        $forecasted_dates = array();
        $forecasted_date_vals = array();
        $prev_days = array();
        $prev_vals = array();
        $data_return =array();
        $prev_blank = array();
        $cur_blank =array();
        $cur_date_add = $start_date;

        $date1=date_create($start_date);
        $date2=date_create($end_date);
        $diffs=date_diff($date1,$date2);
        $diff = (int)$diffs->format("%a");
        $i = 1;
        array_push($forecasted_dates, $start_date);
        $date1 = str_replace('-', '/', $start_date);
        $cur_date_add = date('Y-m-d',strtotime($date1 . "+1 days"));
        while($diff >= $i){
            array_push($forecasted_dates, $cur_date_add);
            $date1 = str_replace('-', '/', $cur_date_add);
            $cur_date_add = date('Y-m-d',strtotime($date1 . "+1 days"));
            $i++;
        }
        $date1 = str_replace('-', '/', $start_date);

        for ($x = 1; $x <= 93; $x++) {
            $cur_prev_date_add = date('Y-m-d',strtotime($date1 . "-".$x." days"));
            array_push($prev_days,$cur_prev_date_add);
            array_push($prev_blank, null);
        }
        $end_day_inventory = $prev_days[count($prev_days)-1];
        $inventory_array = get_end_inventory($end_day_inventory, $item_id);
        foreach($inventory_array as $inv)
        {       
            array_push($prev_vals,$inv);
        }
        array_push($forecasted_dates, $end_date);

        $ind = 1;

        $already_forecasted_inventory = [];
      
        foreach($forecasted_dates as $date){
            $forecasted_inventory = 0;
            $total_afcast = 0;
            $cur_total_inv = 0;
            for ($x = 1; $x <= count($prev_days)-$ind; $x++) {
                $cur_total_inv += $prev_vals[sizeof($prev_days)-$x];
            }
            $forecasted_inventory = ((float)$cur_total_inv/(93-$ind));
            // echo 'forecasted_inv: '.$forecasted_inventory;   
            if (sizeof($already_forecasted_inventory) > 0){
                foreach($already_forecasted_inventory as $fcast){
                    $total_afcast += $fcast;
                }
                $total_afcast = (float)$total_afcast/sizeof($already_forecasted_inventory);
                $forecasted_inventory = (float)($total_afcast + $forecasted_inventory)/2;
            }

            array_push($already_forecasted_inventory,$forecasted_inventory);
            array_push($forecasted_date_vals, round($forecasted_inventory));
            $ind+=1;
        }

        $final_dates = array_merge(array_reverse($prev_days),$forecasted_dates);
        $final_forecasted_vals = array_merge($prev_blank,$forecasted_date_vals);
        $final_prev_vals = array_merge($prev_vals,$cur_blank);
        array_push($data_return, $final_dates);
        array_push($data_return, $final_forecasted_vals);
        array_push($data_return, $final_prev_vals);
        return $data_return;
    }
    function time_series($start_date, $end_date, $item_id){
        $dbc=mysqli_connect('127.0.0.1','root','Rane0708!','mydbmiggy');

        $forecasted_dates = array();
        $forecasted_date_vals = array();
        $prev_days = array();
        $prev_vals = array();
        $data_return =array();
        $prev_blank = array();
        $cur_blank =array();
        $cur_date_add = $start_date;

        $date1=date_create($start_date);
        $date2=date_create($end_date);
        $diffs=date_diff($date1,$date2);
        $diff = (int)$diffs->format("%a");
        $i = 1;
        array_push($forecasted_dates, $start_date);
        $date1 = str_replace('-', '/', $start_date);
        $cur_date_add = date('Y-m-d',strtotime($date1 . "+1 days"));
        while($diff >= $i){
            array_push($forecasted_dates, $cur_date_add);
            $date1 = str_replace('-', '/', $cur_date_add);
            $cur_date_add = date('Y-m-d',strtotime($date1 . "+1 days"));
            $i++;
        }
        $date1 = str_replace('-', '/', $start_date);

        for ($x = 1; $x <= 368; $x++) {
            $cur_prev_date_add = date('Y-m-d',strtotime($date1 . "-".$x." days"));
            array_push($prev_days,$cur_prev_date_add);
            array_push($prev_blank, null);
        }
        $end_day_inventory = $prev_days[count($prev_days)-1];
        $inventory_array = get_end_inventory($end_day_inventory, $item_id);
        foreach($inventory_array as $inv)
        {       
            array_push($prev_vals,$inv);
        }
        array_push($forecasted_dates, $end_date);

        $ind = 1;

        $already_forecasted_inventory = [];
      
        foreach($forecasted_dates as $date){
            $forecasted_inventory = 0;
            $total_afcast = 0;
            $cur_total_inv = 0;
            for ($x = 1; $x <= count($prev_days)-$ind; $x++) {
                $cur_total_inv += $prev_vals[sizeof($prev_days)-$x];
            }
            $forecasted_inventory = ((float)$cur_total_inv/(368-$ind));
            // echo 'forecasted_inv: '.$forecasted_inventory;   
            if (sizeof($already_forecasted_inventory) > 0){
                foreach($already_forecasted_inventory as $fcast){
                    $total_afcast += $fcast;
                }
                $total_afcast = (float)$total_afcast/sizeof($already_forecasted_inventory);
                $forecasted_inventory = (float)($total_afcast + $forecasted_inventory)/2;
            }
            array_push($already_forecasted_inventory,$forecasted_inventory);
            array_push($forecasted_date_vals, round($forecasted_inventory));
            $ind+=1;
        }
        
        $final_dates = array_merge(array_reverse($prev_days),$forecasted_dates);
        $final_forecasted_vals = array_merge($prev_blank,$forecasted_date_vals);
        $final_prev_vals = array_merge($prev_vals,$cur_blank);
        array_push($data_return, $final_dates);
        array_push($data_return, $final_forecasted_vals);
        array_push($data_return, $final_prev_vals);
        return $data_return;
    }
?>