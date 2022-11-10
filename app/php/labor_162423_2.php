<?php

    $przedmiot = ' Programowanie Aplikacji WWW ';
    $nr_indeksu = ' 162423 ';
 
    $nrGrupy = ' 2 ';

    echo $przedmiot;
    echo "<br>Igor Kawczyński <br> $nr_indeksu <br> grupa $nrGrupy";


    echo "<br> <br> Zastosowanie metody include()";
    $include = include 'include.php';
    echo "<br> $include";

    echo "<br> <br> Zastosowanie metody require_once()";
    $require_once = require_once 'require_once.php';
    echo "<br> $require_once";

    echo "<br> <br> Warunki if, else, elseif, switch";
    $x = 5;
    $y = 6;
    $temp = $x;
    $temp2 = $y - $x;
    echo "<br> x = $x | y = $y";
    echo "<br> <br> IF ELSE";
    if ($x > $y) {
        echo "<br> x is bigger than y";
        echo "<br> now im gonna exchange their values";
        $x = $y;
        $y = $temp;
        echo "<br> x = $x | y = $y";
    }
    else {
        echo "<br> y is bigger than x";
        echo "<br> now im gonna enlarge x so it's gonna be equal to y";
        $x = $x + $temp2;
        echo "<br> x = $x | y = $y";
    }
    echo "<br> <br> SWITCH";
    $z = 5;
    switch ($z) {
        case 4:
            echo "<br> z equals 4";
            break;
        case 5:
            echo "<br> z equals 5";
            break;
        case 6:
            echo "<br> z equals 6";
            break;
    }


    echo "<br> <br> Pętla while() i for()";
    echo "<br> WHILE";
    echo "<br> Odliczę od 1 do 10... <br>";
    $x = 1;
    while ($x <= 10):
        echo "$x <br>";
        $x++;
    endwhile;
    echo "<br> FOR";
    echo "<br> Odliczę od -1 do -10... <br>";
    for ($x = -1; $x >= -10; $x--) {
        echo "$x <br>";
    }

    echo "<br> <br> Typy zmiennych _GET, _POST, _SESSION";
    echo "<br> Przykładowe użycie zmiennej &nbsp GET w pliku get.php, &nbsp POST w widoku kontakt (plik mail.php) oraz &nbsp SESSION w sessions.php + sessions2.php "

?>
