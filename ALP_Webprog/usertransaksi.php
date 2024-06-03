<?php include_once ('navigation.php'); ?>
<?php include_once ('controller.php'); ?>

<main class="px-4 md:px-24">
    <section class="pt-24 lg:pt-28 px-4 lg:px-24 space-y-4">
        <div class="justify-center text-center pb-2">
        <?php
            // Display the username being checked
            if (isset($_GET['user_id'])) {
                $user_id = urldecode($_GET['user_id']);
                $username = getUsernameByUserID($user_id); // Function to get username by user_id
                $username = strtoupper($username); // Convert to uppercase
                echo "<h2 class='pt-12 text-3xl lg:text-4xl font-bold'>$username's Transactions</h2>";
            } ?>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7 mt-4">
            <?php
                if (isset($_GET['user_id'])) {
                    $user_id = urldecode($_GET['user_id']);
                    $transactions = readTransaction($user_id);
                    
                    foreach ($transactions as $transaction) {
            ?>
                        <div class="w-full bg-white border border-gray-200 rounded-lg shadow p-5 space-y-2">
                <div>
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Transaction Status</h5>
                    <div class="relative">
                        <img class="rounded-t-lg w-full" src="img/<?= $transaction["product_image"] ?>" />
                        <form method="POST" action="deletetransaction.php">
                            <input type="hidden" name="deleteTransaction" value="1">
                            <input type="hidden" name="transaction_id" value="<?= $transaction['id'] ?>">
                            <input type="hidden" name="user_id" value="<?= $user_id ?>">
                            <button type="submit" class="absolute top-3 left-3 text-black inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-[#f3bae5] rounded-lg hover:bg-[#f48fdb]">
                                Delete Transaction
                            </button>
                        </form>
                    </div>
                    <p>Brand: <?= $transaction["brand"] ?></p>
                    <p>Product: <?= $transaction["nama_produk"] ?></p>
                    <p>Quantity: <?= $transaction["jumlah_produk"] ?></p>
                    <p>Price: Rp <?= number_format($transaction["harga_produk"]) ?>,00</p>
                    <p>Total Price: Rp <?= number_format($transaction["total_harga"]) ?>,00</p>
                    <p>Date: <?= $transaction["tanggal_transaksi"] ?></p>
                    <p>Status: <?= $transaction["status"] ?></p>
                </div>
            </div>

            <?php }
                } else {
                    echo "<p class='text-center'>No user selected.</p>";
                }
                
        if (count($transactions) <= 0) { ?>
            </div>
            <div class='flex flex-col justify-center items-center md:space-y-12'>
                    <p class='text-2xl'>This user has not made a purchase yet.</p>
                    <a href='userlist.php' class='inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#8a6792] hover:bg-[#755B7B] rounded-lg'>Return to User List</a>
            </div>
        <?php } ?>

    </section>
</main>

<?php include_once ('footer.php'); ?>
<?php
    function getUsernameByUserID($user_id) {
        $conn = my_connectDB();
        $sql_query = "SELECT username FROM users WHERE  id = ?";
        
        if ($stmt = $conn->prepare($sql_query)) {
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($username);
            $stmt->fetch();
            $stmt->close();
        } else {
            die("Error preparing SQL statement: " . $conn->error);
        }

        my_closeDB($conn);
        return $username;
    }
    ?>
