<?php
    session_start();
    echo "Hello, " . $_SESSION["nama"] . " From " . $_SESSION["jurusan"] . " Batch " . $_SESSION["angkatan"];
?>