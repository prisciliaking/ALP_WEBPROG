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

        login.addEventListener('click', function () {
            popupLogin.classList.toggle('hidden');
            profileMenu.classList.toggle('hidden');
        });

        loginMobile.addEventListener('click', function () {
            popupLogin.classList.toggle('hidden');
            profileMenu.classList.toggle('hidden');
        });

        register.addEventListener('click', function () {
            popupRegister.classList.toggle('hidden');
            profileMenu.classList.toggle('hidden');
        });

        registerMobile.addEventListener('click', function () {
            popupRegister.classList.toggle('hidden');
            profileMenu.classList.toggle('hidden');
        });

        closepopupLogin.addEventListener('click', function () {
            popupLogin.classList.add('hidden');
        });

        closepopupRegister.addEventListener('click', function () {
            popupRegister.classList.add('hidden');
        });
    </script>
</body>

</html>