
<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

	include("config.php");

	function AddStock()
	{
		session_start();
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if($mysqli->connect_errno)
		{
			$_SESSION['Message'] = "MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}";
			exit();
		}

		if(isset($_POST["portToAdd"]))
		{
			$aPorts = $_POST['portToAdd'];

			if(empty($aPorts))
			{
				$_SESSION['Message'] = "You didn't select any portfolios to add to!";
			}
			else
			{
				$n = count($aPorts);

				for($i=0; $i < $n; $i++)
				{
					$exists = 0;
					$sql1 = "SELECT * from StockData WHERE PortfolioID = '{$aPorts[$i]}' AND s0 = '{$_POST['InputName']}'";
					$result = $mysqli->query($sql1);
					if($result->num_rows != 0)
					{
						$exists = 1;
					}

					if($exists == 1)
					{
						$_SESSION['Message'] .= "Stock already exists within portfolio[$aPorts[$i]]! <br>";
					}
					else
					{
						$sql2 = "INSERT INTO StockData (PortfolioID, s0) VALUES ('{$aPorts[$i]}', '{$_POST['InputName']}')";
						if($mysqli->query($sql2))
						{
							$_SESSION['Message'] .= "Successfully added stock to portfolio[$aPorts[$i]]! <br>";
							// BUILD XML AND SAVE IT
						}
					}
				}

				$_SESSION['Ticker'] = $_POST['InputName'];
				$_SESSION['Market'] = $_POST['MarketName'];

				header('Location: selectfields.php');
				//header('Location: mainpage.php');
			}
		}
		else
		{
			$_SESSION['Message'] = "Failed to access checkboxes.";
			header('Location: addstock.php');
		}
	}


	if(isset($_POST['submit']))
	{
		AddStock();
	}
?>
