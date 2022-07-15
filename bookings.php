<?php

// Followign Restful standards, we set the content-type header as application/json so the 
// app can detect the type of data that is returned (in this case, so it parses it as JSON)
 
header('Content-Type: application/json');

// We assume a BookingController exists, which handles the model Booking that stores 
// booking related data: member name, date of the class.
// This BookingController has an update feature that saves this information in an existing object.

require_once('controller/BookingController.php');

if (isset($_GET['user_name']) && $_GET['user_name']!="" 
    && isset($_GET['date']) && $_GET['date']!="") {
    
    $booking = new BookingController();

    $result = array();
    
	$user_name = $_GET['user_name'];
	$date = $_GET['date'];
	
	$booking_array = array(
                    'user_name' => $_GET['user_name'],
                    'date'      => $_GET['date']
                );
                
     $result = $booking->update($booking_array);
                
	 if($result){ 
	     response(200,"Class booked");
	 }
	
} else {
	response(400,"Invalid Request: not enough data");
}


function response($response_code,$response_desc){

	$response['response_code'] = $response_code;
	$response['response_desc'] = $response_desc;
	
	$json_response = json_encode($response);
	
	echo $json_response;
}
?>
