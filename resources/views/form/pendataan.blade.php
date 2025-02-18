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
    <div class="absolute w-full h-[170%] top-14 bg-black4 opacity-50">
    </div>
    <nav>
        <div class="nav bg-black3 p-3 w-full">
            <div class="nav-back">
                <div class="nav-menu flex justify-between items-center">
                    <div class="nav-txt px-1 font-bold text-2xl text-white5">
                        <h2>ServiceHub</h2>
                    </div>
                    <div class="nav-txt flex items-center relative">
                        <div class="nav-txt font-medium text-lg flex items-center text-white5 mr-5 ">
                            <a href="list"><i class='bx bxs-data'></i>list data</a>
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
    <div class="main bg-black3 h-auto w-9/12 absolute top-20 left-40 rounded-xl">
        <div class="main-back">
            <div class="main-head">
                <div class="head-txt p-2 font-semibold text-4xl text-center text-white5">
                    <h2>pendataan</h2>
                </div>
            </div>
            <div class="main-menu">
                <form action="{{ route('data.store') }}" method="post">
                    @csrf

                    <div class="keluhan ml-2 my-1">
                        <input type="text" class="w-[98%] rounded-lg h-7" name="keluhan" id="" placeholder="keluhan">
                    </div>


                    <!-- Barang -->
                    <div class="main-txt p-2 font-semibold text-2xl text-center text-white5">
                        <h2>Barang</h2>
                    </div>
                    <div class="flex flex-wrap bg-black4 w-[98%] ml-2 rounded-lg p-1 h-auto">
                        @foreach ($Barang as $item)
                            <div class="main-input p-2">
                                <div class="input flex bg-black3 items-center text-white5 w-72 p-2 rounded-lg transition transform hover:scale-95">
                                    <label class="flex w-40">
                                        <input type="checkbox" name="barang[{{ $item->id_barang }}][id_barang]" value="{{ $item->id_barang }}" class="mr-2">
                                        {{ $item->nama_barang }} ({{ $item->stok }})
                                    </label>
                                    <input type="number" name="barang[{{ $item->id_barang }}][harga]" placeholder="Harga Satuan"
                                        class="ml-2 mt-2 rounded-lg p-1 h-7 w-[30%] text-black bg-white">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="total">
                        <input type="number" name="total_harga_barang" placeholder="Total harga barang" class="ml-2 mt-5 rounded-lg p-1 h-7 w-[98%] text-black bg-white">
                    </div>

                    <!-- Jasa -->
                    <div class="main-txt p-2 font-semibold text-2xl text-center text-white5">
                        <h2>Jasa</h2>
                    </div>
                    <div class="flex flex-wrap bg-black4 w-[98%] ml-2 rounded-lg p-1 h-auto">
                        @foreach ($Jasa as $item)
                            <div class="main-input p-2">
                                <div class="input flex bg-black3 items-center text-white5 p-2 w-60 rounded-lg transition transform hover:scale-95">
                                    <label class="flex w-40">
                                        <input type="checkbox" name="jasa[{{ $item->id_jasa }}][id_jasa]" value="{{ $item->id_jasa }}" class="mr-2">
                                        {{ $item->nama_jasa }}
                                    </label>
                                    <input type="number" name="jasa[{{ $item->id_jasa }}][harga]" placeholder="Harga Satuan"
                                        class="ml-2 mt-2 rounded-lg p-1 h-7 w-[30%] text-black bg-white">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="total">
                        <input type="number" name="total_harga_jasa" placeholder="Total harga jasa" class="ml-2 mt-5 rounded-lg p-1 h-7 w-[98%] text-black bg-white">
                    </div>
                    <div class="total">
                        <input type="number" name="total_harga_semua" placeholder="Total harga semuanya" class="ml-2 mt-5 rounded-lg p-1 h-7 w-[98%] text-black bg-white">
                    </div>
                    <div class="total flex">
                        <input type="number" name="dibayar" placeholder="dibayar" class="ml-2 mt-5 rounded-lg p-1 h-7 w-[49%] text-black bg-white">
                        <input type="number" name="kembalian" placeholder="kembalian" class="ml-2 mt-5 rounded-lg p-1 h-7 w-[48%] text-black bg-white">
                    </div>

                    <div class="main-btn mt-4 ml-3 mb-3">
                        <button type="submit"
                            class="bg-black4 text-white5 rounded-lg h-10 w-[98%] border-2 border-black4 hover:bg-white5 hover:text-black3 transition-colors duration-500">
                            Tambah Transaksi
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
