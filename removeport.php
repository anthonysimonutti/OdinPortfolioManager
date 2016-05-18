
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

	include("config.php");

	function RemovePortfolio()
	{
		session_start();
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($mysqli->connect_errno)
		{
			$_SESSION['Message'] = "MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}";
			exit();
		}

		if(isset($_POST["portToDelete"]))
		{
			$aPorts = $_POST['portToDelete'];

			if(empty($aPorts))
			{
				$_SESSION['Message'] = "You didn't select any portfolios to delete!";
			}
			else
			{
				$n = count($aPorts);

				for($i=0; $i < $n; $i++)
				{
					$sql = "DELETE FROM PortfolioData WHERE PortfolioID = '{$aPorts[$i]}'";
					$result = $mysqli->query($sql);
					if($result)
					{
						$_SESSION['Message'] .= "Successfully deleted portfolio[$aPorts[$i]]! <br>";
						//header('Location: mainpage.php');
					}
					else
					{
						$_SESSION['Message'] .= "Failed to delete portfolio[$aPorts[$i]]! <br>";
						//header('Location: removeportfolio.php');
					}
				}
				header('Location: mainpage.php');
			}
		}
		else
		{
			$_SESSION['Message'] = "Failed to access checkboxes.";
			header('Location: removeportfolio.php');
		}
	}


	if(isset($_POST['submit']))
	{
		RemovePortfolio();
	}
?>
