<?php
session_start();
ini_set('display_errors', 'On'); //error report

if(!(isset($_SESSION['username'])))
{
	header("Location: http://web.engr.oregonstate.edu/~paule/CS_494_W14/Final_Project.html");
}
		$username =  $_SESSION['username'];
		
//Connects to the database
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","paule-db","nOpoDr2G8grzrWxj","paule-db");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}

?>


<!DOCTPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http:/www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">


<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
        <style>
          body { background: orange; }
		  .center-table
{
  margin: 0 auto !important;
  float: none !important;
}
        </style>
</head>
<body>
<div class="input-group">
<form action="http://web.engr.oregonstate.edu/~paule/CS_494_W14/addStats.php" method="POST">
<div style="text-align:center;"><font color="blue"><h4>Add Points and Opponent to your Stats Table:</h4></div>
<input type="text" class="form-control" placeholder="Personal Points"  name="stats">
<input type="text" class="form-control" placeholder="Opponent Team Name" name="op"><br>
<input type="submit" value="Add Stats" class="btn btn-success">
</form>
</div>


<?php

if(!($stmt = $mysqli->prepare("SELECT Stats.points AS points, Stats.opponent AS opponent FROM Stats
INNER JOIN BBall_user_password ON BBall_user_password.id = Stats.id
WHERE BBall_user_password.user_name = '$username'"))){
    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
}

if(!$stmt->execute()){
    echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}
if(!$stmt->bind_result($points, $opponent)){
    echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
}

$table = "<table class='span5 center-table'><style>table , th, td
{
border-collapse:collapse;
border: 1px solid black;
}
</style>
";
	$table=$table."<tr><td><h2>Personal Points</h2></td><td><h2>Opponent</h2></td></tr>";

while($stmt->fetch()){
	$table= $table."<tr><td>" . $points . "</td><td>" . $opponent . "</td></tr>";
}


	$table = $table."</table></div>";
	echo $table;
	
	
	$mysqli->close();


?>

</body>
</html>

