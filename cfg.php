<?php 

session_start();

if(!isset($_SESSION['loginFailed']))
{
    $_SESSION['loginFailed'] = 1;
}

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = 'root';
  $baza = 'moja_strona';

  $username = $_POST['username'];
  $password = $_POST['password'];

  if ( (empty($password) || empty($username) ) && $_SESSION['loginFailed'] != 0) {
    $_SESSION['loginFailed'] = 1;
  }
  if ($username == "root" && $password == "root") {
    $_SESSION['loginFailed'] = 0;
  }

  $link = mysqli_connect($dbhost, $dbuser, $dbpass);
  if(!$link) {
    echo'<b> Połączenie zostało zerwane! </b>';
  }
  if(!mysqli_select_db($link, $baza)) {
    echo'<b> Baza nie została wybrana! </b>';
  }

  ?>