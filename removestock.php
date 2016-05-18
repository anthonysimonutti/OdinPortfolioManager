
<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Odin - Remove Stock</title>

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
                    Odin Remove Stock
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

                        <h1 style="text-align: center;">Odin - Remove Stock</h1>

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
                                  $string = "<form class=\"form-signin\" action=\"removest.php\" method=\"post\">";
                                  while($portfolioRow = mysqli_fetch_row($portfolioResult))
                                  {
                                    $stockSql = "SELECT * from StockData WHERE PortfolioID = '$portfolioRow[0]'";
                                    //print($stockSql);
                                    $stockResult = $mysqli->query($stockSql);
                                    if($stockResult->num_rows != 0)
                                    {
                                      while($stockRow = mysqli_fetch_row($stockResult))
                                      {
                                        $string .= "<h4 style=\"text-align:center;\">
                                                      <input type=\"checkbox\" name=\"stockToDelete[]\" value=\"$stockRow[0]\" /> Remove '$stockRow[81]' from '$portfolioRow[1]'<br />
                                                    </h4>";
                                      }
                                    }
                                    else
                                    {
                                      print("Portfolio '$portfolioRow[1]' has no stocks.");
                                    }
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

                      <form class="form-signin" method="POST" action="removest.php" role="form">
                        <?php print($string)?>
                        <button id="button" class="btn btn-lg btn-primary btn-block" type="submit" name="submit" href="removeportfolio.php">Remove</button>
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
