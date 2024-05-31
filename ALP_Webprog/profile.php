<?php include_once('navigation.php'); ?>

    <main class="lg:px-24">
        <section class="pt-24 lg:pt-28 px-4 lg:px-24 space-y-4">

            <div class="px-4 py-8">
                <div class="bg-[#F3BAE5] bg-opacity-60 py-8 rounded shadow-md">
                    <!-- admin view profile -->
                    <div class="flex justify-center items-center">
                        <div class="max-w-80">
                            
                    <?php if($_SESSION["role"] == "admin") { ?>
                        <img class="w-full h-full rounded-full object-cover" src="https://i.ibb.co.com/3FS6XHG/adminprofile.png" alt="adminprofile">
                    <?php } else { ?>
                        <img class="w-full h-full rounded-full object-cover" src="https://i.ibb.co.com/71FZ7YH/userprofile.png" alt="userprofile">
                    <?php } ?>
                        </div>
                    </div>


                    <!-- edit profile name -->
                    <div>
                        <div class="px-4 py-6">
                            <!-- ini buat update username dan password user -->
                        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"]) && $_POST["action"] == "updateProfile") {
                                updateUser();
                        } ?>
                            <!-- end -->
                            
                        <?php if(isset($_SESSION["username"])){ ?>
                            <form action="" method="POST">
                                <input type="hidden" name="action" value="updateProfile">
                                <div class="md:flex md:flex-col md:items-center md:space-y-6 md:px-52">
                                    <div class="pb-4 w-full space-y-2">
                                        <label for="username" class="text-lg">Username</label>
                                        <input class="rounded-md w-full p-2 md:p-4 text-lg" type="text" name="username" value="<?=$_SESSION["username"]?>">
                                    </div>
                                    <div class="pb-4 w-full space-y-2">
                                        <label for="password" class="text-lg">Password</label>
                                        <input class="rounded-md w-full p-2 md:p-4 text-lg" type="text" name="password" value="<?=$_SESSION["password"]?>">
                                    </div>
                                </div>
                                <div class="pt-4 w-full md:px-52 flex justify-center font-semibold md:justify-end space-x-4">
                                    <input type="submit" value="Update Profile" class="rounded-md p-2 text-lg text-white bg-[#8A6791] hover:bg-[#BEAECB]">
                                    <button type="button" onclick="window.location.href='logout.php';" class="rounded-md p-2 text-lg text-white bg-[#8A6791] hover:bg-[#BEAECB]">
                                        Logout
                                    </button>
                                </div>
                            </form>
                        <?php } ?>

                            
                            <!-- for add product -->
                            <?php if($_SESSION["role"] == "admin") { ?>
                            <div class="md:px-52 flex justify-center md:justify-end pt-6 ">
                                <a href="newcart.php">
                                    <button
                                        class=" bg-[#8A6791] text-lg text-white font-semibold py-2 px-4 rounded hover:bg-[#BEAECB] focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                        Add Product
                                    </button>
                                </a>
                            </div>
                            <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </section>

    </main>
    <?php include_once('footer.php'); ?>