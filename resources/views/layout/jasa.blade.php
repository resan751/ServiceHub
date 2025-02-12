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
                    <div class="nav-txt pt-9 "><button class="w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="dashboard" class="pl-3"><i class='bx bxs-user-rectangle'></i>User</a></button></div>
                    <div class="nav-txt "><button class=" w-full h-10 rounded-md text-start hover:border hover:text-white "><a href="barang" class="pl-3 w-full h-full"><i class='bx bx-cart'></i>Barang</a></button></div>
                    <div class="nav-txt "><button class=" w-full h-12 rounded-md text-start border text-white"><p class="pl-3 pt-2 w-full h-full"><i class='bx bx-smile'></i>Jasa</p></button></div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <div class="nav-txt pt-80"><button class=" w-full h-14 rounded-md text-start border border-white3 hover:border-white hover:text-white transition transform hover:scale-95"><p class=" pl-12 pt-3 font-semibold text-xl w-full h-full"><i class='bx bx-exit'></i>Logout</p></button></div>
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
                        Hai, @auth{{ Auth::user()->username}} @endauth
                    </div>
                    <hr color="black">
                </div>
            </div>
            <div class="ad">
                <div class="btn">
                    <button class=" ml-6 bg-blue-400 hover:bg-blue-600 p-1 rounded"><a class=" p-1 font-semibold" href="adjasa"><i class='bx bx-plus'></i>add data</a></button>
                </div>
            </div>
                <div class="tabel-head text-center mt-1 font-semibold">
                    <h2>Tabel Jasa</h2>
                </div>
                <div class="main-tabel flex justify-center">
                    <table class="w-[99%] table-fixed">
                        <thead>
                          <tr>
                            <th class="border-black border-l-2 border-t-2 border-b-2 w-20 text-start pl-1" >id jasa</th>
                            <th class="border-black border-t-2 border-b-2 w-[31rem] text-start">nama jasa</th>
                            <th class="border-black border-t-2 border-b-2 w-96 text-start">harga jasa</th>
                            <th class="border-black border-t-2 border-b-2 border-r-2 text-start" colspan="2">action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($Jasa as $list)
                            <tr>
                                <td class=" border-l-2 border-b-2 border-black pl-1 ">{{ $list->id_jasa }}</td>
                            <td class=" border-b-2 border-black">{{ $list->nama_jasa }}</td>
                            <td class=" border-b-2 border-black">Rp{{ number_format($list->harga_jasa, 0, ',', '.' ) }}</td>
                            <td class=" border-b-2 border-black h-9 "><button class="bg-amber-500 hover:bg-amber-600 p-1 rounded transition transform hover:scale-95"><a class=" p-1 font-semibold" href="{{ route('jasa.edit', $list->id_jasa) }}">Update</a></button></td>
                            <form action="{{ route('jasa.destroy', $list->id_jasa) }}" method="post">
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
