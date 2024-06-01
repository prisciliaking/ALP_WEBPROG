<?php
    session_start();
    //Function untuk connect ke database
    function my_connectDB(){
        $host = "localhost";
        $users = "root";
        $pwd = "";
        $db = "yupiskin";

        $conn = mysqli_connect($host, $users, $pwd, $db) or die("Error connect to database");
        
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
            $sql_query = "SELECT * FROM `users` WHERE username = '$username'";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            if($result -> num_rows == 1){
                echo "<script>
                        alert('Username already exists!');
                    </script>";
                return false;
            }else{
                $role = "user";
                $sql_query = "INSERT INTO `users` (`username`, `password`, `role`) VALUES ('$username', '$password', '$role')";
                $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
                $sql_query = "SELECT * FROM `users` WHERE username = '$username'";
                $userData = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
                $row = mysqli_fetch_assoc($userData);
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                $_SESSION['role'] = "users";

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
            $sql_query = "SELECT * FROM `users` WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            $rows = mysqli_fetch_assoc($result);
            //cek result kosong atau tidak, num_rows jumlah baris di result
            if($result -> num_rows == 1){
                $_SESSION['user_id'] = $rows['id'];
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

    // ini cuma bisa dipake buat delete users doang gak bisa role admin
    function deleteUser() {
        if ($_SESSION["role"] == "users") {
            $username = $_SESSION["username"];
            $conn = my_connectDB();
    
            if ($conn) {
                $sql_query = "DELETE FROM users WHERE username = ?";
                $stmt = mysqli_prepare($conn, $sql_query);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "s", $username);
                    if (mysqli_stmt_execute($stmt)) {
                        session_unset();
                        session_destroy();
                        echo "<script>alert('Success to delete users');</script>";
                        return true;
                    } else {
                        echo "<script>alert('Failed to delete users');</script>";
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
            echo "<script>alert('users is not logged in or does not have permission');</script>";
        }
        return false;
    }

    //Function to update users n admin information
    function updateUser() {
        if (isset($_SESSION["username"])) {
            $current_username = $_SESSION["username"];
            $new_username = $_POST["username"];
            $new_password = $_POST["password"];

            $conn = my_connectDB();

            if ($conn != NULL) {
                $sql_query = "UPDATE `users` SET username = ?, password = ? WHERE username = ?";
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
                        alert('users is not logged in');
                    </script>";
            return false;
        }
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
                $data["id"] = $row["id"];
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

    

    function uploadProduct(){
        $conn = my_connectDB();

        $brand = $_POST["brand"];
        $name = $_POST["product_name"];
        $price = $_POST["price"];
        $image = $_POST["product_image"];

        //Only if the image is a file
        $image = uploadImage();
        if(!$image){
            echo "<script>
                        alert('Product upload failed');
                    </script>";
            return false;
        }else{
            $sql_query = "INSERT INTO `produk` (`brand`, `produk_name`, `harga`, `product_image`) VALUES ('$brand', '$name', '$price', '$image')";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            my_closeDB($conn);
            echo "<script>
                        alert('Product upload successful');
                    </script>";
            return $result;
        }

        // If the image is a link
        // if($conn != NULL){
        //     $sql_query = "INSERT INTO `produk` (`brand`, `produk_name`, `harga`, `product_image`) VALUES ('$brand', '$name', '$price', '$image')";
        //     $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
        //     my_closeDB($conn);
        //     echo "<script>
        //                 alert('Product upload successful');
        //             </script>";
        //     return $result;
        // }else{
        //     echo "<script>
        //                 alert('Product upload failed');
        //             </script>";
        //     return false;
        // }
    }

    //If you want to upload a file
    function uploadImage(){
        $photo = $_FILES['product_image'];
        $fileName = $photo['name'];
        $fileSize = $photo['size'];
        $error = $photo['error'];
        $tempName = $photo['tmp_name'];

        //Check if there is any image
        if($error == 4){
            return false;
        }

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
        return $newFileName;
    }

    function getProductWithID($editID){
        $data = array();
        if($editID > 0){
            $conn = my_connectDB();

            $sql_query = "SELECT * FROM `produk` WHERE id = " . $editID;
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            //result berupa array

            if($result -> num_rows > 0){
                while($row = $result -> fetch_assoc()){
                    //Simpan data dari database ke dalam array
                    $data["id"] = $row["id"];
                    $data["brand"] = $row["brand"];
                    $data["name"] = $row["produk_name"];
                    $data["harga"] = $row["harga"];
                    $data["product_image"] = $row["product_image"];
                }
            }
            my_closeDB($conn);
            return $data;
        }
    }

    function updateProduct($id, $brand, $name, $harga, $image, $oldImage){
        if($id!="" && $brand!="" && $name!="" && $harga!="" && $image!=""){
            if($image != $oldImage){
                $oldImage = "img/".$oldImage;
                if(file_exists( $oldImage)){
                    unlink($oldImage);
                }else{
                    echo "<script>
                            alert('Old image doesn't exist');
                        </script>";
                }
            }

            $conn = my_connectDB();
            $sql_query = "UPDATE `produk` 
                            SET `brand` = '$brand', 
                                `produk_name` = '$name', 
                                `harga` = '$harga',
                                `product_image` = '$image' 
                            WHERE `produk`.`id` = $id;";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            my_closeDB($conn);
            echo "<script>
                        alert('Product edit successful');
                    </script>";
            return $result;
        }
    }

    function deleteProduct($deleteID, $oldImage){
        $conn = my_connectDB();

        if($conn != NULL){
            $oldImage = "img/".$oldImage;
            if(file_exists( $oldImage)){
                unlink($oldImage);
            }else{
                echo "<script>
                        alert('Old image doesn't exist');
                    </script>";
            }

            $sql_query = "DELETE FROM produk WHERE `produk`.`id` = $deleteID";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            my_closeDB($conn);
            return $result;
        }
    }

    function readUsers() {
        $conn = my_connectDB();
        $alldata = array();
        // ngecek user yang diambil cuma yang ada role di user doang
        $sql_query = "SELECT username, password, role FROM `user` WHERE `role` = 'user'";
        $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data["username"] = $row["username"];
                $data["password"] = $row["password"];
                $data["role"] = $row["role"];
                array_push($alldata, $data);
            }
        } else {
            echo "<script>
                    alert('Users not found');
                  </script>";
        }
    
        my_closeDB($conn);
        return $alldata;
    }

    function readTransaction($id) {
        $transactions = array();
        
        if (!empty($id)) {
            $conn = my_connectDB();
        
            // SQL query to get transaction details
            $sql_query = "SELECT t.id, t.produk_id, p.brand, p.product_image, p.produk_name AS nama_produk, t.jumlah, p.harga, 
                          (t.jumlah * p.harga) AS total_harga, t.tanggal, t.status
                          FROM transaksi t
                          JOIN produk p ON t.produk_id = p.id
                          JOIN users u ON t.user_id = u.id
                          WHERE u.id = ? AND u.role = 'user'";
        
            if ($stmt = $conn->prepare($sql_query)) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
        
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $transaction = array(
                            "id" => $row["id"],
                            "produk_id" => $row["produk_id"],
                            "brand" => $row["brand"],
                            "product_image" => $row["product_image"],
                            "nama_produk" => $row["nama_produk"],
                            "jumlah_produk" => $row["jumlah"],
                            "harga_produk" => $row["harga"],
                            "total_harga" => $row["total_harga"],
                            "tanggal_transaksi" => $row["tanggal"],
                            "status" => $row["status"]
                        );
                        $transactions[] = $transaction;
                    }
                }
        
                $stmt->close();
            } else {
                die("Error preparing SQL statement: " . $conn->error);
            }
        
            my_closeDB($conn);
        }
        return $transactions;
    }

    if(isset($_GET["addCartID"])){
        $conn = my_connectDB();
        $productID = $_GET["addCartID"];
        $user_id = $_SESSION["user_id"];
        $data = array();
        $product = getProductWithID($productID);
        $currDate = date("Y-m-d");
        if($productID!="" && $user_id!=""){
            $sql_query = "SELECT * FROM transaksi WHERE `id` = $productID && `user_id` = $user_id && `status` = 'pending'";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            if($result -> num_rows == 1){
                while($row = $result -> fetch_assoc()){
                    //Simpan data dari database ke dalam array
                    $data["id"] = $row["id"];
                    $data["jumlah"] = $row["jumlah"];
                    $data["status"] = $row["status"];
                    $data["user_id"] = $row["user_id"];
                    $data["id"] = $row["id"];
                }

                $data["jumlah"]++;

                $sql_query = "UPDATE `transaksi` 
                            SET `jumlah` = ".$data['jumlah']."
                            WHERE `transaksi`.`id` = ".$data['id'].";";
                $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            }else{
                $sql_query = "INSERT INTO `transaksi` (`jumlah`, `tanggal`, `status`, `user_id`, `produk_id`) VALUES (1, '$currDate', 'pending', '$user_id', $productID)";
                $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            }
            my_closeDB($conn);
            echo "Product added to cart";
        }else{
            echo "Please login first!";
            return false;
        }
    }
?>
