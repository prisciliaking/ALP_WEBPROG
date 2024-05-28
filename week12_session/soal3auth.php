<?php
    session_start();
    $_SESSION['username'] = '123';
    $_SESSION['password'] = 'admin';
    if($_POST['username'] == $_SESSION['username'] && $_POST['password'] == $_SESSION['password']){
        header('Location: soal3home.php');
    }else{
        header('Location: soal3fail.php');
    }
?>