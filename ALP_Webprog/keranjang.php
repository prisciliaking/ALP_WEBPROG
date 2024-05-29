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
                <div class="md:hover:text-violet-900 md:hover:scale-105 md:transition-transform md:cursor-pointer">
                    <span class="material-symbols-outlined text-3xl">shopping_cart</span>
                </div>
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
                window.onscroll = function(){
                    const header = document.querySelector('header');
                    const nav = document.querySelector('nav');
                    const fixedNav = header.offsetTop;
                    var width = screen.width;
                    if(window.pageYOffset > fixedNav){
                        header.classList.remove('absolute');
                        header.classList.remove('bg-[#DEBBD9]');
                        header.classList.add('fixed');
                        header.classList.add('navbar-fixed');
                    }else{
                        header.classList.add('absolute');
                        header.classList.add('bg-[#DEBBD9]');
                        header.classList.remove('fixed');
                        nav.classList.remove('navbar-fixed');
                    }
                }

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
    </header>

    <main>
        <section class="pt-32 px-4 lg:px-24">
            <div class="container">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
                    <a href="#"><ion-icon name="logo-instagram" class="text-4xl mr-6 lg:mr-7 hover:text-violet-900"></ion-icon></a>
                    <a href="#"><ion-icon name="logo-facebook" class="text-4xl mr-6 lg:mr-7 hover:text-violet-900"></ion-icon></a>
                    <a href="#"><ion-icon name="mail-outline" class="text-4xl mr-6 lg:mr-7 hover:text-violet-900"></ion-icon></a>
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

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
</body>
</html>
