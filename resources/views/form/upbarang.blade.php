<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>update barang</title>
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
<body class=" font-jakarta bg-black3">
    <div class="back absolute ml-1 mt-1">
        <button class="text-white2 bg-black p-1 text-center mt-1 ml-1 rounded-md hover:scale-95 hover:text-white">
            <i class='bx bx-left-arrow-alt'></i>
            <a href="{{ route('barang.index') }}">back</a>
        </button>
    </div>
    <div class="flex justify-center">
        <div class="main bg-black1 w-2/6 h-96 mt-24 rounded-3xl justify-center flex  ">
            <div class="main-back w-11/12">
            <div class="main-head p-3 pb-5 text-2xl font-semibold text-center text-white">
                <h1>UPDATE BARANG</h1>
            </div>
            <form action="{{ route('barang.update', $Barang->id_barang) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="main-menu">
                    <div class="main-input mt-3"><input type="text"  name="nama_barang" placeholder="nama barang" class="w-full h-9 rounded-lg" value="{{ $Barang->nama_barang }}" id=""></div>
                    <div class="main-input mt-5"><input type="number" name="harga_barang" placeholder="harga barang" class="w-full h-9 rounded-lg" value="{{ $Barang->harga_barang }}" id=""></div>
                    <div class="main-input mt-5"><input type="number" name="stok" placeholder="stok" class="w-full h-9 rounded-lg" value="{{ $Barang->stok }}" id=""></div>
                    <div class="main-btn w-full h-10 p-2 mt-28 bg-black2 text-white2 hover:text-white hover:bg-black rounded-lg text-center"><button class="w-full" type="submit">Update</button></div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
