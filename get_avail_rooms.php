<?php 
    include("include/dbconfig.php");
    global $mysqli;
    //echo "cats";
    $return_arr = array();
    $room_arr   = array();

    $book_startdate  = $_POST["start"];
    $book_enddate    = $_POST["end"];

    $bookstart_year  = (int)substr($book_startdate, 0, 4); 
    $bookstart_month = (int)substr($book_startdate, 5, 2);
    $bookstart_day   = (int)substr($book_startdate, -2);

    $bookend_year    = (int)substr($book_enddate, 0, 4); 
    $bookend_month   = (int)substr($book_enddate, 5, 2);
    $bookend_day     = (int)substr($book_enddate, -2);
  
    //echo $book_startdate . " " . $book_enddate . "<br>"; 
    //echo $bookstart_day . " " . $bookend_day . "<br>"; 
    
    function calculate_days()
    {
        $days_cnt = 0;
        
        global $bookstart_year, $bookend_year,
               $bookstart_month, $bookend_month,
               $bookstart_day, $bookend_day; 

        if($bookstart_year == $bookend_year) {
            while($bookstart_month < $bookend_month) {
                //calculate current month days
                //each month is considered to have 31 days
                while($bookstart_day < 31) {
                    $days_cnt++;
                    $bookstart_day++;
                }
                
                //we must calculate the days of next 
                //month so we start from the first day of 
                //the month
                $bookstart_day = 0;
                $bookstart_month++;
            }
                
            if($bookstart_month == $bookend_month) {
                 
                //calculate current month days
                while($bookstart_day < $bookend_day) {
                    $days_cnt++;
                    $bookstart_day++;
                }
            }
        }
        if($bookstart_year < $bookend_year) {
            while($bookstart_month != $bookend_month) {
                //calculate current month days
                //each month is considered to have 31 days
                while($bookstart_day < 31) {
                    $days_cnt++;
                    $bookstart_day++;
                }
                
                //we must calculate the days of next 
                //month so we start from the first day of 
                //the month
                $bookstart_day = 0;
                if($bookstart_month == 12)
                    $bookstart_month = 1;
                else
                    $bookstart_month++;
                
            }
                
            if($bookstart_month == $bookend_month) {

                //calculate current month days
                while($bookstart_day < $bookend_day) {
                    $days_cnt++;
                    $bookstart_day++;
                }
            }
        }

        //echo "zile in cazare: " . $days_cnt . "<br>";
        return $days_cnt;
    }

    function form_text(&$type, &$bath, &$ac, &$pet)
    {
        if ($type == 1)
            $type = strval($type) . " camera";
        else
            $type = strval($type) . " camere";
        if(!strcmp($bath, "public"))
            $bath = "baie publica";
        else
            $bath = "baie privata";
        
        /*
        if($ac)
            $ac = "cu aer conditionat";
        else
            $ac = "fara aer conditionat";
        */
        /*
        if($pet)
            $pet = "animal companie";
        else
            $pet = "fara animal companie";
        */ 
    }

    
     //for each room we check if it is available
     //for renting during the date range provided
     //by the client
     
    $inhouse_days = calculate_days();
    //echo "AAAAA: " . $bookstart_month . "<br>";
    for($i=1; $i<=15; $i++) {
 
        //we get all the reservations of the room
        //with id $i
        $query = "SELECT reserv_id, start, end FROM reservation WHERE room_id=?";
        //echo "i=" . $i . "<br>";
        $roomIsAvailable = false;
        $bookStartExists = false;
        if($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("i", $i);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($reserv_id, $start, $end);
            
            $check = false;
            
            //room is free and rent is made between another reservations 
            //if END DATE from reservation row < BOOKING START DATE
            //and if START DATE from next reservation row > BOOKING END DATE
            while($stmt->fetch()) {

                $rowstart_year  = (int)substr($start, 0, 4);
                $rowstart_month = (int)substr($start, 5, 2);
                $rowstart_day   = (int)substr($start, -2);

                $rowend_year    = (int)substr($end, 0, 4);
                $rowend_month   = (int)substr($end, 5, 2);
                $rowend_day     = (int)substr($end, -2);
                
                //echo "start row: YYYY - MM - DD : " . $rowstart_year . 
                  "-" .  $rowstart_month . "-" . $rowstart_day . "<br>"; 
                //echo "end row: YYYY - MM - DD : " . $rowend_year . "-" . 
                    $rowend_month ."-" . $rowend_day . "<br>"; 
                
                if(!strcmp($book_startdate, $start)) {
                    $bookStartExists = true;
                    $roomIsAvailable = false;
                    break;
                }

                if(!$check) {
                    if($bookstart_year > $rowend_year) {
                        //echo "\$check got true" . "<br>";
                        $check = true;
                    }
                    if($bookstart_year == $rowend_year) {
                        if($bookstart_month > $rowend_month) {
                            //echo "\$check got true" . "<br>";
                            $check = true;
                        }
                        if($bookstart_month = $rowend_month) {
                            if($bookstart_day >= $rowend_day) {
                                //echo "\$check got true" . "<br>";
                                $check = true;
                            }
                        }
                    }
                } 
                else {
                    if($rowstart_year > $bookend_year) {
                        $roomIsAvailable = true;
                        //echo "\$roomIsAvailable got true" . "<br>";
                        break;
                    }
                    if($rowstart_year == $bookend_year) {
                        if($bookend_month < $rowstart_month) {
                            $roomIsAvailable = true;
                            //echo "\$roomIsAvailable got true" . "<br>";
                            break;
                        }
                        if($bookend_month == $rowstart_month) {
                            if($bookend_day <= $rowstart_day) {   
                                $roomIsAvailable = true;
                                //echo "\$roomIsAvailable got true" . "<br>";
                                break;
                             } 
                        }
                    }
                }   
            }

            //if reservation not exists and
            //if we can't put booking between reservation rows
            //we put it after all rows
            if(!$bookStartExists) {
                if( ($check && !$roomIsAvailable)
                    || (!$check && !$roomIsAvailable))
                    $roomIsAvailable = true;
            }

            $stmt->free_result(); 
            $stmt->close();
        } 
        
        if($roomIsAvailable) {
            
            $query = "SELECT room_id, type, bath, ac, pet, 
                      price FROM room WHERE room_id=?";
            if($stmt = $mysqli->prepare($query)) {
                $stmt->bind_param("i", $i);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($room_id, $type, $bath, $ac, $pet, 
                                   $price_per_day);
                $stmt->fetch();
                   
                //echo $room_id . "XX<br>";
                //$total_price = 0;
                $total_price = $price_per_day * $inhouse_days;
                form_text($type, $bath, $ac, $pet);
                //echo $type . "<br>" . $bath . "<br>";
                array_push($room_arr, $room_id, $type, $bath, $ac, $pet,
                           $price_per_day, $total_price);
                $stmt->free_result(); 
                $stmt->close();
            }
        }
    }

    $return_arr["room_arr"] = $room_arr;
    echo json_encode($return_arr);
?> 
