<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>form login</title>
    @vite('resources/css/app.css')
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-image: url('image/ms2.jpeg');
        }
    </style>
</head>

<body class=" font-jakarta">
    <form action="{{ route('login.aunthenticate') }}" method="post">
        @csrf
        <div class="login h-full">
            <div class="login-back bg-white3 w-3/6 h-full flex justify-center">
                <div class="login-menu w-4/6 h-full  ">
                    <div class="login-head text-center text-6xl pt-12 text-black2 font-black font-poppin">
                        <h1>LOGIN</h1>
                    </div>
                    <div class="logo text-center text-9xl pt-10">
                        <i class='bx bx-user'></i>
                    </div>
                    <div class="login-input pt-10">
                        <input class="w-full h-10 rounded-lg bg-white border-solid border-2 border-black" type="text"
                            placeholder="username" name="username" id="" required></div>
                    @error('username')
                        <div>{{ $message }}</div>
                    @enderror
                    <div class="login-input pt-4 relative flex items-center justify-center">
                        <input class="pw w-full h-10 rounded-lg bg-white border-solid border-2 border-black"
                            type="password" placeholder="Password" name="password" id="" required>
                        {{-- <div class="eye cursor-pointer absolute flex items-center justify-center right-[10px]">
                            <p>lo</p>
                        </div> --}}
                    </div>
                    @error('username')
                        <div>{{ $message }}</div>
                    @enderror
                    <div class="login-txt pt-4 ml-96 text-black2 text-lg font-bold hover:text-white1 w-18">
                        <a href="register">register</a>
                    </div>
                    <div class="login-btn">
                        <div class="btn w-full h-10 bg-black text-white2 mt-28 rounded-lg text-center hover:text-white">
                            <button class="w-full pt-2 " type="submit"><i class='bx bx-log-in'></i>Login</button></div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
