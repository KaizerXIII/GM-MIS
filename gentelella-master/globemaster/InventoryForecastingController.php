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
        $diffs=date_diff($date1,$date2);
        $diff = (int)$diffs->format("%a");
        $i = 1;
        // array_push($forecasted_dates, $start_date);
        $date2 = str_replace('-', '/',(date_format($date2, 'Y-m-d')));
        
        $cur_date_add = date('Y-m-d',strtotime($date2 . "-1 days"));

        while($diff >= $i)
        {
            array_push($COMPUTED_DAYS, $cur_date_add);
            $date1 = str_replace('-', '/', $cur_date_add);
            $cur_date_add = date('Y-m-d',strtotime($date1 . "-1 days"));
            $i++;
            
        }
        foreach($COMPUTED_DAYS as $comp_date)
        {
            $SQL_GET_TOTAL_SALES_PER_ITEM = "SELECT sum(order_details.item_qty) as CURRENT_SALES FROM orders
            JOIN order_details ON orders.ordernumber = order_details.ordernumber
            WHERE DATE(orders.order_date) = DATE('$date2') AND order_details.item_id = '$item_id'";
            $RESULT_GET_TOTAL_SALES_PER_ITEM =  mysqli_query($dbc,$SQL_GET_TOTAL_SALES_PER_ITEM);
            $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM = mysqli_fetch_assoc($RESULT_GET_TOTAL_SALES_PER_ITEM); //Query for Today

            $CURRENT_SALES_PER_ITEM = $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM['CURRENT_SALES'];

            $SQL_GET_RESTOCK_PER_ITEM = "SELECT sum(quantity) AS CURRENT_RESTOCK from restock_detail
            WHERE DATE(restock_date) = DATE('$date2') AND item_id = '$item_id'";
            $RESULT_GET_RESTOCK_PER_ITEM =  mysqli_query($dbc,$SQL_GET_RESTOCK_PER_ITEM);
            $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM = mysqli_fetch_assoc($RESULT_GET_RESTOCK_PER_ITEM);

            $CURRENT_RESTOCK_PER_ITEM = $ROW_RESULT_GET_TOTAL_SALES_PER_ITEM['CURRENT_RESTOCK']; //Query for Today

            $SQL_GET_CURRENT_ITEM_COUNT = "SELECT * FROM items_trading WHERE item_id ='$item_id'";
            $RESULT_GET_CURRENT_ITEM_COUNT =  mysqli_query($dbc,$SQL_GET_RESTOCK_PER_ITEM);

            $CURRENT_ENDING_INVENTORY = $CURRENT_ENDING_INVENTORY + ($CURRENT_RESTOCK_PER_ITEM - $CURRENT_SALES_PER_ITEM); //dis da ending inventory
        }
        return $CURRENT_ENDING_INVENTORY;
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
        while($diff > $i){
            array_push($forecasted_dates, $cur_date_add);
            $date1 = str_replace('-', '/', $cur_date_add);
            $cur_date_add = date('Y-m-d',strtotime($date1 . "+1 days"));
            $i++;
            array_push($cur_blank, null);
        }

        $date1 = str_replace('-', '/', $start_date);
        for ($x = 1; $x <= 30; $x++) {
            $cur_prev_date_add = date('Y-m-d',strtotime($date1 ."-".$x." days"));
            if ($x != 1){
                $cur_prev_date_add = date('Y-m-d',strtotime($date1 . "-".(($x-1)*3)." days"));
            }
            array_push($prev_days,$cur_prev_date_add);
            array_push($prev_blank, null);
        }
        foreach($prev_days as $date)
        {     
            array_push($prev_vals,get_end_inventory($date, $item_id));     
        }
        array_push($forecasted_dates, $end_date);

        $ind = 1;

        $already_forecasted_sales = [];
        foreach($forecasted_dates as $date){
            $forecasted_sales = 0;
            $total_afcast = 0;
            $query = "SELECT it.item_name, SUM(o.totalamt) as 'total_amount'
                  FROM orders o
                  join order_details od on o.ordernumber = od.ordernumber
                  join items_trading it on it.item_id = od.item_id
                  where it.item_id = ".$item_id." and DATE(o.order_date) 
                  between DATE_SUB('".$date."', INTERVAL ".(90-$ind)." DAY) and '".$date."'
                  group by 1;";
            $result=mysqli_query($dbc,$query);
            $row_cnt = $result->num_rows;

            if ($row_cnt>0){
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    $forecasted_sales = ((float)$row['total_amount']/(90-$ind));
                }
            }else{
                $forecasted_sales = 0;
            }
            if (sizeof($already_forecasted_sales) > 0){
                foreach($already_forecasted_sales as $fcast){
                    $total_afcast += $fcast;
                }
                $total_afcast = (float)$total_afcast/sizeof($already_forecasted_sales);
                $forecasted_sales = (float)($total_afcast + $forecasted_sales)/2;
            }

            array_push($already_forecasted_sales,$forecasted_sales);
            array_push($forecasted_date_vals, round($forecasted_sales));
            $ind+=1;
        }
        $final_dates = array_merge(array_reverse($prev_days),$forecasted_dates);
        $final_forecasted_vals = array_merge($prev_blank,$forecasted_date_vals);
        $final_prev_vals = array_merge(array_reverse($prev_vals),$cur_blank);
        array_push($data_return, $final_dates);
        array_push($data_return, $final_forecasted_vals);
        array_push($data_return, $final_prev_vals);
        return $data_return;
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
        while($diff > $i){
            array_push($forecasted_dates, $cur_date_add);
            $date1 = str_replace('-', '/', $cur_date_add);
            $cur_date_add = date('Y-m-d',strtotime($date1 . "+1 days"));
            $i++;
        }
        $date1 = str_replace('-', '/', $start_date);

        for ($x = 1; $x <= 30; $x++) {
            $cur_prev_date_add = date('Y-m-d',strtotime($date1 . "-".$x." days"));
            array_push($prev_days,$cur_prev_date_add);
            array_push($prev_blank, null);
        }
        foreach($prev_days as $date)
        {
                     
            array_push($prev_vals,get_end_inventory($date, $item_id));
           
        }
        array_push($forecasted_dates, $end_date);

        $ind = 1;

        $already_forecasted_inventory = [];

        foreach($forecasted_dates as $date){
            $forecasted_inventory = 0;
            $total_afcast = 0;
            $cur_total_inv = 0;
            for ($x = 1; $x <= count($prev_days)-$ind; $x++) {
                $cur_total_inv = get_end_inventory($prev_days[count($prev_days)-$x],$item_id);
            }
            $forecasted_inventory = ((float)$cur_total_inv/(30-$ind));
               
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
        $final_prev_vals = array_merge(array_reverse($prev_vals),$cur_blank);
        array_push($data_return, $final_dates);
        array_push($data_return, $final_forecasted_vals);
        array_push($data_return, $final_prev_vals);
        return $data_return;
    }
    function time_series($start_date, $end_date, $item_id){
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
        while($diff > $i){
            array_push($forecasted_dates, $cur_date_add);
            $date1 = str_replace('-', '/', $cur_date_add);
            $cur_date_add = date('Y-m-d',strtotime($date1 . "+1 days"));
            $i++;
        }
        $date1 = str_replace('-', '/', $start_date);
        for ($x = 1; $x <= 73; $x++) {
            $cur_prev_date_add = date('Y-m-d',strtotime($date1 ."-".$x." days"));
            if ($x != 1){
                $cur_prev_date_add = date('Y-m-d',strtotime($date1 . "-".(($x-1)*5)." days"));
            }
            array_push($prev_days,$cur_prev_date_add);
            array_push($prev_blank, null);
        }
        foreach($prev_days as $date){
            $query = "SELECT it.item_name, SUM(o.totalamt) as 'total_amount'
                  FROM orders o
                  join order_details od on o.ordernumber = od.ordernumber
                  join items_trading it on it.item_id = od.item_id
                  where it.item_id = ".$item_id." and DATE(o.order_date) between 
                  DATE_SUB('".$date."', INTERVAL 4 DAY) and'".$date."'
                  group by 1;";
            $result=mysqli_query($dbc,$query);
            $row_cnt = $result->num_rows;

            if ($row_cnt>0){
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    $day_sales = ((float)$row['total_amount']);
                    array_push($prev_vals,$day_sales);
                }
            }else{
                $day_sales = 0;
                array_push($prev_vals,$day_sales);
            }
        }
        array_push($forecasted_dates, $end_date);

        $ind = 1;

        $already_forecasted_sales = [];

        foreach($forecasted_dates as $date){
            $forecasted_sales = 0;
            $total_afcast = 0;
            $query = "SELECT it.item_name, SUM(o.totalamt) as 'total_amount'
                  FROM orders o
                  join order_details od on o.ordernumber = od.ordernumber
                  join items_trading it on it.item_id = od.item_id
                  where it.item_id = ".$item_id." and DATE(o.order_date) 
                  between DATE_SUB('".$date."', INTERVAL ".(365-$ind)." DAY) and '".$date."'
                  group by 1;";
            $result=mysqli_query($dbc,$query);
            $row_cnt = $result->num_rows;

            if ($row_cnt>0){
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    $forecasted_sales = ((float)$row['total_amount']/(365-$ind));
                }
            }else{
                $forecasted_sales = 0;
            }
            if (sizeof($already_forecasted_sales) > 0){
                foreach($already_forecasted_sales as $fcast){
                    $total_afcast += $fcast;
                }
                $total_afcast = (float)$total_afcast/sizeof($already_forecasted_sales);
                $forecasted_sales = (float)($total_afcast + $forecasted_sales)/2;
            }

            array_push($already_forecasted_sales,$forecasted_sales);
            array_push($forecasted_date_vals, round($forecasted_sales));
            $ind+=1;
        }
        $final_dates = array_merge(array_reverse($prev_days),$forecasted_dates);
        $final_forecasted_vals = array_merge($prev_blank,$forecasted_date_vals);
        $final_prev_vals = array_merge(array_reverse($prev_vals),$cur_blank);
        array_push($data_return, $final_dates);
        array_push($data_return, $final_forecasted_vals);
        array_push($data_return, $final_prev_vals);
        return $data_return;
    }
?>