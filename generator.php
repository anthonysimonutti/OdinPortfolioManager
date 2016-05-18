
<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Odin - Graphical View</title>

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
                    Odin Graphical View
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
                        <h1 style="text-align: center;">Odin - Generate Graph</h1>
                      </form>
                      <form>
                         <div class="form-group">
                           <label for="InputName">Enter Ticker</label>
                           <div class="input-group">
                             <input type="text" class="form-control" name="InputName" id="InputName" placeholder="Enter Ticker" required>
                             <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                           </div>
                         </div>
                             <h5>Time Span</h5>
                                 <div>
                                  <select class="form-control" name="Time Span" id="ChartTimeSpan">
                                          <option selected="selected" value="1d">1 Day</option>
                                          <option value="5d">5 Days</option>
                                          <option value="3m">3 Months </option>
                                          <option value="6m">6 Months</option>
                                          <option value="1y">1 Year</option>
                                          <option value="2y">2 Year</option>
                                          <option value="5y">5 Year</option>
                                          <option value="my">Maximum</option>
                                  </select>
                                </div>
                              <h5>Chart Type</h5>
                                  <div>
                                    <select class="form-control" name="Chart Type" id="ChartType">
                                            <option selected="selected" value="l">Line</option>
                                            <option value="b">Bar</option>
                                            <option value="c">Candle</option>
                                </select>
                            </div>
                            <h5>Chart Scale</h5>
                            <div>
                                    <select class="form-control" name="Chart Scale" id="ChartScale">
                                            <option selected="selected" value="off">Arithmetic</option>
                                            <option value="on">Logarithmic</option>
                                </select>
                            </div>
                            <h5>Moving Average Indicator</h5>
                            <div>
                                    <select class="form-control" name="Moving Average Indicator" id="MovingAverageInterval">
                                            <option selected="selected" value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="200">200</option>
                                </select>
                             </div>
                             <input type="button" id="btn" value="Generate" />
                      </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /#wrapper -->

    <script type="text/javascript">
        document.getElementById('btn').onclick = function() {
      var ticker = document.getElementById('InputName').value;
      var timespan = document.getElementById('ChartTimeSpan').value;
      var charttype = document.getElementById('ChartType').value;
      var scaling = document.getElementById('ChartScale').value;
      var movingavg = document.getElementById('MovingAverageInterval').value;
        src = 'http://chart.finance.yahoo.com/z?s=' + ticker + '&t=' + timespan + '&q=' + charttype + '&l=' + scaling + '&z=l&p=m' + movingavg;
        //src = 'http://chart.finance.yahoo.com/z?s=' + ticker + '&t=' + timespan + '&q=' + charttype + '&l='  scaling + '&z=l&p=m50,e200';
        //src = 'http://chart.finance.yahoo.com/z?s=' + ticker + '&t=' timespan + '&q=' + charttype + '&l=' + scaling + &z=l&p=m50,e200,v&a=p12,p
                //src = 'http://webpage.com/images/' + val +'.png',
                img = document.createElement('img');

            img.src = src;
            document.body.appendChild(img);
        }
    </script>

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
