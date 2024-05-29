<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Buat Yupi Skin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body class="bg-[#F6E7F1]">
    <nav class="bg-[#DEBBD9]">
        <div class="flex justify-between items-center p-2  md:pl-24 md:pr-24">
            <!-- Mobile Menu Button -->
            <div class="flex items-center pl-4 md:hidden">
                <button id="menuButton" class="text-3xl">
                <span class="material-symbols-outlined text-3xl"> menu </span>
                </button>
            </div>
            <!-- Logo -->
            <div class="flex items-center logo-nav md:pl-0 md:pr-0">
                <a href="home.php">
                    <div class="flex items-center space-x-4">
                        <div class="max-w-16">
                            <img src="https://i.ibb.co.com/LZL0FqD/LOGO-YUPI-CARE-ALP.png" alt="Logo">
                        </div>
                        <div class="max-w-20 hidden md:block">
                            <img src="https://i.ibb.co.com/grppxQP/yupi-skin.png" alt="yupiskin">
                        </div>
                    </div>
                </a>
            </div>
            <!-- Cart Icon -->
            <div class="flex items-center space-x-4 md:hidden pr-4">
                <div class="md:hover:text-violet-900 md:hover:scale-105 md:transition-transform md:cursor-pointer">
                    <span class="material-symbols-outlined text-3xl">shopping_cart</span>
                </div>
            </div>
            <!-- Navbar Title (hidden on mobile) -->
            <!-- Profile and Cart Icons (hidden on mobile) -->
            <div class="hidden md:flex navbar-icon space-x-12">
                <div class="hover:text-violet-900 hover:scale-105 transition-transform items-center justify-center cursor-pointer" id="cartIcon">
                    <div class="font-semibold text-xl">
                        <a href="home.php">
                                <div class="flex items-center space-x-2">
                                <span class="material-symbols-outlined text-3xl"> home </span>
                                <h1> Home </h1>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="hover:text-violet-900 hover:scale-105 transition-transform items-center justify-center cursor-pointer" id="cartIcon">
                    <div class="font-semibold text-xl">
                        <div class="flex items-center space-x-2">
                            <span class="material-symbols-outlined text-3xl">shopping_cart</span>
                            <h1>My Cart</h1>
                        </div>
                    </div>
                </div>
                <div class="relative" id="profileMenuContainer">
                    <div class="hover:text-violet-900 hover:scale-105 transition-transform items-center justify-center cursor-pointer" id="profileMenuButton">
                        <div class="font-semibold text-xl">
                            <div class="flex items-center space-x-2">
                                <span class="material-symbols-outlined text-3xl">account_circle</span>
                                <h1>Profile</h1>
                            </div>
                        </div>
                    </div>
                    <!-- Dropdown Menu -->
                    <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                        <a href="login.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                        <a href="register.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Register</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden">
            <a href="home.php" class="block px-4 py-2 text-lg font-semibold text-gray-700 hover:bg-gray-100">Home</a>
            <div class="relative" id="mobileProfileMenuContainer">
                <button class="w-full text-left px-4 py-2 text-lg font-semibold text-gray-700 hover:bg-gray-100" id="mobileProfileMenuButton">Profile</button>
                <!-- Mobile Profile Dropdown Menu -->
                <div id="mobileProfileMenu" class="hidden bg-white rounded-md shadow-lg">
                    <a href="login.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                    <a href="register.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Register</a>
                </div>
            </div>
        </div>
    <script>
        //navigation js
        const profileMenuButton = document.getElementById('profileMenuButton');
        const profileMenu = document.getElementById('profileMenu');
        const profileMenuContainer = document.getElementById('profileMenuContainer');

        profileMenuButton.addEventListener('mouseover', function() {
            profileMenu.classList.remove('hidden');
        });

        profileMenuContainer.addEventListener('mouseleave', function() {
            profileMenu.classList.add('hidden');
        });

        // Mobile menu functionality
        const menuButton = document.getElementById('menuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileProfileMenuButton = document.getElementById('mobileProfileMenuButton');
        const mobileProfileMenu = document.getElementById('mobileProfileMenu');

        menuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        mobileProfileMenuButton.addEventListener('click', function() {
            mobileProfileMenu.classList.toggle('hidden');
        });

        //end of navigation js
    </script>
    </nav>

    <main>
        <div>
            <?php
                echo "ini saya mencoba echonya php"
            ?>
        </div>
    </main>

    <footer>
    </footer>

</body>
</html>
