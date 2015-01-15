<!DOCTYPE html>
<html>
<head><title>CS 494 Final Project</title>
<meta charset="UTF-8">
<script src="jquery.min.js"></script>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

</head>
<body>
          <h2>Z day Login Page</h2>
			<form method="POST">
				<fieldset>
						<input type="text" id="username">
						<input type="password" id="password"><br>
						<input type="button" value="Login" onclick="validate()">
				</fieldset>
			</form>
 

<form action="http://web.engr.oregonstate.edu/~paule/CS_494_W14/createUser.html" method="POST">
<input type="submit" value="Create Account">	
</form>	

<div id="error"></div>

<script>
function validate() 
{

	var password = $("#password").val();
	var username = $("#username").val();
	 var url = "http://web.engr.oregonstate.edu/~paule/CS_494_W14/valLogin.php";

	 	$.ajax({
			 url: url,
             type:"POST",
             data:{"username":username, "password":password},
             success:successFunction, error:errorFunction});
			 
			 
			 function successFunction(data)
             {      
				if(data == 'Fail')
				{
					alert("Login attempt fail. Please try again.");
				}
				else //if login is successful, redirects to home page
				{	
					window.location='http://web.engr.oregonstate.edu/~paule/CS_494_W14/zHome.php';
				
				}
				
				
			 }
			 function errorFunction(jqXHR, textStatus, errMsg)
			 {
				var errNum = jqXHR.status; //gives you error number 
				var msg1 = "The requested page was: ";
				var msg2 = "The error number returned was: ";
				var msg3 = "The error message was: ";
				$("#error").html(msg1+lst+"<BR>"+msg2+errNum+"<BR>"+msg3+errMsg);
				$("#error").show();
			 }
			 
 
}
</script>

</body>
</html>
