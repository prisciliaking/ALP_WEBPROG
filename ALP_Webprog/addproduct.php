<?php include_once('navigation.php'); ?>

<?php
    if(isset($_POST["submit_new_product"])){
        uploadProduct();
    }
?>
<main class="pt-20 px-4 md:px-24">
    <section class="pt-24 md:pt-8 px-4 lg:px-24">
        <h1>Add New Product</h1>
        <form action="addproduct.php" method="POST" enctype="multipart/form-data">
            <label for="brand">Brand:</label>
            <input type="text" name="brand" id="brand" required><br>

            <label for="product_name">Product Name:</label>
            <input type="text" name="product_name" id="product_name" required><br>

            <label for="price">Price:</label>
            <input type="number" name="price" id="price" required><br>

            <!-- The image will be using link from imgbb -->
            <label for="product_image">Product Image:</label>
            <input type="text" name="product_image" id="product_image" required><br>
            <!-- <input type="file" name="product_image" id="product_image" required><br> -->
            <input type="submit" name="submit_new_product" id="submit_new_product" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#f3bae5] rounded-lg hover:bg-[#f48fdb]">
        </form>
    </section>
</main>

<?php include_once('footer.php'); ?>