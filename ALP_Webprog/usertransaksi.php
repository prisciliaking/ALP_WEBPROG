<?php include_once 'navigation.php'; ?>
<?php include_once 'controller.php'; ?>

<main class="px-4 md:px-24">
    <section class="pt-24 lg:pt-28 px-4 lg:px-24 space-y-4">
        <div class="justify-center text-center pb-2">
        <?php
            // Menampilkan username yang diperiksa
            if (isset($_GET['username'])) {
                $username = urldecode($_GET['username']);
                $username = strtoupper($username); // Konversi ke huruf kapital
                echo "<h2 class='pt-12 text-3xl lg:text-4xl font-bold'>$username's Transactions</h2>";
            } ?>
               </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7 mt-4">
            <?php
                if (isset($_GET['username'])) {
                    $username = urldecode($_GET['username']);
                    $transactions = getUser($username);
                    
                    foreach ($transactions as $transaction) {
            ?>
                        <div class="w-full bg-white border border-gray-200 rounded-lg shadow p-5 space-y-2">
    <div>
        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Transaction ID: <?=$transaction["transaksi_id"]?>
        </h5><img class="rounded-t-lg" src="img/<?= $transaction["product_image"] ?>" />
        <p>Brand: <?=$transaction["brand"]?></p> <!-- Perbaikan nama kolom -->
        <p>Product: <?=$transaction["nama_produk"]?></p>
        <p>Quantity: <?=$transaction["jumlah_produk"]?></p>
        <p>Price: <?=$transaction["harga_produk"]?></p>
        <p>Total Price: <?=$transaction["total_harga"]?></p>
        <p>Date: <?=$transaction["tanggal_transaksi"]?></p>
        <p>Status: <?=$transaction["status"]?></p>
    </div>
</div>

            <?php
                    }
                } else {
                    echo "<p class='text-center'>No user selected.</p>";
                }
            ?>
        </div>
    </section>
</main>

<?php include_once 'footer.php'; ?>
