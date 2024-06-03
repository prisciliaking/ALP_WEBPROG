<?php
include_once('navigation.php');
include_once('controller.php');

// Ambil user ID dari sesi
$user_id = $_SESSION['user_id'];

// Ambil semua transaksi
$all_transactions = readTransaction($user_id);

// Filter transaksi dengan status pending
$pending_transactions = array_filter($all_transactions, function($transaction) {
    return $transaction['status'] === 'pending';
});
?>

<main class="lg:px-24">
    <section class="pt-24 lg:pt-28 px-4 lg:px-24 space-y-4">
        <!-- shopping cart text -->
        <div class="text-cart items-center lg:justify-between lg:text-center pb-4 lg:pb-12">
            <h1 class="text-3xl lg:text-4xl font-bold">Shopping Cart</h1>
        </div>

        <!-- shopping cart details -->
        <div class="md:flex md:space-x-4 justify-between">
            <div>
                <div class="cartlist bg[#F6E7F1] bg-opacity-50 px-4 py-12 rounded-md shadow">
                    <div class="md:flex justify-between">
                        <label class="inline-flex items-center">
                            <input type="checkbox" id="select-all" class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="ml-2 font-semibold text-md">Select All</span>
                        </label>
                        <div class="hidden lg:block text-xl font-semibold">
                            <h1>Product Details</h1>
                        </div>
                    </div>

                    <div>
                        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                    </div>

                    <div class="space-y-2">
                        <?php if (!empty($pending_transactions)){ ?>
                            <?php foreach ($pending_transactions as $transaction){ ?>
                                <div>
                                    <label class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                                        <input type="checkbox"
                                            class="form-checkbox item-checkbox h-5 w-5 text-blue-600 hidden md:block">
                                        <div class="max-w-full md:max-w-32">
                                            <img class="rounded-lg w-full" src="img/<?=$transaction['product_image']?>" alt="<?=$transaction['brand']?>" />
                                        </div>
                                        <div class="flex flex-col space-y-2">
                                            <div class="flex items-center space-x-2">
                                                <input type="checkbox" class="form-checkbox item-checkbox h-5 w-5 text-blue-600 lg:hidden">
                                                <span class="font-semibold text-xl"><?=$transaction['brand']?></span>
                                            </div>
                                            <p><?=$transaction['nama_produk']?></p>
                                            <div class="flex justify-between items-center py-4 md:space-x-56">
                                                <div>
                                                    <p class="text-xl font-bold">Rp. <?=number_format($transaction['harga_produk'])?>.00</p>
                                                </div>
                                                <div class="flex items-center">
                                                    <button class="group rounded-l-xl px-4 py-2 border border-gray-200 flex items-center justify-center shadow-sm transition duration-500 hover:bg-gray-50 hover:border-gray-300">
                                                        <svg class="stroke-gray-900 transition duration-500 group-hover:stroke-black" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                                            <path d="M16.5 11H5.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                                        </svg>
                                                    </button>
                                                    <input type="text" class="border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[60px] text-center bg-transparent" value="<?= $transaction['jumlah_produk'] ?>">
                                                    <button class="group rounded-r-xl px-4 py-2 border border-gray-200 flex items-center justify-center shadow-sm transition duration-500 hover:bg-gray-50 hover:border-gray-300">
                                                        <svg class="stroke-gray-900 transition duration-500 group-hover:stroke-black" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                <div>
                                    <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class='flex flex-col justify-center items-center md:space-y-12'>
                                <p class='text-2xl'>There is no transaction here.</p>
                                <a href='home.php' class='inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#8a6792] hover:bg-[#755B7B] rounded-lg'>Return Home</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div>
                <div class="subtotal bg-[#F6E7F1] bg-opacity-50 px-4 py-12 rounded-md shadow">
                    <h2 class="font-manrope font-semibold text-xl text-black">Subtotal</h2>
                    <div>
                        <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                    </div>
                    <div>
                        <form>
                            <div class="flex items-center justify-between py-8 md:space-x-52">
                                <p class="font-medium text-xl leading-8 text-[#8A6791]">Total</p>
                                <?php
                                $total = 0;
                                foreach ($pending_transactions as $transaction) {
                                    $total += $transaction['total_harga'];
                                } ?>
                                <p class="font-semibold text-xl text-[#8A6791]">
                                    Rp. <?= number_format($total, 0, ',', '.') ?>,00
                                </p>
                            </div>
                            <button class="w-full text-center bg-[#F3BAE5] rounded-xl py-3 px-6 font-semibold text-lg text-white transition-all duration-500 hover:bg-[#f48fdb]">Checkout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include_once('footer.php'); ?>

<!-- Add the following script at the end of your file -->
<script>
document.getElementById('select-all').addEventListener('change', function() {
    // Get the state of the "Select All" checkbox
    const selectAllChecked = this.checked;

    // Get all item checkboxes
    const itemCheckboxes = document.querySelectorAll('.item-checkbox');

    // Set the state of all item checkboxes to match the "Select All" checkbox
    itemCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAllChecked;
    });
});
</script>
