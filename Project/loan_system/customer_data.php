<html lang="en">
	<head>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" 
		integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
		<link rel = "stylesheet" href = "css/Dataset.css">
		<link rel="stylesheet" href="css/navbar.css">
		<link rel = "stylesheet" href = "css/sidebar.css">
		<link rel = "stylesheet" href = "css/info.css">
		<style>
			.edit-btn{
				width:50px;
				height:50px;
				font-size:15px;
				background-color:orange;
				border:1px solid orange;
				color:white;
				outline:none;
				cursor:pointer;
			}
			.delete-btn{
				width:50px;
				height:50px;
				font-size:15px;
				background-color:red;
				border:1px solid red;
				color:white;
				outline:none;
				cursor:pointer;
			}
		</style>
	</head>
	<body>
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
	<div class = "Dataset">
	<table border = "1" class = "table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Loan Type</th>
							<th>Loan Amount
							<th>Duration(month)</th>
							<th>Interest</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Total</th>
							<th>Status</th>
							<th>Edit</th>
						</tr>
						<tbody id="load-table">
	
						</tbody>
				</table>
				<div id = "modal">
					<div id = "modal-form">
					<h2>Edit Form</h2>
					<form id = "addform">
<div class = "input-tag">
Name
<label><input type = "text" name = "cname" id = "edit-name" placeholder = "Enter name"></label>
Loan Type
<label><input type = "text" name = "cloantype" id = "edit-loantype" placeholder = "Enter Loan Type"></label>
</div>
<div class = "input-tag">
Amount
<label><input type = "number" name = "cloanamount" id = "edit-loanamount" placeholder = "Enter Loan amount"></label>
Duration
<label><input type = "number" name = "cduration" id = "edit-duration" placeholder = "Enter Duration In Month"></label>
</div>
<div class = "input-tag">
Interest
<label><input type = "number" name = "cinterest" id = "edit-interest" placeholder = "Enter Interest"></label>
Start Date
<label><input type = "date" name = "cstart" id = "edit-start"></label>
</div>
<div class = "input-tag">
		Status<select id = "edit-status" name = "cstatus" style = "width:200px;height:30px;font-size:20px">
			<option value = "New">New</option>
		</select>
</div>
<div class = "btn">
	<input type = "submit" id = "save-btn">
</div>
</form>
					<div id="close-btn">x</div>
					</div>
				</div>
				<script>
				$(document).ready(function(){
					function loadTable(){
						$("#load-table").html("");
						$.ajax({
							url:'http://localhost/loan_system/api_fetch_data.php',
							type:"GET",
							success:function(data){
								if(data.status == false){
									$("#load-table").append("<tr><td colspan = '8'><h2>"+data.message+"</h2></td></tr>");
								}else{
									$.each(data, function(key, value){
										$("#load-table").append("<tr>"
																+"<td>" + value.name + "</td>"
																+"<td>" + value.loantype + "</td>"
																+"<td>" + value.loanamount + "</td>"
																+"<td>" + value.duration + "</td>"
																+"<td>" + value.interest + "</td>"
																+"<td>" + value.start + "</td>"
																+"<td>" + value.end + "</td>"
																+"<td>" + value.total + "</td>"
																+"<td>" + value.status + "</td>"+
																"<td><button class='edit-btn' data-eid='"+value.name+"'>Edit</button></td>"+
																"</tr>");
									});
								}
							}
						});
					}
				loadTable();
				$(document).on("click",".edit-btn", function(){
					$("#modal").show();
					var custname = $(this).data("eid");
					var row = this;
					var ob = {cname : custname},
					 myJSON = JSON.stringify(ob);
					 //console.log(myJSON);
					$.ajax({
						url:'http://localhost/loan_system/api_fetch_single_data.php',
							type:"POST",
							data:myJSON,
							success : function(data){
							//console.log(data);
							$("#edit-name").val(data[0].name);
							$("#edit-loantype").val(data[0].loantype);
							$("#edit-loanamount").val(data[0].loanamount);
							$("#edit-duration").val(data[0].duration);
							$("#edit-interest").val(data[0].interest);
							$("#edit-start").val(data[0].start);
							$("#edit-end").val(data[0].end);
							$("#edit-total").val(data[0].total);
							$("#edit-status").val(data[0].status);
							if(data[0].status == "Approved"){
								alert("this customer information only change by Admin");
								$("#modal").hide();
							}else{
								$("#modal").show();
							}
						}
						
					});
				});
				$("#close-btn").on("click",function(){
					$("#modal").hide();
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
		url:'http://localhost/loan_system/api_update.php',
		type:"POST",
		data:jsonObj,
		success : function(data){
			
				$("#modal").hide();
				loadTable();
			$("addform").trigger("reset");
				
		}
			
		});
	});
});			//Edit

				</script>
		<div class = "side_list" id = "toggle_bar">
		<ul style = "margin:5px 0px;" id = "toggle_ul">
			<li><a href = "agent.php">Customer detail</a></li>
			<li><a href = "customer_data.php">customer data</a></li>
		</ul>
	</div>				
	</body>
