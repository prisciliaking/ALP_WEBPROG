<?php
    session_start();
    $_SESSION['nama'] ='Apta';
    $_SESSION['jurusan'] = 'IMT';
    $_SESSION['angkatan'] = '2019';
    echo "Session is set. To show it, <a href='file2.php'>Click Here</a>";
?>