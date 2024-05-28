<?php
    session_start();
    echo "<ol>";
    echo "<li><a href='soal3home.php'>Home</a></li>";
    echo "<li><a href='#'>Detail</a></li>";
    echo "</ol>";
    echo "Hello, " . $_SESSION['username'];
    echo "<br>This is detail screen";
?>