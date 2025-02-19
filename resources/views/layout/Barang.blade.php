<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>dashboard admin</title>
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
    {{-- Sidebar Navigation --}}
    <nav class="w-48 h-full">
        <div class="nav-back">
            <div class="nav-head text-white text-lg font-bold p-1 pt-1">
                <h1><i class='bx bxs-category'></i>ServiceHub</h1>
            </div>
            <div class="nav-menu text-white1">
                <div class="nav-txt pt-9">
                    <a href="dashboard" class="w-full h-10 rounded-md text-start hover:border hover:text-white block pl-3">
                        <i class='bx bxs-user'></i>User
                    </a>
                </div>
                <div class="nav-txt">
                    <button class="w-full h-12 rounded-md text-start border text-white">
                        <p class="pl-3"><i class='bx bx-cart'></i>Barang</p>
                    </button>
                </div>
                <div class="nav-txt">
                    <a href="jasa" class="w-full h-10 rounded-md text-start hover:border hover:text-white block pl-3">
                        <i class='bx bxs-user-rectangle'></i>Jasa
                    </a>
                </div>
                <form action="{{ route('logout') }}" method="post" class="nav-txt pt-80">
                    @csrf
                    <button type="submit" class="w-full h-14 rounded-md text-start border border-white3 hover:border-white hover:text-white transition transform hover:scale-95">
                        <p class="pl-12 font-semibold text-xl">
                            <i class='bx bx-exit'></i>Logout
                        </p>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="main bg-white w-10/12 ml-4 mt-3 h-[38rem] rounded-3xl p-5">
        <div class="main-head flex justify-between items-center mb-4">
            <div class="head-txt font-semibold text-4xl">
                <p>Hai, @auth{{ Auth::user()->username }}@endauth</p>
            </div>
            <form method="GET" action="{{ route('barang.index') }}" class="flex items-center">
                <input type="text"
                    name="search"
                    placeholder="Cari barang..."
                    value="{{ request('search') }}"
                    class="border-2 border-black3 rounded-lg p-2 w-60">
                <button type="submit"
                    class="ml-2 bg-black3 text-white5 p-2 rounded-md absolute right-[150px] hover:text-white transition transform hover:scale-95">
                    <i class='bx bx-search-alt-2'></i>
                </button>
                <a href="{{ route('barang.index') }}"
                    class="ml-2 w-24 text-center bg-black3 text-white5 border-2 border-black3 hover:bg-white5 hover:text-black3 transition-colors duration-500 p-2 rounded-md">
                    Reset
                </a>
            </form>
        </div>

        <hr class="border-black mb-4">

        {{-- Chart Section --}}
        <div class="flex mb-4">
            <div class="w-5/12">
                <canvas id="pieChart" class="max-h-48"></canvas>
            </div>
            <div class="flex-1 flex flex-wrap">
                @forelse ($barang as $chart)
                    <div class="m-2 bg-white border-2 border-black rounded-lg shadow-md shadow-black w-44 h-14 p-2">
                        <p class="font-semibold text-xl">
                            {{ $chart->nama_barang }}: {{ $chart->stok }}
                        </p>
                    </div>
                @empty
                    <p class="text-center w-full">Tidak ada data barang</p>
                @endforelse
            </div>
        </div>

        {{-- Table Section --}}
        <div class="mb-4">
            <div class="flex items-center mb-2">
                <a href="adbarang"
                    class="ml-6 bg-white5 border-2 border-blue-600 text-blue-600 hover:text-white5 hover:bg-blue-600 transition-colors duration-500 rounded h-10 w-10 flex items-center justify-center">
                    <i class='bx bx-plus text-2xl'></i>
                </a>
                <h2 class="ml-4 font-semibold">Tabel Barang</h2>
            </div>

            <div class="overflow-y-auto scrollbar-hide h-52">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="border-y-2 border-l-2 border-black text-start pl-2 w-22">ID Barang</th>
                            <th class="border-y-2 border-black text-start pl-2">Nama</th>
                            <th class="border-y-2 border-black text-start pl-2">Harga</th>
                            <th class="border-y-2 border-black text-start pl-2 w-40">Stok</th>
                            <th class="border-y-2 border-r-2 border-black text-start pl-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Barang as $list)
                            <tr>
                                <td class="border-y-2 border-l-2 border-black pl-2">{{ $list->id_barang }}</td>
                                <td class="border-y-2 border-black pl-2">{{ $list->nama_barang }}</td>
                                <td class="border-y-2 border-black pl-2">Rp{{ number_format($list->harga_barang, 0, ',', '.') }}</td>
                                <td class="border-y-2 border-black pl-2">{{ $list->stok }}</td>
                                <td class="border-y-2 border-r-2 border-black p-2">
                                    <div class="flex gap-2">
                                        <a href="{{ route('barang.edit', $list->id_barang) }}"
                                            class="bg-white5 border-2 border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white5 transition-colors duration-500 rounded p-1">
                                            <i class='bx bxs-edit-alt text-xl'></i>
                                        </a>
                                        <form action="{{ route('barang.destroy', $list->id_barang) }}"
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
                                <td colspan="5" class="border-y-2 border-black text-center p-4">
                                    Barang tidak ditemukan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function confirmDelete(event) {
            event.preventDefault();
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                event.target.closest("form").submit();
            }
        }

        // Chart initialization
        const barangData = @json($barang);
        const ctx = document.getElementById('pieChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: barangData.map(item => item.nama_barang),
                datasets: [{
                    label: 'Stok Barang',
                    data: barangData.map(item => item.stok),
                    backgroundColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 159, 120, 1)',
                    ],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>
</html>
