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
                $user = "user";
                $sql_query = "INSERT INTO `user` (`username`, `password`, `role`) VALUES ('$username', '$password', '$user')";
                $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['role'] = "user";

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
            $rows = mysqli_fetch_assoc($result);
            //cek result kosong atau tidak, num_rows jumlah baris di result
            if($result -> num_rows == 1){
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['role'] = $rows['role'];

            }else{
                echo "Username or password is incorrect";
            }
        }

        my_closeDB($conn);
    }

    function getProductAmount(){
        $conn = my_connectDB();

        $sql_query = "SELECT * FROM `produk`";
        $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));

        if($result -> num_rows > 0){
            $num_of_rows = mysqli_num_rows( $result );
            return $num_of_rows;
        }else{
            
        }
        my_closeDB($conn);
    }

    function readProducts(){
        $conn = my_connectDB();
        $allData = array();

        $sql_query = "SELECT * FROM `produk`";
        $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
        if($result -> num_rows > 0){
            while($row = $result -> fetch_assoc()){
                //Simpan data dari database ke dalam array
                $data["id"] = $row["produk_id"];
                $data["brand"] = $row["brand"];
                $data["name"] = $row["produk_name"];
                $data["harga"] = $row["harga"];
                //Simpan data di allData
                array_push($allData, $data);
            }
        }else{
            echo "You don't have any product";
        }

        my_closeDB($conn);
        return $allData;
    }

    function updateUser() {
            if (isset($_SESSION["username"])) {
                $current_username = $_SESSION["username"];
                $new_username = $_POST["username"];
                $new_password = $_POST["password"];
    
                $conn = my_connectDB();
    
                if ($conn != NULL) {
                    $sql_query = "UPDATE `user` SET username = ?, password = ? WHERE username = ?";
                    if ($stmt = mysqli_prepare($conn, $sql_query)) {
                        mysqli_stmt_bind_param($stmt, "sss", $new_username, $new_password, $current_username);
                        $result = mysqli_stmt_execute($stmt);
                        
                        if ($result) {
                            // Update session variables
                            $_SESSION["username"] = $new_username;
                            $_SESSION["password"] = $new_password;
                        } else {
                            echo "Failed to update profile";
                        }
    
                        mysqli_stmt_close($stmt);
                    } else {
                        die("Failed to prepare SQL query: " . mysqli_error($conn));
                    }
                    my_closeDB($conn);
                } else {
                    echo "Error connecting to database";
                }
            } else {
                echo "User is not logged in";
            }
        }

?>
