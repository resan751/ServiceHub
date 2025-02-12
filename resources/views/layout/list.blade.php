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

<body class=" font-jakarta overflow-hidden">
    <div class="absolute w-full h-[92%] top-14 bg-black4 opacity-50">
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
                            <p>username</p>
                            <i class='bx bx-chevron-down'></i>
                        </div>
                        <div id="dropdownMenu"
                            class="hidden absolute right-0 top-7 shadow-lg rounded-lg w-32 transition-all duration-500">
                            <ul class="">
                                <li class="">
                                    <div class="btn mx-2"><button
                                            class="bg-white py-1 px-5 rounded-md items-center border-2 border-orange-500 text-orange-500 hover:bg-red-600 hover:text-white hover:border-red-600 transition-colors duration-500 w-full ">logout</button>
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
    <div class="back w-full ">
        <button
            class="text-white5 bg-black3 p-1 text-center absolute top-16 left-2 rounded-md hover:bg-white5 hover:text-black3 transition-colors duration-500">
            <i class='bx bx-left-arrow-alt'></i>
            <a href="list/back">back</a>
        </button>
    </div>
    <div class="main bg-white5 w-full h-80 absolute top-80">
        <div class="main-back">
            <div class="main-menu">
                <div class="tabel-txt flex justify-around">
                    <p class=" mt-1  font-medium text-lg">tabel barang</p>
                    <p class=" mt-1  font-medium text-lg">tabel jasa</p>
                </div>
                <div class="main-tabel flex justify-around overflow-y-auto scrollbar-hide h-52">
                    <table class="w-1/6 table-fixed">
                        <thead>
                            <tr>
                                <th class="border-black border-l-2 border-t-2 border-b-2 w-20 text-start pl-1">id barang</th>
                                <th class="border-black border-t-2 border-b-2 w-36 text-start pl-2">nama</th>
                                <th class="border-black border-t-2 border-b-2 w-36 text-start">harga</th>
                                <th class="border-black border-t-2 border-b-2 border-r-2 w-28 text-start">stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($Barang as $list)
                                <tr>
                                    <td class=" border-l-2 border-b-2 border-black pl-1 ">{{ $list->id_barang }}</td>
                                    <td class=" border-b-2 pl-2 border-black">{{ $list->nama_barang }}</td>
                                    <td class=" border-b-2 border-black">{{ $list->harga_barang }}</td>
                                    <td class=" border-r-2 border-b-2 border-black">{{ $list->stok }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    <table class="w-1/6 table-fixed">
                        <thead>
                          <tr>
                            <th class="border-black border-l-2 border-t-2 border-b-2 w-20 text-start pl-1" >id jasa</th>
                            <th class="border-black border-t-2 border-b-2 w-44 text-start">nama jasa</th>
                            <th class="border-black border-t-2 border-r-2 border-b-2 w-32 text-start">harga jasa</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($Jasa as $list)
                            <tr>
                                <td class=" border-l-2 border-b-2 border-black pl-1 ">{{ $list->id_jasa }}</td>
                            <td class=" border-b-2 border-black">{{ $list->nama_jasa }}</td>
                            <td class=" border-r-2 border-b-2 border-black">{{ $list->harga_jasa }}</td>
                          </tr>
                          @empty

                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
