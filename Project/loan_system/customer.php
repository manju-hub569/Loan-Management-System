<html lang="en">
	<head>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" 
		integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/admin.css">
		<link rel="stylesheet" href="css/navbar.css">
		<link rel = "stylesheet" href = "css/Dataset.css">
		<link rel = "stylesheet" href = "css/info.css">
	</head>
<body>
    <!--nav-->
    <nav>
        <div class="logo">
		<input type = "checkbox" id = "openclose" onclick="toggle()">
            <label><a href="#">Loan Management System</a></label>
        </div>
		<div class = "navigators">
			<ul>
				<li><a href="customer.php">Customer</a></li>
				<li><a href="index.php">Administrator</a></li>
			</ul>
		</div>
    </nav>
<div id = "modal">
					<div id = "modal-form">
					<h2>My Profile</h2>
					<form id = "addform">
<div class = "input-tag">Name
<label><input type = "text" name = "cname" id = "edit-name" disabled></label>
Loan Type
<label><input type = "text" name = "cloantype" id = "edit-loantype" disabled></label>
</div>
<div class = "input-tag">Loan amount
<label><input type = "number" name = "cloanamount" id = "edit-loanamount" disabled></label>
Duration(month)
<label><input type = "number" name = "cduration" id = "edit-duration" disabled></label>
</div>
<div class = "input-tag">Interest
<label><input type = "number" name = "cinterest" id = "edit-interest" disabled></label>
Start Date
<label><input type = "date" name = "cstart" id = "edit-start" disabled></label>
</div>
<div class = "input-tag">
End Date
<label><input type = "date" name = "cend" id = "edit-end" disabled></label>
Status
<label><input type = "text" name = "cstatus" id = "edit-status" disabled></label>
</div>
</form>
					<div id="close-btn">x</div>
					</div>
				</div>
    <!--form-->
	<main>
	<div class = "border">
		<div class = "head">Customer Login</div>
			<div class = "elements">
				<form id = "authform" name = "authform">
				<input type = "text" name = "cname" id = "cname" placeholder = "UserName" required><br/>
				<input type = "password" name = "cloanamount" id = "cpass" placeholder = "Password" required><br/>
				<input type = "submit" name = "submit" id = "sub" value = "Login" onclick = "authfrm();">
			</div>
		</div>
	</main>
	<script>
 function authfrm(){
	 var a = document.getElementById("cname").value;
	 var b = document.getElementById("cpass").value;
	 if(a == "" && b == ""){
		 alert("Please Fill the credentials");
	 }
 }
$(document).ready(function(){
	function jsonData(targetForm){
	var arr = $(targetForm).serializeArray();
	var obj = {};
	for(var a = 0; a < arr.length; a++){
		obj[arr[a].name] = arr[a].value;
	}
	var json_string = JSON.stringify(obj);
	return json_string;
}
$("#sub").on("click",function(e){
	e.preventDefault();

	var jsonOb = jsonData("#authform");
	//console.log(jsonOb);
	$.ajax({
		url:'http://localhost/loan_system/api_fetch_profile_data.php',
		type:"POST",
		data:jsonOb,
		success : function(data){
			if(data.status == false){
				alert("Login Fail");
			}else{
							alert("Loged in Successfull");
							$("#modal").show();
							$("#edit-name").val(data[0].name);
							$("#edit-loantype").val(data[0].loantype);
							$("#edit-loanamount").val(data[0].loanamount);
							$("#edit-duration").val(data[0].duration);
							$("#edit-interest").val(data[0].interest);
							$("#edit-start").val(data[0].start);
							$("#edit-end").val(data[0].end);
							$("#edit-total").val(data[0].total);
							$("#edit-status").val(data[0].status);
							console.log($("#edit-status").val(data[0].status));
			}

		}
			
		});
	});
					$("#close-btn").on("click",function(){
					$("#modal").hide();
				});
});
	</script>
</body>
</html>