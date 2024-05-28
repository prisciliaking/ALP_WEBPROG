<?php
    session_start();
    echo "<h1>Data Lengkap</h1>";
    echo "<br>Nama: " . $_SESSION["name"];
    echo "<br>Usia: " . $_SESSION["age"];
    echo "<br>Tahun lahir: " . $_SESSION["yob"];
?>