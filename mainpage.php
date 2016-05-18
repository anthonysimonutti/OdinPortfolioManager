
<!DOCTYPE html>
<?php session_start();
  $fieldsInfo = array('StockID','PortfolioID','time','After Hours Change (Realtime)','Annualized Gain','Ask','Ask (Realtime)','Ask Size','Average Daily Volume','Bid','Bid (Realtime)','Bid Size','Book Value Per Share','Change','Change in Percent','Change From Fiftyday Moving Average','Change From Two Hunderday Moving Average','Change From Year High','Change From Year Low','Change in Percent','Change in Percent (Realtime)','Change (Realtime)','Commission','Currency','Days High','Days Low','Days Range','Days Range (Realtime)','Days Value Change','Days Value Change (Realtime)','Dividend Pay Date','Trailing Annual Dividend Yield','Trailing Annual Dividend Yield in Percent','Diluted E P S','E B I T D A','E P S Estimate Current Year','E P S Estimate Next Quarter','E P S Estimate Next Year','Ex Dividend Date','Fiftyday Moving Average','Shares Flot','High Limit','Holdings Gain','Holdings Gain Percent','Holdings Gain Percent (Realtime)','Holdings Gain (Realtime)','Holdings Value','Holdings Value (Realtime)','Last Trade Date','Last Trade Price Only','Last Trade (Realtime) With Time','Last Trade Size','Last Trade Time','Last Trade With Time','Low Limit','Market Capitilization','Market Cap (Realtime)','More Info','Name','Notes','Oneyr Target Price','Open','Oder Book (Realtime)','P E G Ratio','P E Ratio','P E Ratio (Realtime)','Percent Change From FiftyDay Moving Average','Percent Change From Two Hundredday Moving Average','Change In Percent From Year High','Percent Change From Year Low','Previous Close','Price Book','Price E P S Estimate Current Year','Price E P S Estimate Next Year','Price Paid','Price Sales','Revenue','Shares Owned','Shares Outstanding','Short Ratio','Stock Exchange','Symbol','Ticker Trend','Trade Date','Trade Links','Trade Links Additional','Two Hundredday Moving Average','Volume','Year High','Year Low','Year Range');
  // Commented out for now due to Atom error that made everything else bright green :/
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Odin - Mainpage</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Odin Main Page
                    </a>
                </li>
                <li>
                  <a href="addportfolio.php">Add Portfolio</a>
                </li>
                <li>
                  <a href="removeportfolio.php">Remove Portfolio</a>
                </li>
                <li>
                  <a href="addstock.php">Add Stock</a>
                </li>
                <li>
                  <a href="removestock.php">Remove Stock</a>
                </li>
                <li>
                  <a href="generator.php">Graphical View</a>
                </li>
                <li>
		  <a href="#">Refresh</a>
		</li>
		<li>
                  <a href="index.php">Logout</a>
                </li>
            </ul>
        </div>


        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                      <a href="#menu-toggle" id="menu-toggle">
                        <img src="img/menu.svg" style="padding-left:30px;">
                      </a>
                    <!--<div class="dropdown" style="padding-right:50px;display:block;float:right;">
                      <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                        <img src="img/gear.png">
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-right" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Please Login</a></li>
                      </ul>
                    </div> -->

                      <form class="main">
                        <h2 class="form-signin-heading" style="color:red;"> <!-- style="color:red;font-size:160%;width:100%;text-align:left;"> -->
                          <?php if(!empty($_SESSION['Message'])) { echo $_SESSION['Message']; } ?>
                        </h2>
                        <?php unset($_SESSION['Message']); ?>

                        <h1 style="text-align: center;">Odin Portfolio Manager</h1>
                        <h1 style="font-size:20px">
                          Welcome
                          <?php if(!empty($_SESSION['FirstName'])) { echo $_SESSION['FirstName']; } ?>
                          <?php if(!empty($_SESSION['LastName'])) { echo $_SESSION['LastName']; } ?>!
                        </h1>

                        <?php
                          include("config.php");
                          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                          if($mysqli->connect_errno)
                          {
                            $_SESSION['Message'] = "MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}";
                            header('Location: mainpage.php');
                          }
                          else
                          {
                              //$_SESSION['Message'] = "MySQL connection established!";
                              //header('Location: mainpage.php');
                              if(!empty($_SESSION['UserID']))
                              {
                                $userid = $_SESSION['UserID'];

                                $portfolioSql = "SELECT * from PortfolioData WHERE OwnerID = '$userid'";
                                $portfolioResult = $mysqli->query($portfolioSql);
                                if($portfolioResult->num_rows != 0)
                                {
                                  while($portfolioRow = mysqli_fetch_row($portfolioResult))
                                  {
                                    $stockString = "";

                                    $stockSql = "SELECT * from StockData WHERE PortfolioID = '$portfolioRow[0]'";
                                    $stockResult = $mysqli->query($stockSql);
                                    if($stockResult->num_rows != 0)
                                    {
                                      while($stockRow = mysqli_fetch_row($stockResult))
                                      {
                                        $fields = "";
                                        $data = "NULL";
                                        for ($i = 0; $i < count($stockRow); ++$i)
                                        {
                                          // FETCH ASSOCIATIVE? MAY FIX THESE PROBLEMS/HELP

                                          if($i == 0 || $i == 1) // OR $i != 1 OR $i != 2)
                                          {}
                                          else if($i == 2)
                                          {
                                            if($stockRow[$i] != NULL)
                                            {
                                              $date = gmdate("F j, Y, g:i a", $stockRow[$i]);
                                            }
                                          }
                                          else
                                          {
                                            if($stockRow[$i] != NULL)
                                            {
                                              $fields .= "<p><b>" . $fieldsInfo[$i] . ":</b> " . $stockRow[$i] . "</p>";
                                              // Commented out for now due to an Atom error that made all other text bright green.
                                              // Made work difficult.
                                              //$fields .= "<p>" . $stockRow[$i] . "</p>";
                                            }
                                          }
                                        }
                                        $fields .= "<p><b style=\"color:red\">LAST UPDATED:</b> " . $date . "</p>";

                                        $stockTemp = "<div class=\"panel-group\" id=\"accordion\"><div class=\"panel panel-default\"><div class=\"panel-heading\"><h4 class=\"panel-title\"><a data-toggle=\"collapse\" data-parent=\"#accordionP$portfolioRow[0]S$stockRow[0]\" href=\"#collapseP$portfolioRow[0]S$stockRow[0]\">$stockRow[81]</a></h4></div><div id=\"collapseP$portfolioRow[0]S$stockRow[0]\" class=\"panel-collapse collapse in\"><div class=\"panel-body\">$fields</div></div></div></div>";
                                        //print($stockTemp);
                                        $stockString .= $stockTemp;
                                      }
                                    }
                                    else
                                    {
                                      $stockString .= "No stocks to show! Try adding a stock in the sidebar!";
                                    }

                                    $string = "<div class=\"panel-group\" id=\"accordion\"><div class=\"panel panel-default\"><div class=\"panel-heading\"><h4 class=\"panel-title\"><a data-toggle=\"collapse\" data-parent=\"#accordionP$portfolioRow[0]\" href=\"#collapseP$portfolioRow[0]\"> $portfolioRow[1] </a></h4></div><div id=\"collapseP$portfolioRow[0]\" class=\"panel-collapse collapse in\"><div class=\"panel-body\"><p><i>$portfolioRow[3]</i></p>$stockString</div></div></div></div>";
                                    print($string);
                                  }
                                }
                                else
                                {
                                  print("No portfolios to show! Try adding a portfolio in the sidebar!");
                                }
                              }
                              else
                              {
                                $_SESSION['Message'] = "Log in to view data!";
                                header('Location: mainpage.php');
                              }
                          }
                        ?>

                        <h2><img src="img/logo_transparency.png" style="width:300px; height: 300px;padding-top: 20px;"></h2>
                      </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    $("#wrapper").toggleClass("toggled");
    </script>

</body>

</html>
