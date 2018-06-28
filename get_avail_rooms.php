<?php 
    include("include/dbconfig.php");
    global $mysqli;
    //echo "cats";
    $return_arr = array();
    $room_arr   = array();

    $book_startdate = $_POST["start"];
    $book_enddate   = $_POST["end"];
    $bookstart_month = (int)substr($book_startdate, 5, 2);
    $bookend_month   = (int)substr($book_enddate, 5, 2);
    $bookstart_day = (int)substr($book_startdate, -2);
    $bookend_day   = (int)substr($book_enddate, -2);
  
    //echo $book_startdate . $book_enddate . "<br>"; 
    
    /* for each room we must check if reservations
        are not made during date range
    */
    
    function calculate_price($price_per_day)
    {
        $total_price = -1;
        $days_cnt = 0;
        
        global $book_startdate, $book_enddate; 
        $bookstart_month = (int)substr($book_startdate, 5, 2);
        $bookend_month   = (int)substr($book_enddate, 5, 2);
        $bookstart_day = (int)substr($book_startdate, -2);
        $bookend_day   = (int)substr($book_enddate, -2);
        while($bookstart_month < $bookend_month)
        {
            //calculate current month days
            //each month is considered to have 31 days
            while($bookstart_day < 31)
            {
                $days_cnt++;
                $bookstart_day++;
            }
            
            //we must calculate the days of next 
            //month so we start from the first day of 
            //the month
            $bookstart_day = 0;
            $bookstart_month++;
        }
            
        if($bookstart_month == $bookend_month)
        {
             
            //calculate current month days
            while($bookstart_day < $bookend_day)
            {
                $days_cnt++;
                $bookstart_day++;
            }
        }
        //echo "zile in cazare: " . $days_cnt . "<br>";
        return $days_cnt * $price_per_day;
    }

    function form_text(&$type, &$bath, &$ac, &$pet)
    {
        if ($type == 1)
            $type = strval($type) . " camera";
        else
            $type = strval($type) . " camere";
        if(!strcmp($bath, "public"))
            $bath = "baie pe palier";
        else
            $bath = "baie privata";
        if($ac)
            $ac = "cu aer conditionat";
        else
            $ac = "fara aer conditionat";
        if($pet)
            $pet = "animal companie";
        else
            $pet = "fara animal companie"; 
    }

    for($i=1; $i<=15; $i++) 
    { 
    
    $query = "SELECT reserv_id, start, end FROM room WHERE room_id=?";


    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("i", $i);
        $stmt->execute();
        $stmt->store_result();
        $num_of_rows = $stmt->num_rows;
        $stmt->bind_result($reserv_id, $start, $end);
        
        $room_available = false;
        $check_start = false;
        while($stmt->fetch()) {
            
            $rowstart_month = (int)substr($start, 5, 2);
            $rowend_month   = (int)substr($end, 5, 2);
            $rowstart_day = (int)substr($start, -2);
            $rowend_day   = (int)substr($end, -2);
            
            if(!$check_start)
                if($bookstart_month >= $rowend_month) 
                    if($bookstart_day >= $rowend_day)
                        $check_start = true;
                
            //if END DATE FROM RESERVATION ROW < BOOKING DATE
            //we must check 
            //IF START DATE FROM NEXT ROW > BOOKING DATE
            if($check_start)
                if($bookstart_month <= $rowstart_month)
                    if($bookstart_day <= $rowstart_day)
                        if($bookend_month <= $rowstart_month)
                            if($bookend_day <= $rowstart_day)
                            {   
                                $room_available = true;
                                break;
                            }     
         }
   
            if(strlen($available)==1) 
            {   
                //echo $room_id . "XXX<br>";
                $total_price = calculate_price($price);
                form_text($type, $bath, $ac, $pet);
                echo $type . "<br>" . $bath . "<br>";
                array_push($room_arr, $room_id, $type, $bath, $ac, $pet,
                           $price, $total_price);
            }
            
        }
        $stmt->free_result(); 
        $stmt->close();
    }
    $return_arr["room_arr"] = $room_arr;
    echo json_encode($return_arr);
?> 
