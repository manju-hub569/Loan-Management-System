<html>
	<head>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" 
		integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Slabo+27px&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="css/info.css">
		<link rel="stylesheet" href="css/navbar.css">
		<link rel = "stylesheet" href = "css/sidebar.css">
	</head>
		<body>
		<!--nav-->
    <nav>
        <div class="logo">
            <label><a href="#">Loan Management System</a></label>
        </div>
<div class = "navigators">
			<ul>
				<li><a href="index.php">Logout</a></li>
			</ul>
		</div>
    </nav>
			<div class = "side_list" id = "toggle_bar">
		<ul style = "margin:5px 0px;" id = "toggle_ul">
			<li><a href = "agent.php">customer detail</a></li>
			<li><a href = "customer_data.php">customer data</a></li>
		</ul>
	</div>
<div class = "brdr" style = "box-shadow:0px 0px 2px black">
<form id = "addform">
<div class = "input-tag">
Name
<label><input type = "text" name = "cname" id = "cname" placeholder = "Enter name" required></label>
Loan Type
<label><input type = "text" name = "cloantype" id = "cloantype" placeholder = "Enter Loan Type" required></label>
</div>
<div class = "input-tag">
Amount
<label><input type = "number" name = "cloanamount" id = "cloanamount" placeholder = "Enter Loan amount" required></label>
Duration
<label><input type = "number" name = "cduration" id = "cduration" placeholder = "Enter Duration In Month" required></label>
</div>
<div class = "input-tag">
Interest
<label><input type = "number" name = "cinterest" id = "cinterest" placeholder = "Enter Interest" required></label>
Start Date
<label><input type = "date" name = "cstart" id = "cstart" required></label>
</div>
<div class = "input-tag">
		<label style = "font-size:20px;color:grey">Status</label>
		<select id = "edit-status" name = "cstatus" style = "width:200px;height:30px;font-size:20px">
			<option value = "New">New</option>
		</select>
</div>
<div class = "btn">
	<input type = "submit" id = "save-btn" onclick = "send();" style = "color:white;background-color:green;border:1px solid green;cursor:pointer;">
</div>
</form>
</div>
<script>
	$(document).ready(function(){
		if(("#addform") == ""){
			alert("Fill the form");
		}
	});
function jsonData(targetForm){
	var arr = $(targetForm).serializeArray();
	var obj = {};
	for(var a = 0; a < arr.length; a++){
		obj[arr[a].name] = arr[a].value;
	}
	var json_string = JSON.stringify(obj);
	return json_string;
}
$("#save-btn").on("click",function(e){
	e.preventDefault();
	var jsonObj = jsonData("#addform");
	//console.log(jsonObj);
	$.ajax({
		url:'http://localhost/loan_system/api_insert.php',
		type:"POST",
		data:jsonObj,
		success : function(data){
			if(data.status == false){
				alert("Failed To Insert Information");
			}else{
				alert("Insert Successfull");
			}
		}
	});
});
</script>
</html>