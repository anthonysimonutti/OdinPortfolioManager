
<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Odin - Select Fields</title>

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
                    Odin Select Fields
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

                        <h1 style="text-align: center;">Odin - Select Fields</h1>
                      </form>

                      <form class="form-signin" method="POST" action="fields.php" role="form"> <!--"cgi-bin/mainserversend.py" role="form"> -->
                        <div class="form-group">
                          <h3>Fields for <?php echo $_SESSION['Ticker'];?></h3>
                            <select class="form-control" name="OtherFields[]" id="OtherFields" multiple="multiple" size = 20>
                              <option value="c8"> AfterHoursChangeRealtime </option>
                              <option value="g3">AnnualizedGain</option>
                              <option value="a0">Ask</option>
                              <option value="b2">AskRealtime</option>
                              <option value="a5">AskSize</option>
                              <option value="a2">AverageDailyVolume</option>
                              <option value="b0">Bid</option>
                              <option value="b3">BidRealtime</option>
                              <option value="b6">BidSize</option>
                              <option value="b4">BookValuePerShare</option>
                              <option value="c1">Change</option>
                              <option value="c0">Change_ChangeInPercent</option>
                              <option value="m7">ChangeFromFiftydayMovingAverage</option>
                              <option value="m5">ChangeFromTwoHundreddayMovingAverage</option>
                              <option value="k4">ChangeFromYearHigh</option>
                              <option value="j5">ChangeFromYearLow</option>
                              <option value="p2">ChangeInPercent</option>
                              <option value="k2">ChangeInPercentRealtime</option>
                              <option value="c6">ChangeRealtime</option>
                              <option value="c3">Commission</option>
                              <option value="c4">Currency</option>
                              <option value="h0">DaysHigh</option>
                              <option value="g0">DaysLow</option>
                              <option value="m0">DaysRange</option>
                              <option value="m2">DaysRangeRealtime</option>
                              <option value="w1">DaysValueChange</option>
                              <option value="w4">DaysValueChangeRealtime</option>
                              <option value="r1">DividendPayDate</option>
                              <option value="d0">TrailingAnnualDividendYield</option>
                              <option value="y0">TrailingAnnualDividendYieldInPercent</option>
                              <option value="e0">DilutedEPS</option>
                              <option value="j4">EBITDA</option>
                              <option value="e7">EPSEstimateCurrentYear</option>
                              <option value="e9">EPSEstimateNextQuarter</option>
                              <option value="e8">EPSEstimateNextYear</option>
                              <option value="q0">ExDividendDate</option>
                              <option value="m3">FiftydayMovingAverage</option>
                              <option value="f6">SharesFloat</option>
                              <option value="l2">HighLimit</option>
                              <option value="g4">HoldingsGain</option>
                              <option value="g1">HoldingsGainPercent</option>
                              <option value="g5">HoldingsGainPercentRealtime</option>
                              <option value="g6">HoldingsGainRealtime</option>
                              <option value="v1">HoldingsValue</option>
                              <option value="v7">HoldingsValueRealtime</option>
                              <option value="d1">LastTradeDate</option>
                              <option value="l1">LastTradePriceOnly</option>
                              <option value="k1">LastTradeRealtimeWithTime </option>
                              <option value="k3">LastTradeSize</option>
                              <option value="t1">LastTradeTime</option>
                              <option value="l0">LastTradeWithTime </option>
                              <option value="l3">LowLimit</option>
                              <option value="j1">MarketCapitalization</option>
                              <option value="j3">MarketCapRealtime</option>
                              <option value="i0">MoreInfo</option>
                              <option value="n0">Name</option>
                              <option value="n4">Notes</option>
                              <option value="t8">OneyrTargetPrice</option>
                              <option value="o0">Open</option>
                              <option value="i5">OrderBookRealtime</option>
                              <option value="r5">PEGRatio</option>
                              <option value="r0">PERatio</option>
                              <option value="r2">PERatioRealtime</option>
                              <option value="m8">PercentChangeFromFiftydayMovingAverage</option>
                              <option value="m6">PercentChangeFromTwoHundreddayMovingAverage</option>
                              <option value="k5">ChangeInPercentFromYearHigh</option>
                              <option value="j6">PercentChangeFromYearLow</option>
                              <option value="p0">PreviousClose</option>
                              <option value="p6">PriceBook</option>
                              <option value="r6">PriceEPSEstimateCurrentYear</option>
                              <option value="r7">PriceEPSEstimateNextYear </option>
                              <option value="p1">PricePaid</option>
                              <option value="p5">PriceSales</option>
                              <option value="s6">Revenue</option>
                              <option value="s1">SharesOwned</option>
                              <option value="j2">SharesOutstanding</option>
                              <option value="s7">ShortRatio</option>
                              <option value="x0">StockExchange</option>
                              <option value="s0">Symbol</option>
                              <option value="t7">TickerTrend</option>
                              <option value="d2">TradeDate</option>
                              <option value="t6">TradeLinks</option>
                              <option value="f0">TradeLinksAdditional</option>
                              <option value="m4">TwoHundreddayMovingAverage</option>
                              <option value="v0">Volume</option>
                              <option value="k0">YearHigh</option>
                              <option value="j0">YearLow</option>
                              <option value="w0">YearRange</option>
                            </select>
                          <button id="button" class="btn btn-lg btn-primary btn-block" type="submit" name="submit" href="selectfields.php">Add</button>
                          <img src="img/logo_transparency.png" style="width:300px; height: 300px;padding-top: 20px;">
                        </div>
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
