
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

	include("config.php");

	function SignIn()
	{
		session_start();
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($mysqli->connect_errno)
		{
			$_SESSION['Message'] = "MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}";
			exit();
		}

		$username = $_POST['user'];
		$password = $_POST['pass'];

		$sql = "SELECT * from UserData WHERE Username LIKE '{$username}' AND Password LIKE '{$password}' LIMIT 1";
		$result = $mysqli->query($sql);
		if($result->num_rows == 1)
		{
			$row = $result->fetch_row();
			$_SESSION['UserID'] = $row[0];
			$_SESSION['Username'] = $row[1];
			$_SESSION['FirstName'] = $row[2];
			$_SESSION['LastName'] = $row[3];

			//echo $_SESSION['UserID'];
			//echo $_SESSION['Username'];
			//echo $_SESSION['FirstName'];
			//echo $_SESSION['LastName'];

			header('Location: mainpage.php'); //echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
		}
		else
		{
			$_SESSION['Message'] = "Incorrect username or password!";
			header('Location: index.php');
		}
	}


	if(isset($_POST['submit']))
	{
		SignIn();
	}
?>
