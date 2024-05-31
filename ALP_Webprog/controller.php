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
                echo "<script>
                        alert('Username already exists!');
                    </script>";
                return false;
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
            echo "<script>
                        alert('Error connect to database');
                    </script>";
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
                echo "<script>
                        alert('Username or password is incorrect');
                    </script>";
                return false;
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
                $data["product_image"] = $row["product_image"];
                //Simpan data di allData
                array_push($allData, $data);
            }
        }else{
            echo "<script>
                        alert('Products not found');
                    </script>";
        }

        my_closeDB($conn);
        return $allData;
    }

    //Function to update user n admin information
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
                        echo "<script>
                            alert('Failed to update profile');
                        </script>";
                        return false;
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
            echo "<script>
                        alert('User is not logged in');
                    </script>";
            return false;
        }
    }

    function uploadProduct(){
        $conn = my_connectDB();

        $brand = $_POST["brand"];
        $name = $_POST["product_name"];
        $price = $_POST["price"];
        $image = $_POST["product_image"];

        //Only if the image is a file
        // $image = uploadImage();
        // if(!$image){
        //     return false;
        // }else{
        //     $sql_query = "INSERT INTO `produk` (`brand`, `produk_name`, `price`, `image`) VALUES ('$brand', '$name', '$price', '$image')";
        //     $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
        //     return $result;
        // }

        if($conn != NULL){
            $sql_query = "INSERT INTO `produk` (`brand`, `produk_name`, `harga`, `product_image`) VALUES ('$brand', '$name', '$price', '$image')";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            my_closeDB($conn);
            echo "<script>
                        alert('Product upload successful');
                    </script>";
            return $result;
        }else{
            echo "<script>
                        alert('Product upload failed');
                    </script>";
            return false;
        }
    }

    //If you want to upload a file
    function uploadImage(){
        $photo = $_FILES['product_image'];
        $fileName = $photo['name'];
        $fileSize = $photo['size'];
        $error = $photo['error'];
        $tempName = $photo['tmp_name'];

        //Check if the submission is an image
        $validExtension = ["jpg", "jpeg", "png"];
        //Get the submission's extension
        $fileExtension = explode('.', $fileName);
        $fileExtension = strtolower(end($fileExtension));

        //Function to check if a String exists inside an array
        if(!in_array($fileExtension, $validExtension)){
            echo "<script>
                        alert('Only pictures/images with jpg/jpeg/png extensions are allowed!');
                    </script>";
            return false;
        }

        //Check if the size of image is too large
        //Size here is in byte so 1jt = 1 MB kurleb
        if($fileSize > 1000000){
            echo "<script>
                        alert('Image size is too large');
                    </script>";
            return false;
        }

        //Generate new name for the image - jaga2 2 org upload file dgn nama yg sama
        $newFileName = uniqid().'.'.$fileExtension;

        //Uploading the image
        move_uploaded_file($tempName, 'img/'.$newFileName);
        return $fileName;
    }

        // ini cuma bisa dipake buat delete user doang gak bisa role admin
    function deleteUser() {
        if ($_SESSION["role"] == "user") {
            $username = $_SESSION["username"];
            $conn = my_connectDB();
    
            if ($conn) {
                $sql_query = "DELETE FROM user WHERE username = ?";
                $stmt = mysqli_prepare($conn, $sql_query);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    if (mysqli_stmt_execute($stmt)) {
                        session_unset();
                        session_destroy();
                        echo "<script>alert('Success to delete user');</script>";
                        return true;
                    } else {
                        echo "<script>alert('Failed to delete user');</script>";
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
            echo "<script>alert('User is not logged in or does not have permission');</script>";
        }
        return false;
    }
?>
