
<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Odin - Remove Portfolio</title>

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
                    Odin Add Stock
                  </a>
                </li>
                <li>
                  <a href="mainpage.php">Back</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                      <a href="#menu-toggle" id="menu-toggle">
                        <img src="img/menu.svg" style="padding-left:30px;">
                      </a>

                      <form class="main">
                        <h2 class="form-signin-heading" style="color:red;"> <!-- style="color:red;font-size:160%;width:100%;text-align:left;"> -->
                          <?php if(!empty($_SESSION['Message'])) { echo $_SESSION['Message']; } ?>
                        </h2>
                        <?php unset($_SESSION['Message']); ?>

                        <h1 style="text-align: center;">Odin - Add Stock</h1>
                        <h4 style="text-align:center;">Pick which portfolios to add to:</h4>
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
                                  $string = "<form class=\"form-signin\" action=\"removeport.php\" method=\"post\" >";
                                  while($portfolioRow = mysqli_fetch_row($portfolioResult))
                                  {
                                        $string .= "<h4 style=\"text-align:center;\">
                                                  <input type=\"checkbox\" name=\"portToAdd[]\" value=\"$portfolioRow[0]\" /> Add to '$portfolioRow[1]'<br />
                                                </h4>";
                                  }
                                  //$string .= "<input type=\"submit\" name=\"submit\" value=\"submit\" /></form>";
                                  //print($string);
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
                      </form>

                      <form class="form-signin" method="POST" action="addst.php" role="form"> <!--"cgi-bin/mainserversend.py" role="form"> -->
                        <?php print($string)?>
                        <input type="text" class="form-control" name="InputName" placeholder="Stock Ticker" required autofocus>
                        <input type="text" class="form-control" name="MarketName" placeholder="Market" required autofocus>
                        <!--<div class="form-group">
                          <h3>Fields</h3>
                            <div>
                              <select class="form-control" name="OtherFields" id="OtherFields" multiple="multiple" size = 20>
                              <option value="AfterHoursChangeRealtime"> AfterHoursChangeRealtime </option>
                              <option value="AnnualizedGain">AnnualizedGain</option>
                              <option value="Ask">Ask</option>
                              <option value="AskRealtime">AskRealtime</option>
                              <option value="AskSize">AskSize</option>
                              <option value="AverageDailyVolume">AverageDailyVolume</option>
                              <option value="Bid">Bid</option>
                              <option value="BidRealtime">BidRealtime</option>
                              <option value="BidSize">BidSize</option>
                              <option value="BookValuePerShare">BookValuePerShare</option>
                              <option value="Change">Change</option>
                              <option value="Change_ChangeInPercent">Change_ChangeInPercent</option>
                              <option value="ChangeFromFiftydayMovingAverage">ChangeFromFiftydayMovingAverage</option>
                              <option value="ChangeFromTwoHundreddayMovingAverage">ChangeFromTwoHundreddayMovingAverage</option>
                              <option value="ChangeFromYearHigh">ChangeFromYearHigh</option>
                              <option value="ChangeFromYearLow">ChangeFromYearLow</option>
                              <option value="ChangeInPercent">ChangeInPercent</option>
                              <option value="ChangeInPercentRealtime">ChangeInPercentRealtime</option>
                              <option value="ChangeRealtime">ChangeRealtime</option>
                              <option value="Commission">Commission</option>
                              <option value="Currency">Currency</option>
                              <option value="DaysHigh">DaysHigh</option>
                              <option value="DaysLow">DaysLow</option>
                              <option value="DaysRange">DaysRange</option>
                              <option value="DaysRangeRealtime">DaysRangeRealtime</option>
                              <option value="DaysValueChange">DaysValueChange</option>
                              <option value="DaysValueChangeRealtime">DaysValueChangeRealtime</option>
                              <option value="DividendPayDate">DividendPayDate</option>
                              <option value="TrailingAnnualDividendYield">TrailingAnnualDividendYield</option>
                              <option value="TrailingAnnualDividendYieldInPercent">TrailingAnnualDividendYieldInPercent</option>
                              <option value="DilutedEPS">DilutedEPS</option>
                              <option value="EBITDA">EBITDA</option>
                              <option value="EPSEstimateCurrentYear">EPSEstimateCurrentYear</option>
                              <option value="EPSEstimateNextQuarter">EPSEstimateNextQuarter</option>
                              <option value="EPSEstimateNextYear">EPSEstimateNextYear</option>
                              <option value="ExDividendDate">ExDividendDate</option>
                              <option value="FiftydayMovingAverage">FiftydayMovingAverage</option>
                              <option value="SharesFloat">SharesFloat</option>
                              <option value="HighLimit">HighLimit</option>
                              <option value="HoldingsGain">HoldingsGain</option>
                              <option value="HoldingsGainPercent">HoldingsGainPercent</option>
                              <option value="HoldingsGainPercentRealtime">HoldingsGainPercentRealtime</option>
                              <option value="HoldingsGainRealtime">HoldingsGainRealtime</option>
                              <option value="HoldingsValue">HoldingsValue</option>
                              <option value="HoldingsValueRealtime">HoldingsValueRealtime</option>
                              <option value="LastTradeDate">LastTradeDate</option>
                              <option value="LastTradePriceOnly">LastTradePriceOnly</option>
                              <option value="LastTradeRealtimeWithTime">LastTradeRealtimeWithTime </option>
                              <option value="LastTradeSize">LastTradeSize</option>
                              <option value="LastTradeTime">LastTradeTime</option>
                              <option value="LastTradeWithTime">LastTradeWithTime </option>
                              <option value="LowLimit">LowLimit</option>
                              <option value="MarketCapitalization">MarketCapitalization</option>
                              <option value="MarketCapRealtime">MarketCapRealtime</option>
                              <option value="MoreInfo">MoreInfo</option>
                              <option value="Name">Name</option>
                              <option value="Notes">Notes</option>
                              <option value="OneyrTargetPrice">OneyrTargetPrice</option>
                              <option value="Open">Open</option>
                              <option value="OrderBookRealtime">OrderBookRealtime</option>
                              <option value="PEGRatio">PEGRatio</option>
                              <option value="PERatio">PERatio</option>
                              <option value="PERatioRealtime">PERatioRealtime</option>
                              <option value="PercentChangeFromFiftydayMovingAverage">PercentChangeFromFiftydayMovingAverage</option>
                              <option value="PercentChangeFromTwoHundreddayMovingAverage">PercentChangeFromTwoHundreddayMovingAverage</option>
                              <option value="ChangeInPercentFromYearHigh">ChangeInPercentFromYearHigh</option>
                              <option value="PercentChangeFromYearLow">PercentChangeFromYearLow</option>
                              <option value="PreviousClose">PreviousClose</option>
                              <option value="PriceBook">PriceBook</option>
                              <option value="PriceEPSEstimateCurrentYear">PriceEPSEstimateCurrentYear</option>
                              <option value="PriceEPSEstimateNextYear">PriceEPSEstimateNextYear </option>
                              <option value="PricePaid">PricePaid</option>
                              <option value="PriceSales">PriceSales</option>
                              <option value="Revenue">Revenue</option>
                              <option value="SharesOwned">SharesOwned</option>
                              <option value="SharesOutstanding">SharesOutstanding</option>
                              <option value="ShortRatio">ShortRatio</option>
                              <option value="StockExchange">StockExchange</option>
                              <option value="Symbol">Symbol</option>
                              <option value="TickerTrend">TickerTrend</option>
                              <option value="TradeDate">TradeDate</option>
                              <option value="TradeLinks">TradeLinks</option>
                              <option value="TradeLinksAdditional">TradeLinksAdditional</option>
                              <option value="TwoHundreddayMovingAverage">TwoHundreddayMovingAverage</option>
                              <option value="Volume">Volume</option>
                              <option value="YearHigh">YearHigh</option>
                              <option value="YearLow">YearLow</option>
                              <option value="YearRange">YearRange</option>
                            </select>
                          </div>
                        </div>-->
                        <button id="button" class="btn btn-lg btn-primary btn-block" type="submit" name="submit" href="addstock.php">Add</button>
                        <img src="img/logo_transparency.png" style="width:300px; height: 300px;padding-top: 20px;">
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
