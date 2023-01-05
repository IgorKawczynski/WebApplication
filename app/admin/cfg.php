<?php 

// Wystartowanie sesji
session_start();

if(!isset($_SESSION['loginFailed']))
{
    $_SESSION['loginFailed'] = 1;
}
// Raport wszystkich error'ów
  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// ustawienie danych do bazy
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = 'root';
  $baza = 'moja_strona';

  $username = $_POST['username'];
  $password = $_POST['password'];

// konfiguracja do logowania ->  Przy poprawnych danych ustaw użytkownika w sesji jako zalogowanego...
  if ( (empty($password) || empty($username) ) && $_SESSION['loginFailed'] != 0) {
    $_SESSION['loginFailed'] = 1;
  }
  if ($username == "root" && $password == "root") {
    $_SESSION['loginFailed'] = 0;
  }

  // na wypadek zerwania połączenia
  $link = mysqli_connect($dbhost, $dbuser, $dbpass);
  if(!$link) {
    echo'<b> Połączenie zostało zerwane! </b>';
  }
  // na wypadek nie wybrania dobrej bazy danych
  if(!mysqli_select_db($link, $baza)) {
    echo'<b> Baza nie została wybrana! Wybierz jakąś</b>';
  }

  ?>