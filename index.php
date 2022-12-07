<html>

<body>

  <?php

  session_start();
  error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);


  include("./cfg.php");
  include("./showpage.php");
  // include("./app/php/header.php");
  // include("./app/php/footer.php");


  $autor = ' Igor Kawczynski<br>';
  $przedmiot = ' Programowanie Aplikacji WWW<br>';
  $nr_indeksu = ' 162423<br>';
  $nrGrupy = ' 2<br>';


  // echo $autor, $przedmiot, $nr_indeksu, $nrGrupy;

  // $url = $_GET['url'];
  // switch ($url) {
  //   case 'home':
  //     $url = './app/html/home.html';
  //     include($url);
  //   case 'news':
  //     $url = './app/html/news.html';
  //     include($url);
  //   case 'manchester-united':
  //     $url = './app/html/manchester-united.html';
  //     include($url);
  //   case 'manchester-city':
  //     $url = './app/html/manchester-city.html';
  //     include($url);
  //   case 'liverpool':
  //     $url = './app/html/liverpool.html';
  //     include($url);
  //   case 'chelsea':
  //     $url = './app/html/chelsea.html';
  //     include($url);
  //   case 'goals':
  //     $url = './app/html/goals.html';
  //     include($url);
  //   case 'assists':
  //     $url = './app/html/assists.html';
  //     include($url);
  //   case 'clean-sheets':
  //     $url = './app/html/clean-sheets.html';
  //     include($url);
  //   case 'forum':
  //     $url = './app/html/forum.html';
  //     include($url);
  //   case 'users':
  //     $url = './app/html/users.html';
  //     include($url);
  //   case 'login':
  //     $url = './app/html/login.html';
  //     include($url);
  //   case 'register':
  //     $url = './app/html/register.html';
  //     include($url);
  //   case 'contact':
  //     $url = './app/html/contact.html';
  //     include($url);
  // }
  if ($_GET['url'] == "home")
  {
    $site = './app/html/home.html';
    pokazPodstrone(1, $link);
  }
  if ($_GET['url'] == "news")
  {
    $site = './app/html/news.html';
    include("./app/php/navbar.php");
    pokazPodstrone(13, $link);
  }
  if ($_GET['url'] == "manchester-united")
  {
    $site = './app/html/manchester-united.html';
    include("./app/php/navbar.php");
    pokazPodstrone(12, $link);
  }
  if ($_GET['url'] == "manchester-city")
  {
    $site = './app/html/manchester-city.html';
    include("./app/php/navbar.php");
    pokazPodstrone(11, $link);
  }
  if ($_GET['url'] == "liverpool")
  {
    $site = './app/html/liverpool.html';
    include("./app/php/navbar.php");
    pokazPodstrone(9, $link);
  }
  if ($_GET['url'] == "chelsea")
  {
    $site = './app/html/chelsea.html';
    include("./app/php/navbar.php");
    pokazPodstrone(3, $link);
  }
  if ($_GET['url'] == "goals")
  {
    $site = './app/html/goals.html';
    include("./app/php/navbar.php");
    pokazPodstrone(8, $link);
  }
  if ($_GET['url'] == "assists")
  {
    $site = './app/html/assists.html';
    include("./app/php/navbar.php");
    pokazPodstrone(2, $link);
  }
  if ($_GET['url'] == "clean-sheets")
  {
    $site = './app/html/clean-sheets.html';
    include("./app/php/navbar.php");
    pokazPodstrone(4, $link);
  }
  if ($_GET['url'] == "forum")
  {
    $site = './app/html/forum.html';
    include("./app/php/navbar.php");
    pokazPodstrone(7, $link);
  }
  if ($_GET['url'] == "login")
  {
    $site = './app/html/login.html';
    include("./app/php/navbar.php");
    pokazPodstrone(10, $link);
  }
  if ($_GET['url'] == "register")
  {
    $site = './app/html/register.html';
    include("./app/php/navbar.php");
    pokazPodstrone(14, $link);
  }
  if ($_GET['url'] == "contact")
  {
    $site = './app/html/contact.html';
    include("./app/php/navbar.php");
    pokazPodstrone(5, $link);
  }
  if ($_GET['url'] == "films")
  {
    $site = './app/html/films.html';
    include("./app/php/navbar.php");
    pokazPodstrone(6, $link);
  }
  // if ($_GET[''] == "")
  // {
  //   include("./app/html/home.html");
  // }

  if (file_exists($site))
  {
    return;
  }
  else
  {
    throw new ErrorException($site . ": THIS SITE DOES NOT EXIST SIR !");
  }

  ?>
</body>

</html>