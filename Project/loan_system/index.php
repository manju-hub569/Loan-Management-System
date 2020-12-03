<html lang="en">
	<head>
		<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
		<link rel="stylesheet" href= "css/admin.css">
		<link rel="stylesheet" href="css/navbar.css">
		<script>
			function validate() {
      
         if( document.myForm.name.value == "Agent" && document.myForm.pass.value == "Agent") {
		   location.href = "agent.php";
            document.myForm.name.focus() ;
            return false;
         }
         if( document.myForm.name.value == "Admin" && document.myForm.pass.value == "Admin") {
		   location.href = "cust_detail.php";
            document.myForm.name.focus() ;
            return false;
         }else{
			 alert("Wrong Credentials");
		 }
		          return( true );
      }
	  validate();
		</script>
	</head>
<body>
    <!--nav-->
    <nav>
        <div class="logo">
            <label><a href="#">Loan Management System</a></label>
        </div>
		<div class = "navigators">
			<ul>
				<li><a href="customer.php">Customer</a></li>
				<li><a href="index.php">Administrator</a></li>
			</ul>
		</div>
    </nav>
    <!--form-->
	
	<main>
	<div class = "border">
		<div class = "head"><label>Agent and Admin Login</label></div>
	<div class = "elements">
		<form name = "myForm" onsubmit = "return(validate());">
			<input type = "text" name = "name" id = "cname" placeholder = "UserName" required><br/>
			<input type = "password" name = "pass" id = "cpass" placeholder = "Password" required><br/>
			<input type = "submit" name = "submit" id = "sub" value = "Login">
		</form>
	</div>
		</div>
	</main>
</body>
</html>