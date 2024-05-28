<?php
    session_start();
    echo "Nama = " . $_SESSION['nama'] . "<br>";
    echo "Jurusan = " . $_SESSION['jurusan'] . "<br>";
    echo "Angkatan = " . $_SESSION['angkatan'] . "<br>";
    echo "Edit bio? <a href='soal2file1.php'>Click Here.</a>"
?>