<?php

function pokazPodstrone($id, $link)
{
    $id_clear = htmlspecialchars($id); // czyszczenie id - na wypadek SQL Injection Attack
    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result);

    // wywolanie podstrony z bazy danych
    if(empty($row['id']))
    {
        $web = '[ERROR 404: Nie odnaleziono takiej strony]';
    }
    else
    { 
        $web = $row['page_content'];
    }

  echo $web;
}

// print pokazPodstrone(1, './html/home.html');

?>