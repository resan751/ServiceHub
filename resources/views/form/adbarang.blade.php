<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>input barang</title>
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

            body {
                background-image: url('image/ms3.jpeg');
                background-repeat: no-repeat;
                background-size: 100%
            }
        </style>
</head>
<body class=" font-jakarta">
   <div class="main h-full w-4/12 bg-black3">
    <div class="main-back">
        <div class="back w-full ">
            <button class="text-white2 bg-black p-1 text-center mt-1 ml-1 rounded-md hover:scale-95 hover:text-white">
                <i class='bx bx-left-arrow-alt'></i>
                <a href="barang">back</a>
            </button>
        </div>
        <div class="main-head text-center text-4xl text-white font-bold">
            <h2>tambah barang</h2>
        </div>
        <div class="icon text-center text-9xl mt-3 mb-12 text-white">
            <i class='bx bx-wrench'></i>
        </div>
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            <div class="main-menu text-center">
                <div class="main-input mb-5"><input type="text" class="w-5/6 h-8 p-1 rounded-lg" name="nama_barang" placeholder="nama barang" id=""></div>
                <div class="main-input mb-5"><input type="number" class="w-5/6 h-8 p-1 rounded-lg" name="harga_barang" placeholder="harga barang" id=""></div>
                <div class="main-input mb-5"><input type="number" class="w-5/6 h-8 p-1 rounded-lg" name="stok" placeholder="stok" id=""></div>
                <div class="main-btn">
                    <button type="submit" class="mt-40 bg-white w-5/6 h-8 rounded-md hover:border-2 hover:border-black hover:bg-white2"><i class='bx bx-plus'></i>tambah</button>
                </div>
            </div>
        </form>
    </div>
   </div>
</body>
</html>
