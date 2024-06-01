<?php include_once('navigation.php'); ?>

<main class="pt-20 px-4 md:px-24">
    <section class="pt-24 md:pt-8 px-4 lg:px-24">
        
        <div class="px-4 mt-12 mb-7 max-w-3xl mx-auto">
            <h1 class="text-3xl font-semibold mb-4">Edit Product Form</h1>
            <p class="text-gray-600">Admins, please update the necessary fields with the latest information about the product. 
                Ensure all data is accurate and reflects any recent changes. 
                Thank you for keeping our catalog up to date!
            </p>
        </div>

        <?php
            if(isset($_GET["editID"])){
                $editID = $_GET["editID"];
                $_SESSION["editID"] = $editID;
                $data = getProductWithID($editID);
                $_SESSION["oldImage"] = $data["product_image"];
        ?>

        <form action="editproduct.php" method="POST" enctype="multipart/form-data" class="px-4 mb-32 max-w-3xl mx-auto space-y-4">
            <div class="flex space-x-4">
                <div class="w-1/4 mb-7 flex flex-col items-center">
                    <?php
                        if(file_exists("img/".$data["product_image"])){
                    ?>
                            <img src="img/<?=$data["product_image"]?>" class="rounded-lg border border-4 border-[#8a6792]" alt="">
                    <?php
                        }
                    ?>
                    <input type="submit" name="delete_product" id="delete_product" value="Delete" class="inline-flex items-center mt-4 px-3 py-2 text-sm font-medium text-center text-white bg-[#8a6792] hover:bg-[#755B7B] rounded-lg">
                </div>
                <div class="w-3/4">
                    <div>
                        <label for="brand">Brand*</label>
                        <input value="<?=$data["brand"]?>" class="border border-gray-400 block py-2 px-4 w-full rounded focus:outline-[#8a6792]" type="text" name="brand" id="brand" required><br>
                    </div>

                    <div>
                        <label for="product_name">Product Name*</label>
                        <input value="<?=$data["name"]?>" class="border border-gray-400 block py-2 px-4 w-full rounded focus:outline-[#8a6792]" type="text" name="product_name" id="product_name" required><br>
                    </div>

                    <div class="w-1/4">
                        <label for="price">Price*</label>
                        <div class="flex">
                            <div class="flex items-center px-2 bg-[#f3bae5] text-[#8a6792] rounded-l">Rp</div>
                            <input value="<?=$data["harga"]?>" class="border border-gray-400 block py-2 px-4 w-full rounded-r focus:outline-none focus:border-[#8a6792]" type="number" name="price" id="price" required><br>
                        </div>
                    </div>

                    <div class="pt-6">
                        <label for="product_image">Product Image*</label>
                        <input class="block py-2 px-4 w-full rounded focus:outline-[#8a6792]" type="file" name="product_image" id="product_image"><br>
                        <p class="text-sm text-gray-600">Accepted file types: JPG, JPEG, and PNG only.</p>
                    </div>

                    <div>
                        <input type="submit" name="edit_product" id="edit_product" value="Update" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#8a6792] hover:bg-[#755B7B] rounded-lg">
                    </div>
                </div>
            </div>
        </form>

        <?php
            }
            if(isset($_POST["edit_product"])){
                $brand = $_POST["brand"];
                $name = $_POST["product_name"];
                $harga = $_POST["price"];
                $image = $_FILES["product_image"];
                $image = uploadImage();

                if(!$image){
                    $image = $_SESSION["oldImage"];
                }

                $result = updateProduct($_SESSION["editID"], $brand, $name, $harga, $image, $_SESSION["oldImage"]);

                if($result==1){
        ?>
                    <div class="flex space-x-4 mx-auto max-w-3xl space-y-4">
                        <div class="w-1/4 mb-7">
                            <img src="img/<?=$image?>" class="rounded-lg border border-4 border-[#8a6792]" alt="">
                        </div>
                        <div class="w-3/4">
                            <div>
                                <label for="brand">Brand*</label>
                                <input readonly value="<?=$brand?>" class="border border-gray-400 block py-2 px-4 w-full rounded focus:outline-[#8a6792]" type="text" name="brand" id="brand" required><br>
                            </div>

                            <div>
                                <label for="product_name">Product Name*</label>
                                <input readonly value="<?=$name?>" class="border border-gray-400 block py-2 px-4 w-full rounded focus:outline-[#8a6792]" type="text" name="product_name" id="product_name" required><br>
                            </div>

                            <div class="w-1/4">
                                <label for="price">Price*</label>
                                <div class="flex">
                                    <div class="flex items-center px-2 bg-[#f3bae5] text-[#8a6792] rounded-l">Rp</div>
                                    <input readonly value="<?=$harga?>" class="border border-gray-400 block py-2 px-4 w-full rounded-r focus:outline-none focus:border-[#8a6792]" type="number" name="price" id="price" required><br>
                                </div>
                            </div>
                        </div>
                    </div>
        <?php

                }
        ?>
        <?php
            }
            
            if(isset($_POST["delete_product"])){
                $result = deleteProduct($_SESSION["editID"], $_SESSION["oldImage"]);

                if($result == 1){
        ?>
                    <div class="flex flex-col items-center space-y-4">
                        <p class="text-2xl">Product has been deleted.</p>
                        <a href="home.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#8a6792] hover:bg-[#755B7B] rounded-lg">Return to Home</a>
                    </div>
        <?php
                }
            }
        ?>
    </section>
</main>

<?php include_once('footer.php'); ?>