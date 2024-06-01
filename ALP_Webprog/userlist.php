<?php include_once 'navigation.php' ?>
<?php include_once 'controller.php'; ?>

<main class="px-4 md:px-24">
<section class="pt-24 lg:pt-28 px-4 lg:px-24 space-y-4">
        <div class="justify-center text-center pb-2">
            <h2 class="pt-12 text-3xl lg:text-4xl font-bold">User Information</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-7 mt-4">
            <?php
                $result = readUsers();
                foreach ($result as $row) {
            ?>
                <div class="w-full bg-white border border-gray-200 rounded-lg shadow p-5 space-y-2">
                    <div>
                        <img class="rounded-t-lg" src="img/userprofile.png" alt="userprofile"/>
                    </div>

                    <div>
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Username: <?= strtoupper($row["username"]) ?></h5>
                        <a href="usertransaksi.php?user_id=<?=urlencode($row["id"])?>" class="bg-[#F3BAE5] hover:bg-[#BEAECB] text-[#8A6791] hover:text-white px-2 rounded-md font-semibold">View Transactions</a>
                    </div>
                </div>
            <?php
                }
            ?>
        </div>
    </section>
</main>

<?php include_once 'footer.php' ?>
