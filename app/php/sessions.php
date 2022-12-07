<?php
session_start();
?>

<!DOCTYPE html>
<html>

<body>

    <?php
    $_SESSION["klub"] = "Manchester United";
    $_SESSION["zawodnik"] = "Cristiano Ronaldo 7";
    echo "Zmienne w sesji zostały przypisane.";
    ?>

    <?php
    // usunięcie zmiennych z sesji
    session_unset();

    // usunięcie sesji
    session_destroy();
    ?>
</body>

</html>