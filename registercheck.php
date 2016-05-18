
	<!-- <script type="text/javascript">alert("Username already in use!");</script>
	<meta http-equiv="refresh" content="0; ../Odin/register.html" /> -->
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
			//echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
			exit();
		}

		$username = $_POST['user'];
		$firstname = $_POST['first'];
		$lastname = $_POST['last'];
		$email = $_POST['email'];
		$password = $_POST['pass'];

		$exists = 0;
		$result = $mysqli->query("SELECT Username from UserData WHERE Username = '{$username}' LIMIT 1");
		if($result->num_rows == 1)
		{
			$exists = 1;
		}

		if($exists == 1)
		{
			$_SESSION['Message'] = "Username already exists!";
			header('Location: register.php');
			//echo "<p>Username already exists!</p>";
		}
		else
		{
			$sql = "INSERT INTO UserData (Username, FirstName, LastName, Email, Password) VALUES ('{$username}', '{$firstname}', '{$lastname}', '{$email}', '{$password}')";
			if($mysqli->query($sql))
			{
				$_SESSION['Message'] = "Successfully registered!";
				//echo "<p>Registered Successfully!</p>";
				header('Location: index.php'); //echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
			}
			else
			{
				$_SESSION['Message'] = "MySQL error no {$mysqli->errno} : {$mysqli->error}";
				//echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
				exit();
			}
		}
	}


	if(isset($_POST['submit']))
	{
		SignIn();
	}
?>
