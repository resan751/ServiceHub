<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard admin</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class=" font-jakarta bg-black3 flex">
    <nav>
        <div class="nav h-full w-48">
            <div class="nav-back">
                <div class="nav-head text-white text-lg font-bold p-1 pt-1">
                    <h1><i class='bx bxs-category'></i>ServiceHub</h1>
                </div>
                <div class="nav-menu text-white1">
                    <div class="nav-txt pt-9 "><button class="w-full h-10 rounded-md text-start hover:border hover:text-white"><a href="dashboard" class="pl-3"><i class='bx bxs-user'></i>User</a></button></div>
                    <div class="nav-txt "><button class=" w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="barang" class="pl-3 w-full h-full"><i class='bx bx-cart'></i>Barang</a></button></div>
                    <div class="nav-txt "><button class=" w-full h-12 rounded-md text-start border text-white "><p class="pl-3 w-full h-full"><i class='bx bxs-user-rectangle'></i>Jasa</p></button></div>
                    <div class="nav-txt "><button class=" w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="list" class="pl-3 w-full h-full"><i class='bx bxs-data'></i>List</a></button></div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <div class="nav-txt pt-72"><button
                                class=" w-full h-14 rounded-md text-start border border-white3 hover:border-white hover:text-white transition transform hover:scale-95">
                                <p class=" pl-12 pt-3 font-semibold text-xl w-full h-full"><i
                                        class='bx bx-exit'></i>Logout</p>
                            </button></div>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah penghapusan langsung sebelum konfirmasi
            let confirmAction = confirm("Apakah Anda yakin ingin menghapus data ini?");
            if (confirmAction) {
                event.target.closest("form").submit(); // Melanjutkan penghapusan jika konfirmasi "OK"
            } else {
                alert("Penghapusan dibatalkan.");
            }
        }
    </script>
    <div class="main bg-white w-10/12 ml-4 mt-3 h-[38rem] rounded-3xl    ">
        <div class="main-back">
            <div class="main-menu">
                <div class="main-head flex justify-between items-center">
                    <div class="head-txt p-5 font-semibold text-4xl">
                    Hai, @auth{{ Auth::user()->username }} @endauth
                </div>
                <form method="GET" action="{{ route('jasa.index') }}" class="flex">
                    <input type="text" name="search" placeholder="Cari jasa..." value="{{ request('search') }}"
                        class="border-2 border-black3 rounded-lg p-2 w-60 h-10">
                    <button type="submit"
                        class="ml-2 bg-black3 text-white5 p-2 rounded-md h-7 hover:text-white absolute right-36 top-[39px] transition transform hover:scale-95"><i
                            class='bx bx-search-alt-2'></i></button>
                    <a href="{{ route('jasa.index') }}"
                        class="ml-2 w-24 h-10 text-center bg-black3 text-white5 border-2 border-black3 hover:bg-white5 hover:text-black3 transition-colors duration-500  p-2 rounded-md mr-3">
                        Reset
                    </a>
                </form>
            </div>
            <hr color="black">
        </div>
        <div class="ad">
            <div class="btn mt-2">
                <button class=" ml-6 bg-white5 border-2 border-blue-600 text-blue-600 hover:text-white5 hover:bg-blue-600 transition-colors duration-500 rounded h-10 "><a class=" p-1 font-bold text-4xl"
                        href="adjasa"><i class='bx bx-plus'></i></a></button>
            </div>
        </div>
        <div class="tabel-head text-center font-semibold text-lg">
            <h2>Tabel Jasa</h2>
        </div>
        <div class="main-tabel">
            <div class="overflow-y-auto scrollbar-hide h-[27rem]">
                <table class="w-[95%] ml-7 border-collapse">
                    <thead>
                        <tr>
                            <th class="border-y-2 border-l-2 border-black text-start pl-2 w-20">ID Jasa</th>
                            <th class="border-y-2 border-black text-start pl-2">Nama Jasa</th>
                            <th class="border-y-2 border-black text-start pl-2">Harga Jasa</th>
                            <th class="border-y-2 border-r-2 border-black text-start pl-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Jasa as $list)
                            <tr>
                                <td class="border-y-2 border-l-2 border-black pl-2">{{ $list->id_jasa }}</td>
                                <td class="border-y-2 border-black pl-2">{{ $list->nama_jasa }}</td>
                                <td class="border-y-2 border-black pl-2">Rp{{ number_format($list->harga_jasa, 0, ',', '.') }}</td>
                                <td class="border-y-2 border-r-2 border-black p-2">
                                    <div class="flex gap-2">
                                        <a href="{{ route('jasa.edit', $list->id_jasa) }}"
                                            class="bg-white5 border-2 border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white5 transition-colors duration-500 rounded p-1">
                                            <i class='bx bxs-edit-alt text-xl'></i>
                                        </a>
                                        <form action="{{ route('jasa.destroy', $list->id_jasa) }}"
                                            method="post"
                                            onsubmit="return confirmDelete(event)">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-white5 border-2 border-red-700 text-red-700 hover:bg-red-700 hover:text-white5 transition-colors duration-500 rounded p-1">
                                                <i class='bx bx-trash text-xl'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border-y-2 border-black text-center p-4">
                                    Jasa tidak ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</body>

</html>
