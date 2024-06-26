<?php include_once('navigation.php'); ?>

    <section class="pt-24 md:pt-8 px-4 md:px-24">
        <div id="default-carousel" class="relative w-full lg:px-20 carousel-box" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-full">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="img/carousel_banner_1.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="img/carousel_banner_2.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <!-- <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="img/sale_banner.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div> -->
                <!-- Item 4 -->
                <!-- <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="img/sale_banner.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div> -->
                <!-- Item 5 -->
                <!-- <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="img/sale_banner.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div> -->
            </div>
        </div>
    </section>

    <!-- Carousel Animation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <main class="px-4 md:px-24">
        <section class="pt-16 md:pt-8 px-4 lg:px-24">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-7">
                <?php
                    $result = readProducts();
                    if(isset($_SESSION["role"])){
                        $role = $_SESSION["role"];
                    }
                    $role = "";
                    foreach($result as $row){
                ?>
                <form action="controller.php" method="POST">
                    <input type="hidden" name="produkID" value="<?=$row['id']?>">
                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow bg-[#beaecb] hover-product">
                        <div class="hover-img">
                            <img class="rounded-t-lg" src="img/<?=$row["product_image"]?>" alt="" />

                            <?php
                                if(isset($_SESSION["role"])){
                                    if($_SESSION["role"] != "admin"){
                            ?>
                                        <button type="submit" name="addToCart" class="text-black inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#f3bae5] rounded-lg hover:bg-[#f48fdb] product-button">
                                            Add to cart
                                        </button>
                            <?php  
                                    }else{
                            ?>
                                        <a href="editproduct.php?editID=<?=$row['id']?>" class="text-black inline-flex items-center px-3 py-2 text-sm font-medium text-center bg-[#f3bae5] rounded-lg hover:bg-[#f48fdb] product-button">
                                            Edit Product
                                        </a>
                            <?php
                                    }      
                                }else{
                            ?>
                                        <button type="submit" name="addToCart" class="text-black inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#f3bae5] rounded-lg hover:bg-[#f48fdb] product-button">
                                            Add to cart
                                        </button>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?=$row["brand"]?></h5>
                            <p class="mb-3 font-normal text-gray-700"><?=$row["name"]?></p>
                            <p class="mb-3 font-normal text-gray-700">Rp. <?=number_format($row["harga"])?>,00</p>
                        </div>
                    </div>
                </form>
                <?php
                    }
                ?>
                <?php
                if(isset($_SESSION["role"])){
                    if($_SESSION["role"] == "admin"){
                ?>
                    <a href="addproduct.php">
                        <div class="bg-[#beaecb] w-full h-full border border-gray-200 rounded-lg shadow hover:scale-105 transition-transform flex items-center justify-center">
                            <ion-icon name="add-circle-outline" class="text-6xl"></ion-icon>
                        </div>
                    </a>
                <?php
                    }
                }
                ?>
            </div>
        </section>
    </main>
    <?php include_once('footer.php'); ?>