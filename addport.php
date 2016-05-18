
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

	include("config.php");

	function AddPortfolio()
	{
		session_start();
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($mysqli->connect_errno)
		{
			$_SESSION['Message'] = "MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}";
			exit();
		}

		$pname = $_POST['pname'];
		$description = $_POST['description'];

		print($_SESSION['UserID']);

		$sql = "INSERT INTO PortfolioData (PortfolioName, OwnerID, Description) VALUES ('{$pname}', '{$_SESSION['UserID']}', '{$description}')";

		$result = $mysqli->query($sql);
		if($result)
		{
			$_SESSION['Message'] = "Successfully added portfolio!";
			header('Location: mainpage.php'); //echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
		}
		else
		{
			$_SESSION['Message'] = "Failed to add portfolio!";
			header('Location: addportfolio.php');
		}
	}


	if(isset($_POST['submit']))
	{
		AddPortfolio();
	}
?>
