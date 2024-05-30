<?php include_once("controller.php")?>

<!-- Login User -->
<?php
    if (isset($_POST["loginUser"])) {
        loginUser();
    }
?>

<!-- Register User -->
<?php
    if (isset($_POST["createUser"])) {
        createUser();
    }
?>

<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YuPiCare</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body class="bg-[#F6E7F1]">
    <header class="absolute w-full bg-[#DEBBD9]">
        <nav>
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
                    <a href="keranjang.php">
                        <div class="md:hover:text-violet-900 md:hover:scale-105 md:transition-transform md:cursor-pointer">
                            <span class="material-symbols-outlined text-3xl">shopping_cart</span>
                        </div>
                    </a>
                </div>
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
                            <a href="keranjang.php">
                                <div class="flex items-center space-x-2">
                                    <span class="material-symbols-outlined text-3xl">shopping_cart</span>
                                    <h1>My Cart</h1>
                                </div>
                            </a>
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
                        <?php
                            if(isset($_SESSION["username"])){
                        ?>
                            <div id="profileMenu2" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><?=$_SESSION["username"]?></a>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" id="profile">Profile</a>
                                <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" id="logout">Logout</a>
                            </div>
                        <?php
                            }else{
                        ?>
                            <!-- Dropdown Menu -->
                            <div id="profileMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 login" id="login">Login</a>
                                <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 register" id="register">Register</a>
                            </div>
                        <?php
                            }
                        ?>
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
                        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 login" id="loginMobile">Login</a>
                        <a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 register" id="registerMobile">Register</a>
                    </div>
                </div>
            </div>
            <script>
                //navigation js
                window.onscroll = function() {
                    const header = document.querySelector('header');
                    const nav = document.querySelector('nav');
                    const fixedNav = header.offsetTop;
                    var width = screen.width;
                    if (window.pageYOffset > fixedNav) {
                        header.classList.remove('absolute');
                        header.classList.remove('bg-[#DEBBD9]');
                        header.classList.add('fixed');
                        header.classList.add('navbar-fixed');
                    } else {
                        header.classList.add('absolute');
                        header.classList.add('bg-[#DEBBD9]');
                        header.classList.remove('fixed');
                        nav.classList.remove('navbar-fixed');
                    }
                }

                const profileMenuButton = document.getElementById('profileMenuButton');
                const profileMenu = document.getElementById('profileMenu');
                const profileMenuContainer = document.getElementById('profileMenuContainer');
                const profileMenu2 = document.querySelector('#profileMenu2');

                profileMenuButton.addEventListener('click', function() {
                    profileMenu.classList.toggle('hidden');
                });

                profileMenuButton.addEventListener('click', function() {
                    profileMenu2.classList.toggle('hidden');
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
    </header>

    <!-- Pop-up Login Page -->
    <section class="hidden" id="popuplogin">
        <div id="login-popup" tabindex="-1" class="bg-black/50 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 h-full items-center justify-center flex">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <button id="close-popup-login" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center popup-close"><svg aria-hidden="true" class="w-5 h-5" fill="#c6c7c7" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" cliprule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close popup</span>
                    </button>

                    <div class="p-5">
                        <h3 class="text-2xl mb-0.5 font-medium"></h3>
                        <p class="mb-4 text-sm font-normal text-gray-800"></p>

                        <div class="text-center mb-4">
                            <p class="mb-3 text-2xl font-semibold leading-5 text-slate-900">
                                Login to your account
                            </p>
                            <p class="mt-2 text-sm leading-4 text-slate-600">
                                You must be logged in to perform this action.
                            </p>
                        </div>
                        <form action="home.php" class="w-full" method="POST">
                            <label for="username" class="sr-only">Username</label>
                            <input name="username" type="username" required="" class="block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-black focus:ring-offset-1" placeholder="Username" value="">
                            <label for="password" class="sr-only">Password</label>
                            <input name="password" type="password" required="" class="mt-2 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-black focus:ring-offset-1" placeholder="Password" value="">
                            <input type="submit" name="loginUser" class="inline-flex w-full mt-4 items-center justify-center rounded-lg bg-black p-2 py-3 text-sm font-medium text-white outline-none focus:ring-2 focus:ring-black focus:ring-offset-1 disabled:bg-gray-400">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pop-up Register Page -->
    <section class="hidden" id="popupregister">
        <div id="login-popup" tabindex="-1" class="bg-black/50 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 h-full items-center justify-center flex">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <div class="relative bg-white rounded-lg shadow">
                    <button id="close-popup-register" type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center popup-close"><svg aria-hidden="true" class="w-5 h-5" fill="#c6c7c7" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" cliprule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close popup</span>
                    </button>

                    <div class="p-5">
                        <h3 class="text-2xl mb-0.5 font-medium"></h3>
                        <p class="mb-4 text-sm font-normal text-gray-800"></p>

                        <div class="text-center mb-4">
                            <p class="mb-3 text-2xl font-semibold leading-5 text-slate-900">
                                Register an Account
                            </p>
                        </div>
                        <form action="home.php" class="w-full" method="POST">
                            <label for="username" class="sr-only">Username</label>
                            <input name="username" type="text" required class="block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-black focus:ring-offset-1" placeholder="Username" value="">
                            <label for="password" class="sr-only">Password</label>
                            <input name="password" type="password" required class="mt-2 block w-full rounded-lg border border-gray-300 px-3 py-2 shadow-sm outline-none placeholder:text-gray-400 focus:ring-2 focus:ring-black focus:ring-offset-1" placeholder="Password" value="">
                            <input type="submit" name="createUser" class="inline-flex w-full mt-4 items-center justify-center rounded-lg bg-black p-2 py-3 text-sm font-medium text-white outline-none focus:ring-2 focus:ring-black focus:ring-offset-1 disabled:bg-gray-400">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-24 md:pt-8 px-4 md:px-24">
        <div id="default-carousel" class="relative w-full lg:px-20 carousel-box" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-full">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="carousel_banner_1.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="carousel_banner_2.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="sale_banner.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="sale_banner.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="sale_banner.jpg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
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
                    if(isset($_SESSION["username"])){
                        $username = $_SESSION["username"];
                    }
                    $username = "";
                    foreach($result as $row){
                ?>
                    <div class="w-full bg-white border border-gray-200 rounded-lg shadow bg-[#beaecb]">
                        <div class="hover-img">
                            <img class="rounded-t-lg" src="https://i.ibb.co.com/m0pVBcs/skintific-moist-2.png" alt="" />

                            <?php
                                if(isset($_SESSION["username"])){
                                    if($_SESSION["username"] != "admin"){
                            ?>
                                        <button href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#f3bae5] rounded-lg hover:bg-[#f48fdb] product-button">
                                            Add to cart
                                        </button>
                            <?php  
                                    }      
                                }else{
                            ?>
                                    <button href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-[#f3bae5] rounded-lg hover:bg-[#f48fdb] product-button">
                                        Add to cart
                                    </button>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="p-5">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900"><?=$row["brand"]?></h5>
                            <p class="mb-3 font-normal text-gray-700"><?=$row["name"]?></p>
                        </div>
                    </div>
                <?php
                    }
                ?>
                <?php
                if(isset($_SESSION["username"])){
                    if($_SESSION["username"] == "admin"){
                ?>
                    <div class="w-full bg-white">
                        <!-- add new product button -->
                    </div>
                <?php
                    }
                }
                ?>
            </div>
        </section>
    </main>

    <footer class="mt-48">
        <div class="waves">
            <div class="wave" id="wave1"></div>
            <div class="wave" id="wave2"></div>
            <div class="wave" id="wave3"></div>
            <div class="wave" id="wave4"></div>
        </div>

        <div class="container mt-14 text-[#DEBBD9]">
            <div class="grid grid-cols-1 lg:grid-cols-3">
                <div class="flex flex-wrap mx-auto lg:align-left mb-2">
                    <a href="#"><ion-icon name="logo-instagram" class="text-4xl mr-6 lg:mr-7 hover:text-violet-900"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-facebook" class="text-4xl mr-6 lg:mr-7 hover:text-violet-900"></ion-icon></a>
                    <a href="#"><ion-icon name="mail-outline" class="text-4xl mr-6 lg:mr-7 hover:text-violet-900"></ion-icon></a>
                </div>
                <div class="mx-auto mb-8">
                    <div class="max-w-14 mx-auto">
                        <img src="https://i.ibb.co.com/LZL0FqD/LOGO-YUPI-CARE-ALP.png" alt="Logo">
                    </div>
                </div>
                <div class="mx-auto text-center lg:text-left lg:align-right">
                    <p>© 2024 YuPiSkin Inc. All rights reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const login = document.querySelector('.login');
        const register = document.querySelector('.register');
        const loginMobile = document.querySelector('#loginMobile');
        const registerMobile = document.querySelector('#registerMobile');
        const popupLogin = document.querySelector('#popuplogin');
        const popupRegister = document.querySelector('#popupregister');
        const closepopupLogin = document.querySelector('#close-popup-login');
        const closepopupRegister = document.querySelector('#close-popup-register');

        login.addEventListener('click', function() {
            popupLogin.classList.toggle('hidden');
            profileMenu.classList.toggle('hidden');
        });

        loginMobile.addEventListener('click', function() {
            popupLogin.classList.toggle('hidden');
            profileMenu.classList.toggle('hidden');
        });

        register.addEventListener('click', function() {
            popupRegister.classList.toggle('hidden');
            profileMenu.classList.toggle('hidden');
        });

        registerMobile.addEventListener('click', function() {
            popupRegister.classList.toggle('hidden');
            profileMenu.classList.toggle('hidden');
        });

        closepopupLogin.addEventListener('click', function() {
            popupLogin.classList.add('hidden');
        });

        closepopupRegister.addEventListener('click', function() {
            popupRegister.classList.add('hidden');
        });
    </script>
</body>

</html>
