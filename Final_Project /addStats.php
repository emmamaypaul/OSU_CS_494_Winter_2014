<?php
ini_set('display_errors', 'On');//checks errors
session_start();
if(!(isset($_SESSION['username'])))
{
	header("Location: http://web.engr.oregonstate.edu/~paule/CS_494_W14/Final_Project.html");
}
		$username =  $_SESSION['username'];
	

//new instance of mysqli class giving host name, database name, user name, and password 
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","paule-db","XXXXXXXXXXX","paule-db");
	if(!$mysqli || $mysqli->connect_errno) //if if mysqli doesn't exist or if there is a connection error
	{ 
		echo "Connection error ".$mysqli->connect_errno. " " .$mysqli->connect_error;
	}
	

if(!(isset($_SESSION['username'])))
{
	header("Location: http://web.engr.oregonstate.edu/~paule/CS_494_W14/Final Project.html");
}
		$username =  $_SESSION['username'];
	//make prepared statement using the mysqli objects prepare method 	
	//prepare will return false on an error and the error should be stored in the mysqli object 
	//step below returns statement object 
	
	
if(isset($_POST["stats"]) && !empty($_POST["stats"]) && isset($_POST["op"]) && !empty($_POST["op"]))
{
	$stats = $_POST["stats"];
	$op = $_POST["op"];
	
	if(!($tblInpt = $mysqli->prepare("INSERT INTO Stats (points, opponent,id) values (?, ?, (SELECT BBall_user_password.id FROM BBall_user_password WHERE BBall_user_password.user_name =?))")))
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
		
		
	//bind user supplied data to variables, "sis" means string, integer, string, with their respective variables they are assigned to
	//we need to bind the user info to variables in case someone ever tried in inject harmful code, binding their text to a variable prevents hacking
	if(!($tblInpt->bind_param("sss", $stats, $op, $username)))
		echo "Binding parameters failed: (".$mysqli->errno.") ".$msqli->error;

	//execute the statement, returns true on success or FALSE on failure, errors stored in the statement object 
	//executing the variables and prepared table, executes the insert into from prepare 
	if(!$tblInpt->execute())
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	
	//closing after execution because if you don't close it and have unfetched rows you will get erros trying to make a new prepared statement
	$tblInpt->close();
	
	echo "Stats Added";
	
}


$mysqli->close();

?>

<br><br>
<form action="http://web.engr.oregonstate.edu/~paule/CS_494_W14/homepage.php" method="POST">
<div><input type="submit" value="Go Back"></div>
</form>
