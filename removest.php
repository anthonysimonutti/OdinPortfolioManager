
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

	include("config.php");

	function RemoveStock()
	{
		session_start();
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($mysqli->connect_errno)
		{
			$_SESSION['Message'] = "MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}";
			exit();
		}

		if(isset($_POST["stockToDelete"]))
		{
			$aStocks = $_POST['stockToDelete'];

			if(empty($aStocks))
			{
				$_SESSION['Message'] = "You didn't select any stocks to delete!";
			}
			else
			{
				$n = count($aStocks);

				for($i=0; $i < $n; $i++)
				{
					$sql = "DELETE FROM StockData WHERE StockID = '{$aStocks[$i]}'";
					$result = $mysqli->query($sql);
					if($result)
					{
						$_SESSION['Message'] .= "Successfully deleted stock[$aStocks[$i]]! <br>";
						//header('Location: mainpage.php');
					}
					else
					{
						$_SESSION['Message'] .= "Failed to delete stock[$aStocks[$i]]! <br>";
						//header('Location: removeportfolio.php');
					}
				}
				header('Location: mainpage.php');
			}
		}
		else
		{
			$_SESSION['Message'] = "Failed to access checkboxes.";
			header('Location: removestock.php');
		}
	}


	if(isset($_POST['submit']))
	{
		RemoveStock();
	}
?>
