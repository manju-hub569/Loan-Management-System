<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control_Allow-Methods: POST');
header('Access-Control_Allow-Headers: Access-Control_Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-with');

$data = json_decode(file_get_contents("php://input"),true);

$name = $data['cname'];
$loantype = $data['cloantype'];
$loanamount = $data['cloanamount'];
$duration = $data['cduration'];
//duration coding
$months = $duration * 30;
//End code
$interest = $data['cinterest'];
$start = $data['cstart'];
//End date coding
$add_days = date('Y-m-d', strtotime($start.'+'.$months.'days'));
$data['cend'] = $add_days;
//code End
$end = $data['cend'];
 //total amount coding
 
 $total_amount = $loanamount + $interest * $months;
 $data['ctotal'] = $total_amount;
 //End Code
$total = $data['ctotal'];
$status = $data['cstatus'];


include "config.php";
$sql = "INSERT INTO customer(name,loantype,loanamount,duration,interest,start,end,total,status) VALUES ('{$name}','{$loantype}',{$loanamount},{$duration},{$interest},'{$start}','{$end}',{$total},'{$status}')";

if(mysqli_query($conn, $sql)){
	echo json_encode(array('message'=>'customer Record inserted.', 'status' => true));
}else{
	echo json_encode(array('message'=>'customer Record Not inserted.', 'status' => false));
}
?>