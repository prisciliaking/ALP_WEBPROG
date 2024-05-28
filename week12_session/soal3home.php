<?php
    session_start();
    echo "<ol>";
    echo "<li><a href='#'>Home</a></li>";
    echo "<li><a href='soal3detail.php'>Detail</a></li>";
    echo "</ol>";
    echo "Hello, " . $_SESSION['username'];
    echo "<br>This is home screen";
?>