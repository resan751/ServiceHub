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

<body class="font-jakarta bg-black3 flex">
    <nav>
        <div class="nav h-full w-48">
            <div class="nav-back">
                <div class="nav-head text-white text-lg font-bold p-1 pt-1">
                    <h1><i class='bx bxs-category'></i>ServiceHub</h1>
                </div>
                <div class="nav-menu text-white1">
                    <div class="nav-txt pt-9 "><button class="w-full h-10 rounded-md text-start hover:border hover:text-white"><a href="dashboard" class="pl-3"><i class='bx bxs-user'></i>User</a></button></div>
                    <div class="nav-txt "><button class=" w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="barang" class="pl-3 w-full h-full"><i class='bx bx-cart'></i>Barang</a></button></div>
                    <div class="nav-txt "><button class=" w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="jasa" class="pl-3 w-full h-full"><i class='bx bxs-user-rectangle'></i>Jasa</a></button></div>
                    <div class="nav-txt "><button class=" w-full h-12 rounded-md text-start border text-white  "><p class="pl-3 w-full h-full pt-2"><i class='bx bxs-data'></i>List</p></button></div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <div class="nav-txt pt-72">
                            <button
                                class="w-full h-14 rounded-md text-start border border-white3 hover:border-white hover:text-white transition transform hover:scale-95">
                                <p class="pl-12 pt-3 font-semibold text-xl w-full h-full"><i
                                        class='bx bx-exit'></i>Logout</p>
                            </button>
                        </div>
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
    <div class="main bg-white w-10/12 ml-4 mt-3 h-[95%] overflow-y-auto scrollbar-hide rounded-3xl">
        <div class="main-back">
            <div class="main-menu">
                <div class="main-head">
                    <div class="head-txt p-5 font-semibold text-4xl">
                        Hai, @auth{{ Auth::user()->username }} @endauth
                    </div>
                    <hr color="black">
                    <form action="{{ route('list .index') }}" method="get" class="mb-4 p-4 bg-black3 rounded-lg m-1">
                        <div class="flex gap-4 items-center">
                            <div>
                                <label for="bulan" class="text-white5">Filter Bulan:</label>
                                <select name="bulan" id="bulan" class="p-2 border rounded bg-white5 text-black3">
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ sprintf('%02d', $i) }}" {{ $bulan == sprintf('%02d', $i) ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div>
                                <label for="tahun" class="text-white5">Tahun:</label>
                                <select name="tahun" id="tahun" class="p-2 border rounded bg-white5 text-black3">
                                    @for ($i = date('Y'); $i >= 2020; $i--)
                                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Filter
                            </button>
                        </div>
                    </form>

                    <div class="summary bg-black3 p-4 mb-4 rounded-lg m-1">
                        <h2 class="text-xl font-bold mb-2 text-white5">Ringkasan {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white5 text-black3 p-3 rounded-lg">
                                <p class="font-semibold">Jumlah Transaksi:</p>
                                <p class="text-2xl font-bold">{{ $jumlahTransaksi }}</p>
                            </div>
                            <div class="bg-white5 text-black3 p-3 rounded-lg">
                                <p class="font-semibold">Total Pendapatan:</p>
                                <p class="text-2xl font-bold">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex overflow-x-auto scrollbar-hide w-[98%] ml-2 mb-2 text-white5">
                        @forelse ($services as $item)
                            <div class="main-tran bg-black3 w-96 h-auto mx-3 rounded-xl">
                                <div class="font-semibold text-xl text-center w-full h-8 p-1 items-center">
                                    <h2>data transaksi</h2>
                                </div>
                                <div class="main-txt font-semibold px-3">
                                    <p>ID service: {{ $item->id_service }}</p>
                                    <p>Petugas: {{ $item->user->username }}</p>
                                    <p>tanggal: {{ $item->tanggal }}</p>
                                    <p>keluhan: {{ $item->keluhan }}</p>
                                </div>

                                <div class="head w-full text-center font-semibold text-xl pb-2">
                                    <p>DETAIL</p>
                                </div>
                                <hr class="w-full text-white pb-2">
                                @forelse ($item->details as $detail)
                                    <div class="detail w-full font-semibold">
                                        @if ($detail->id_barang)
                                            <div class="barang flex justify-between px-3">
                                                <p>Barang: {{ $detail->barang->nama_barang }}</p>
                                                <p>Rp{{ number_format($detail->harga_satuan,  0, ',', '.') }}</p>
                                            </div>
                                        @elseif ($detail->id_jasa)
                                            <div class="jasa flex justify-between px-3">
                                                <p>Jasa: {{ $detail->jasa->nama_jasa }} </p>
                                                <p>Rp{{number_format($detail->harga_satuan,  0, ',', '.') }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <p>Tidak ada detail</p>
                                @endforelse
                                <hr class="w-full text-white pb-2 pt-2">
                                <div class="transaksi w-full px-3 font-semibold">
                                    <div class="total flex justify-between">
                                        <p>total:</p>
                                        <p>Rp{{number_format($item->total_harga,  0, ',', '.') }}</p>

                                    </div>
                                    <div class="bayar flex justify-between">
                                        <p>bayar:</p>
                                        <p>Rp{{number_format($item->dibayar,  0, ',', '.') }}</p>

                                    </div>
                                    <div class="kembalian flex justify-between pb-2">
                                        <p>kembalian:</p>
                                        <p>Rp{{ number_format($item->kembalian,  0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <hr class="w-full text-white">
                                <form action="{{ route('data.destroy', $item->id_service) }}" method="post"
                                    onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                    class="bg-white5 border-2 m-2 ml-[21rem]  border-red-700 text-red-700 hover:bg-red-700 hover:text-white5 transition-colors duration-500 rounded p-1">
                                    <i class='bx bx-trash text-xl '></i>
                                </button>
                            </form>
                            <hr class="w-full text-white">
                            <h1 class="text-center font-bold text-3xl py-2">ServiceHub</h1>
                            </div>
                        @empty
                            <p>Tidak ada service</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
