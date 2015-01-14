<!DOCTYPE HTML>
<html>
<head><title>domath.php</title>
<meta charset="UTF-8">
</head>

<body>

<?php
session_start();
//reference used: http://stackoverflow.com/questions/17872848/how-to-call-php-function-from-submit-button
//ini_set('display_errors', 'On');


if(isset($_SESSION["username"]) && !empty($_SESSION["username"]) && isset($_SESSION["num1"]) && !empty($_SESSION["num1"]) && isset($_SESSION["num2"]) && !empty($_SESSION["num2"]))
    {
		echo "Welcome ".$_SESSION["username"].", lets math your numbers ".$_SESSION["num1"]." and ".$_SESSION["num2"]."!"."<br>";
	
	}
	else
	{
	//if there is no current session it will redirect to input.php
		 header('Location: http://web.engr.oregonstate.edu/~paule/CS_494_W14/input.php');
	}
?>



<br>
<form action="http://web.engr.oregonstate.edu/~paule/CS_494_W14/domath.php" method="GET">
<input type="submit" name="op" value="Addition"/>
<input type="submit" name="op" value="Subtraction"/>
<input type="submit" name="op" value="Multiplication"/>
<input type="submit" name="op" value="Division"/>
<br>

<?php
	if($_GET['op']=="Addition")
		{
			addition();
		}
		else if($_GET['op']=="Subtraction")
		{
			subtract();
		}
			else if($_GET['op'] == "Multiplication")
		{
			mult();
		}
		else if($_GET['op'] == "Division")
		{
			div();
		}

$niceMsg = "The answer of ";
$_SESSION["niceMsg"]=$niceMsg;
$goodbye = ". Pleasure doing math with you!";
$_SESSION["goodbye"]=$goodbye;
		

function addition()
{
	$sumTotal = $_SESSION['num1'] + $_SESSION['num2'];
	echo "<div><br>".$_SESSION["niceMsg"].$_SESSION['num1']." + ".$_SESSION['num2']." = ".$sumTotal.$_SESSION["goodbye"]."</div>";
}
function subtract()
{
	$subTotal = $_SESSION['num1'] - $_SESSION['num2'];
	echo "<div><br>".$_SESSION["niceMsg"].$_SESSION['num1']." - ".$_SESSION['num2']." = ".$subTotal.$sumTotal.$_SESSION["goodbye"]."</div>";
}
function mult()
{
	$multTotal = $_SESSION['num1'] * $_SESSION['num2'];
	echo "<div><br>".$_SESSION["niceMsg"].$_SESSION['num1']." * ".$_SESSION['num2']." = ".$multTotal.$sumTotal.$_SESSION["goodbye"]."</div>";
}
function div()
{
	$divTotal = $_SESSION['num1'] / $_SESSION['num2'];
	echo "<div><br>".$_SESSION["niceMsg"].$_SESSION['num1']." / ".$_SESSION['num2']." = ".$divTotal.$sumTotal.$_SESSION["goodbye"]."</div>";
}

?>

</form>
</body>
</html>

