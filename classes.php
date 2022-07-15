<?php

 // Followign Restful standards, we set the content-type header as application/json so the 
 // app can detect the type of data that is returned (in this case, so it parses it as JSON)
 
header('Content-Type: application/json');

// We assume a ClassController exists, which handles the model Class that stores 
// class related data: name, start date, end date, capacity.
// This ClassController has an update feature that saves this information in an existing object.

require_once('controller/ClassController.php');

if (isset($_GET['class_name']) && $_GET['class_name']!=""
    && isset($_GET['start_date']) && $_GET['start_date']!="" 
    && isset($_GET['end_date']) && $_GET['end_date']!=""
    && isset($_GET['capacity']) && $_GET['capacity']!="") {
    
    $class = new ClassController();

    $result = array();
    
	$class_name = $_GET['class_name'];
	$start_date = $_GET['start_date'];
	$end_date = $_GET['end_date'];
	$capacity = $_GET['capacity'];

	$class_array = array(
                    'name'       => $_GET['class_name'],
                    'start_date' => $_GET['start_date'],
                    'end_date'   => $_GET['end_date'],
                    'capacity'   => $_GET['capacity'],
                );
                
     $result = $class->update($class_array);
                
	 if($result){ 
	     response(200,"Class created");
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
