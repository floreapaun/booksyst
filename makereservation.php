<?php 
    include("include/dbconfig.php");
    global $mysqli;
    //echo "cats";
    $return_arr = array();

    $room_id    = $_POST["room_id"]; 
    $client_phone  = $_POST["client_phone"];
    $start    = $_POST["start"];
    $end    = $_POST["end"];

    $query = "INSERT INTO reservation(room_id, client_phone, start, end) VALUES(?, ?, ?, ?)";
    if($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("isss", $room_id, $client_phone, $start, $end);
        $stmt->execute();
        $stmt->close();
    }
    
    $return_arr["message"] = "Rezervare in aprobare. Asteptati sa fiti contactat."; 
    echo json_encode($return_arr);
?>
    
     
