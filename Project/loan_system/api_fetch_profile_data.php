<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
$data = json_decode(file_get_contents("php://input"),true);

$cust_name = $data['cname'];
$cust_loan = $data['cloanamount'];

include "config.php";
$sql = "SELECT * FROM customer WHERE name = '{$cust_name}' && loanamount = {$cust_loan}";
$result = mysqli_query($conn, $sql) or die("SQL QUERY FAILED");
if(mysqli_num_rows($result) > 0){
	$output = mysqli_fetch_all($result, MYSQLI_ASSOC);
	echo json_encode($output);
}else{
	echo json_encode(array('message'=>'No Record Found.', 'status' => false));
}
?>