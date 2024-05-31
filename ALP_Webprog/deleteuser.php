<?php
session_start();
include 'controller.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteUser'])) {
    if (deleteUser()) {
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Failed to delete user');</script>";
    }
} else {
    header("Location: profile.php");
}
?>
