<?php
    $arr_data = [];
    $zero = "0";
    require_once('../DataFetchers/mysql_connect.php');
    for ($x = 1; $x <= 12; $x++) {
        $query = "SELECT it.item_name, SUM(o.totalamt) as 'total_amount'  
                  FROM orders o 
                  join order_details od on o.ordernumber = od.ordernumber 
                  join items_trading it on it.item_id = od.item_id 
                  where it.item_id = ".$_POST['item_id']." and MONTH(o.order_date) = ".$x."
                  group by 1;";
        $result=mysqli_query($dbc,$query);

        $row_cnt = $result->num_rows;

        if ($row_cnt>0){
            while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
            {
                array_push($arr_data, (float)$row['total_amount']);
            }
        }
        else{
                array_push($arr_data, 0);
        }
    }
    echo json_encode($arr_data);
    ?>