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
        if ($_SESSION["role"] == "user") {
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
                        alert('User is not logged in');
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


    // ini gunanya buat ambil product sesuai dengan id user, jadi 
    // selain id user yg dipilih gk bakalan keluar itu product user lain
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


    // ini buat update product seperti biasa ygy
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


    // ini cuma delete product biasa 
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

    // ini buat ngeliat diuser list, admin bisa ngeliat user yang punya role user
    function readUsers() {
        $conn = my_connectDB();
        $alldata = array();
        // ngecek user yang diambil cuma yang ada role di user doang
        $sql_query = "SELECT * FROM `users` WHERE `role` = 'user'";
        $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data["id"] = $row["id"];
                $data["username"] = $row["username"];
                $data["password"] = $row["password"];
                $data["role"] = $row["role"];
                array_push($alldata, $data);
            }
        } else {
        }
    
        my_closeDB($conn);
        return $alldata;
    }


    // ini buat ngambil transaksi yang dmiliki oleh user dicek berdasarkan idnya
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


    // ini buat add cart ke user berdasarkan idnya
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addToCart']) && isset($_POST['produkID'])){
        if(!isset($_SESSION['user_id'])){
            header("Location: home.php");
            exit();
        }

        $conn = my_connectDB();
        $productID = $_POST['produkID'];
        $user_id = $_SESSION["user_id"];
        $data = array();
        $product = getProductWithID($productID);
        $currDate = date("Y-m-d");
        if($productID!="" && $user_id!=""){
            $sql_query = "SELECT * FROM transaksi WHERE `produk_id` = $productID && `user_id` = $user_id && `status` = 'pending'";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            if($result -> num_rows >= 1){
                while($row = $result -> fetch_assoc()){
                    //Simpan data dari database ke dalam array
                    $data["id"] = $row["id"];
                    $data["jumlah"] = $row["jumlah"];
                }
                //bakalan ngecount sendiri kalau misal add to cart tapi belum di bayar
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
            header("Location: home.php");
            exit();
        }else{
            header("Location: home.php");
            exit();
            
        }
    }

    function deleteTransaction($transaction_id, $user_id) {
        $conn = my_connectDB();
        $sql_query = "DELETE FROM transaksi WHERE id = ? AND user_id = ?";
    
        if ($stmt = $conn->prepare($sql_query)) {
            $stmt->bind_param("ii", $transaction_id, $user_id);
            $stmt->execute();
    
            // Debugging output to check query execution
            error_log("SQL query executed: " . $stmt->affected_rows . " rows affected.");
    
            if ($stmt->affected_rows > 0) {
                $result = true;
            } else {
                $result = false;
            }
    
            $stmt->close();
        } else {
            die("Error preparing SQL statement: " . $conn->error);
        }
    
        my_closeDB($conn);
        return $result;
    }

    function changeTransactionStatus($userID, $productID){
        $conn = my_connectDB();
        if($userID!="" && $productID!=""){
            $sql_query = "UPDATE `transaksi` SET `status` = 'success' WHERE `user_id` = $userID && `produk_id` = $productID && `status` = 'pending'";
            $result = mysqli_query($conn, $sql_query) or die(mysqli_error($conn));
            if($result){
                echo "<script>
                        alert('Transaction status changed');
                    </script>";
                return $result;
            }else{
                echo "<script>
                        alert('Approval system failed');
                    </script>";
                return false;
            }
            my_closeDB($conn);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteTransaction']) && isset($_POST['transaction_id']) && isset($_POST['user_id'])) {
        // Retrieve transaction_id and user_id from POST data and convert them to integers for security
        $transaction_id = intval($_POST['transaction_id']);
        $user_id = intval($_POST['user_id']);
    
        // Debugging output to check values (this will be logged)
        error_log("Attempting to delete transaction ID: $transaction_id for user ID: $user_id");
    
        // Call the deleteTransaction function to delete the transaction with the provided IDs
        $deleteSuccess = deleteTransaction($transaction_id, $user_id);
    
        // Check if the transaction was deleted successfully
        if ($deleteSuccess) {
            // Log success message
            error_log("Transaction ID: $transaction_id for user ID: $user_id deleted successfully.");
    
            // Redirect to the same page with a success message
            header("Location: usertransaksi.php?user_id=" . urlencode($user_id) . "&message=Transaction deleted successfully");
            exit(); // Exit the script after redirecting
        } else {
            // Log failure message
            error_log("Failed to delete transaction ID: $transaction_id for user ID: $user_id.");
    
            // Redirect to the same page with an error message
            header("Location: usertransaksi.php?user_id=" . urlencode($user_id) . "&message=Failed to delete transaction");
            exit(); // Exit the script after redirecting
        }
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approveTransaction']) && isset($_POST['produk_id']) && isset($_POST['user_id'])){
        $productID = $_POST['produk_id'];
        $userID = $_POST['user_id'];
    
        error_log("Attempting to delete transaction ID: $transaction_id for user ID: $user_id");
    
        $result = changeTransactionStatus($userID, $productID);
    
        header("Location: usertransaksi.php?user_id=" . urlencode($userID));
        exit();
    }
    ?>
