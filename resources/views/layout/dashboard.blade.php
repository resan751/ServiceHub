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
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
        <style>
            * {
                margin: 0;
                padding: 0;
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
                    <div class="nav-txt pt-9 "><button class="w-full h-12 rounded-md text-start border text-white"><p class="pl-3"><i class='bx bxs-user-rectangle'></i>User</p></button></div>
                    <div class="nav-txt "><button class=" w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="barang" class="pl-3 w-full h-full"><i class='bx bx-cart'></i>Barang</a></button></div>
                    <div class="nav-txt "><button class=" w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="jasa   " class="pl-3 w-full h-full"><i class='bx bx-smile'></i>Jasa</a></button></div>
                    <div class="nav-txt pt-80"><button class=" w-full h-14 rounded-md text-start border border-white3 hover:border-white hover:text-white transition transform hover:scale-95"><a href="home" class=" pl-12 font-semibold text-lg w-full h-full"><i class='bx bx-exit'></i>kembali</a></button></div>
                </div>
            </div>
        </div>
    </nav>
     <div class="main bg-white w-10/12 ml-4 mt-3 h-[38rem] rounded-3xl    ">
        <div class="main-back">
            <div class="main-menu">
                <div class="main-head">
                    <div class="head-txt p-5 font-semibold text-4xl">
                        Hai Admin!
                    </div>
                    <hr color="black">
                </div>
                <div class="flex">

                    <div class="main-grafik">
                        <div class="grafik-head text-start ml-12 font-semibold">
                            <h2>Grafik user</h2>
                        </div>
                        <canvas id="Chart" class="w-48 h-48 mx-auto ml-1"></canvas> <!-- Adjust size and center the chart -->
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
                    <p class=" font-semibold text-2xl ml-2 mr-2 w-72 h-22 p-3 rounded-lg bg-white border-2 border-black shadow-lg shadow-red-600">Total User: {{ $adminCount + $userCount }}</p>
                    <p class="  font-semibold text-2xl ml-2 mr-2 w-72 h-22 p-3 rounded-lg bg-white border-2 border-black shadow-lg shadow-admin">admin: {{ $adminCount }}</p>
                    <p class="  font-semibold text-2xl ml-2 mr-2 w-72 h-22 p-3 rounded-lg bg-white border-2 border-black shadow-lg shadow-user">User: {{ $userCount }}</p>
                </div>
            </div>
                <div class="tabel-head text-center mt-10 font-semibold">
                    <h2>Tabel user</h2>
                </div>
                <div class="main-tabel flex justify-center">
                    <table class="w-[99%] table-fixed">
                        <thead>
                          <tr>
                            <th class="border-black border-l-2 border-t-2 border-b-2 w-20 text-start pl-1" >id user</th>
                            <th class="border-black border-t-2 border-b-2 w-96 text-start">nama</th>
                            <th class="border-black border-t-2 border-b-2 w-96 text-start">email</th>
                            <th class="border-black border-t-2 border-b-2 w-28 text-start">role</th>
                            <th class="border-black border-t-2 border-b-2 border-r-2 text-start" colspan="2">action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($User as $list)
                            <tr>
                                <td class=" border-l-2 border-b-2 border-black pl-1 ">{{ $list->id_user }}</td>
                            <td class=" border-b-2 border-black">{{ $list->username }}</td>
                            <td class=" border-b-2 border-black">{{ $list->email }}</td>
                            <td class=" border-b-2 border-black">{{ $list->role }}</td>
                            <td class=" border-b-2 border-black h-9"><button class="  bg-amber-500 hover:bg-amber-600 p-1 rounded transition transform hover:scale-95"><a class=" p-1 font-semibold" href="{{ route('dashboard.edit', $list->id_user) }}">Update</a></button></td>
                            <form action="{{ route('dashboard.destroy', $list->id_user) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <td class=" border-b-2 border-r-2 border-black h-9" ><button class=" bg-red-600 hover:bg-red-700 p-1 rounded transition transform hover:scale-95" type="submit">Delete</button></td>
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
