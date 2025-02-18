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
    </style>
</head>

<nav>
<body class=" font-jakarta bg-black3 flex">
        <div class="nav h-full w-48">
            <div class="nav-back">
                <div class="nav-head text-white text-lg font-bold p-1 pt-1">
                    <h1><i class='bx bxs-category'></i>ServiceHub</h1>
                </div>
                <div class="nav-menu text-white1">
                    <div class="nav-txt pt-9 "><button class="w-full h-12 rounded-md text-start border text-white">
                            <p class="pl-3"><i class='bx bxs-user'></i>User</p>
                        </button></div>
                    <div class="nav-txt "><button
                            class=" w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="barang"
                                class="pl-3 w-full h-full"><i class='bx bx-cart'></i>Barang</a></button></div>
                    <div class="nav-txt "><button
                            class=" w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="jasa   "
                                class="pl-3 w-full h-full"><i class='bx bxs-user-rectangle'></i>Jasa</a></button></div>
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
                <div class="main-head">
                    <div class="head-txt p-5 font-semibold text-4xl">
                    Hai, @auth{{ Auth::user()->username }} @endauth
                </div>
                <hr color="black">
            </div>
            <div class="flex">
                <div class="main-grafik">
                    <div class="grafik-head text-start ml-12 font-semibold">
                        <h2>Grafik user</h2>
                    </div>
                    <canvas id="Chart" class="w-48 h-48 mx-auto ml-1"></canvas>
                    <script>
                        const activityCtx = document.getElementById('Chart').getContext('2d');
                        new Chart(activityCtx, {
                            type: 'pie',
                            data: {
                                labels: ['Admin', 'User'],
                                datasets: [{
                                    data: [{{ $adminCount }}, {{ $userCount }}],
                                    backgroundColor: ['rgba(255, 159, 64, 0.8)', 'rgba(75, 192, 192, 0.8)']
                                }]
                            }
                        });
                    </script>
                </div>
                <div class="grafik-user justify-start ml-5 mt-7 flex">
                    <p class=" font-semibold text-2xl ml-2 mr-2 w-72 h-22 p-3 rounded-lg bg-white border-2 border-black shadow-lg shadow-red-600">
                        Total User: {{ $adminCount + $userCount }}
                    </p>
                    <p class="  font-semibold text-2xl ml-2 mr-2 w-72 h-22 p-3 rounded-lg bg-white border-2 border-black shadow-lg shadow-admin">
                        admin: {{ $adminCount }}
                    </p>
                    <p class="  font-semibold text-2xl ml-2 mr-2 w-72 h-22 p-3 rounded-lg bg-white border-2 border-black shadow-lg shadow-user">
                        User: {{ $userCount }}
                    </p>
                </div>
            </div>
            <div class="tabel-head text-center mt-10 font-semibold text-lg">
                <h2>Tabel user</h2>
            </div>
            <div class="main-tabel">
                <div class="overflow-y-auto scrollbar-hide h-52">
                    <table class="w-[95%] ml-7 border-collapse">
                        <thead>
                            <tr>
                                <th class="border-y-2 border-l-2 border-black text-start pl-2 w-20">ID User</th>
                                <th class="border-y-2 border-black text-start pl-2">Nama</th>
                                <th class="border-y-2 border-black text-start pl-2">Email</th>
                                <th class="border-y-2 border-black text-start pl-2 w-28">Role</th>
                                <th class="border-y-2 border-r-2 border-black text-start pl-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($User as $list)
                                <tr>
                                    <td class="border-y-2 border-l-2 border-black pl-2">{{ $list->id_user }}</td>
                                    <td class="border-y-2 border-black pl-2">{{ $list->username }}</td>
                                    <td class="border-y-2 border-black pl-2">{{ $list->email }}</td>
                                    <td class="border-y-2 border-black pl-2">{{ $list->role }}</td>
                                    <td class="border-y-2 border-r-2 border-black p-2">
                                        <div class="flex gap-2">
                                            <a href="{{ route('dashboard.edit', $list->id_user) }}"
                                                class="bg-white5 border-2 border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white5 transition-colors duration-500 rounded p-1">
                                                <i class='bx bxs-edit-alt text-xl'></i>
                                            </a>
                                            <form action="{{ route('dashboard.destroy', $list->id_user) }}"
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
                                        User tidak ditemukan
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
