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

            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }
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
                    <div class="nav-txt pt-9 "><button
                            class="w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="dashboard"
                                class="pl-3 w-full h-full"><i class='bx bxs-user-rectangle'></i>User</a></button></div>
                    <div class="nav-txt "><button class=" w-full h-12 rounded-md text-start border text-white">
                            <p class="pl-3"><i class='bx bx-cart'></i>Barang</p>
                        </button></div>
                    <div class="nav-txt "><button
                            class=" w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="jasa"
                                class="pl-3 w-full h-full"><i class='bx bx-smile'></i>Jasa</a></button></div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <div class="nav-txt pt-80"><button
                                class=" w-full h-14 rounded-md text-start border border-white3 hover:border-white hover:text-white transition transform hover:scale-95">
                                <p class=" pl-12 pt-3 font-semibold text-xl w-full h-full"><i
                                        class='bx bx-exit'></i>Logout</p>
                            </button></div>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    <div class="main bg-white w-10/12 ml-4 mt-3 h-[38rem] rounded-3xl    ">
        <div class="main-back">
            <div class="main-menu">
                <div class="main-head">
                    <div class="head-txt p-5 font-semibold text-4xl">
                    Hai, @auth{{ Auth::user()->username }} @endauth
                </div>
                <hr color="black">
            </div>
            <div class="flex">
                <div class="main-grafik w-5/12 h-48">
                    <div class="chart-container ">
                        <canvas id="pieChart" class=" max-h-48 w-full text-start gap-11"></canvas>
                        <!-- Adjust size and center the chart -->
                    </div>
                    <script>
                        // Data dari controller
                        var barangData = @json($barang);

                        // Mengambil nama barang dan stok
                        var labels = barangData.map(function(item) {
                            return item.nama_barang;
                        });

                        var stok = barangData.map(function(item) {
                            return item.stok;
                        });

                        // Membuat pie chart
                        var ctx = document.getElementById('pieChart').getContext('2d');
                        var pieChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Stok Barang',
                                    data: stok,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255,1)',
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
                </div>
                <div class="grafik-barang flex flex-wrap">
                    @forelse ($barang as $chart)
                        <button
                            class="m-2  bg-white border-2 border-black rounded-lg shadow-md shadow-black w-44 h-14">
                            <p class="font-semibold text-xl text-left pl-2">{{ $chart->nama_barang }}:
                                {{ $chart->stok }}</p>
                        </button>


                    @empty
                    @endforelse
                </div>
            </div>
            <div class="ad">
                <div class="btn">
                    <button class=" ml-6 bg-blue-400 hover:bg-blue-600 p-1 rounded"><a class=" p-1 font-semibold"
                            href="adbarang"><i class='bx bx-plus'></i>add data</a></button>
                </div>
            </div>
            <div class="tabel-head text-center font-semibold">
                <h2>Tabel user</h2>
            </div>
            <div class="main-tabel flex justify-center overflow-y-auto scrollbar-hide h-52">
                <table class="w-[99%] table-fixed ">
                    <thead>
                        <tr>
                            <th class="border-black border-l-2 border-t-2 border-b-2 w-20 text-start pl-1">id barang
                            </th>
                            <th class="border-black border-t-2 border-b-2 w-96 text-start">nama</th>
                            <th class="border-black border-t-2 border-b-2 w-96 text-start">harga</th>
                            <th class="border-black border-t-2 border-b-2 w-28 text-start">stok</th>
                            <th class="border-black border-t-2 border-b-2 border-r-2 text-start" colspan="2">
                                action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Barang as $list)
                            <tr>
                                <td class=" border-l-2 border-b-2 border-black pl-1 ">{{ $list->id_barang }}</td>
                                <td class=" border-b-2 border-black">{{ $list->nama_barang }}</td>
                                <td class=" border-b-2 border-black">{{ $list->harga_barang }}</td>
                                <td class=" border-b-2 border-black">{{ $list->stok }}</td>
                                <td class=" border-b-2 border-black h-9"><button
                                        class="  bg-amber-500 hover:bg-amber-600 p-1 rounded transition transform hover:scale-95"><a
                                            class=" p-1 font-semibold"
                                            href="{{ route('barang.edit', $list->id_barang) }}">Update</a></button>
                                </td>
                                <form action="{{ route('barang.destroy', $list->id_barang) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <td class=" border-b-2 border-r-2 border-black h-9"><button
                                            class=" bg-red-600 hover:bg-red-700 p-1 rounded transition transform hover:scale-95"
                                            type="submit">Delete</button></td>
                                </form>
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
