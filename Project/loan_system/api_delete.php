<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control_Allow-Methods: DELETE');
header('Access-Control_Allow-Headers: Access-Control_Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-with');
$data = json_decode(file_get_contents("php://input"),true);

$cust_name = $data['cname'];


include "config.php";
$sql = "DELETE FROM customer WHERE name = '{$cust_name}'";

if(mysqli_query($conn, $sql)){
	echo json_encode(array('message'=>'customer Record deleted.', 'status' => true));
}else{
	echo json_encode(array('message'=>'Customer Record not deleted.', 'status' => false));
}
?>