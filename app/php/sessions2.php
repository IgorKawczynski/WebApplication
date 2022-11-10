<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<body>

<?php
    echo "<br> Klubem jest : " . $_SESSION["klub"] . ".<br>";
    echo "<br> Piłkarz to : " . $_SESSION["zawodnik"] . ".";
?>

</body>
</html>