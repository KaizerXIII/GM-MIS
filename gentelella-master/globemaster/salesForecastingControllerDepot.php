<?php
    
    function naive($start_date, $end_date, $item_id){
        $dbc=mysqli_connect('127.0.0.1','root','1234','depotdb');

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
        foreach($prev_days as $date){
            $query = "SELECT p.productID, SUM(sd.Price) AS 'totalprice'
                  FROM gm_products p
                  JOIN gm_salesdetails sd on p.ProductID = sd.ProductID
                  JOIN gm_sales s on sd.SalesID = s.SalesID
                  WHERE p.productID = ".$item_id." and DATE(sd.RecordDate) = '".$date."'
                  GROUP BY 1;";
            $result=mysqli_query($dbc,$query);
            $row_cnt = $result->num_rows;

            if ($row_cnt>0){
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    $day_sales = ((float)$row['totalprice']);
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
            $query = "SELECT p.productID, SUM(sd.Price) AS 'totalprice'
                    FROM gm_products p
                    JOIN gm_salesdetails sd on p.ProductID = sd.ProductID
                    JOIN gm_sales s on sd.SalesID = s.SalesID
                    WHERE p.productID = ".$item_id." and DATE(sd.RecordDate) 
                    between DATE_SUB('".$forecasted_dates[0]."', INTERVAL ".(30-$ind)." DAY) and '".$forecasted_dates[0]."'
                    GROUP BY 1;";
            $result=mysqli_query($dbc,$query);
            $row_cnt = $result->num_rows;

            if ($row_cnt>0){
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    $forecasted_sales = ((float)$row['totalprice']/(30-$ind));
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
    function short_term($start_date, $end_date, $item_id){
        $dbc=mysqli_connect('127.0.0.1','root','1234','depotdb');

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
        for ($x = 1; $x <= 90; $x++) {
            $cur_prev_date_add = date('Y-m-d',strtotime($date1 ."-".$x." days"));
            array_push($prev_days,$cur_prev_date_add);
            array_push($prev_blank, null);
        }
        foreach($prev_days as $date){
            $query = "SELECT p.productID, SUM(sd.Price) AS 'totalprice'
                    FROM gm_products p
                    JOIN gm_salesdetails sd on p.ProductID = sd.ProductID
                    JOIN gm_sales s on sd.SalesID = s.SalesID
                    WHERE p.productID = ".$item_id." and DATE(sd.RecordDate) = '".$date."'
                    GROUP BY 1;";
            $result=mysqli_query($dbc,$query);
            $row_cnt = $result->num_rows;

            if ($row_cnt>0){
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    $day_sales = ((float)$row['totalprice']);
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
            $query = "SELECT p.productID, SUM(sd.Price) AS 'totalprice'
                    FROM gm_products p
                    JOIN gm_salesdetails sd on p.ProductID = sd.ProductID
                    JOIN gm_sales s on sd.SalesID = s.SalesID
                    WHERE p.productID = ".$item_id." and DATE(sd.RecordDate) 
                    between DATE_SUB('".$forecasted_dates[0]."', INTERVAL ".(90-$ind)." DAY) and '".$forecasted_dates[0]."'
                    GROUP BY 1;";
            $result=mysqli_query($dbc,$query);
            $row_cnt = $result->num_rows;

            if ($row_cnt>0){
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    $forecasted_sales = ((float)$row['totalprice']/(90-$ind));
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
    function time_series($start_date, $end_date, $item_id){
        $dbc=mysqli_connect('127.0.0.1','root','1234','depotdb');
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
        for ($x = 1; $x <= 365; $x++) {
            $cur_prev_date_add = date('Y-m-d',strtotime($date1 ."-".$x." days"));
            
            array_push($prev_days,$cur_prev_date_add);
            array_push($prev_blank, null);
        }
        foreach($prev_days as $date){
            $query = "SELECT p.productID, SUM(sd.Price) AS 'totalprice'
            FROM gm_products p
            JOIN gm_salesdetails sd on p.ProductID = sd.ProductID
            JOIN gm_sales s on sd.SalesID = s.SalesID
            WHERE p.productID = ".$item_id." and DATE(sd.RecordDate) = '".$date."'
            GROUP BY 1;";
            $result=mysqli_query($dbc,$query);
            $row_cnt = $result->num_rows;

            if ($row_cnt>0){
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    $day_sales = ((float)$row['totalprice']);
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
            $query = "SELECT p.productID, SUM(sd.Price) AS 'totalprice'
            FROM gm_products p
            JOIN gm_salesdetails sd on p.ProductID = sd.ProductID
            JOIN gm_sales s on sd.SalesID = s.SalesID
            WHERE p.productID = ".$item_id." and DATE(sd.RecordDate) 
            between DATE_SUB('".$forecasted_dates[0]."', INTERVAL ".(365-$ind)." DAY) and '".$forecasted_dates[0]."'
            GROUP BY 1;";
            $result=mysqli_query($dbc,$query);
            $row_cnt = $result->num_rows;

            if ($row_cnt>0){
                while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
                {
                    $forecasted_sales = ((float)$row['totalprice']/(365-$ind));
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