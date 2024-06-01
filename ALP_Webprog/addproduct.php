<?php include_once('navigation.php'); ?>

<?php
    if(isset($_POST["submit_new_product"])){
        uploadProduct();
    }
?>
<main class="pt-20 px-4 md:px-24">
    <section class="pt-24 md:pt-8 px-4 lg:px-24">
        <div class="px-4 mt-12 mb-7 max-w-3xl mx-auto">
            <h1 class="text-3xl font-semibold mb-4">New Product Upload Form</h1>
            <p class="text-gray-600">Admins, please complete the following fields with detailed information about the new product. 
                Ensure all data is accurate and images meet our quality standards. 
                Your thoroughness will help maintain the integrity of our catalog. 
                Thank you!
            </p>
        </div>
        <form action="addproduct.php" method="POST" enctype="multipart/form-data" class="px-4 mb-32 max-w-3xl mx-auto space-y-2">
            <div class="flex space-x-4">
                <div class="w-1/2">
                    <label for="brand">Brand*</label>
                    <input class="border border-gray-400 block py-2 px-4 w-full rounded focus:outline-[#8a6792]" type="text" name="brand" id="brand" required><br>
                </div>

                <div class="w-1/2">
                    <label for="product_name">Product Name*</label>
                    <input class="border border-gray-400 block py-2 px-4 w-full rounded focus:outline-[#8a6792]" type="text" name="product_name" id="product_name" required><br>
                </div>
            </div>

            <div class="w-1/4">
                <label for="price">Price*</label>
                <div class="flex">
                    <div class="flex items-center px-2 bg-[#f3bae5] text-[#8a6792] rounded-l">Rp</div>
                    <input class="border border-gray-400 block py-2 px-4 w-full rounded-r focus:outline-none focus:border-[#8a6792]" type="number" name="price" id="price" required><br>
                </div>
            </div>

            <div class="pt-6">
                <label for="product_image">Product Image*</label>
                <input class="block pt-2 px-4 w-full rounded focus:outline-[#8a6792]" type="file" name="product_image" id="product_image" required><br>
                <p class="text-sm text-gray-600">Accepted file types: JPG, JPEG, and PNG only.</p>
            </div>

            <div>
                <input type="submit" name="submit_new_product" id="submit_new_product" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#8a6792] hover:bg-[#755B7B] rounded-lg placeholder-[#8a6792]">
            </div>
        </form>
    </section>
</main>

<?php include_once('footer.php'); ?>