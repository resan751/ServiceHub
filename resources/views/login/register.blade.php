<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
<style>
    *{
        margin: 0;
        padding: 0;

    }
    body{
        background-image:url('image/ms2.jpeg');
        /* height: 100vh;
        width: 100%;
        object-fit: contain */
    }
</style>
</head>
<body class=" font-jakarta">
    <script>
        function togglePassword() {
            let passwordField = document.getElementById("password");
            let eyeIcon = document.getElementById("eyeIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.classList.replace('bx-show', 'bx-hide'); // Ganti ikon jadi mata tertutup
            } else {
                passwordField.type = "password";
                eyeIcon.classList.replace('bx-hide', 'bx-show'); // Ganti ikon jadi mata terbuka
            }
        }
    </script>
    <div class="bg-black3 opacity-50 h-full w-3/6 absolute left-[680px]"></div>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="register h-full bg-black3 w-3/6">
            <div class="back w-full ">
                <button class="text-white5 bg-black4 p-1 text-center mt-1 ml-1 rounded-md hover:bg-white5 hover:text-black4 transition-colors duration-500">
                    <i class='bx bx-left-arrow-alt'></i>
                    <a href="/">back</a>
                </button>
            </div>
            <div class="register-back flex justify-center">
                <div class="register-menu w-4/6 h-full  ">
                    <div class="register-head text-center text-6xl pt-12 text-white5 font-black">
                        <h1>REGISTER</h1>
                    </div>
                    <div class="logo text-center text-9xl pt-10 text-white5">
                        <i class='bx bx-user-plus'></i>
                    </div>
                    <div class="register-input pt-10"><input class="w-full h-10 rounded-lg bg-white border-solid border-2 border-black" type="text" placeholder="Username" name="username" id=""></div>
                    <div class="register-input pt-4"><input class="w-full h-10 rounded-lg bg-white border-solid border-2 border-black" type="email" placeholder="email" name="email" id=""></div>
                    <div class="register-input pt-4"><input class="w-full h-10 rounded-lg bg-white border-solid border-2 border-black" type="password" placeholder="Password" name="password" id="password"></div>
                    <button class="text-black left-[33.5rem] text-2xl absolute top-[29.5rem]" type="button" onclick="togglePassword()">
                        <i id="eyeIcon" class='bx bx-show'></i>
                    </button>
                    <div class="register-btn">
                        <div class="btn w-full p-2 mt-20 bg-black4 text-white5 hover:text-black3 hover:bg-white5 transition-colors duration-500 rounded-lg text-center"><button class="w-full" type="submit"><i class='bx bx-log-in'></i>register</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
