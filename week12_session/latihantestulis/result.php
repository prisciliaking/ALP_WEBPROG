<?php
    session_start();
    $_SESSION["name"] = $_POST["name"];
    $_SESSION["yob"] = yob();
    $_SESSION["age"] = $_POST["age"];

    function yob(){
        return 2024 - $_POST["age"];
    }

    echo "Hello " . $_SESSION["name"] . "<br>Anda lahir di tahun " . $_SESSION["yob"];
    echo "<a href='end.php'>OK</a>";
?>