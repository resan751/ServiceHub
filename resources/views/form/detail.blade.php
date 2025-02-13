<html lang="en">

<head>
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
        }

        body {
            background-image: url('image/ms2.jpeg');
        }
    </style>
    </style>
</head>

<body class="font-jakarta overflow-hidden">
    <div class="bg-black3 opacity-50 absolute w-full h-[92%] mt-[56px]"></div>
    <nav>
        <div class="nav bg-black3 p-3 w-full">
            <div class="nav-back">
                <div class="nav-menu flex justify-between items-center">
                    <div class="nav-txt px-1 font-bold text-2xl text-white5">
                        <h2>ServiceHub</h2>
                    </div>
                    <div class="nav-txt flex items-center relative">
                        <div class="list bg-black3 text-white5 px-3 mx-5 rounded-xl font-medium text-lg flex items-center hover:bg-black4 hover:border-2 hover:border-white5  transition-all duration-100">
                            <a class="" href="list">list data</a>
                        </div>
                        <div class="nav-txt px-1 font-medium text-lg flex items-center cursor-pointer text-white5"
                            id="userDropdown">
                            @auth
                                <p>{{ Auth::user()->username }}</p>
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
                                            <button
                                                class="bg-white py-1 px-5 rounded-md items-center border-2 border-orange-500 text-orange-500 hover:bg-red-600 hover:text-white hover:border-red-600 transition-colors duration-500 w-full ">logout</button>
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
    <div class="back absolute ml-1 mt-1">
        <button
            class="text-white5 bg-black3 p-1 text-center mt-1 ml-1 rounded-md hover:scale-95 hover:text-black3 hover:bg-white5 transition-color duration-500">
            <i class='bx bx-left-arrow-alt'></i>
            <a href="">back</a>
        </button>
    </div>
    <div class="absolute top-28 left-96 w-[35rem] h-">
        <div class="main bg-black3 w-full h-[31rem] rounded-3xl justify-center flex  ">
            <div class="main-back w-11/12">
                <div class="main-head p-3 pb-3 text-2xl font-semibold text-center text-white5">
                    <h1>PENDATAAN</h1>
                </div>
                <form action="" method="POST">
                    @csrf
                    <div class="barang-head text-xl text-center text-white5">
                        <h2>BARANG</h2>
                    </div>
                    <div class="barang-check flex flex-wrap bg-black4 h-20 p-1 rounded-md transition-all duration-300  ">
                        @forelse ($Barang as $data)
                            <div class="flex">
                                <label class="mx-2 text-white" for="">{{ $data->nama_barang }}</label>
                                <input class="h-7" type="checkbox" name="nama_barang" id="">
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <div class="barang-head text-xl text-center text-white5 mt-2">
                        <h2>JASA</h2>
                    </div>
                    <div class="barang-check flex flex-wrap bg-black4 h-32 p-1 rounded-md  ">
                        @forelse ($Jasa as $data)
                            <div class="flex">
                                <label class="mx-2 text-white" for="">{{ $data->nama_jasa }}</label>
                                <input class="h-7" type="checkbox" name="nama_jasa" id="">
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <div
                        class="main-btn w-full h-10 p-2 mt-52 bg-black4 text-white5 hover:text-black3 hover:bg-white5 transition-color duration-500 rounded-lg text-center">
                        <button class="w-full" type="submit">TAMBAH</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
