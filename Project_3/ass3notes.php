<!DOCTYPE html>
<html>
<head><title>Assignment 3 - Database Interaction</title>
<meta charset="UTF-8">
</head>
<body>

<form method="POST">
<div>Favorite Country: <input type="text" name="countryName"></div>
<div>Number of times visited: <input type="text" name="numVisited"></div>
<div>Dream travel destination: <input type="text" name="dreamCountry"></div>
<input type="submit">
</form>

<?php
ini_set('display_errors', 'On');//checks errors

//new instance of mysqli class giving host name, database name, user name, and password 
$mysqli = new mysqli("oniddb.cws.oregonstate.edu","paule-db","XXXXXXXXXXX","paule-db");
	if(!$mysqli || $mysqli->connect_errno) //if if mysqli doesn't exist or if there is a connection error
	{ 
		echo "Connection error ".$mysqli->connect_errno. " " .$mysqli->connect_error;
	}
	else 
	{
		echo "Connection success. Table was successfully created.";
	}
	

if(isset($_POST["countryName"]) && !empty($_POST["countryName"]) && isset($_POST["numVisited"]) && !empty($_POST["numVisited"]) && isset($_POST["dreamCountry"]) && !empty($_POST["dreamCountry"]))
{	//if the variables for the table are set and not empty, then we will prepare, bind, execute, and close
	

	//make prepared statement using the mysqli objects prepare method 	
	//prepare will return false on an error and the error should be stored in the mysqli object 
	//step below returns statement object 
	if(!($tblInpt = $mysqli->prepare("INSERT INTO CountryTable(countryName, numVisited, dreamCountry) VALUES(?,?,?)")))
		echo "Preparation failed: (".$mysqli->errno.") ".$msqli->error;
		
		$string1 = $_POST["countryName"];
		$num = $_POST["numVisited"];
		$string2 = $_POST["dreamCountry"];
		
	//bind user supplied data to variables, "sis" means string, integer, string, with their respective variables they are assigned to
	//we need to bind the user info to variables in case someone ever tried in inject harmful code, binding their text to a variable prevents hacking
	if(!($tblInpt->bind_param("sis", $string1, $num, $string2)))
		echo "Binding parameters failed: (".$mysqli->errno.") ".$msqli->error;

	//execute the statement, returns true on success or FALSE on failure, errors stored in the statement object 
	//executing the variables and prepared table, executes the insert into from prepare 
	if(!$tblInpt->execute())
		echo "Execution failed: (".$mysqli->errno.") ".$mysqli->error;
	
	//closing after execution because if you don't close it and have unfetched rows you will get erros trying to make a new prepared statement
	$tblInpt->close();
	
}

$robot = "robot";
	
	
//reference: http://stackoverflow.com/questions/18299405/php-get-the-last-row-in-database-using-mysql
//reference: http://stackoverflow.com/questions/1765861/how-to-get-last-10-records-form-sql-table-in-asc-order
$data = $mysqli->query("SELECT * FROM CountryTable ORDER BY ID DESC LIMIT 10");
$table = "<table border='1'>";
while($rowInfo = $data->fetch_row()) //while there are rows to fetch 
{	
	$table = $table."<tr><td>".$rowInfo[1]."</td><td>".$rowInfo[2]."</td><td>".$rowInfo[3]."</td></tr>";

	//count for number of times robot is in table, reference: http://us2.php.net/manual/en/function.substr-count.php
	$numRobot = substr_count($table, $robot);
	
}
$table= $table."</table>"; //add the closing html tag of the table to the table info

echo $table; //prints the table 

echo "The substring ".$robot." appears ".$numRobot." times";



?>
</body>
</html>
















