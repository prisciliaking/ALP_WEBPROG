<?php
    session_start();
    $_SESSION['nama'] = $_POST['nama'];
    $_SESSION['jurusan'] = $_POST['jurusan'];
    $_SESSION['angkatan'] = $_POST['angkatan'];
    echo "Bio Anda sudah tersimpan. <a href='soal2file3.php'>Click Here.</a>";
?>