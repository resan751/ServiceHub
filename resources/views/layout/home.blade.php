<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>dashboard karyawan</title>
@vite('resources/css/app.css')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
    rel="stylesheet">
<style>
    * {
        margin: 0;
        padding: 0;

        body {
            background-image: url('image/msm.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

    }
</style>
</head>

<body class=" font-jakarta">
    <div class="absolute w-full h-[45%] top-14 bg-black4 opacity-50">
    </div>
    <nav>
        <div class="nav bg-black3 p-3 w-full">
            <div class="nav-back">
                <div class="nav-menu flex justify-between items-center">
                    <div class="nav-txt px-1 font-bold text-2xl text-white5">
                        <h2>ServiceHub</h2>
                    </div>
                    <div class="nav-txt flex items-center relative">
                        <div class="nav-txt px-1 font-medium text-lg flex items-center cursor-pointer text-white5"
                            id="userDropdown">
                            @auth
                            <p>{{ Auth::user()->username}}</p>
                            @endauth
                            <i class='bx bx-chevron-down'></i>
                        </div>
                        <div id="dropdownMenu"
                            class="hidden absolute right-0 top-7 shadow-lg rounded-lg w-32 transition-all duration-500">
                            <ul class="">
                                <li class="">
                                    <div class="btn mx-2">
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="bg-white py-1 px-5 rounded-md items-center border-2 border-orange-500 text-orange-500 hover:bg-red-600 hover:text-white hover:border-red-600 transition-colors duration-500 w-full ">logout</button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                            <script>
                                const userDropdown = document.getElementById('userDropdown');
                                const dropdownMenu = document.getElementById('dropdownMenu');

                                userDropdown.addEventListener('click', () => {
                                    dropdownMenu.classList.toggle('hidden');
                                });

                                document.addEventListener('click', (event) => {
                                    if (!userDropdown.contains(event.target)) {
                                        dropdownMenu.classList.add('hidden');
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="button absolute top-72 left-[31rem]">
        <button class="bg-black3 text-white5 px-5 py-2 rounded-md mx-2 hover:bg-white5 hover:text-black3 transition-colors duration-500"><a href="http://"><i class='bx bxs-data'></i>pendataan</a></button>
        <button class="bg-black3 text-white5 px-5 py-2 rounded-md mx-2 hover:bg-white5 hover:text-black3 transition-colors duration-500"><a href="list"><i class='bx bxs-data'></i>list data </a></button>
    </div>
    <div class="main bg-white7 w-full h-[291px] mt-[285px]">
        <div class="main-back">
            <div class="main-menu">
                popop
            </div>
        </div>
    </div>
</body>

</html>
