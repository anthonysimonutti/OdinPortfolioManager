<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

  session_start();
  header('Content-Type: text/xml');
  $myfile = fopen("xml.txt", "w") or die("Unable to open file!");

  $string = "";
  $fields = $_POST['OtherFields'];
  if(empty($fields))
  {
    $_SESSION['Message'] = "You didn't select any fields!";
  }
  else
  {
    $ticker = $_SESSION['Ticker'];
    $market = $_SESSION['Market'];
    $string = "<?xml version=\"1.0\"?><data><ticker symbol=\"$ticker\" market=\"$market\">";

    foreach($fields as $selectedOption)
    {
      $string .= "<field>$selectedOption</field>";
    }
    $string .= "</ticker></data>";
    print($string);
    fwrite($myfile, $string);
    $_SESSION['Message'] = "Fetch XML created!";
  }
  fclose($myfile);
  header('Location: mainpage.php');
?>
