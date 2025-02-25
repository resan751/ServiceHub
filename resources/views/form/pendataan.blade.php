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

        }

        body {
            background-image: url('image/msm.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>

<body class=" font-jakarta">
    <div class="absolute w-full h-[170%] top-[68px] bg-black4 opacity-40">
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
                            <button class="bg-black3 p-2 rounded-lg" id="hargaBtn"><i class='bx bxs-data'></i>list
                                data</button>
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
                        <input type="text" class="w-[98%] rounded-lg h-7" name="keluhan" id=""
                            placeholder="keluhan">
                    </div>


                    <!-- Barang -->
                    <div class="main-txt p-2 font-semibold text-2xl text-center text-white5">
                        <h2>Barang</h2>
                    </div>
                    <div class="flex flex-wrap bg-black4 w-[98%] ml-2 rounded-lg p-1 h-auto">
                        @foreach ($Barang as $item)
                            <div class="main-input p-2">
                                <div
                                    class="input flex bg-black3 items-center text-white5 w-72 p-2 rounded-lg transition transform hover:scale-95">
                                    <label class="flex w-40">
                                        <input type="checkbox" name="barang[{{ $item->id_barang }}][id_barang]"
                                            value="{{ $item->id_barang }}" class="mr-2">
                                        {{ $item->nama_barang }} ({{ $item->stok }})
                                    </label>
                                    <input type="number" name="barang[{{ $item->id_barang }}][harga]"
                                        placeholder="Harga Satuan"
                                        class="ml-2 mt-2 rounded-lg p-1 h-7 w-[30%] text-black bg-white">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="total">
                        <input type="number" name="total_harga_barang" placeholder="Total harga barang"
                            class="ml-2 mt-5 rounded-lg p-1 h-7 w-[98%] text-black bg-white">
                    </div>

                    <!-- Jasa -->
                    <div class="main-txt p-2 font-semibold text-2xl text-center text-white5">
                        <h2>Jasa</h2>
                    </div>
                    <div class="flex flex-wrap bg-black4 w-[98%] ml-2 rounded-lg p-1 h-auto">
                        @foreach ($Jasa as $item)
                            <div class="main-input p-2">
                                <div
                                    class="input flex bg-black3 items-center text-white5 p-2 w-64 rounded-lg transition transform hover:scale-95">
                                    <label class="flex w-40">
                                        <input type="checkbox" name="jasa[{{ $item->id_jasa }}][id_jasa]"
                                            value="{{ $item->id_jasa }}" class="mr-2">
                                        {{ $item->nama_jasa }}
                                    </label>
                                    <input type="number" name="jasa[{{ $item->id_jasa }}][harga]"
                                        placeholder="Harga Satuan"
                                        class="ml-2 mt-2 rounded-lg p-1 h-7 w-[40%] text-black bg-white">
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="total">
                        <input type="number" name="total_harga_jasa" placeholder="Total harga jasa"
                            class="ml-2 mt-5 rounded-lg p-1 h-7 w-[98%] text-black bg-white">
                    </div>
                    <div class="total">
                        <input type="number" name="total_harga_semua" placeholder="Total harga semuanya" class="ml-2 mt-5 rounded-lg p-1 h-7 w-[98%] text-black bg-white" readonly>
                    </div>
                    <div class="total flex">
                        <input type="number" name="dibayar" placeholder="dibayar" class="ml-2 mt-5 rounded-lg p-1 h-7 w-[49%] text-black bg-white">
                        <input type="number" name="kembalian" placeholder="kembalian" class="ml-2 mt-5 rounded-lg p-1 h-7 w-[48%] text-black bg-white" readonly>
                    </div>

                    <div class="main-btn mt-4 ml-3 mb-3">
                        <button type="submit"
                            class="bg-black4 text-white5 rounded-lg h-10 w-[98%] border-2 border-black4 hover:bg-white5 hover:text-black3 transition-colors duration-500">
                            Tambah Transaksi
                        </button>
                    </div>
                </form>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div id="list" class="harga hidden bg-white5 absolute w-96 right-10 top-14 rounded-lg transition-all duration-500">
        <div class="tabel-harga">
            <span class="close ml-[22rem] text-3xl font-semibold"><button class=""><i class='bx bx-x'></i></button></span>
            <h2 class="text-center font-semibold text-2xl">Daftar Harga</h2>
            <table class=" table-fixed ml-12 my-2">
                <thead>
                    <tr>
                        <th class="border-black border-t-2 border-b-2 border-l-2 w-36 text-start pl-2">barang</th>
                        <th class="border-black border-t-2 border-b-2 border-r-2 w-36 text-start">harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Barang as $list)
                        <tr>
                            <td class=" border-b-2 border-l-2 pl-2 border-black">{{ $list->nama_barang }}</td>
                            <td class=" border-b-2 border-r-2 border-black">
                                Rp{{ number_format($list->harga_barang, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            <table class="table-fixed ml-10 my-2 ">
                <thead>
                    <tr>
                        <th class="border-black border-t-2 border-l-2 border-b-2 w-44 pl-2 text-start">nama jasa</th>
                        <th class="border-black border-t-2 border-r-2 border-b-2 w-32 text-start">harga jasa
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Jasa as $list)
                        <tr>
                            <td class=" border-b-2 border-l-2 pl-2 border-black">{{ $list->nama_jasa }}</td>
                            <td class=" border-b-2 border-r-2 border-black">
                                Rp{{ number_format($list->harga_jasa, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkboxesBarang = document.querySelectorAll('input[type="checkbox"][name^="barang"]');
        const checkboxesJasa = document.querySelectorAll('input[type="checkbox"][name^="jasa"]');
        const totalHargaBarangInput = document.querySelector('input[name="total_harga_barang"]');
        const totalHargaJasaInput = document.querySelector('input[name="total_harga_jasa"]');
        const totalHargaSemuaInput = document.querySelector('input[name="total_harga_semua"]');
        const dibayarInput = document.querySelector('input[name="dibayar"]');
        const kembalianInput = document.querySelector('input[name="kembalian"]');

        function hitungTotal(checkboxes) {
            let total = 0;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const hargaInput = checkbox.closest('.input').querySelector('input[type="number"]');
                    const harga = parseFloat(hargaInput.value) || 0;
                    total += harga;
                }
            });
            return total;
        }

        function updateTotal() {
            const totalBarang = hitungTotal(checkboxesBarang);
            const totalJasa = hitungTotal(checkboxesJasa);
            const totalSemua = totalBarang + totalJasa;

            totalHargaBarangInput.value = totalBarang;
            totalHargaJasaInput.value = totalJasa;
            totalHargaSemuaInput.value = totalSemua;

            updateKembalian();
        }

        function updateKembalian() {
            const totalSemua = parseFloat(totalHargaSemuaInput.value) || 0;
            const dibayar = parseFloat(dibayarInput.value) || 0;
            kembalianInput.value = Math.max(0, dibayar - totalSemua);
        }

        // Event listeners untuk checkbox dan input harga
        checkboxesBarang.forEach(checkbox => {
            checkbox.addEventListener('change', updateTotal);
            const hargaInput = checkbox.closest('.input').querySelector('input[type="number"]');
            if (hargaInput) {
                hargaInput.addEventListener('input', updateTotal);
            }
        });

        checkboxesJasa.forEach(checkbox => {
            checkbox.addEventListener('change', updateTotal);
            const hargaInput = checkbox.closest('.input').querySelector('input[type="number"]');
            if (hargaInput) {
                hargaInput.addEventListener('input', updateTotal);
            }
        });

        // Event listener untuk input dibayar
        dibayarInput.addEventListener('input', updateKembalian);

        // Panggil updateTotal saat halaman dimuat untuk menginisialisasi nilai
        updateTotal();
    });
    const hargaBtn = document.getElementById('hargaBtn');
    const list = document.getElementById('list');

    hargaBtn.addEventListener('click', () => {
        list.classList.toggle('hidden');
    });

    document.addEventListener('click', (event) => {
        if (!hargaBtn.contains(event.target)) {
            list.classList.add('hidden');
        }
    });
</script>

</html>
