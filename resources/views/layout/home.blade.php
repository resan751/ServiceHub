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

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
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
    <div class="button absolute top-72 left-[30rem]">
        <button
            class="bg-black3 w-80 font-semibold text-xl text-white5 px-5 py-2 rounded-md mx-2 hover:bg-white5 hover:text-black3 transition-colors duration-500"><a
                href="{{ route('pendataan') }}"><i class='bx bxs-data'></i>pendataan</a></button>
    </div>
    <div class="main bg-white7 w-full h-auto top-[21rem] absolute text-white5">
        <form action="{{ route('data.index') }}" method="get" class="mb-4 p-4 bg-black3 rounded-lg m-1">
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
            <h2 class="text-xl font-bold mb-2">Ringkasan {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</h2>
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

        <div class="main-back">
            <div class="main-menu">
                <div class=" flex overflow-x-auto overflow-y-auto scrollbar-hide">
                    @forelse ($services as $item)
                        <div class="main-tran bg-black3 w-96 h-auto m-3 rounded-xl">
                            <div class=" font-semibold text-xl text-center w-full h-8 p-1 items-center">
                                <h2>data transaksi</h2>
                            </div>
                            <div class="main-txt font-semibold px-3 ">
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
                                            <p>Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
                                        </div>
                                    @elseif ($detail->id_jasa)
                                        <div class="jasa flex justify-between px-3">
                                            <p>Jasa: {{ $detail->jasa->nama_jasa }} </p>
                                            <p>Rp{{ number_format($detail->harga_satuan, 0, ',', '.') }}</p>
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
                                    <p>Rp{{ number_format($item->total_harga, 0, ',', '.') }}</p>

                                </div>
                                <div class="bayar flex justify-between">
                                    <p>bayar:</p>
                                    <p>Rp{{ number_format($item->dibayar, 0, ',', '.') }}</p>

                                </div>
                                <div class="kembalian flex justify-between pb-2">
                                    <p>kembalian:</p>
                                    <p>Rp{{ number_format($item->kembalian, 0, ',', '.') }}</p>
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
</body>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function confirmDelete(event) {
        event.preventDefault();
        if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
            event.target.closest("form").submit();
        }
    }
</script>

</html>
