<?php
    session_start();
    //Function untuk connect ke database
    function my_connectDB(){
        $host = "localhost";
        $user = "root";
        $pwd = "";
        $db = "yupiskin";

        $conn = mysqli_connect($host, $user, $pwd, $db) or die("Error connect to database");
        
        return $conn;
    }

    //function untuk close connection
    function my_closeDB($conn){
        mysqli_close($conn);
    }

    //Function untuk register
    function createUser(){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $conn = my_connectDB();

        if($conn!=NULL){

            $sql_query = "SELECT * FROM `user` WHERE username = '$username'";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            if($result -> num_rows == 1){
                echo "Username already exist";
            }else{
                $sql_query = "INSERT INTO `user` (`username`, `password`) VALUES ('$username', '$password')";
                $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                my_closeDB($conn);
                return $result;
            }
        }else{
            echo "Error connect to database";
        }
    }

    function loginUser(){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $conn = my_connectDB();
        if($conn!=NULL){
            $sql_query = "SELECT * FROM `user` WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            
            //cek result kosong atau tidak, num_rows jumlah baris di result
            if($result -> num_rows == 1){
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $result;
            }else{
                echo "Username or password is incorrect";
            }
        }

        my_closeDB($conn);
    }

    function logoutUser(){
        $url = "http://localhost/alp/home.php";
        session_destroy();
        // header('Location: '.$url);
        die();
    }
?>