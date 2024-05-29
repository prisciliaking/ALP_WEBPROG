<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YuPiCare</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body class="bg-[#F6E7F1]">
    <!-- navigation -->
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
                        <div
                            class="md:hover:text-violet-900 md:hover:scale-105 md:transition-transform md:cursor-pointer">
                            <span class="material-symbols-outlined text-3xl">shopping_cart</span>
                        </div>
                    </a>
                </div>
                <!-- Profile and Cart Icons (hidden on mobile) -->
                <div class="hidden md:flex navbar-icon space-x-12">
                    <div class="hover:text-violet-900 hover:scale-105 transition-transform items-center justify-center cursor-pointer"
                        id="cartIcon">
                        <div class="font-semibold text-xl">
                            <a href="home.php">
                                <div class="flex items-center space-x-2">
                                    <span class="material-symbols-outlined text-3xl"> home </span>
                                    <h1> Home </h1>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="hover:text-violet-900 hover:scale-105 transition-transform items-center justify-center cursor-pointer"
                        id="cartIcon">
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
                        <div class="hover:text-violet-900 hover:scale-105 transition-transform items-center justify-center cursor-pointer"
                            id="profileMenuButton">
                            <div class="font-semibold text-xl">
                                <div class="flex items-center space-x-2">
                                    <span class="material-symbols-outlined text-3xl">account_circle</span>
                                    <h1>Profile</h1>
                                </div>
                            </div>
                        </div>
                        <!-- Dropdown Menu -->
                        <div id="profileMenu"
                            class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                            <a href="login.php"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                            <a href="register.php"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Register</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden">
                <a href="home.php"
                    class="block px-4 py-2 text-lg font-semibold text-gray-700 hover:bg-gray-100">Home</a>
                <div class="relative" id="mobileProfileMenuContainer">
                    <button class="w-full text-left px-4 py-2 text-lg font-semibold text-gray-700 hover:bg-gray-100"
                        id="mobileProfileMenuButton">Profile</button>
                    <!-- Mobile Profile Dropdown Menu -->
                    <div id="mobileProfileMenu" class="hidden bg-white rounded-md shadow-lg">
                        <a href="login.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Login</a>
                        <a href="register.php"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Register</a>
                    </div>
                </div>
            </div>
            <script>
                //navigation js
                window.onscroll = function () {
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

                profileMenuButton.addEventListener('mouseover', function () {
                    profileMenu.classList.remove('hidden');
                });

                profileMenuContainer.addEventListener('mouseleave', function () {
                    profileMenu.classList.add('hidden');
                });

                // Mobile menu functionality
                const menuButton = document.getElementById('menuButton');
                const mobileMenu = document.getElementById('mobileMenu');
                const mobileProfileMenuButton = document.getElementById('mobileProfileMenuButton');
                const mobileProfileMenu = document.getElementById('mobileProfileMenu');

                menuButton.addEventListener('click', function () {
                    mobileMenu.classList.toggle('hidden');
                });

                mobileProfileMenuButton.addEventListener('click', function () {
                    mobileProfileMenu.classList.toggle('hidden');
                });

                //end of navigation js
            </script>
        </nav>
    </header>

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
                                <h1> Product Details </h1>
                            </div>
                        </div>

                        <div>
                            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                        </div>

                        <div class="space-y-2">
                            <div>
                                <label class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                                    <input type="checkbox"
                                        class="form-checkbox item-checkbox h-5 w-5 text-blue-600 hidden md:block">

                                    <div class="max-w-full md:max-w-32">
                                        <img class="rounded-lg w-full"
                                            src="https://i.ibb.co.com/m0pVBcs/skintific-moist-2.png" alt="Skintific" />
                                    </div>

                                    <div class="flex flex-col space-y-2">
                                        <div class="flex items-center space-x-2">
                                            <input type="checkbox"
                                                class="form-checkbox item-checkbox h-5 w-5 text-blue-600 lg:hidden">
                                            <span class="font-semibold text-xl">Skintific</span>
                                        </div>
                                        <p>MSH Niacinamide Brightening Moisture Gel</p>

                                        <div class="flex justify-between items-center py-4 md:space-x-56">
                                            <div>
                                                <p class="text-xl font-bold">Rp 30.000</p>
                                            </div>

                                            <div class="flex items-center">
                                                <button
                                                    class="group rounded-l-xl px-4 py-2 border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300">
                                                    <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                        xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        viewBox="0 0 22 22" fill="none">
                                                        <path d="M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                            stroke-linecap="round" />
                                                    </svg>
                                                </button>

                                                <input type="text"
                                                    class="border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[60px] text-center bg-transparent"
                                                    placeholder="1">
                                                <button
                                                    class="group rounded-r-xl px-4 py-2 border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300">
                                                    <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                        xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                        viewBox="0 0 22 22" fill="none">
                                                        <path d="M11 5.5V16.5M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                            stroke-linecap="round" />
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

                            <div class="space-y-2">
                                <div>
                                    <label class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                                        <input type="checkbox"
                                            class="form-checkbox item-checkbox h-5 w-5 text-blue-600 hidden md:block">

                                        <div class="max-w-full md:max-w-32">
                                            <img class="rounded-lg w-full"
                                                src="https://i.ibb.co.com/m0pVBcs/skintific-moist-2.png"
                                                alt="Skintific" />
                                        </div>

                                        <div class="flex flex-col space-y-2">
                                            <div class="flex items-center space-x-2">
                                                <input type="checkbox"
                                                    class="form-checkbox item-checkbox h-5 w-5 text-blue-600 lg:hidden">
                                                <span class="font-semibold text-xl">Skintific</span>
                                            </div>
                                            <p>MSH Niacinamide Brightening Moisture Gel</p>

                                            <div class="flex justify-between items-center py-4 md:space-x-56">
                                                <div>
                                                    <p class="text-xl font-bold">Rp 30.000</p>
                                                </div>

                                                <div class="flex items-center">
                                                    <button
                                                        class="group rounded-l-xl px-4 py-2 border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300">
                                                        <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                            xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                            viewBox="0 0 22 22" fill="none">
                                                            <path d="M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                                stroke-linecap="round" />
                                                        </svg>
                                                    </button>

                                                    <input type="text"
                                                        class="border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[60px] text-center bg-transparent"
                                                        placeholder="1">
                                                    <button
                                                        class="group rounded-r-xl px-4 py-2 border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300">
                                                        <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                            xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                                                            viewBox="0 0 22 22" fill="none">
                                                            <path d="M11 5.5V16.5M16.5 11H5.5" stroke=""
                                                                stroke-width="1.6" stroke-linecap="round" />
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


                                <div class="space-y-2">
                                    <div>
                                        <label class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                                            <input type="checkbox"
                                                class="form-checkbox item-checkbox h-5 w-5 text-blue-600 hidden md:block">

                                            <div class="max-w-full md:max-w-32">
                                                <img class="rounded-lg w-full"
                                                    src="https://i.ibb.co.com/m0pVBcs/skintific-moist-2.png"
                                                    alt="Skintific" />
                                            </div>

                                            <div class="flex flex-col space-y-2">
                                                <div class="flex items-center space-x-2">
                                                    <input type="checkbox"
                                                        class="form-checkbox item-checkbox h-5 w-5 text-blue-600 lg:hidden">
                                                    <span class="font-semibold text-xl">Skintific</span>
                                                </div>
                                                <p>MSH Niacinamide Brightening Moisture Gel</p>

                                                <div class="flex justify-between items-center py-4 md:space-x-56">
                                                    <div>
                                                        <p class="text-xl font-bold">Rp 30.000</p>
                                                    </div>

                                                    <div class="flex items-center">
                                                        <button
                                                            class="group rounded-l-xl px-4 py-2 border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300">
                                                            <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                                xmlns="http://www.w3.org/2000/svg" width="22"
                                                                height="22" viewBox="0 0 22 22" fill="none">
                                                                <path d="M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                                    stroke-linecap="round" />
                                                            </svg>
                                                        </button>

                                                        <input type="text"
                                                            class="border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[60px] text-center bg-transparent"
                                                            placeholder="1">
                                                        <button
                                                            class="group rounded-r-xl px-4 py-2 border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300">
                                                            <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                                xmlns="http://www.w3.org/2000/svg" width="22"
                                                                height="22" viewBox="0 0 22 22" fill="none">
                                                                <path d="M11 5.5V16.5M16.5 11H5.5" stroke=""
                                                                    stroke-width="1.6" stroke-linecap="round" />
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


                                    <div class="space-y-2">
                                        <div>
                                            <label
                                                class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                                                <input type="checkbox"
                                                    class="form-checkbox item-checkbox h-5 w-5 text-blue-600 hidden md:block">

                                                <div class="max-w-full md:max-w-32">
                                                    <img class="rounded-lg w-full"
                                                        src="https://i.ibb.co.com/m0pVBcs/skintific-moist-2.png"
                                                        alt="Skintific" />
                                                </div>

                                                <div class="flex flex-col space-y-2">
                                                    <div class="flex items-center space-x-2">
                                                        <input type="checkbox"
                                                            class="form-checkbox item-checkbox h-5 w-5 text-blue-600 lg:hidden">
                                                        <span class="font-semibold text-xl">Skintific</span>
                                                    </div>
                                                    <p>MSH Niacinamide Brightening Moisture Gel</p>

                                                    <div class="flex justify-between items-center py-4 md:space-x-56">
                                                        <div>
                                                            <p class="text-xl font-bold">Rp 30.000</p>
                                                        </div>

                                                        <div class="flex items-center">
                                                            <button
                                                                class="group rounded-l-xl px-4 py-2 border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300">
                                                                <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                                    xmlns="http://www.w3.org/2000/svg" width="22"
                                                                    height="22" viewBox="0 0 22 22" fill="none">
                                                                    <path d="M16.5 11H5.5" stroke="" stroke-width="1.6"
                                                                        stroke-linecap="round" />
                                                                </svg>
                                                            </button>

                                                            <input type="text"
                                                                class="border-y border-gray-200 outline-none text-gray-900 font-semibold text-lg w-full max-w-[60px] text-center bg-transparent"
                                                                placeholder="1">
                                                            <button
                                                                class="group rounded-r-xl px-4 py-2 border border-gray-200 flex items-center justify-center shadow-sm transition-all duration-500 hover:bg-gray-50 hover:border-gray-300">
                                                                <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black"
                                                                    xmlns="http://www.w3.org/2000/svg" width="22"
                                                                    height="22" viewBox="0 0 22 22" fill="none">
                                                                    <path d="M11 5.5V16.5M16.5 11H5.5" stroke=""
                                                                        stroke-width="1.6" stroke-linecap="round" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="subtotal bg-[#F6E7F1] bg-opacity-50 px-4 py-12 rounded-md shadow">
                        <h2 class="font-manrope font-semibold text-xl text-black">
                            Subtotal</h2>
                        <div>
                            <hr class="h-px my-4 bg-gray-200 border-0 dark:bg-gray-700">
                        </div>

                        <div>

                            <form>
                                <div class="flex items-center justify-between py-8 md:space-x-56">
                                    <p class="font-medium text-xl leading-8 text-[#8A6791]">Total</p>
                                    <p class="font-semibold text-xl leading-8 text-[#8A6791]">Rp 300.000</p>
                                </div>
                                <button
                                    class="w-full text-center bg-[#F3BAE5] rounded-xl py-3 px-6 font-semibold text-lg text-white transition-all duration-500 hover:bg-[#f48fdb]">Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
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
                <div class="flex flex-wrap mx-auto lg:align-left mb-10">
                    <a href="#"><ion-icon name="logo-instagram"
                            class="text-4xl mr-6 lg:mr-7 hover:text-violet-900"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-facebook"
                            class="text-4xl mr-6 lg:mr-7 hover:text-violet-900"></ion-icon></a>
                    <a href="#"><ion-icon name="mail-outline"
                            class="text-4xl mr-6 lg:mr-7 hover:text-violet-900"></ion-icon></a>
                </div>
                <div class="mx-auto mb-8">
                    <div class="max-w-14 mx-auto">
                        <img src="https://i.ibb.co.com/LZL0FqD/LOGO-YUPI-CARE-ALP.png" alt="Logo">
                    </div>
                </div>
                <div class="mx-auto lg:align-right">
                    <p>© 2024 YuPiSkin Inc. All rights reserved</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // $("#hamburger").ready(
        //     function(){
        //         $("#hamburger").click(
        //             function(){
        //                 $("#nav-list").toggleClass("hidden");
        //                 $(this).toggleClass("hamburger-active");
        //             }
        //         )
        //     }
        // );
    </script>
    <script>
        $(document).ready(function () {
            $('#select-all').change(function () {
                $('.item-checkbox').prop('checked', this.checked);
            });

            $('.item-checkbox').change(function () {
                let allChecked = $('.item-checkbox').length === $('.item-checkbox:checked').length;
                $('#select-all').prop('checked', allChecked);
            });
        });
    </script>
</body>

</html>
